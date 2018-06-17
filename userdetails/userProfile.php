<?php
session_start();

if( isset( $_REQUEST['logout'] ))
{
    unset($_SESSION['loggedIn']);
    header("Location: index.php");
}
if(!isset($_SESSION['loggedIn'])) {
    header("Location: index.php");
}
?>
<html>
<head>
    <title>
        User Profile
    </title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<style>
    .modalEdit {
        display: none;
        position: absolute;
        left: 33.3%;
        top: 5%;
        max-width: 600px;
        padding: 40px;
        margin: 40px auto;
        border-radius: 10px;
        background-color:rgba(19, 35, 47,1);
         }
</style>

<body>
<div class="container">
    <div style="float: left;width: 150px;height: 150px; margin-left: 10px">
        <div id="image_data"class="field-wrap">

        </div>
    </div>
    <div id="mydiv" class="field-wrap" style="float:left;padding-left: 10px; width: 40%;">

        <div id="uName" style="margin-top:15px;padding: 10px; font-size:20px ">
            <?php echo $_SESSION['username'] ?>
        </div>

        <div id="uEmail" style="padding: 10px;font-size: 20px">
            <?php echo $_SESSION['email'] ?>
        </div>

    </div>
    <div style="float: right;margin-top: 25px; width: 10%;">
        <button  id="reset1" style="padding: 10px; margin-bottom: 10px; background-color: #1ab188;">Edit</button>
        <button id="reset2" style="padding: 10px;background-color: #1ab188">Edit</button>
    </div>
<div style="clear:both;"></div>
    <div class="field-wrap">
        <form method="post" id="image_form" enctype="multipart/form-data">
            <input  class="custom-file-input" type="file" id="image" name="image" />
            <input type="hidden" name="action" id="action" value="update" />
            <input  type="submit"  id="insert" name="insert" value="Update Your Profile Photo" />
        </form>
    </div>
    <div class="field-wrap">
        <form method="post" id="logout_form">
            <input type="submit" class="button-block button"  name="logout" id="logout" value="logout" />
        </form>
    </div>
</div>

<div id="edit" class="modalEdit">
    <span class="close">&times;</span>
    <h1 style="color: white;" >Want to Edit Your UserName?</h1>
    <form method="post">
        <div class="field-wrap" >
            <label>Enter Your New UserName
            </label>
            <input type="text" id="edit_userName" required autocomplete="off"/>
        </div>
        <button onclick="editUserName()" class="button button-block">Update Your UserName</button>
    </form>
</div>
<div id="edit1" class="modalEdit">
    <span class="close1">&times;</span>
    <h1 style="color: white;" >Want to Edit Your Email-ID ?</h1>
    <form method="post">
        <div class="field-wrap " >
            <label>Enter Your Email<span class="req">*</span>
            </label>
            <input  type="email" id="edit_email" required autocomplete="off"/>
        </div>
        <button onclick="editEmail()" class="button button-block">Update Your Password</button>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
    var modal = document.getElementById('edit');
    var modal1 = document.getElementById('edit1');
    var btn1 = document.getElementById("reset1");
    var btn2 = document.getElementById("reset2");
    var span = document.getElementsByClassName("close")[0];
    var span1 = document.getElementsByClassName("close1")[0];
    btn1.onclick = function() {
        modal.style.display = "block";

    }
    btn2.onclick = function() {
        modal1.style.display = "block";

    }
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";

    }
    span1.onclick = function() {
        modal1.style.display = "none";

    }

    $(document).ready(function() {
        fetch_data();
        function fetch_data() {
            var action = "fetch";
            $.ajax({
                url: "api/insertPic.php",
                method: "POST",
                data: {action: action},
                success: function (data) {
                    $('#image_data').html(data);
                }
            });
        }
        $('#image_form').submit(function(event){
            event.preventDefault();
            var image_name = $('#image').val();
            if(image_name == '')
            {
                alert("Please Select Image");
                return false;
            }
            else
            {
                $.ajax({
                    url:"api/insertPic.php",
                    method:"POST",
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert(data);
                        fetch_data();
                        $('#image_form')[0].reset();
                    }
                });
            }
        });
    });


    function  editUserName() {
        var userName = $('#edit_userName').val()
            $.ajax({
                url: "http://localhost/userdetails/api/editUserName.php",
                method: "POST",
                data:  JSON.stringify({ "userName": userName}),
                contentType: "application/json",
                processData: false,
                success: function (data) {
                    JSON.stringify(data);
                    var status = data[0].status;
                    console.log(status);
                    if (status == 'success') {
                        alert('UserName Updated Successfully');
                        window.location.replace("http://localhost/userdetails/userProfile.php");
                    }
                    else {
                        alert('Failed to update .....');
                        return false;
                    }
                }
            });
        }

    function  editEmail() {
        var Email = $('#edit_email').val();

        $.ajax({
            url: "http://localhost/userdetails/api/editEmail.php",
            method: "POST",
            data:  JSON.stringify({ "Email": Email}),
            contentType: "application/json",
            processData: false,
            success: function (data) {
                JSON.stringify(data);
                var status = data[0].status;
                console.log(status);
                if (status == 'success') {
                    alert('Email Updated Successfully');
                    window.location.replace("http://localhost/userdetails/userProfile.php");
                }
                else {
                    alert('Failed to update .....');
                    return false;
                }
            }
        });
    }



</script>
</body>
</html>