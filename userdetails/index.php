<?php
session_start();
if(isset($_SESSION['loggedIn']))
{
    header('Location:http://localhost/userdetails/userProfile.php');
}
?>
<html>
<head>
    <title>My Registration Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div  id = 'container' class="container ">
    <ul class="main-tab">
        <li class="tab active">
            <a href="#login">Login</a>
        </li>
        <li class="tab">
            <a href="#signUp">SignUp</a>
        </li>
    </ul>
    <div  class="main-tab-content">
        <div id="login">
            <form method="post">
                <div class="field-wrap">
                    <label>Email<span class="req">*</span>
                    </label>
                    <input type="email" required id="loginEmail"/>
                </div>
                <div class="field-wrap">
                    <label>Password<span class="req">*</span>
                    </label>
                    <img src="showpass.png " class="show-pass img1">
                    <input type="password"  required autocomplete="new-password" id="loginPassword">
                </div>
                <p class="forgot">
                    <a href="#" id="forgetPass">Forgot Password?
                    </a>
                </p>
                <button  onclick="return(signIn())"   class="button button-block">login</button>
                </form>
        </div>
        <div id="signUp">
            <form method="post" >
                <div class="field-wrap">
                    <label>UserName
                        <span class="req">*</span>
                    </label>
                    <input type="text" required autocomplete="off" id="username" name="username"/>
                </div>
                <div class="field-wrap">
                    <label>Email
                        <span class="req">*</span>
                    </label>
                    <input type="email"  required autocomplete="off" name="email" id="email"/>
                </div>
                <div class="field-wrap">
                    <label>Password
                        <span class="req">*</span>
                    </label>
                    <img src="showpass.png " class="show-pass img1 ">
                    <input type="password" name="password" id="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="field-wrap">
                    <label>Mobile
                        <span class="req">*</span>
                    </label>
                    <input type="text" id="mobile"  name="mobile" required autocomplete="off" />
                </div>
                <button  onclick="signUpUser()"  class="button-block button">SignUp</button>
            </form>
        </div>
    </div>
</div>
<div id="forgetPassword" class="modal">
    <span class="close">&times;</span>
    <h1  >Forgot Password ?</h1>
    <form method="post">
        <div class="field-wrap" >
            <label>Enter Your Email<span class="req">*</span>
            </label>
            <input type="email" id="forget-pass-email" required autocomplete="off"/>
        </div>
        <button onclick="forgetPass()" class="button button-block">Get your Password</button>
    </form>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="javaScriptFile.js"></script>
</body>
</html>