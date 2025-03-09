$(document).ready(function () {
    
    const countryData = window.intlTelInputGlobals.getCountryData();
    
    const input = document.querySelector("#telp");
    
    const iti = window.intlTelInput(input, {
        initialCountry: "id",
        hiddenInput: () => "full_phone",
        utilsScript: base_url_assets + "/build/js/utils.js"
    });
    input.addEventListener('keyup', function() {
        $('input[name="full_phone"]').val(iti.getNumber());
        $('input[name="full_phone_country"]').val(iti.getSelectedCountryData()['iso2']);
        // console.log(iti.getSelectedCountryData())
        
    });
    input.addEventListener('blur', function() {
        if (!iti.isValidNumber()) {
            $("#feedback-telp").html('Invalid nomor');
            $("#feedback-telp").addClass("text-danger");
            $("#telp").addClass("is-invalid text-danger");
            $("#form_simpan").prop("disabled", true);
            // console.log(1)
            } else {
            // console.log(2)
            $("#form_simpan").prop("disabled", false);
            $("#feedback-telp").html('');
            $("#feedback-telp").removeClass("text-danger").addClass('text-success');
            $("#telp").removeClass('is-invalid text-danger').addClass("is-valid text-success");
        }
    });
    // listen to the telephone input for changes
    input.addEventListener('countrychange', () => {
        $("#telp").change();
    });
    
    const input2 = document.querySelector("#telp2");
    
    const iti2 = window.intlTelInput(input2, {
        initialCountry: "id",
        hiddenInput: () => "full_phone_alternate",
        utilsScript: base_url_assets + "/build/js/utils.js"
    });
    input2.addEventListener('keyup', function() {
        $('input[name="full_phone_alternate"]').val(iti2.getNumber());
        $('input[name="full_phone_alternate_country"]').val(iti2.getSelectedCountryData()['iso2']);
        // console.log(iti.getSelectedCountryData())
        
    });
    input2.addEventListener('blur', function() {
        if (!iti2.isValidNumber()) {
            $("#feedback-telp-2").html('Invalid nomor');
            $("#feedback-telp").addClass("text-danger");
            $("#telp2").addClass("is-invalid text-danger");
            // $("#form_simpan").prop("disabled", true);
            // console.log(1)
            } else {
            // console.log(2)
            // $("#form_simpan").prop("disabled", false);
            $("#feedback-telp-2").html('');
            $("#feedback-telp-2").removeClass("text-danger").addClass('text-success');
            $("#telp2").removeClass('is-invalid text-danger').addClass("is-valid text-success");
        }
    });
    // listen to the telephone input for changes
    input2.addEventListener('countrychange', () => {
        $("#telp2").change();
    });
    
    new bootstrap.Modal('#kategori').show();
    
    $('#kategori #kategori-val').on('change', function (e) {
        const kategori = $(this).val();
        const isSantriBaru = kategori === 'baru';
        
        $('#nt-form').slideToggle();
        $('#nt-form input').attr('required', !isSantriBaru);
    });
    $('#kategori form').on('submit', function (e) {
        e.preventDefault();
        const kategori = $('#kategori-val', this).val();
        if (kategori === 'nt') {
            $('button', this).prop('disabled', true).html(spinner);
            $("#statusPendidikan").empty();
            $("#statusPendidikan").append("<option value='Baru'>Baru</option>");
            // console.log(1)
            const formData = {
                nis: $('#nt-noin', this).val(),
                namaIbu: $('#nt-namaibu', this).val(),
                tanggalLahir: $('#nt-tgllhr', this).val(),
            };
            
            $.ajax({
                type: 'post',
                data: formData,
                dataType: 'json',
                url: base_url +'santri',
                success: (response) => {
                    if (response.status === 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            customClass: sweetAlertButtonClass,
                            buttonsStyling: false,
                            }).then((params) => {
                            $('button', this).attr('disabled', false).text('Submit');
                        });
                    }
                    
                    if (response.status === 'success') {
                        generateFormValue(response.data);
                        // const santri = response.data;
                        // for (const key in santri) $(`#${key}`).val(santri[key]);
                        
                        $('button', this).attr('disabled', false).text('Submit');
                        bootstrap.Modal.getInstance($('#kategori')).hide();
                        
                        setTimeout(() => {
                            $('#kategori').remove();
                        }, 1000);
                    }
                },
            });
            } else {
            bootstrap.Modal.getInstance('#kategori').hide();
            setTimeout(() => {
                $('#kategori').remove();
            }, 1000);
        }
    });
});

// ambil data kelas ketika data memilih unit
$('body').on("change","#form_unit",function(){
    var id = $(this).val();
    var statusSantri = $('#statusPendidikan').val();
    load_kamar(id)
    load_biaya(id)
    // console.log(id)
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/kelas",
        data: {id:id,status:statusSantri},
        dataType : "json",
        beforeSend: function(){
            $("#form_kelas").empty();
            $("#form_biaya").empty();
            $("#form_kamar").empty();
            $("#form_kuota").empty();
            $("#form_kelas").append("<option value='0'>Pilih</option>");
        },
        success: function(response) {
            var msize = response.length;
            var i = 0;
            for (; i < msize; i++) {
                var teg = response[i]["id"];
                var name = response[i]["name"];
                $("#form_kelas").append("<option value='" + teg + "'>" + name + "</option>");
            }
        }
    });
});

$('body').on("change","#gender",function(){
    var status = $("#statusPendidikan").val();
    $("#statusPendidikan").val(status).change();
});

function load_biaya(id_unit){
    
    var thnakademik = $("#thnakademik").val();
    var status = $("#statusPendidikan").val();
    
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/biaya",
        data: {id:id_unit,status:status,thnakademik:thnakademik},
        dataType : "json",
        beforeSend: function(){
            $("#form_biaya").empty();
        },
        success: function(response) {
            
            var teg = response.id;
            var name = response.name;
            $("#form_biaya").append("<option value='" + teg + "'>" + name + "</option>");
            
        }
    });
    
}
function load_kamar(id)
{
    
    var gender = $("#gender").val();
    // console.log(gender)
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/load_kamar",
        data: {id:id,gender:gender},
        dataType : "json",
        beforeSend: function(){
            $("#form_kamar").empty();
        },
        success: function(response) {
            var len = response.length;
            if(len > 0){
                $("#form_kamar").append("<option value='0'>Pilih Kamar</option>");
                for (var i = 0; i < len; i++) {
                    var id = response[i]['id'];
                    
                    var name = response[i]['name'];
                    $("#form_kamar").append("<option value='" + id + "'>" + name + "</option>");
                }
                }else{
                $("#form_kamar").append("<option value='0'>Jenis Kelamin Belum dipilih</option>");
            }
        }
    });
}

$('body').on("change","#form_kamar",function(){
    var id = $(this).val();
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/kamar",
        data: {id:id},
        dataType : "json",
        beforeSend: function(){
            $("#form_kuota").empty();
        },
        success: function(response) {
            var teg = response.id;
            if(teg==0){
                alert('Maaf Kuota kamar kosong, pilih yang lain');
                $("#form_kamar").val(0);
                return
            }
            var name = response.name;
            $("#form_kuota").append("<option value='" + teg + "'>" + name + "</option>");
        }
    });
});

$("#form_prov").filter(function () {
    $.ajax({
        url: base_url+ "dashboard/provinsi",
        type: "POST",
        dataType: 'json',
        beforeSend: function () {
            $("#form_prov").append("<option value='loading'>loading</option>");
            $("#form_prov").attr("disabled", true);
        },
        success: function (response) {
            if(response.status==false){
                $("#form_prov").append("<option value='loading'>loading</option>");
                $("#form_prov").attr("disabled", true);
                $("#form_prov").attr("disabled", true);
                return;
            }
            $("#form_prov option[value='loading']").remove();
            $("#form_prov").attr("disabled", false);
            $("#form_prov").append("<option value=''>Pilih Provinsi</option>");
            var len = response.length;
            for (var i = 0; i < len; i++) {
                var id = response[i]['id'];
                var name = response[i]['name'];
                $("#form_prov").append("<option value='" + id + "'>" + name + "</option>");
            }
        }
    });
});
// ambil data kabupaten ketika data memilih provinsi
$('body').on("change","#form_prov",function(){
    var id = $(this).val();
    if (!id) { // Jika ID kosong, jangan lanjutkan
        $("#form_kab").empty().append("<option value=''>Pilih</option>").prop("disabled", true);
        return;
    }
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/kabupaten",
        data: {id:id},
        dataType : "json",
        beforeSend: function(){
            $("#form_kab").empty();
            $("#form_kec").empty().attr("disabled", true);
            $("#form_des").empty().attr("disabled", true);
            $("#form_kab").append("<option value=''>Pilih</option>");
        },
        success: function(response) {
            $("#form_kab").attr("disabled", false);
            var msize = response.length;
            var i = 0;
            for (; i < msize; i++) {
                var teg = response[i]["id"];
                var name = response[i]["name"];
                $("#form_kab").append("<option value='" + teg + "'>" + name + "</option>");
            }
        }
    });
});


$('body').on("change","#form_kab",function(){
    var id = $(this).val();
    if (!id) { // Jika ID kosong, jangan lanjutkan
        $("#form_kec").empty().append("<option value=''>Pilih</option>").prop("disabled", true);
        return;
    }
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/kecamatan",
        data: {id:id},
        dataType : "json",
        beforeSend: function(){
            $("#form_kec").empty();
            $("#form_des").empty().empty().attr("disabled", true);
            $("#form_kec").append("<option value=''>Pilih</option>");
        },
        success: function(response) {
            $("#form_kec").attr("disabled", false);
            var msize = response.length;
            var i = 0;
            for (; i < msize; i++) {
                var teg = response[i]["id"];
                var name = response[i]["name"];
                $("#form_kec").append("<option value='" + teg + "'>" + name + "</option>");
            }
        }
    });
});


$('#form_kec').on("change", function(){
    var id = $(this).val();
    
    if (!id) { // Jika ID kosong, jangan lanjutkan
        $("#form_des").empty().append("<option value=''>Pilih</option>").prop("disabled", true);
        return;
    }
    
    $.ajax({
        type: 'POST',
        url: base_url + "dashboard/desa",
        data: {id: id},
        dataType: "json",
        beforeSend: function(){
            $("#form_des").empty().append("<option value=''>Memuat...</option>").prop("disabled", true);
        },
        success: function(response) {
            if (response.length > 0) {
                let options = response.map(item => `<option value="${item.id}">${item.name}</option>`).join("");
                $("#form_des").html("<option value=''>Pilih</option>" + options).prop("disabled", false);
                } else {
                $("#form_des").html("<option value=''>Tidak ada data</option>").prop("disabled", true);
            }
        },
        error: function() {
            $("#form_des").html("<option value=''>Terjadi kesalahan</option>").prop("disabled", true);
        }
    });
});


$('#fotoSantri, #fotoKk, #fotobukti').change(function () {
    const id = $(this).attr('id');
    const foto = this.files[0];
    $(this).removeClass('is-invalid');
    
    if (foto) {
        
        const img = new Image();
        
        img.src = URL.createObjectURL(foto);
        $(`#${id}Preview`).attr('src', URL.createObjectURL(foto));
        $(`#${id}PreviewContainer`).show();
        } else {
        $(`#${id}PreviewContainer`).hide();
    }
});

$('#image').change(function(){
    $("#frames").html('');
    for (var i = 0; i < $(this)[0].files.length; i++) {
        $("#frames").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" width="80px" height="100px"/>');
    }
});

document.getElementById('nik').addEventListener('keypress', function (event) {
    let key = String.fromCharCode(event.which);
    
    if (!/^[0-9]$/.test(key)) {
        event.preventDefault();
    }
    
    if (this.value.length >= 16) {
        event.preventDefault();
    }
});
 $('body').on("input", "#nik", function(){
    let nikLength = $(this).val().replace(/[^0-9]/g, '').length; // Pastikan hanya angka yang dihitung
    let errorMessage = "NIK harus 16";
    
    if(nikLength < 16 ){
        $(this).addClass('is-invalid').removeClass('is-valid');
        $(this).siblings('.invalid-tooltip').text(errorMessage).show();
        $(".search-input").css("color", "red");
        } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).siblings('.invalid-tooltip').hide();
        $(".search-input").css("color", "green");
        }
});

document.getElementById('nisn').addEventListener('keypress', function (event) {
    let key = String.fromCharCode(event.which);
    
    if (!/^[0-9]$/.test(key)) {
        event.preventDefault();
    }
    
    if (this.value.length >= 12) {
        event.preventDefault();
    }
});

$('body').on("input", "#nisn", function(){
    let nisnLength = $(this).val().replace(/[^0-9]/g, '').length; // Pastikan hanya angka yang dihitung
    let errorMessage = "NISN minimal 10 digit dan maksimal 12 digit";
    
    if(nisnLength < 10 || nisnLength > 12){
        $(this).addClass('is-invalid').removeClass('is-valid');
        $(this).siblings('.invalid-tooltip').text(errorMessage).show();
        $(".search-input").css("color", "red");
        } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).siblings('.invalid-tooltip').hide();
        $(".search-input").css("color", "green");
    }
});

document.getElementById('nikAyah').addEventListener('keypress', function (event) {
    let key = String.fromCharCode(event.which);
    
    if (!/^[0-9]$/.test(key)) {
        event.preventDefault();
    }
    
    if (this.value.length >= 16) {
        event.preventDefault();
    }
});
$('body').on("input", "#nikAyah", function(){
    let nikAyah = $(this).val().replace(/[^0-9]/g, ''); // Pastikan hanya angka
    $(this).val(nikAyah); // Mengupdate input agar hanya angka
    
    if(nikAyah.length !== 16){
        $(this).addClass('is-invalid').removeClass('is-valid');
        $(this).siblings('.invalid-tooltip').text('NIK Ayah harus 16 digit').show();
        } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).siblings('.invalid-tooltip').hide();
    }
});

document.getElementById('nikIbu').addEventListener('keypress', function (event) {
    let key = String.fromCharCode(event.which);
    
    if (!/^[0-9]$/.test(key)) {
        event.preventDefault();
    }
    
    if (this.value.length >= 16) {
        event.preventDefault();
    }
});
$('body').on("input", "#nikIbu", function(){
    let nikIbu = $(this).val().replace(/[^0-9]/g, ''); // Hanya angka
    $(this).val(nikIbu); // Perbarui nilai input agar hanya angka
    
    if(nikIbu.length !== 16){
        $(this).addClass('is-invalid').removeClass('is-valid');
        $(this).siblings('.invalid-tooltip').text('NIK Ibu harus 16 digit').show();
        } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
        $(this).siblings('.invalid-tooltip').hide();
    }
});



document.getElementById('nama').addEventListener('input', function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});

document.getElementById('namaAyah').addEventListener('input', function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});

document.getElementById('namaIbu').addEventListener('input', function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});
document.getElementById('birthPlace').addEventListener('input', function () {
    this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
});

document.addEventListener("DOMContentLoaded", function () {
    var forms = document.querySelectorAll('.needs-validation');
    
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            if (!form.checkValidity()) {
                event.stopPropagation();
                form.classList.add('was-validated');
                
                // Fokus pada elemen input pertama yang tidak valid
                const firstInvalidElement = form.querySelector(':invalid');
                if (firstInvalidElement) {
                    firstInvalidElement.focus();
                }
                
                return;
            }
            
            // Fungsi validasi input
            function validateInput(id, minLength, errorMessage) {
                let input = $("#" + id);
                let length = input.val().length;
                
                if (length < minLength) {
                    input.addClass('is-invalid').removeClass('is-valid');
                    input.siblings('.invalid-tooltip').text(errorMessage).show();
                    input.focus();
                    return false;
                    } else {
                    input.removeClass('is-invalid').addClass('is-valid');
                    input.siblings('.invalid-tooltip').hide();
                    return true;
                }
            }
            
            // Validasi panjang NIK & NISN
            if (!validateInput("nik", 16, "NIK harus 16 digit")) return;
            if (!validateInput("nisn", 10, "NISN minimal 10 digit")) return;
            if (!validateInput("nikAyah", 16, "NIK Ayah harus 16 digit")) return;
            if (!validateInput("nikIbu", 16, "NIK Ibu harus 16 digit")) return;
            
            // Validasi Google reCAPTCHA
            let response = grecaptcha.getResponse();
            if (response.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: 'Error reCAPTCHA',
                    confirmButtonText: 'OK',
                });
                return;
            }
            
            // Kirim data via AJAX
            const formData = new FormData(form);
            let submitButton = $('button:submit', form);
            submitButton.html('<span class="spinner-border spinner-border-sm"></span> Mengirim...').prop('disabled', true);
            
            $.ajax({
                type: 'POST',
                url: base_url + "dashboard/proses",
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === false) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: response.message,
                            confirmButtonText: 'OK',
                            }).then(() => {
                            if (response.message) {
                                const errors = response.message;
                                setTimeout(() => {
                                    const firstErrorKey = Object.keys(errors)[0];
                                    $("#" + firstErrorKey).focus();
                                }, 500);
                                
                                for (const key in errors) {
                                    $("#" + key).addClass('is-invalid');
                                    $("#" + key).siblings('.invalid-tooltip').text(errors[key]);
                                }
                            }
                        });
                        } else {
                        Swal.fire({
                            title: 'Konfirmasi',
                            buttonsStyling: false,
                            showCancelButton: false,
                            reverseButtons: true,
                            html: rulesConfirmElement,
                            confirmButtonText: 'Tutup',
                            cancelButtonText: 'Periksa Data',
                            customClass: {
                                ...sweetAlertButtonClass,
                                confirmButton: 'btn btn-success rounded-pill flex-grow-1',
                                cancelButton: 'btn btn-outline-success rounded-pill flex-grow-1',
                                actions: 'w-100 px-4 gap-2',
                                title: 'fs-4',
                            },
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $('input, select').val('');
                                $('#formulir').hide();
                                $('#nomor_pendaftaran').html(response.nik);
                                $('#sukses').removeClass('d-none').show();
                                redirectToPage();
                                } else {
                                location.reload();
                            }
                        });
                    }
                },
                complete: function () {
                    submitButton.text('Submit Formulir').prop('disabled', false);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengirim data!',
                    });
                    submitButton.text('Submit Formulir').prop('disabled', false);
                }
            });
            
            form.classList.add('was-validated');
        }, false);
    });
});


function redirectToPage() {
    window.location.href = base_url+'pendaftaran-sukses';
}
// $('#formPendaftaran').on('submit', function (e) {
// e.preventDefault();

// });

