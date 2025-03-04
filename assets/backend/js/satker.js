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
        var existingDescription = $("#label").val();
        var resAIW = $("#aktif").val();
        if (existingDescription == "") {
            showNotif('top-center','Input Data','Nama menu harus diisi','warning');
            $("#label").focus();
            } else {
            if (resAIW == "") {
                showNotif('top-center','Input Data','Aktif harus dipilih','warning');
                $("#aktif").focus();
                } else {
                create();
            }
        }
    }
    /**
        * @return {?}
    */
    function create() {
        /** @type {!Array} */
        var level = [];
        $(".get_value").each(function() {
            if ($(this).is(":checked")) {
                level.push($(this).val());
            }
        });
        /** @type {string} */
        level = level.toString();
        var data = {
            type : $("#type").val(),
            label : $("#label").val(),
            rekapan : $("#rekapan").val(),
            aktif : $("#aktif").val(),
            level : level,
            id : $("#id").val()
        };
        $.ajax({
            type : "GET",
            url : base_url + "satker/save_menu",
            data : data,
            beforeSend : function() {
               $('body').loading();　
                $("#submits").html("Proses...");
            },
            dataType : "json",
            cache : false,
            success : function(data) {
               $('body').loading('stop');　
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
                $("#label").val("");
                $("#rekapan").val("");
                $("#aktif").val("");
                $("#id").val("");
                $(".get_value").prop("checked", false);
                // gload("hide");
            },
            error : function(res, status, e) {
                $('body').loading('stop');　
                alert(e);
            }
        });
        return false;
    }
    $("#save").prop("disabled", true);
    $("#submit-form").validate({
        rules : {
            link : {
                required : true
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
            url : base_url + "satker/crud",
            data : notifData,
            cache : false,
            beforeSend : function() {
                $('body').loading();　
            },
            success : function(data) {
                $('body').loading('stop');　
                $("#save").prop("disabled", true);
                $("#showicon").addClass("fa-bars");
                $(".hide-txt").hide("slow");
                $("#accordionSidebar").load(location.href + " #accordionSidebar");
                // $("#menu-id").load(location.href + " #menu-id");
                showNotif('top-right','Simpan Data','Sukses','success');
            },
            error : function(deleted_model, err, op) {
                $('body').loading('stop');　
            }
        });
    });
    $(document).on("click", ".edit-button", function() {
        var id = $(this).attr("id");
        $(".get_value").prop("checked", false);
        $.ajax({
            type : "GET",
            url : base_url + "satker/crud",
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
                const cArr = action.level.split(",").length;
                if (cArr > 1) {
                    var idArr = action.level.split(",");
                    } else {
                    /** @type {!Array} */
                    idArr = [action.level];
                }
                const pipelets = idArr;
                pipelets.forEach(function(domRootID, index) {
                    $("#idlevel" + domRootID).prop("checked", true);
                });
                $("#submits").html("Update");
                $("#id").val(action.id);
                $("#label").val(action.label).focus();
                $("#rekapan").val(action.rekapan);
                $("#aktif").val(action.aktif);
                $('body').loading('stop');　
            },
            error : function(deleted_model, err, op) {
                $('body').loading('stop');　
            }
        });
    });
    $(document).on("click", "#reset", function() {
        $(".get_value").prop("checked", false);
        $("#label").val("");
        $("#rekapan").val("");
        $("#aktif").val("");
        $("#id").val("");
        $(".hide-txt").hide("slow");
    });
});
/**
    * @return {undefined}
*/
function show_selected() {
    /** @type {(Element|null)} */
    var videoSelect = document.getElementById("icon");
    var highlowselect = videoSelect[videoSelect.selectedIndex].value;
    document.getElementById("eclass").value = highlowselect;
    $("#showicon").addClass(highlowselect);
    $("#myModal").modal("hide");
}
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
        url : base_url + "satker/crud",
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
        error : function(deleted_model, err, op) {
            $('body').loading('stop');　
        }
    });
});
