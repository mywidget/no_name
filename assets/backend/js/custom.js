/** @type {string} */
var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search;
/** @type {!Array<string>} */
var pathArray = newURL.split("/");
// console.log(pathArray[3])
/** @type {number} */
var len = pathArray.length;
if (location.hostname === "localhost" || location.hostname === "127.0.0.1" || location.hostname === my_ip) {
	// console.log(pathArray)
	
	if (len > 5) {
		/** @type {string} */
		var url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4] + "/" + pathArray[5];
		} else if(len > 4){
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4];
		} else if(len > 3){
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3];
	}
	} else {
	if (len > 4) {
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3] + "/" + pathArray[4];
		} else {
		/** @type {string} */
		url = window.location.protocol + "//" + window.location.host + "/" + pathArray[3];
	}
}

$(".dropdown").on("shown.bs.dropdown", function(canCreateDiscussions) {
	$(".dropdown-menu input").focus();
});

function sweet_alert(p, color, icon, buttons,modal) {
    Swal.fire({
		icon : icon,
		title: p,
		text : color,
		showDenyButton: false,
		showCancelButton: false,
		confirmButtonText: "Close",
		denyButtonText: `Don't save`,
		customClass : {
            confirmButton : "btn btn-" + buttons
		},
        buttonsStyling : false
		}).then((result) => {
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			$("#"+modal).modal('hide');
			} else if (result.isDenied) {
			$("#"+modal).modal('hide');
		}
	});
}

function sweet(p, color, icon, buttons) {
    const $ = Swal.mixin({
        customClass : {
            confirmButton : "btn btn-" + buttons
		},
        buttonsStyling : false
	});
    $.fire({
        icon : icon,
        title : p,
        text : color
	});
}

showToastPosition = function(i, heading, message, iconType) {
	resetToastPosition();
	$.toast({
		heading : heading,
		text : message,
		position : String(i),
		icon : iconType,
		stack : false,
		loaderBg : "#f96868"
	});
};

resetToastPosition = function() {
	$(".jq-toast-wrap").removeClass("bottom-left bottom-right top-left top-right mid-center");
	$(".jq-toast-wrap").css({
		"top" : "",
		"left" : "",
		"bottom" : "",
		"right" : ""
	});
};
showNotif = function(pos, title, msg, show) {
	resetToastPosition();
	$.toast({
		heading : title,
		text : msg,
		position : String(pos),
		icon : show,
		stack : false,
		loaderBg : "#f96868"
	});
};
/**
	* @param {string} val
	* @param {number} precision
	* @param {string} prefix
	* @param {string} t
	* @param {string} decimal
	* @return {?}
*/
function formatMoney(val, precision, prefix, t, decimal) {
	val = val || 0;
	/** @type {number} */
	precision = !isNaN(precision = Math.abs(precision)) ? precision : 0;
	prefix = prefix !== undefined ? prefix : "";
	t = t || ".";
	decimal = decimal || ",";
	/** @type {string} */
	var sign = val < 0 ? "-" : "";
	/** @type {string} */
	var i = parseInt(val = Math.abs(+val || 0).toFixed(precision), 10) + "";
	/** @type {number} */
	var j = (j = i.length) > 3 ? j % 3 : 0;
	return prefix + sign + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (precision ? decimal + Math.abs(val - i).toFixed(precision).slice(2) : "");
}
/**
	* @param {!Object} options
	* @return {undefined}
*/
function formatNumber(options) {
	/** @type {string} */
	var url = "";
	var parts = options.value.toString().split("|");
	parts[0] = parts[0].replace(/[^0-9]/g, "");
	for (; parts[0].length > 3;) {
		/** @type {string} */
		url = "." + parts[0].substr(parts[0].length - 3, parts[0].length) + url;
		parts[0] = parts[0].substr(0, parts[0].length - 3);
	}
	options.value = parts[0] + url;
}
/**
	* @param {string} comment
	* @return {?}
*/
function angka(comment) {
	comment = comment ? comment : "";
	var sql = comment.replace("Rp", "");
	var newClassName = replaceAll(".", "", sql);
	return newClassName;
}
function KeyUpformatRupiah(angka) {
    // Menghapus semua karakter non-angka dan hanya mengambil angka saja
    var angkaHanyaAngka = angka.replace(/[^0-9]/g, '');
    
    // Jika input kosong atau hanya terdiri dari angka kosong, kembalikan string kosong
    if (!angkaHanyaAngka) return '';
	
    // Memastikan angka yang diproses dalam bentuk string
    var reverse = angkaHanyaAngka.toString().split('').reverse().join(''); // Membalik angka
    var ribuan = reverse.match(/\d{1,3}/g); // Memecah angka menjadi grup ribuan
    ribuan = ribuan.join('.').split('').reverse().join(''); // Menyambung grup ribuan dengan titik
    
    return 'Rp ' + ribuan; // Menambahkan simbol "Rp" di depan
}
function formatRupiah(angka) {
    // Memastikan angka adalah string atau angka
    if (typeof angka !== 'string' && typeof angka !== 'number') {
        return '';  // Jika bukan string atau number, kembalikan string kosong
    }

    // Konversi angka menjadi string jika angka berupa number
    angka = angka.toString();
    
    // Menghapus semua karakter non-angka dan hanya mengambil angka saja
    var angkaHanyaAngka = angka.replace(/[^0-9]/g, '');
    
    // Jika input kosong atau hanya terdiri dari angka kosong, kembalikan string kosong
    if (!angkaHanyaAngka) return '';

    // Memastikan angka yang diproses dalam bentuk string
    var reverse = angkaHanyaAngka.split('').reverse().join(''); // Membalik angka
    var ribuan = reverse.match(/\d{1,3}/g); // Memecah angka menjadi grup ribuan
    ribuan = ribuan.join('.').split('').reverse().join(''); // Menyambung grup ribuan dengan titik
    
    return 'Rp ' + ribuan; // Menambahkan simbol "Rp" di depan
}

function format_Rupiah(angka) {
	var angka = angka ? angka : 0;
	var reverse = angka.toString().split('').reverse().join(''); // Membalik angka
	var ribuan = reverse.match(/\d{1,3}/g); // Memecah angka menjadi grup ribuan
	ribuan = ribuan.join('.').split('').reverse().join(''); // Menyambung grup ribuan dengan titik
	return ribuan ?  ribuan : ''; // Menambahkan simbol "Rp" di depan
}
$(document).ready(function() {
	// Format input amount ke format rupiah
	$('.rupiah').on('input', function() {
		var nilai = $(this).val().replace(/[^\d]/g, ''); // Menghapus selain angka
		$(this).val(formatRupiah(nilai));
	});
	
	$('.rprp').on('input', function() {
		var nilai = $(this).val().replace(/[^\d]/g, ''); // Menghapus selain angka
		$(this).val(format_Rupiah(nilai));
	});
	
	
});
/**
	* @param {string} substr
	* @param {string} replacement
	* @param {string} str
	* @return {?}
*/
function replaceAll(substr, replacement, str) {
	for (; str.indexOf(substr) > -1;) {
		str = str.replace(substr, replacement);
	}
	return str;
}
/**
	* @return {undefined}
*/

function cek_notifikasi(){
	$.ajax({
		type: 'POST',
		url: base_url+'home/cek_notifikasi/',
		dataType:'json',
		success: function(html){
			if(html.status==true)
			{
				$("#modalNotif").modal('hide');
				}else{
				$("#modalNotif").modal('show');
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			sweet('Peringatan!!!',thrownError,'warning','warning');
			
		}
	});
}

// Fungsi logout yang memicu SweetAlert2 setelah logout
function alert_timer(timer=2000) {
	let timerInterval;
	Swal.fire({
		title: "Auto close alert!",
		html: "I will close in <b></b> milliseconds.",
		timer: timer,
		timerProgressBar: true,
		didOpen: () => {
			Swal.showLoading();
			const timer = Swal.getPopup().querySelector("b");
			timerInterval = setInterval(() => {
				timer.textContent = `${Swal.getTimerLeft()}`;
			}, 100);
		},
		willClose: () => {
			clearInterval(timerInterval);
		}
		}).then((result) => {
		/* Read more about handling dismissals below */
		if (result.dismiss === Swal.DismissReason.timer) {
			console.log("I was closed by the timer");
		}
	});
}
function alert_logout(base_url) {
	Swal.fire({
		title: "Form Login",
		icon: "warning",
		html: `
		<input type="email" id="email" class="swal2-input" placeholder="Enter your email" required>
		<input type="password" id="password" class="swal2-input" placeholder="Enter your password" required>
		`,
		confirmButtonText: "Login",
		showCancelButton: true,
		preConfirm: async () => {
			const email = document.getElementById('email').value;
			const password = document.getElementById('password').value;
			
			// Validasi input
			if (!email || !password) {
				Swal.showValidationMessage("Email dan kata sandi diperlukan");
				return false;
			}
			
			// Kirim data login ke controller CodeIgniter
			try {
				const response = await fetch(base_url+'login', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({ email, password })
				});
				
				const result = await response.json();
				if (!result.status) {
					return Swal.showValidationMessage(`Login gagal: ${result.message}`);
				}
				
				// Jika login berhasil
				Swal.fire({
					title: `Selamat Datang kembali, ${result.userName}!`,
					text: 'Anda telah berhasil masuk.',
					icon: 'success',
				});
				
				} catch (error) {
				Swal.showValidationMessage(`Permintaan gagal: ${error}`);
			}
		},
		allowOutsideClick: () => !Swal.isLoading(),
		didOpen: () => {
			// Pastikan input email mendapatkan fokus saat SweetAlert muncul
			document.getElementById('email').focus();
		}
		}).then((result) => {
		if (result.isConfirmed) {
			// Jika tombol "Login" ditekan
			// console.log("User logged in.");
			} else if (result.isDismissed) {
			// Jika tombol "Cancel" ditekan
			// console.log("Login canceled.");
			// Anda bisa menangani aksi lain di sini, seperti menampilkan pesan
			Swal.fire({
				title: "Anda membatalkan login!",
				text: "Anda dapat masuk lagi kapan saja.",
				icon: "info"
				}).then(() => {
				// Setelah pengguna menekan tombol OK pada alert ini, redirect ke halaman lain
				window.location.href = base_url+'auth'; // Ganti dengan URL tujuan yang sesuai
			});
		}
	});
}
