$(document).ready(function () {
    // hapus user
    $('.hapusUser').on('click', function () {
        const id = $(this).data('id');
        $('#idUser').val(id);
    });

    //ubah user
    $('.ubahUser').on('click', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const role = $(this).data('role');
        const is_active = $(this).data('is_active');

        $('#idUpdateUser').val(id);
        $('#ubahNama').val(name);
        $('#ubahEmail').val(email);
        $('#ubahRole').val(role).change();

        if (is_active == 1) {
            $('.ubah-is-active').prop('checked', true);
        } else {
            $('.ubah-is-active').prop('checked', false);
        }
    });

    //reset password user
    $('.btnResetPassword').on('click', function () {
        const id_reset = $(this).data('resetid');
        const email_reset = $(this).data('email');
        $('#idResetPassword').val(id_reset);
        $('#emailResetPassword').val(email_reset);
    });

    $('.closeResetPassword').on('click', function () {
        $('.idResetPassword').val('') == null;
        $('.resetPassword').val('') == null;
    });

    //validate reset password
    $("#errorResetPassword").hide();
    let resetPasswordError = true;
    $("#btnResetPassword").prop("disabled", true);
    $("#resetPassword").keyup(function () {
        validatePassword();
    });

    function validatePassword() {
        let passwordValue = $("#resetPassword").val();
        if (passwordValue.length == "") {
            $("#errorResetPassword").show();
        } else if (passwordValue.length < 3) {
            $("#errorResetPassword").show();
            $("#errorResetPassword").html("Password harus lebih dari 3 karakter");
        } else {
            $("#btnResetPassword").prop('disabled', false);
            $("#errorResetPassword").hide();
        }
    }

    //validate form update user
    $("#errorName").hide();
    let errorUpdateName = true;
    $("#ubahNama").keyup(function () {
        validateUpdateName();
    });

    function validateUpdateName() {
        let nameValue = $("#ubahNama").val();
        if (nameValue.length == "") {
            $("#errorUbahNama").show();
            $("#btnUpdateUser").prop("disabled", true);
            errorUpdateName = false;
            return false;
        } else if (nameValue.length < 3) {
            $("#btnUpdateUser").prop("disabled", true);
            $("#errorUbahNama").show();
            $("#errorUbahNama").html("Nama harus lebih dari 3 karakter");
            errorUpdateName = false;
            return false;
        } else {
            $("#errorUbahNama").hide();
            $("#btnUpdateUser").prop('disabled', false);
        }
    }

    // hapus padukuhan
    $('.btnHapusPadukuhan').on('click', function () {
        const id = $(this).data('idpadukuhan');
        $('#idPadukuhan').val(id);
    });

    //clear hapus padukuhan
    $('.closeHapusPadukuhan').on('click', function () {
        $('#idPadukuhan').val("");
    });

    //ubah padukuhan
    $('.btnUbahPadukuhan').on('click', function () {
        const id = $(this).data('id-padukuhan');
        const name = $(this).data('nama-padukuhan');

        $('#idUpdatePadukuhan').val(id);
        $('#ubahNamaPadukuhan').val(name);
    });

     $('.closeUbahPadukuhan').on('click', function () {
        $('#idUpdatePadukuhan').val('') == null;
        $('#idNamaPadukuhan').val('') == null;
     });

    //validate form update padukuhan
    $("#errorNamaPadukuhan").hide();
    let errorUpdateNamapadukuhan = true;
    $("#ubahNamaPadukuhan").keyup(function () {
        validateUpdateNamapadukuhan();
    });

    function validateUpdateNamapadukuhan() {
        let nameValue = $("#ubahNamaPadukuhan").val();
        if (nameValue.length == "") {
            $("#errorNamaPadukuhan").show();
            $("#errorNamaPadukuhan").html("Nama Padukuhan tidak boleh kosong!");
            $("#btnUpdatePadukuhan").prop("disabled", true);
            errorUpdateNamapadukuhan = false;
            return false;
        } else {
            $("#errorNamaPadukuhan").hide();
            $("#btnUpdatePadukuhan").prop('disabled', false);
        }
    }

    var errorMsg = $('#errorNamaPadukuhan').val();
    if (errorMsg != null) {
        $("#modalUbahPadukuhan").modal('show');
    }

//ubah kategori
$('.btnUbahKategori').on('click', function () {
        const id = $(this).data('id-kategori');
        const name = $(this).data('nama-kategori');

        $('#idUpdateKategori').val(id);
        $('#namaUpdateKategori').val(name);

    $('#form-ubah-kategori').css("display", "block");
    $('#namaUpdateKategori').focus();
    $('#form-tambah-kategori').css("display", "none");
    });

    $('.closeUbahKategori').on('click', function () {
        $('#idUpdateKategori').val('') == null;
        $('#namaUpdateKategori').val('') == null;
        $('#form-ubah-kategori').css("display", "none");
        $('#form-tambah-kategori').css("display", "block");
     });

    //validate form update kategori
    $("#errorNamaKategori").hide();
    let errorUpdateNamaKategori = true;
    $("#ubahNamaKategori").keyup(function () {
        validateUpdateNamaKategori();
    });

    function validateUpdateNamaKategori() {
        let nameValue = $("#ubahNamaKategori").val();
        if (nameValue.length == "") {
            $("#errorNamaKategori").show();
            $("#errorNamaKategori").html("Nama Kategori tidak boleh kosong!");
            $("#btnUpdateKategori").prop("disabled", true);
            errorUpdateNamaKategori = false;
            return false;
        } else {
            $("#errorNamaKategori").hide();
            $("#btnUpdateKategori").prop('disabled', false);
        }
    }

    // error update kategori
    if ($("#errorUbahKategori").val() != null) {
        $("#form-ubah-kategori").css("display", "block");
        $("#form-tambah-kategori").css("display", "none");
    } else {
        $("#form-tambah-kategori").css("display", "block");
        $("#form-ubah-kategori").css("display", "none");
    }

    // hapus Kategori
    $('.btnHapusKategori').on('click', function () {
        const id = $(this).data('id-kategori');
        $('#idKategori').val(id);
    });

    //clear hapus Kategori
    $('.closeHapusKategori').on('click', function () {
        $('#idKategori').val("");
    });

    //ubah indikator
$('.btnUbahindikator').on('click', function () {
        const id = $(this).data('id-indikator');
        const name = $(this).data('nama-indikator');
        const key = $(this).data('key-indikator');
    
        // Range Nilai
        const items_range = JSON.parse( JSON.stringify( $(this).data('range') ) );

        $.each(items_range, function(index, value) {
            $(`input[name="ubah_${index}"]`).val(value);
        });
        

        $('#idUpdateindikator').val(id);
        $('#namaUpdateindikator').val(name);
        $('input[name="ubah_key_indikator"]').val(key);
        

    $('#form-ubah-indikator').css("display", "block");
    $('#namaUpdateindikator').focus();
    $('#form-tambah-indikator').css("display", "none");
    });

    $('.closeUbahindikator').on('click', function () {
        $('#idUpdateindikator').val('') == null;
        $('#namaUpdateindikator').val('') == null;
        $('#form-ubah-indikator').css("display", "none");
        $('#form-tambah-indikator').css("display", "block");
     });

    //validate form update indikator
    $("#errorNamaindikator").hide();
    let errorUpdateNamaindikator = true;
    $("#ubahNamaindikator").keyup(function () {
        validateUpdateNamaindikator();
    });

    function validateUpdateNamaindikator() {
        let nameValue = $("#ubahNamaindikator").val();
        if (nameValue.length == "") {
            $("#errorNamaindikator").show();
            $("#errorNamaindikator").html("Nama indikator tidak boleh kosong!");
            $("#btnUpdateindikator").prop("disabled", true);
            errorUpdateNamaindikator = false;
            return false;
        } else {
            $("#errorNamaindikator").hide();
            $("#btnUpdateindikator").prop('disabled', false);
        }
    }

    if ($("#errorUbahindikator").val() != null) {
        $("#form-ubah-indikator").css("display", "block");
        $("#form-tambah-indikator").css("display", "none");
    } else {
        $("#form-tambah-indikator").css("display", "block");
        $("#form-ubah-indikator").css("display", "none");
    }

    // hapus indikator
    $('.btnHapusindikator').on('click', function () {
        const id = $(this).data('id-indikator');
        $('#idindikator').val(id);
    });

    //clear hapus indikator
    $('.closeHapusindikator').on('click', function () {
        $('#idindikator').val("");
    });

    //hapus pertanyaan
    $('.btnHapusPertanyaan').on('click', function () {
        const id = $(this).data('id-pertanyaan');
        $('#id_pertanyaan').val(id);
    });

    //clear hapus pertanyaan
    $('.closeHapusPertanyaan').on('click', function () {
        $('#id_pertanayaan').val("");
    });

 //ubah pertanyaan
    $('.btnUbahPertanyaan').on('click', function () {
        const id = $(this).data('id-pertanyaan');
        const tanggal = $(this).data('tanggal-pertanyaan');
        const surveyor = $(this).data('surveyor');
        const pertanyaan = $(this).data('pertanyaan');
        const id_kategori = $(this).data('id-kategori');
        const id_indikator = $(this).data('id-indikator');
        const id_padukuhan = $(this).data('id-padukuhan');
        const skor = $(this).data('skor');


        $('#idUpdatePertanyaan').val(id);
        $('#ubah_tanggal_pertanyaan').val(tanggal);
        $('#ubah_surveyor_pertanyaan').val(surveyor).change();
        $('#updatePertannyaan').val(pertanyaan);
        $('#updateKategoriPertanyaan').val(id_kategori).change();
        $('#updateIndikatorPertanyaan').val(id_indikator).change();
        $('#updatePadukuhanPertanyaan').val(id_padukuhan).change();
        $('#updateSkor').val(skor);

        $('#form-ubah-pertanyaan').css("display", "block");
        $('#updatePertannyaan').focus();
        $('#form-tambah-pertanyaan').css("display", "none");
    });

    $('.closeUbahpertanyaan').on('click', function () {
        $('#idUpdatepertanyaan').val('') == null;
        $('#namaUpdatepertanyaan').val('') == null;
        $('#form-ubah-pertanyaan').css("display", "none");
        $('#form-tambah-pertanyaan').css("display", "block");
     });

    //validate form update pertanyaan
    $("#errorNamapertanyaan").hide();
    let errorUpdateNamapertanyaan = true;
    $("#ubahNamapertanyaan").keyup(function () {
        validateUpdateNamapertanyaan();
    });

    function validateUpdateNamapertanyaan() {
        let nameValue = $("#ubahNamapertanyaan").val();
        if (nameValue.length == "") {
            $("#errorNamapertanyaan").show();
            $("#errorNamapertanyaan").html("Nama pertanyaan tidak boleh kosong!");
            $("#btnUpdatepertanyaan").prop("disabled", true);
            errorUpdateNamapertanyaan = false;
            return false;
        } else {
            $("#errorNamapertanyaan").hide();
            $("#btnUpdatepertanyaan").prop('disabled', false);
        }
    }

      //error update pertanyaan
    if ($(".error_update_pertanyaan").val() != null) {
        $("#form-ubah-pertanyaan").css("display", "block");
        $("#form-tambah-pertanyaan").css("display", "none");
    } else {
        $("#form-tambah-pertanyaan").css("display", "block");
        $("#form-ubah-pertanyaan").css("display", "none");
    }

 });

