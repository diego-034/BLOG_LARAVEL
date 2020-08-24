function Show() {
    $("#posts").css("display", "none");
    $("#form_post").css("display", "block");
    $("#action").text("Cancel");
    $("#action").attr("onclick", "Hide()");
}

function Hide() {
    $("#form_post").css("display", "none");
    $("#posts").css("display", "block");
    $("#action").text("New Post");
    $("#action").attr("onclick", "Show()");
}

function Validate() {

}