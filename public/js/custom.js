function copyLink(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#'+element+'').text()).select();
    document.execCommand("copy");
    $temp.remove();
    alert("Message link copied to clipboard.")
}
