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
 
            // Kirim data via AJAX
            const formData = new FormData(form);
            let submitButton = $('button:submit', form);
            submitButton.html('<span class="spinner-border spinner-border-sm"></span> Mengirim...').prop('disabled', true);
            
            $.ajax({
                type: 'POST',
                url: base_url + "dashboard/proses_test",
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

