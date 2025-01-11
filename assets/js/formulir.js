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
            $("#feedback-telp-edit").html('');
            $("#feedback-telp-edit").removeClass("text-danger").addClass('text-success');
            $("#telp").removeClass('is-invalid text-danger').addClass("is-valid text-success");
        }
    });
    // listen to the telephone input for changes
    input.addEventListener('countrychange', () => {
        $("#telp").change();
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
    console.log(id)
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

$('body').on("change","#statusPendidikan",function(){
    var form_unit = $("#form_unit").val();
    $("#form_unit").val(form_unit).change();
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
            var name = response.name;
            $("#form_kuota").append("<option value='" + teg + "'>" + name + "</option>");
        }
    });
});
// $('#form_prov').on('change', function () {
// const provinsi = $(this).val();
// $('#form_prov, #kecamatan, #kelurahan').val(null);
// $.getJSON(`/dashboard/kabupatens/${provinsi}`, (kabupaten) => generateSelectOption('#form_kab', kabupaten));
// });

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


$('body').on("change","#form_kec",function(){
    var id = $(this).val();
    $.ajax({
        type: 'POST',
        url: base_url+ "dashboard/desa",
        data: {id:id},
        dataType : "json",
        beforeSend: function(){
            $("#form_des").empty();
            $("#form_des").append("<option value=''>Pilih</option>");
        },
        success: function(response) {
            $("#form_des").attr("disabled", false);
            var msize = response.length;
            var i = 0;
            for (; i < msize; i++) {
                var teg = response[i]["id"];
                var name = response[i]["name"];
                $("#form_des").append("<option value='" + teg + "'>" + name + "</option>");
            }
        }
    });
});

$('#fotoSantri, #fotoKk, #fotobukti').change(function () {
    const id = $(this).attr('id');
    const foto = this.files[0];
    $(this).removeClass('is-invalid');
    
    if (foto) {
        // const maxImageSize = id == 'fotoKk' ? 1000 * 1024 : `${file_size}` * 1024;
        // if (foto.size > maxImageSize) {
        // $(this).val('')
        // .addClass('is-invalid')
        // .siblings('.invalid-feedback')
        // .text(`Ukuran foto terlalu besar mohon gunakan foto dengan ukuran maximal ${id == 'fotoKk' ? '1 MB' : file_size + ' KB'}`
        // );
        // $(`#${id}Preview`).attr('src', '#');
        // $(`#${id}PreviewContainer`).hide();
        
        // // return;
        // }
        
        // const expectedAspectRatio = id == 'fotoKk' ? 16 / 9 : 3 / 4;
        const img = new Image();
        
        // img.onload = () => {
        // const aspectRatio = img.width / img.height;
        // if (Math.abs(aspectRatio - expectedAspectRatio) > 0.01) {
        // $(this)
        // .addClass('is-invalid')
        // .siblings('.invalid-feedback')
        // .text(`Ukuran foto akan di crop dengan ukuran ${
        // id == 'fotoKk' ? '16:9' : '3:4'
        // } silahkan ubah jika tidak sesuai`
        // );
        // }
        // };
        
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

var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
.forEach(function (form) {
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }else{
            event.preventDefault();
            var nik = $("#nik").val().length;
            var nisn = $("#nisn").val().length;
            var nikAyah = $("#nikAyah").val().length;
            var nikIbu = $("#nikIbu").val().length;
            
            if(nik != 16){
                $("#nik").addClass('is-invalid');
                $("#nik").siblings('.invalid-tooltip').text('NIK harus 16 digit');
                $("#nik").focus();
                return;
                }else{
                $("#nik").removeClass('is-invalid').addClass('is-valid');
                $("#nik").siblings('.invalid-tooltip').hide();
            }
            
            if(nisn != 10){
                $("#nisn").addClass('is-invalid');
                $("#nisn").siblings('.invalid-tooltip').text('NISN harus 10 digit');
                $("#nisn").focus();
                return;
                }else{
                $("#nisn").removeClass('is-invalid').addClass('is-valid');
                $("#nisn").siblings('.invalid-tooltip').hide();
            }
            
            if(nikAyah != 16){
                $("#nikAyah").addClass('is-invalid');
                $("#nikAyah").siblings('.invalid-tooltip').text('NIK Ayah harus 16 digit');
                $("#nikAyah").focus();
                return;
                }else{
                $("#nikAyah").removeClass('is-invalid').addClass('is-valid');
                $("#nikAyah").siblings('.invalid-tooltip').hide();
            }
            
            if(nikIbu != 16){
                $("#nikIbu").addClass('is-invalid');
                $("#nikIbu").siblings('.invalid-tooltip').text('NIK Ibu harus 16 digit');
                $("#nikIbu").focus();
                return;
                }else{
                $("#nikIbu").removeClass('is-invalid').addClass('is-valid');
                $("#nikIbu").siblings('.invalid-tooltip').hide();
            }
            var response = grecaptcha.getResponse();
            console.log(response)
            if (response.length == 0) {
                swal.fire({
                    icon: 'error',
                    title: 'error',
                    html:'error recaptha',
                    confirmButtonText: 'OK',
                });
                } else {
                const formData = new FormData($(this)[0]);
                $('button:submit', this).html(spinner).prop('disabled', true);
                
                $.ajax({
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    url: base_url+ "dashboard/proses",
                    success: (response) => {
                        // console.log(response)
                        if (response.status === false) {
                            // alerts()
                            swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: response.message,
                                confirmButtonText: 'OK',
                            })
                            .then(() => {
                                if (response.message) {
                                    const errors = response.message;
                                    setTimeout(() => {
                                        const firstErrorKey = Object.keys(errors)[0];
                                        console.log(firstErrorKey)
                                        $(`#${firstErrorKey}`).focus();
                                    }, 500);
                                    
                                    for (const key in errors) {
                                        $(`#${key}`).addClass('is-invalid');
                                        $(`#${key}`).siblings('.invalid-feedback').text(errors[key]);
                                        $(`#${key}`).siblings('.invalid-tooltip').text(errors[key]);
                                    }
                                }
                            });
                            } else {
                            // const total = response.reduce((acc, { billAmount }) => acc + Number(billAmount), 0);
                            // $('#total').text(formatRupiah(response.amount));
                            // $('#rincian').html(rincianPembayaran(response));
                            swal.fire({
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
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    $('input').val('') 
                                    $('select').val('') 
                                    $('#formulir').hide(); 
                                    $('#nomor_pendaftaran').html(response.nik); 
                                    $('#sukses').removeClass('d-none'); 
                                    $('#sukses').show(); 
                                    redirectToPage(); 
                                    } else {
                                    location.reload(); 
                                }
                            });
                        }
                    },
                    complete: () => {
                        $('button:submit', this).text('Submit Formulir').prop('disabled', false);
                    },
                });
            }
        }
        
        form.classList.add('was-validated')
    }, false)
})
 
function redirectToPage() {
    window.location.href = base_url+'pendaftaran-sukses';
}
// $('#formPendaftaran').on('submit', function (e) {
// e.preventDefault();

// });

