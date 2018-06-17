$('.tab a').on('click', function (e) {
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    target = $(this).attr('href');
    $('.main-tab-content > div').not(target).hide();
    $(target).fadeIn(600);
});


$('.show-pass').on('click', function(){
    var passwordField = $('#loginPassword') ;
    var passwordFieldType = passwordField.attr('type');
     if(passwordFieldType == 'password')
    {
        passwordField.attr('type', 'text');
        $(this).val('Hide');
    } else {
        passwordField.attr('type', 'password');
        $(this).val('Show');
    }
});


function signIn(){
    var email = $('#loginEmail').val();
    var password = $('#loginPassword').val();

    if(password.length>7) {
        $.ajax({
            url: "http://localhost/userdetails/api/signIn.php",
            method: "POST",
            data:  JSON.stringify({"email": email, "password": password}),
            contentType: "application/json",
            processData: false,
            success: function (data) {
                JSON.stringify(data);
                var status = data[0].status;
                console.log(status);
                if (status == 'success') {
                    alert('Login success');
                    window.location.replace("http://localhost/userdetails/userProfile.php");
                }
                else {
                    alert('login failed');
                    return false;
                }
            }
        });
    }
    else {
        alert('Please enter atleast 8 characters for password');
        console.log('clcked');
        return false;
    }
}


function signUpUser(){
    let email = $('#email').val();
    let username = $('#username').val();
    let password = $('#password').val();
    let mobile=$('#mobile').val();
    if(password.length>7 && mobile.length==10) {
        $.post("http://localhost/userdetails/api/signUp.php",
            JSON.stringify(   {
                password: password,
                email: email,
                username: username,
                mobile: mobile,

            }),
            function (data, status) {
                alert("Data: " + data + "\nStatus: " + status);
            });
    }else {
        alert('Please enter correct details');
        return false;
    }
}

var modal = document.getElementById('forgetPassword');
var container = document.getElementById('container');
var btn = document.getElementById("forgetPass");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
    container.style.display="none";
}
span.onclick = function() {
    modal.style.display = "none";
    container.style.display="block";
}


function forgetPass() {
    let email = $('#forget-pass-email').val();
    $.post("http://localhost/userdetails/api/forgetPassword.php",
        {
            email: email,
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
}
