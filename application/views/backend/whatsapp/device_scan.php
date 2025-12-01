
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Device</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Device</li>
		</ol>
	</div>
    
    <div class="alert alert-info border">Pindai QR ini menggunakan multi perangkat whatsapp.</div>
    <div class="row">
        <div class="col-xl-7">
            <div class="card widget widget-stats-large shadow-none">
                <div class="card-header" id="logoutbutton" style="display: none;">
                    <button onclick="startSession()" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-refresh"></i> Start Ulang
					</button>
					<button type="button" class="btn btn-primary btn-sm" onclick="checkConnection()">
						<i class="mdi mdi-connection"></i> Check Connection
					</button>
					<button type="button" class="btn btn-warning btn-sm" onclick="startManualReconnection()">
						<i class="mdi mdi-reload"></i> Start Reconnection
					</button>
					<button type="button" class="btn btn-danger btn-sm" onclick="stopAllMonitoring()">
						<i class="mdi mdi-stop"></i> Stop All Monitoring
					</button>
					
				</div>
                <div class="card-body">
					<div id="qr-container">
						<div id="area-image" class="imageee text-center mb-2 d-flex justify-content-center align-items-center">
							<img src="<?= base_url() ?>assets/img/logo.png" height="200px" alt="Logo" id="qr-image" class="mx-auto d-block">
						</div>
						<div class="text-center mt-2" id="statusss">
							<button class="btn btn-primary mb-2" type="button" disabled>
								<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
								Menunggu inisialisasi...
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
        
        <div class="col-xl-5">
            <div class="card widget widget-stats-large shadow-none">
                <div class="card-header">
                    <button type="button" data-toggle="modal" data-target="#webhooks" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-message-settings-variant"></i> Informasi Device:
					</button>
				</div>
                <div class="card-body account">
                    <h6>Informasi Device:</h6>
                    <ul class="list-group account list-group-flush">
                        <li class="list-group-item p-0">Nama : <span id="nama">-</span></li>
                        <li class="list-group-item p-0">Nomor Device : <span id="number">-</span></li>
                        <li class="list-group-item p-0">Status : <span id="status-text">Menunggu...</span></li>
					</ul>
					<div class="d-flex gap-2 mt-3">
						<button onclick="logoutDevice()" class="btn btn-danger btn-sm scanbutton">
							<i class="mdi mdi-logout-variant"></i> Logout perangkat
						</button>
						<button onclick="getQRCode()" class="btn btn-warning btn-sm ml-2">
							<i class="mdi mdi-qrcode"></i> Refresh QR
						</button>
					</div>
					
				</div>
			</div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h6>Log Connection</h6>
				</div>
                <div class="card-body log-container pt-0">
                    <div id="logs">
                        <div class="log-entry">System initialized...</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk Start Session -->
<div class="modal fade" id="startSessionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Start Session</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Session Name:</label>
                    <input type="text" class="form-control" id="sessionName" value="<?= $row->device ?>">
				</div>
                <div class="form-group">
                    <label>Config (Optional):</label>
                    <textarea class="form-control" id="sessionConfig" rows="3" placeholder='{"printQRInTerminal": true}'></textarea>
				</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="startSessionWithConfig()">Start Session</button>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/backend/socket.io/client-dist/socket.io.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const baseUrl = '<?= base_url() ?>';
    const apiBaseUrl = '<?= $url_send ?>';
    const sessionName = '<?= $row->device ?>';
    var id_pengaturan = 1;
    let socket;
    let connectionCheckInterval = null;
    let reconnectInterval = null;
    let isReconnectionActive = false;
    let isConnected = false;
	
    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeConnection();
        checkExistingSession();
        
        // HAPUS startConnectionMonitoring() dari sini
        // Hanya lakukan pengecekan sekali di awal
        setTimeout(() => {
            checkConnection();
		}, 2000);
	});
	
    // Initialize Socket.IO connection
    function initializeConnection() {
        try {
            if (socket) {
                socket.disconnect();
                socket = null;
			}
			
            socket = io(apiBaseUrl, {
                transports: ['websocket', 'polling'],
                reconnection: false
			});
			
            socket.on('connect', () => {
                console.log('Socket.IO connected to server');
                addLog('Connected to server', 'success');
                isConnected = true;
                stopAllMonitoring(); // HENTIKAN SEMUA monitoring ketika connected
                checkExistingSession();
			});
			
            socket.on('disconnect', (reason) => {
                console.log('Socket.IO disconnected:', reason);
                addLog('Disconnected from server: ' + reason, 'warning');
                updateStatus('Disconnected', 'disconnected');
                isConnected = false;
                
                // Jangan start reconnection otomatis, tunggu manual check
			});
			
            socket.on('qr-updated', (data) => {
                if (data.session === sessionName) {
                    handleQRCode(data.qr);
				}
			});
			
            socket.on('connected', (data) => {
                if (data.session === sessionName) {
                    handleConnected(data);
				}
			});
			
            socket.on('disconnected', (data) => {
                if (data.session === sessionName) {
                    handleDisconnected(data);
				}
			});
			
            socket.on('session-status', (data) => {
                if (data.session === sessionName) {
                    updateStatus(data.status, data.status);
                    if (data.status === 'connected') {
                        stopAllMonitoring();
                        isConnected = true;
						} else {
                        isConnected = false;
					}
				}
			});
			
            socket.on('qr-status', (data) => {
                if (data.session === sessionName) {
                    addLog('QR Status: ' + data.message, 'info');
				}
			});
			
            socket.on('qr-error', (data) => {
                if (data.session === sessionName) {
                    addLog('QR Error: ' + data.error, 'error');
				}
			});
			
            socket.on('connect_error', (error) => {
                console.error('Socket connection error:', error);
                addLog('Connection error: ' + error.message, 'error');
                isConnected = false;
			});
			
			} catch (error) {
            console.error('Socket initialization error:', error);
            addLog('Failed to initialize connection: ' + error.message, 'error');
            isConnected = false;
		}
	}
	
	// MODIFIKASI: Fungsi stopAllMonitoring dengan SweetAlert2
    function stopAllMonitoring() {
        console.log('Stopping ALL monitoring...');
        
        // Hentikan reconnection check
        if (reconnectInterval) {
            clearInterval(reconnectInterval);
            reconnectInterval = null;
		}
        
        // Hentikan regular connection check
        if (connectionCheckInterval) {
            clearInterval(connectionCheckInterval);
            connectionCheckInterval = null;
		}
        
        isReconnectionActive = false;
        console.log('ALL monitoring stopped completely');
        addLog('All automatic monitoring stopped', 'info');
        
        // Tampilkan notifikasi jika diperlukan
        if (arguments.length > 0 && arguments[0] === 'showAlert') {
            Swal.fire({
                title: 'Monitoring Dihentikan',
                text: 'Semua proses monitoring telah dihentikan',
                icon: 'info',
                timer: 1500,
                showConfirmButton: false
			});
		}
	}
	
    // Fungsi untuk start reconnection (hanya dipanggil manual)
    function startReconnectionCheck() {
        console.log('Manual reconnection check started');
        
        // Jika sudah connected, tidak perlu reconnection
        if (isConnected) {
            addLog('Already connected, no reconnection needed', 'info');
            return;
		}
        
        // Hentikan yang lama
        stopAllMonitoring();
        
        isReconnectionActive = true;
        let attemptCount = 0;
        const maxAttempts = 5; // Batasi attempt reconnection
        
        reconnectInterval = setInterval(() => {
            attemptCount++;
            console.log(`Reconnection attempt ${attemptCount}`);
            
            // Jika sudah connected, stop reconnection
            if (socket && socket.connected) {
                addLog('Reconnected successfully!', 'success');
                stopAllMonitoring();
                return;
			}
            
            // Jika melebihi maksimal attempt, stop
            if (attemptCount > maxAttempts) {
                addLog('Max reconnection attempts reached', 'error');
                stopAllMonitoring();
                return;
			}
            
            // Attempt reconnect
            addLog(`Reconnection attempt ${attemptCount}/${maxAttempts}...`, 'warning');
            initializeConnection();
		}, 10000);
        
        addLog('Manual reconnection monitoring started', 'info');
	}
	
    // Handle connected event
    function handleConnected(data) {
        const user = data.user || {};
        
        // Update user info
        document.getElementById('nama').textContent = user.name || 'Unknown';
        document.getElementById('number').textContent = user.id || 'Unknown';
        
        // Update profile picture if available
        if (user.ppUrl) {
            document.getElementById('qr-image').src = user.ppUrl;
			} else if (user.id) {
            document.getElementById('qr-image').src = '<?= base_url() ?>assets/img/connected.jpg';
		}
        
        updateStatus('Connected', 'connected');
        addLog('WhatsApp connected successfully!', 'success');
        
        // Show logout button
        document.getElementById('logoutbutton').style.display = 'block';
        
        // Set flag connected
        isConnected = true;
        
        // HENTIKAN SEMUA monitoring
        stopAllMonitoring();
	}
	
    // Handle disconnected event
    function handleDisconnected(data) {
        updateStatus('Disconnected', 'disconnected');
        addLog('WhatsApp disconnected', 'warning');
        
        // Reset user info
        document.getElementById('nama').textContent = '-';
        document.getElementById('number').textContent = '-';
        
        // Show default image
        document.getElementById('qr-image').src = '<?= base_url() ?>assets/img/logo.png';
        
        // Hide logout button
        document.getElementById('logoutbutton').style.display = 'none';
        
        // Set flag disconnected
        isConnected = false;
        
        // Jangan start otomatis, tunggu manual check
	}
	
	// MODIFIKASI: Fungsi checkConnection dengan SweetAlert2
    async function checkConnection() {
        try {
            addLog('Manual connection check...', 'info');
            const response = await axios.get(`${apiBaseUrl}/test-connection/${sessionName}`);
            
            if (response.data.success) {
                if (response.data.connected) {
                    addLog('Manual check: Connected ✓', 'success');
                    updateStatus('Connected', 'connected');
                    cek_status_device(sessionName);
                    isConnected = true;
                    stopAllMonitoring();
					} else {
                    addLog('Manual check: Disconnected ✗', 'warning');
                    updateStatus('Disconnected', 'disconnected');
                    isConnected = false;
                    
                    // GANTI: alert dengan SweetAlert2
                    Swal.fire({
                        title: 'Device Disconnected',
                        text: 'Device disconnected. Start automatic reconnection?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Start Reconnection',
                        cancelButtonText: 'Tidak',
                        reverseButtons: true
						}).then((result) => {
                        if (result.isConfirmed) {
                            startReconnectionCheck();
						}
					});
				}
				} else {
                addLog('Manual check failed: ' + response.data.message, 'error');
                isConnected = false;
			}
			} catch (error) {
            addLog('Manual check failed: ' + error.message, 'error');
            isConnected = false;
		}
	}
	
	
    // Check existing session status
    async function checkExistingSession() {
        try {
            updateStatus('Checking session...', 'waiting');
            
            const response = await axios.get(`${apiBaseUrl}/status-session/${sessionName}`);
            
            if (response.data.success) {
                if (response.data.connected) {
                    handleConnected({
                        session: sessionName,
                        user: response.data.user
					});
					} else {
                    getQRCode();
				}
				} else {
                addLog('No active session found', 'info');
                startSession();
			}
			} catch (error) {
            console.error('Error checking session:', error);
            if (error.response && error.response.status === 404) {
                addLog('Session not found, starting new session', 'info');
                startSession();
				} else {
                addLog('Error checking session status: ' + error.message, 'error');
			}
		}
	}
	
    // Start session via Socket.IO
    function startSession() {
        addLog('Starting session...', 'info');
        updateStatus('Starting session...', 'waiting');
        
        if (socket && socket.connected) {
            socket.emit('start-session-with-qr', { session: sessionName });
			} else {
            addLog('Socket not connected, trying HTTP API...', 'warning');
            startSessionViaHTTP();
		}
	}
	
    // Start session via HTTP API (fallback)
    async function startSessionViaHTTP() {
        try {
            const response = await axios.post(`${apiBaseUrl}/session/starts`, {
                session: sessionName,
                config: {
                    printQRInTerminal: false
				}
			});
            
            if (response.data.success) {
                addLog('Session started successfully via HTTP', 'success');
                if (response.data.qr_pending) {
                    addLog('QR code pending, waiting for QR update...', 'info');
				}
				} else {
                addLog('Failed to start session: ' + response.data.message, 'error');
			}
			} catch (error) {
            console.error('Error starting session via HTTP:', error);
            addLog('Failed to start session: ' + error.message, 'error');
		}
	}
	
    // Get QR code via HTTP
    async function getQRCode() {
        try {
            updateStatus('Requesting QR code...', 'waiting');
            
            const response = await axios.get(`${apiBaseUrl}/session/qrcode/${sessionName}`);
            
            if (response.data.success) {
                if (response.data.connected) {
                    handleConnected({
                        session: sessionName,
                        user: response.data.user
					});
					} else if (response.data.qr) {
                    handleQRCode(response.data.qr);
					} else {
                    addLog('No QR available, starting new session...', 'info');
                    startSession();
				}
				} else {
                addLog('Failed to get QR: ' + response.data.message, 'error');
			}
			} catch (error) {
            console.error('Error getting QR:', error);
            if (error.response && error.response.status === 404) {
                addLog('Session not found, starting new session', 'info');
                startSession();
				} else {
                addLog('Error getting QR code: ' + error.message, 'error');
			}
		}
	}
	
    // Handle QR code received
    function handleQRCode(qrData) {
        try {
            const qrImage = document.getElementById('qr-image');
            
            if (qrData.startsWith('data:image')) {
                qrImage.src = qrData;
				} else if (qrData.startsWith('base64:')) {
                qrImage.src = 'data:image/png;base64,' + qrData.substring(7);
				} else {
                qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' + encodeURIComponent(qrData);
			}
            
            qrImage.style.display = 'block';
            updateStatus('Scan QR Code dengan WhatsApp', 'waiting');
            addLog('QR code received, please scan with WhatsApp', 'info');
            
            document.getElementById('logoutbutton').style.display = 'block';
			} catch (error) {
            console.error('Error handling QR code:', error);
            addLog('Error displaying QR code', 'error');
		}
	}
	
	// MODIFIKASI: Fungsi logoutDevice dengan SweetAlert2
    async function logoutDevice() {
        // GANTI: confirm dengan SweetAlert2
        const { value: userConfirmed } = await Swal.fire({
            title: 'Logout Device',
            text: 'Yakin ingin logout dari perangkat ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true
		});
        
        if (!userConfirmed) {
            return;
		}
        
        try {
            addLog('Logging out device...', 'info');
            
            const response = await axios.post(`${apiBaseUrl}/backend-logout-device`, {
                session: sessionName
			});
            
            if (response.data.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Device logged out successfully',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
				});
                
                addLog('Device logged out successfully', 'success');
                handleDisconnected({ session: sessionName });
                
                // Restart session after logout
                setTimeout(() => {
                    startSession();
				}, 2000);
				} else {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Logout failed: ' + response.data.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
				});
                addLog('Logout failed: ' + response.data.message, 'error');
			}
			} catch (error) {
            console.error('Error logging out:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Error logging out device: ' + error.message,
                icon: 'error',
                confirmButtonText: 'OK'
			});
            addLog('Error logging out device: ' + error.message, 'error');
		}
	}
	
    // Update status display
    function updateStatus(message, type) {
        const statusElement = document.getElementById('statusss');
        const statusText = document.getElementById('status-text');
        
        statusText.textContent = message;
        statusText.className = `status-${type}`;
        
        let buttonClass = 'btn-secondary';
        let icon = '';
        
        switch(type) {
            case 'connected':
			buttonClass = 'btn-success';
			icon = '<i class="mdi mdi-check-circle"></i>';
			break;
            case 'disconnected':
			buttonClass = 'btn-danger';
			icon = '<i class="mdi mdi-close-circle"></i>';
			break;
            case 'waiting':
			buttonClass = 'btn-warning';
			icon = '<i class="mdi mdi-clock"></i>';
			break;
		}
        
        statusElement.innerHTML = `
		<button class="btn ${buttonClass}" type="button" disabled>
		${icon} ${message}
		</button>
        `;
	}
	
    // // Add log entry
    // function addLog(message, type = 'info') {
        // const logsContainer = document.getElementById('logs');
        // const timestamp = new Date().toLocaleTimeString();
        
        // let badgeClass = 'badge-secondary';
        // switch(type) {
            // case 'success': badgeClass = 'badge-success'; break;
            // case 'error': badgeClass = 'badge-danger'; break;
            // case 'warning': badgeClass = 'badge-warning'; break;
            // case 'info': badgeClass = 'badge-info'; break;
		// }
        
        // const logEntry = document.createElement('div');
        // logEntry.className = 'log-entry mb-1';
        // logEntry.innerHTML = `
		// <span class="badge ${badgeClass}">${timestamp}</span> ${message}
        // `;
        
        // logsContainer.appendChild(logEntry);
        // logsContainer.scrollTop = logsContainer.scrollHeight;
	// }
	
	// MODIFIKASI: Fungsi startManualReconnection dengan SweetAlert2
    function startManualReconnection() {
        if (isConnected) {
            Swal.fire({
                title: 'Info',
                text: 'Already connected, no need to reconnect',
                icon: 'info',
                timer: 1500,
                showConfirmButton: false
			});
            addLog('Already connected, no need to reconnect', 'info');
            return;
		}
        
        Swal.fire({
            title: 'Start Reconnection',
            text: 'Apakah Anda yakin ingin memulai proses reconnection?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Mulai',
            cancelButtonText: 'Batal'
			}).then((result) => {
            if (result.isConfirmed) {
                addLog('Starting manual reconnection...', 'info');
                startReconnectionCheck();
                
                Swal.fire({
                    title: 'Dimulai!',
                    text: 'Reconnection process started',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
				});
			}
		});
	}
	
	
    // Handle page visibility change (optional - bisa dihapus jika tidak mau auto check)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            // Opsional: lakukan check ketika page visible
            // checkConnection();
		}
	});
	
    // Cleanup ketika page di-unload
    window.addEventListener('beforeunload', function() {
        stopAllMonitoring();
        if (socket) {
            socket.disconnect();
		}
	});
	
    // MODIFIKASI: Fungsi cek_status_device dengan SweetAlert2
    function cek_status_device(device) {
        $.ajax({
            url: base_url + 'whatsapp/cek_status_device',
            method: 'POST',
            data: {device: device, id_pengaturan: id_pengaturan},
            dataType: "json",
            success: function(response) {
                if(response.success == true && response.message == 'Connected') {
                    // GANTI: showNotif dengan SweetAlert2
                    Swal.fire({
                        title: 'Device Connected',
                        text: 'Device berhasil terkoneksi',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
					});
                    
                    $('#logoutbutton').removeClass('d-none');
                    isConnected = true;
                    stopAllMonitoring();
					} else if(response.success == true && response.message == 'Disconnect') {
                    // GANTI: showNotif dengan SweetAlert2
                    Swal.fire({
                        title: 'Device Disconnected',
                        text: response.message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
					});
                    
                    $('#logoutbutton').addClass('d-none');
                    isConnected = false;
					} else {
                    Swal.fire({
                        title: 'Device Not Connected',
                        text: 'Perangkat tidak terhubung',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
					});
                    isConnected = false;
				}
			},
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Update Error',
                    text: error,
                    icon: 'error',
                    confirmButtonText: 'OK'
				});
			}
		});
	}
	  // Fungsi tambahan untuk menampilkan error dengan SweetAlert2
    function showErrorAlert(title, message) {
        Swal.fire({
            title: title || 'Error',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#d33'
        });
    }

    // Fungsi tambahan untuk menampilkan success dengan SweetAlert2
    function showSuccessAlert(title, message) {
        Swal.fire({
            title: title || 'Success',
            text: message,
            icon: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    }

    // Fungsi tambahan untuk menampilkan info dengan SweetAlert2
    function showInfoAlert(title, message) {
        Swal.fire({
            title: title || 'Info',
            text: message,
            icon: 'info',
            timer: 1500,
            showConfirmButton: false
        });
    }

    // MODIFIKASI: Update fungsi addLog untuk notifikasi tertentu
    function addLog(message, type = 'info') {
        const logsContainer = document.getElementById('logs');
        const timestamp = new Date().toLocaleTimeString();
        
        let badgeClass = 'badge-secondary';
        switch(type) {
            case 'success': 
                badgeClass = 'badge-success'; 
                // Tampilkan toast untuk log success penting
                if (message.includes('connected successfully') || message.includes('logged out successfully')) {
                    showNotif('bottom-right', 'System', message, 'success');
                }
                break;
            case 'error': 
                badgeClass = 'badge-danger'; 
                // Tampilkan toast untuk error penting
                if (message.includes('Error') || message.includes('Failed') || message.includes('failed')) {
                    showNotif('bottom-right', 'Error', message, 'error');
                }
                break;
            case 'warning': 
                badgeClass = 'badge-warning'; 
                break;
            case 'info': 
                badgeClass = 'badge-info'; 
                break;
        }
        
        const logEntry = document.createElement('div');
        logEntry.className = 'log-entry mb-1';
        logEntry.innerHTML = `
            <span class="badge ${badgeClass}">${timestamp}</span> ${message}
        `;
        
        logsContainer.appendChild(logEntry);
        logsContainer.scrollTop = logsContainer.scrollHeight;
    }

    // Cleanup ketika page di-unload dengan SweetAlert2
    window.addEventListener('beforeunload', function(e) {
        if (isReconnectionActive) {
            // Tampilkan pesan konfirmasi jika ada proses reconnection aktif
            e.preventDefault();
            e.returnValue = 'Ada proses monitoring yang masih aktif. Yakin ingin meninggalkan halaman?';
            
            // Opsional: Tampilkan SweetAlert2
            Swal.fire({
                title: 'Monitoring Active',
                text: 'Ada proses monitoring yang masih aktif. Apakah Anda yakin ingin meninggalkan halaman?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tinggalkan',
                cancelButtonText: 'Tetap di Halaman'
            }).then((result) => {
                if (result.isConfirmed) {
                    stopAllMonitoring();
                    if (socket) {
                        socket.disconnect();
                    }
                    window.close();
                }
            });
        } else {
            stopAllMonitoring();
            if (socket) {
                socket.disconnect();
            }
        }
    });
	// Fungsi untuk menampilkan notifikasi dengan SweetAlert2
    function showNotif(position, title, message, type) {
        const Toast = Swal.mixin({
            toast: true,
            position: position,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
			}
		});
		
        Toast.fire({
            icon: type,
            title: title + ': ' + message
		});
	}
</script>