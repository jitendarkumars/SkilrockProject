<html>
<head>
    <title>Reset Your Password</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
<div class="container">
        <h1>Reset Password ?</h1>
        <form method="post" id="resetPass">
            <div class="field-wrap " >
                <label>Enter Your New Password<span class="req">*</span>
                </label>
                <input type="text" id="new_password" name="new_password" required autocomplete="off"/>
                <input type="hidden" id="email_ID" name="email_ID" value="<?php echo $_GET['email'] ?>">
                <input type="hidden" id="token_ID" name="token_ID" value="<?php echo $_GET['token'] ?>">
                <label>Re-Type your New Password<span class="req">*</span>
                </label>
                <input type="text" id="confirm_new_password" name="confirm_new_password" required autocomplete="off"/>
            </div>
            <button id="resPass" class="button button-block">Reset Password</button>
        </form>

</div>
</body>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>

<script>
    $('#resetPass').submit(function(event){

        let pass1 = $('#new_password').val();
        let pass = $('#confirm_new_password').val();
        if(!(pass1 == pass && pass.length>7 && pass1.length>7)){
            alert('Please type correct password');
        }else {
            let email = $('#email_ID').val();
            let token = $('#token_ID').val();
            $.post("http://localhost/userdetails/api/resetPassword.php",
                {
                    new_password: pass1,
                    email: email,
                    token: token
                },
                function (data) {
                    alert("Data: " + data + "\nStatus: " + status);
                    });
        } });
</script>
</html>
