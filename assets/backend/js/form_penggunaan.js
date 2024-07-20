'use strict';
$(document).ready(function() {
    $(".hide-txt").hide();
    $(".tax-wrap input").focus(function() {
        $(".hide-txt").show("slow");
    });
    $(".tax-wrap input").blur(function() {
        if (!$(this).val()) {
            $(".hide-txt").hide("slow");
            } else {
            $(".hide-txt").show("slow");
        }
    });
    $(".input1").iconpicker(".input1");
    // gload("hide");
});
/** @type {boolean} */
var click = false;
/**
    * @param {?} callback
    * @return {undefined}
*/
function callFunction(callback) {
    if (!click) {
        $("#kolapse").addClass("btn-info");
        $(".dd").nestable("expandAll");
        $("#kolapse").html('<i class="fa fa-minus"></i> Collapse');
        /** @type {boolean} */
        click = true;
        } else {
        $(".dd").nestable("collapseAll");
        $("#kolapse").removeClass("btn-info");
        $("#kolapse").addClass("btn-success");
        $("#kolapse").html('<i class="fa fa-plus"></i> Expand');
        /** @type {boolean} */
        click = false;
    }
}
$(document).ready(function() {
    $("#kolapse").html('<i class="fa fa-plus"></i> Expand');
    /**
        * @param {!Object} e
        * @return {undefined}
    */
    var updateOutput = function(e) {
        var list = e.length ? e : $(e.target);
        var output = list.data("output");
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable("serialize")));
            } else {
            output.val("JSON browser support required for this demo.");
        }
    };
    $("#nestable").nestable({
        group : 1
    }).on("change", updateOutput);
    updateOutput($("#nestable").data("output", $("#nestable-output")));
    $("#nestable").nestable({
        maxDepth : 10,
        collapsedClass : "dd-collapsed"
    }).nestable("collapseAll");
});
$(document).ready(function() {
    /**
        * @return {?}
    */
    function createFolder() {
        var judul = $("#judul").val();
        var idmaster = $("#idmaster").val();
        var idkategori = $("#idkategori").val();
        var aktif = $("#aktif").val();
        
        if (judul == "") {
            showNotif('top-center','Input Data','Nama menu harus diisi','warning');
            $("#judul").focus();
            return
        }
        if (idmaster == "") {
            showNotif('top-center','Input Data','Parent harus dipilih','warning');
            $("#idmaster").focus();
            return
        }
        if (idkategori == "") {
            showNotif('top-center','Input Data','Kategori harus dipilih','warning');
            $("#idkategori").focus();
            return
        }
        if (aktif == "") {
            showNotif('top-center','Input Data','Aktif harus dipilih','warning');
            $("#aktif").focus();
            return
        } 
        create();        
    }
    /**
        * @return {?}
    */
    function create() {
        
        /** @type {string} */
        var data = {
            type : $("#type").val(),
            label : $("#judul").val(),
            tarif : $("#tarif").val(),
            idparent : $("#idparent").val(),
            idmaster : $("#idmaster").val(),
            idkategori : $("#idkategori").val(),
            grup : $("#grup").val(),
            aktif : $("#aktif").val(),
            id : $("#id").val()
        };
        
        $.ajax({
            type : "GET",
            url : base_url + "master/save_form",
            data : data,
            beforeSend : function() {
                $('body').loading();　
            },
            dataType : "json",
            cache : false,
            success : function(data) {
                // console.log(data.aktif)
                if (data.aktif ==1) {
                    $("#reload_"+ data.id).removeClass('text-danger');
                    $("#label_show"+ data.id).removeClass('text-danger');
                    }else{
                    $("#reload_"+ data.id).addClass("text-danger");
                    $("#label_show"+ data.id).addClass("text-danger");
                }
                if (data.type == "add") {
                    if (data.ok == "ok") {
                        $("#menu-id").append(data.menu);
                        $("#submits").html("Submit");
                        $("#reload_"+ data.id).addClass("text-danger");
                        showNotif('top-right','Input Data',data.msg,'success');
                        } else {
                        showNotif('top-right','Input Data',data.msg,'warning');
                        $("#submits").html("Submit");
                    }
                    } else {
                    if (data.type == "edit") {
                        $("#submits").html("Submit");
                        $("#label_show" + data.id).html(data.label);
                        showNotif('top-right','Input Data',data.msg,'success');
                    }
                }
                $("#judul").val("");
                $("#tarif").val(0);
                $("#idparent").val("");
                $("#idmaster").val("");
                $("#idkategori").val("");
                $("#aktif").val(1);
                $("#id").val("");
                $('body').loading('stop');　
            },
            error : function(res, status, e) {
                showNotif('top-right','Input Data',status,'warning');
                $('body').loading('stop');　
            }
        });
        return false;
    }
    
    $("#save").prop("disabled", true);
    $("#submit-form").validate({
        rules : {
            judul : {
                required : false
            }
        },
        submitHandler : createFolder
    });
    $(".dd").on("change", function() {
        $("#save").prop("disabled", this.value == "" ? true : false);
    });
    $("#save").click(function() {
        var notifData = {
            type : $("#type").val(),
            data : $("#nestable-output").val()
        };
        $.ajax({
            type : "GET",
            url : base_url + "master/crud_form",
            data : notifData,
            cache : false,
            beforeSend : function() {
                $('body').loading();　
            },
            success : function(data) {
                $('body').loading('stop');　
                $("#save").prop("disabled", true);
                showNotif('top-right','Simpan Data','Sukses','success');
            },
            error : function(res, status, e) {
                showNotif('top-right','Input Data',status,'warning');
                $('body').loading('stop');　
            }
        });
    });
    $(document).on("click", ".edit-button", function() {
        var id = $(this).attr("id");
        $.ajax({
            type : "GET",
            url : base_url + "master/crud_form",
            dataType : "json",
            data : {
                id : id,
                type : "get"
            },
            cache : false,
            beforeSend : function() {
                $('body').loading();　
            },
            success : function(action) {
                $("#submits").html("Update");
                $("#id").val(action.id);
                $("#judul").val(action.label).focus();
                $("#tarif").val(action.tarif);
                $("#idparent").val(action.idparent);
                $("#idmaster").val(action.idmaster);
                $("#idkategori").val(action.idkategori);
                $("#kategori").val(action.kategori);
                $("#grup").val(action.grup);
                $("#aktif").val(action.aktif);
                $('body').loading('stop');　
                // console.log(action.kategori)
            },
            error : function(res, status, e) {
                $('body').loading('stop');　
                showNotif('top-right','Input Data',status,'warning');
            }
        });
    });
    $(document).on("click", "#reset_form", function() {
        $("#judul").val("");
        $("#tarif").val(0);
        $("#idmaster").val("");
        $("#idkategori").val("");
        $("#aktif").val('1');
        $("#id").val("");
        $("#submits").html("Submit");
    });
});

$("#myModalDel").on("show", function() {
    var salesTeam = $(this).data("id");
    var removeBtn = $(this).find(".danger");
});
$(".confirm-delete").on("click", function(event) {
    event.preventDefault();
    var pack_id = $(this).data("id");
    $("#myModalDel").data("id", pack_id).modal("show");
});
$(document).on("click", "#btnYes", function() {
    var id = $("#myModalDel").data("id");
    $.ajax({
        type : "GET",
        url : base_url + "master/crud_form",
        data : {
            type : "hapus",
            id : id
        },
        cache : false,
        dataType : "json",
        beforeSend : function() {
            $('body').loading();　
        },
        success : function(data) {
            if (data[0] == "ok") {
                showNotif('top-center','Hapus Data','Sukses','success');
                $("li[data-id='" + id + "']").remove();
                } else {
                showNotif('top-center','Hapus Data','Gagal','warning');
            }
            $("#myModalDel").modal("hide");
            $('body').loading('stop');　
        },
        error : function(res, status, e) {
            showNotif('top-right','Input Data',e,'warning');
            $('body').loading('stop');　
        }
    });
});
