function formatRupiah(angka, prefix) {
	var number_string = angka.toString().replace(/[^,\d]/g, ''),
	split = number_string.split(','),
	sisa = split[0].length % 3,
	rupiah = split[0].substr(0, sisa),
	ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
}

function getInputDateValue(dateValue) {
	const date = dateValue ? new Date(dateValue) : new Date();
	
	let day = ('0' + date.getDate()).slice(-2);
	let month = ('0' + (date.getMonth() + 1)).slice(-2);
	let year = date.getFullYear();
	
	return year + '-' + month + '-' + day;
}

const convertRupiah = function (e) {
	if (e.type === 'keydown') {
		key = e.which || e.keyCode;
		if (
			key != 188 && // Comma
			key != 8 && // Backspace
			key != 17 &&
			(key != 86) & (key != 67) && // Ctrl c, ctrl v
			(key < 48 || key > 57) // Non digit
			) {
			e.preventDefault();
		}
		} else if (e.type === 'keyup') {
		let angka = $(this).val(),
		number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
		
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		$(this).val(rupiah);
	}
};

function fnExcelReport(table) {
	var tab_text = "<table border='2px'><tr>";
	var textRange;
	var j = 0;
	tab = document.getElementById(table);
	
	for (j = 0; j < tab.rows.length; j++) {
		tab_text = tab_text + tab.rows[j].innerHTML + '</tr>';
		//tab_text=tab_text+"</tr>";
	}
	
	tab_text = tab_text + '</table>';
	tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ''); //remove if u want links in your table
	tab_text = tab_text.replace(/<img[^>]*>/gi, ''); // remove if u want images in your table
	tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ''); // reomves input params
	
	var ua = window.navigator.userAgent;
	var msie = ua.indexOf('MSIE ');
	
	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
		// If Internet Explorer
		txtArea1.document.open('txt/html', 'replace');
		txtArea1.document.write(tab_text);
		txtArea1.document.close();
		txtArea1.focus();
		sa = txtArea1.document.execCommand('SaveAs', true, 'Say Thanks to Sumit.xls');
	} //other browser not tested on IE 11
	else sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
	
	return sa;
}

function monthName(param) {
	const month = [
		'januari',
		'februari',
		'maret',
		'april',
		'mei',
		'juni',
		'juli',
		'agustus',
		'september',
		'oktober',
		'november',
		'desember',
	];
	return month[param];
}

function semester(param) {
	switch (parseInt(param)) {
		case 9:
		return 1;
		break;
		case 11:
		return 2;
		break;
		case 1:
		return 3;
		break;
		case 3:
		return 4;
		break;
		case 5:
		return 5;
		break;
		case 7:
		return 6;
		break;
	}
}

function formatDateId(param = null, time = null) {
	const date = param ? new Date(param.replace(/ /g, 'T')) : new Date();
	let day = ('0' + date.getDate()).slice(-2);
	let month = monthName(date.getMonth());
	let year = date.getFullYear();
	if (!time) {
		return day + ' ' + month + ' ' + year;
		} else {
		let hour = ('0' + date.getHours()).slice(-2);
		let minutes = ('0' + date.getMinutes()).slice(-2);
		let seconds = ('0' + date.getSeconds()).slice(-2);
		// prettier-ignore
		return day + ' ' + month + ' ' + year + ' | ' + hour + ':' + minutes + ':' + seconds
	}
}

function alerts(option = null) {
	return Swal.mixin({
		customClass: {
			title: 'fw-500',
			actions: 'mx-0',
			popup: 'rounded-3',
			confirmButton: `btn ${option == 'danger' ? 'btn-danger' : 'btn-success'} col-4 mx-1`,
			cancelButton: `btn btn-outline-success col-4 mx-1`,
			denyButton: 'btn col-4 mx-1',
		},
		buttonsStyling: false,
		reverseButtons: true,
	});
}

function toast(position) {
	return alerts().mixin({
		toast: true,
		position: position ?? 'top-end',
		showConfirmButton: false,
		timerProgressBar: true,
		timer: 2000,
	});
}

const spinner = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;
const rulesConfirmElement = `<span class="d-block text-center">
Anda akan melanjutkan ke <strong>Proses Pembayaran</strong> pendaftaran atau <strong>Periksa Data</strong> anda kembali apabila masih ada data yang tidak sesuai.
</span>
<div class="text-start">
<h5 class="text-center text-danger mt-3 mb-0">Catatan Penting:</h5>
<ol>
<li>Data tidak dapat di edit setelah proses pembayaran.</li>
<li>Tidak di perkenankan berpindah ke unit lain setelah submit form.</li>
<li>Apabila anda melakaukan cabut berkas maka tidak ada pengembalian uang pembayaran dalam bentuk apapun.</li>
</ol>
</div>`;

const sweetAlertButtonClass = {
	popup: 'rounded-3',
	confirmButton: 'btn btn-success rounded-pill px-5',
	cancelButton: 'btn btn-outline-success rounded-pill px-5',
};

const generateFormValue = ({
	nis,
	nisn,
	nama,
	gender,
	tempatLahir,
	tanggalLahir,
	pondok,
	namaAyah,
	namaIbu,
	dusun,
	provinsi,
	kabupaten,
	kecamatan,
	kelurahan,
}) => {
console.log(provinsi)
$('#nis').val(nis);
$('#nama').val(nama);
$('#gender').val(gender);
$('#birthPlace').val(tempatLahir);
$('#birthday').val(tanggalLahir);
$('#nisn').val(nisn);
$('#statusSantri').val('Naik Tingkatan');

$('#pondok').val(pondok.id);
$('#namaAyah').val(namaAyah);
$('#namaIbu').val(namaIbu);

$('#dusun').val(dusun);
// $('#form_prov').val(provinsi)
$("#form_prov option[value='36']").selected = true;
// $('#form_kab').val(kabupaten).attr("selected", "selected");
// $('#form_kab').val(kabupaten).change();
// $('#form_kab').html(`<option value="${kabupaten.id}">${kabupaten.text}</option>`).val(kabupaten.id);
// $('#form_kec').html(`<option value="${kecamatan.id}">${kecamatan.text}</option>`).val(kecamatan.id);
// $('#form_des').html(`<option value="${kelurahan.id}">${kelurahan.text}</option>`).val(kelurahan.id);
};

const generateSelectOption = (elemetId, data, header = true) => {
	const headerOption = header ? `<option value="">Pilih</option>` : '';
	const option = data.map(({ id, text }) => `<option value="${id}">${text}</option>`).join('');
	$(elemetId).html(headerOption + option);
};

const rincianPembayaran = (data) => {
	return data.map(
		// prettier-ignore
		({ billCategory, billDesc, billAmount }) =>
		`<div class="d-flex pb-1">
		<input class="form-check-input me-2" name="${billCategory}" type="checkbox" value="${billAmount}" id="${billCategory}" checked ${ billCategory === 'tahap1' ? 'disabled' : '' }>
        <label class="w-100" for="${billCategory}">
		<div class="d-flex justify-content-between">
		<span>${billDesc}</span>
		<span class="tahap${billCategory}">${formatRupiah(billAmount)}</span>
		</div>
        </label>
		</div>`
	);
};

// // prettier-ignore
// const successPage = ({ nis, nama, unit, payment: { bank, nomorVa, nominal } }) =>
// `<main class="container-md mb-4" style="display: none;">
// <h4 class="my-4 text-dark text-center">Pendaftaran Berhasil</h4>

// <h5>Detail Pendaftaran</h5>
// <ul class="list-group">
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Nomor pendaftaran</small>
// </div>
// <div class="col-auto">
// <span>${nis}</span>
// </div>
// </div>
// </li>
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Nama Lengkap</small>
// </div>
// <div class="col-auto">
// <span>${nama}</span>
// </div>
// </div>
// </li>
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Unit Pendidikan</small>
// </div>
// <div class="col-auto">
// <span>${unit}</span>
// </div>
// </div>
// </li>
// </ul>

// <h5 class="mt-3">Detail Tagihan</h5>
// <ul class="list-group">
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Metode pembayaran</small>
// </div>
// <div class="col-auto">
// <span>${bank.toUpperCase()} Virtual Account</span>
// </div>
// </div>
// </li>
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Nomor Virtual Account</small>
// </div>
// <div class="col-auto">
// <span>${nomorVa}</span>
// </div>
// </div>
// </li>
// <li class="list-group-item container">
// <div class="row align-items-center">
// <div class="col-md-3">
// <small class="text-secondary">Total Tagihan</small>
// </div>
// <div class="col-auto">
// <span>Rp. ${formatRupiah(nominal)}</span>
// </div>
// </div>
// </li>
// </ul>

// <div class="mt-3 text-secondary">
// <p>Silahkan lakukan pembayaran sesuai dengan nominal yang tertera untuk mempercepat proses vertifikasi pembayaran. Setelah melakukan pembayaran, sistem kami akan memverifikasi pembayaran secara otomatis.</p>
// <p>Jika anda menghadapi kendala mengenai pembayaran, silakan hubungi kami ke nomor telepon <strong>082321540000</strong></p>
// </div>
// </main>`;
