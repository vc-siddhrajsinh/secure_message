function copyLink(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#'+element+'').text()).select();
    document.execCommand("copy");
    $temp.remove();
    toasterMessage("Link Copied.");
}

function toasterMessage(message, flag = false) {
    var x = document.getElementById("snackbar");
    x.className = "show";
    $("#snackbar").html(message);
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, flag ? 2000: 3000);
}
