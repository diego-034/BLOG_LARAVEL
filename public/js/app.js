function Send(route, method, form) {
    let response = {};
    $.ajax({
        url: route,
        data: form,
        async: false,
        type: method,
        success: function(res) {
            if (!res.success) {
                response.status = false;
            } else {
                response.status = true;
                response.data = res;
            }
        },
        error: function() {
            console.log("Error");
        },
    });
    return response;
}

function Singin() {
    let form = {
        name: $("#name").val(),
        lastname: $("#name").val(),
        email: $("#email").val(),
        password: $("#password").val(),
        confirm_password: $("#confirm_password").val(),
    };
    let response = Send(
        location.protocol + "//" + location.host + "/api/users",
        "POST",
        form
    );
    console.log(response);
    if (response.status == false) {
        alert("Try more later");
        return;
    }
    window.location.href = location.protocol + "//" + location.host + "/home";
}

function Login() {
    let form = { "email": $("#email").val(), "password": $("#password").val() }
    Send(location.protocol + "//" + location.host + "/api/users", "POST", form);
}

function Post() {
    let form = { "email": $("#email").val(), "password": $("#password").val() }
    Send(location.protocol + "//" + location.host + "/api/users", "POST", form);
}

function Posts() {
    let status = GetRoute("", location.pathname);
    if (!status) {
        return;
    }
    let response = Send(
        location.protocol + "//" + location.host + "/api/posts",
        "GET", {}
    );
    console.log(response);
    for (let i = 0; i < 10; i++) {
        let post = response.data.data[i];
        $("#posts")
            .append(`<div class="uk-card uk-card-default 
            uk-card-body uk-width-1-2@m uk-margin-top" id="">
                <h3 class="uk-card-title"><a>${post.post_title}</a></h3>
                <h6>${post.name+" " + post.lastname}</h6>
         <p>${post.post_body}</p>
         <div class="uk-margin">
         <div uk-grid>
             <div class="uk-width-expand@m">
                 <input class="uk-input" type="text" placeholder="Comment">
             </div>
             <div class="uk-width-1-3@m">
                 <button class="uk-button uk-button-default uk-button-small">Send</button>
             </div>
         </div>
     </div>
     </div>`);
    }
}

function GetRoute(name, pathname) {
    let url = pathname.split("/");
    for (var i = 1; i < url.length; i++) {
        if (name == url[i]) {
            return true;
        }
    }
    return false;
}

function Show() {
    $("#posts").css("display", "none");
    $("#form_post").css("display", "block");
    $("#action").text("Cancel");
    $("#action").attr('onclick', 'Hide()');
}

function Hide() {
    $("#form_post").css("display", "none");
    $("#posts").css("display", "block");
    $("#action").text("New Post");
    $("#action").attr('onclick', 'Show()');
}

$(document).ready(function() {
    Posts();
});