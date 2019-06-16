function copyLink(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#'+element+'').text()).select();
    document.execCommand("copy");
    $temp.remove();
    var x = document.getElementById("snackbar");
    x.className = "show";
    $("#snackbar").html("Copy to clipboard");
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}