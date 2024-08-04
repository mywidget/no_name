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
	var sql = comment.replace("Rp.", "");
	var newClassName = replaceAll(".", "", sql);
	return newClassName;
}
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

