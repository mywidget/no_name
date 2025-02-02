<?php
	defined('BASEPATH') or exit('No direct script access allowed');
	
	class Smart_billing extends CI_Controller
	{
		private $biller_name = 'Ponpes Tebuireng 4 Al Ishlah';
		private $secret_key = 'Ewpai69JTcDh7n45K0YMfdCrqmoOS8zjZb1k2uls';
		public function __construct()
		{
			parent::__construct();
			
			
			$this->title = tag_key('site_title');
			
			 $this->load->model('Model_tagihan');
			$this->menu = $this->uri->segment(1); 
			$this->perPage = 10;
		}
		
		public function index()
        {
			cek_session_login(1);
			$this->iduser = $this->session->iduser; 
            $this->level = $this->session->level; 
            $this->idlevel = $this->session->idlevel; 
			cek_menu_akses();
			cek_crud_akses('READ');
			$data['title'] = 'Smart billing BSI | '.$this->title;
			$data['menu'] = getMenu($this->menu);
			
			$data['tagihan'] = $this->Model_tagihan->get_tagihan_data();
			dump($data['tagihan']);
			// $this->thm->load('backend/template','backend/unit_kelas/view_index',$data);
		}
		
		public function inquiry()
        {
			$allowed_collecting_agents	= array('BSM');
			$allowed_channels 		= array('TELLER', 'IBANK', 'ATM', 'MBANK', 'FLAGGING');
			debugLog('REQUEST: ');
			$request = file_get_contents('php://input'); 
			debugLog($request);
			$_JSON = json_decode($request, true);
			
			debugLog($_JSON);
			
			// PARAMATER DI BAWAH INI ADALAH VARIABEL YANG DITERIMA DARI BSI
			$kodeBank			= $_JSON['kodeBank'];
			$kodeChannel			= $_JSON['kodeChannel'];
			$kodeBiller			= $_JSON['kodeBiller'];
			$kodeTerminal			= $_JSON['kodeTerminal'];
			$nomorPembayaran		= $_JSON['nomorPembayaran'];
			$tanggalTransaksi		= $_JSON['tanggalTransaksi'];
			$idTransaksi			= $_JSON['idTransaksi'];
			$totalNominalInquiry		= $_JSON['totalNominalInquiry'];
			
			// PERIKSA APAKAH SELURUH PARAMETER SUDAH LENGKAP
			if (empty($kodeBank) || empty($kodeChannel) || empty($kodeTerminal) || 
			empty($nomorPembayaran) || empty($tanggalTransaksi) || empty($idTransaksi)) {
				$response = json_encode(array(
				'rc' => 'ERR-PARSING-MESSAGE',
				'msg' => 'Invalid Message Format' 
				));
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH KODE BANK DIIZINKAN MENGAKSES WEBSERVICE INI
			
			if (!in_array($kodeBank, $allowed_collecting_agents)) {
				$response = json_encode(array(
				'rc' => 'ERR-BANK-UNKNOWN',
				'msg' => 'Collecting agent is not allowed by '.$this->biller_name
				));
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH KODE CHANNEL DIIZINKAN MENGAKSES WEBSERVICE INI
			
			if (!in_array($kodeChannel, $allowed_channels)) {
				$response = json_encode(array(
				'rc' => 'ERR-CHANNEL-UNKNOWN',
				'msg' => 'Channel is not allowed by '.$this->biller_name
				));
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH CHECKSUM VALID
			
			if (sha1($_JSON['nomorPembayaran'].$this->secret_key.$_JSON['tanggalTransaksi']) != 
			$_JSON['checksum']) {
				$response = json_encode(array(
				'rc' => 'ERR-SECURE-HASH',
				'msg' => 'H2H Checksum is invalid'
				));
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// Retrieve the latest record based on nomor_siswa
			$query = $this->db->select('*')
			->from('tagihan_pembayaran')
			->where('nomor_siswa', $nomorPembayaran)
			->order_by('tanggal_invoice', 'DESC')
			->limit(1)
			->get();
			
			// Fetch the result
			$data_cek_available = $query->row_array();
			debugLog($data_cek_available);
			// Debugging log (if needed)
			log_message('debug', print_r($data_cek_available, true));
			
			// Check if nama is empty or not
			if (empty($data_cek_available['nama'])) {
				// Return error response if 'nama' is empty
				$response = json_encode(array(
				'rc' => 'ERR-NOT-FOUND',
				'msg' => 'Nomor Tidak Ditemukan'
				));
				debugLog('RESPONSE: ' . $response); 
				log_message('debug', 'RESPONSE: ' . $response); // Log the response
				echo $response;
				exit();
			}
			
			$this->load->database(); // Ensure the database is loaded
			
			// Retrieve the latest record where nomor_siswa matches and status_pembayaran is NULL
			$query = $this->db->select('*')
			->from('tagihan_pembayaran')
			->where('nomor_siswa', $nomorPembayaran)
			->where('status_pembayaran', NULL)
			->order_by('tanggal_invoice', 'DESC')
			->limit(1)
			->get();
			
			// Fetch the result
			$data_tagihan = $query->row_array();
			debugLog($data_tagihan);
			// Debugging log (if needed)
			log_message('debug', print_r($data_tagihan, true));
			
			// Check if 'nama' is empty or not
			if (empty($data_tagihan['nama'])) {
				// If nama is empty, it means the payment is already made
				$response = json_encode(array(
				'rc' => 'ERR-ALREADY-PAID',
				'msg' => 'Sudah Terbayar'
				));
				debugLog('RESPONSE: ' . $response); 
				log_message('debug', 'RESPONSE: ' . $response); // Log the response
				echo $response;
				exit();
			}
			
			// Extracting the data from the result
			$nama = $data_tagihan['nama'];
			$id_tagihan = $data_tagihan['id_invoice'];
			$all_info = $data_tagihan['informasi'];
			
			// Split the information into two parts
			$info1 = substr($all_info, 0, 30);
			$info2 = substr($all_info, 30, 30);
			
			// Prepare the array for the 'informasi' field
			$arr_informasi = [
			['label_key' => 'Info1', 'label_value' => $info1],
			['label_key' => 'Info2', 'label_value' => $info2],
			];
			
			// Prepare the 'rincian' field
			$nominalTagihan = intval($data_tagihan['nominal_tagihan']);
			$arr_rincian = [
			[
			'kode_rincian' => 'TAGIHAN',
			'deskripsi' => 'TAGIHAN',
			'nominal' => $nominalTagihan
			],
			];
			
			// Prepare the final response data
			$data_inquiry = [
			'rc' => 'OK',
			'msg' => 'Inquiry Succeeded',
			'nomorPembayaran' => $nomorPembayaran,
			'idPelanggan' => $nomorPembayaran,
			'nama' => $nama,
			'totalNominal' => $nominalTagihan,
			'informasi' => $arr_informasi,
			'rincian' => $arr_rincian,
			'idTagihan' => $id_tagihan,
			];
			
			// Encode the response to JSON
			$response_inquiry = json_encode($data_inquiry);
			
			// Debugging log for the response
			log_message('debug', 'RESPONSE: ' . $response_inquiry);
			debugLog('RESPONSE: ' . $response_inquiry); 
			// Set the header for JSON response
			header('Content-Type: application/json');
			
			// Send the JSON response
			echo $response_inquiry;
			exit();
			
		}
		
		public function processPayment() {
			$allowed_collecting_agents	= array('BSM');
			$allowed_channels 		= array('TELLER', 'IBANK', 'ATM', 'MBANK', 'FLAGGING');
			$request = file_get_contents('php://input'); 
			debugLog($request);
			$_JSON = json_decode($request, true);
			
			$kodeBank             = $_JSON['kodeBank'];
			$kodeChannel          = $_JSON['kodeChannel'];
			$kodeBiller           = $_JSON['kodeBiller'];
			$kodeTerminal         = $_JSON['kodeTerminal'];
			$nomorPembayaran      = $_JSON['nomorPembayaran'];
			$idTagihan            = $_JSON['idTagihan'];
			$tanggalTransaksi     = $_JSON['tanggalTransaksi'];
			$idTransaksi          = $_JSON['idTransaksi'];
			$totalNominal         = $_JSON['totalNominal'];
			$nomorJurnalPembukuan = $_JSON['nomorJurnalPembukuan'];
			
			// PERIKSA APAKAH SELURUH PARAMETER SUDAH LENGKAP
			if (empty($kodeBank) || empty($kodeChannel) || empty($kodeTerminal) || 
			empty($nomorPembayaran) || empty($tanggalTransaksi) || empty($idTransaksi) || 
			empty($totalNominal) || empty($nomorJurnalPembukuan)) {
				$response = json_encode(array(
				'rc' => 'ERR-PARSING-MESSAGE', 
				'msg' => 'Invalid Message Format'
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH KODE BANK DIIZINKAN MENGAKSES WEBSERVICE INI
			if (!in_array($kodeBank, $allowed_collecting_agents)) {
				$response = json_encode(array(
				'rc' => 'ERR-BANK-UNKNOWN',
				'msg' => 'Collecting agent is not allowed by ' . $this->biller_name
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH KODE CHANNEL DIIZINKAN MENGAKSES WEBSERVICE INI
			if (!in_array($kodeChannel, $allowed_channels)) {
				$response = json_encode(array(
				'rc' => 'ERR-CHANNEL-UNKNOWN',
				'msg' => 'Channel is not allowed by ' . $this->biller_name
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PERIKSA APAKAH CHECKSUM VALID
			if (sha1($nomorPembayaran . $this->secret_key . $tanggalTransaksi . $totalNominal . $nomorJurnalPembukuan) != $_JSON['checksum']) {
				$response = json_encode(array(
				'rc' => 'ERR-SECURE-HASH',
				'msg' => 'H2H Checksum is invalid'
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response);
				echo $response;
				exit();
			}
			
			// INQUIRY
			$this->load->database();
			
			// Query to check if the data exists
			$query = $this->db->select('*')
			->from('tagihan_pembayaran')
			->where('nomor_siswa', $nomorPembayaran)
			->order_by('tanggal_invoice', 'DESC')
			->limit(1)
			->get();
			
			$data_cek_available = $query->row_array();
			log_message('debug', print_r($data_cek_available, true));
			debugLog($data_cek_available);
			if (empty($data_cek_available['nama'])) {
				$response = json_encode(array(
				'rc' => 'ERR-NOT-FOUND',
				'msg' => 'Nomor Tidak Ditemukan'
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// Check if payment is already made
			$query = $this->db->select('*')
			->from('tagihan_pembayaran')
			->where('nomor_siswa', $nomorPembayaran)
			->where('status_pembayaran', NULL)
			->order_by('tanggal_invoice', 'DESC')
			->limit(1)
			->get();
			
			$data_tagihan = $query->row_array();
			log_message('debug', print_r($data_tagihan, true));
			debugLog($data_tagihan);
			if (empty($data_tagihan['nama'])) {
				$response = json_encode(array(
				'rc' => 'ERR-ALREADY-PAID',
				'msg' => 'Sudah Terbayar'
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// Additional validation for the payment amount
			$nominalTagihan = intval($data_tagihan['nominal_tagihan']);
			if ($nominalTagihan != $totalNominal) {
				$response = json_encode(array(
				'rc' => 'ERR-PAYMENT-WRONG-AMOUNT',
				'msg' => 'Terdapat kesalahan nilai pembayaran ' . $totalNominal . ' tidak sama dengan tagihan ' . $nominalTagihan
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			// PAYMENT - Start transaction
			log_message('debug', "START PAYMENT");
			debugLog("START PAYMENT"); 
			$this->db->trans_start(); // Start a transaction
			
			try {
				// Update payment status
				$data_update = array(
				'status_pembayaran' => 'SUKSES',
				'nomor_jurnal_pembukuan' => $nomorJurnalPembukuan,
				'waktu_transaksi' => date("Y-m-d H:i:s"),
				'channel_pembayaran' => $kodeChannel
				);
				
				$this->db->where('id_invoice', $data_tagihan['id_invoice']);
				$this->db->update('tagihan_pembayaran', $data_update);
				
				$this->db->trans_complete(); // Commit the transaction
				
				if ($this->db->trans_status() === FALSE) {
					throw new Exception('Error while updating transaction');
				}
				} catch (Exception $e) {
				$this->db->trans_rollback(); // Rollback if error occurs
				$response = json_encode(array(
				'rc' => 'ERR-DB',
				'msg' => 'Error saat Update Transaksi'
				));
				log_message('debug', 'RESPONSE: ' . $response);
				debugLog('RESPONSE: ' . $response); 
				echo $response;
				exit();
			}
			
			log_message('debug', "END PAYMENT");
			debugLog("END PAYMENT");
			// Prepare response data
			$data_payment = [
			'rc' => 'OK',
			'msg' => 'Payment Succeeded',
			'nomorPembayaran' => $nomorPembayaran,
			'idPelanggan' => $nomorPembayaran,
			'nama' => $data_tagihan['nama'],
			'totalNominal' => $nominalTagihan,
			'informasi' => [
            ['label_key' => 'Info1', 'label_value' => substr($data_tagihan['informasi'], 0, 30)],
            ['label_key' => 'Info2', 'label_value' => substr($data_tagihan['informasi'], 30, 30)]
			],
			'rincian' => [
            ['kode_rincian' => 'TAGIHAN', 'deskripsi' => 'TAGIHAN', 'nominal' => $nominalTagihan]
			],
			'idTagihan' => $data_tagihan['id_invoice']
			];
			
			// Send response
			$response_payment = json_encode($data_payment);
			log_message('debug', 'RESPONSE: ' . $response_payment);
			debugLog('RESPONSE: ' . $response_payment);
			header('Content-Type: application/json');
			echo $response_payment;
			exit();
		}
		
		
	}