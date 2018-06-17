
<?php
$mysqli = new mysqli("localhost","root","","userdetails");
if($mysqli->connect_errno){
    printf('connection failed %s ',$mysqli->connect_errno());
    exit();
}
$email = $_POST['email'];
$query = 'SELECT * FROM `users` WHERE email="' . $email . '"';
if ($result=mysqli_query($mysqli,$query))
{
if ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {

    $token=getRandomString(10);
    $query1="insert into emailtoken (token,email) values ('".$token."','".$email."')";
   if(mysqli_query($mysqli,$query1)) {

       mailresetlink($email, $token);
   }


    }
else{
        echo "<script>alert('no user found');</script>";
    }
}
function getRandomString($length)
{
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";

    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
    return $result;
}




function mailresetlink($to,$token){
    $uri = 'http://localhost/userdetails' ;
    require_once('..\PHPMailer\PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username= 'jitendarkumar404@gmail.com';
    $mail->Password= 'Mits@123';
    $mail->SetFrom('no-reply@gmail.com');
    $mail->Subject = 'Reset Passowrd';
    $mail->Body = '\'
            <html>
            <head>
                <title>Forgot Password</title>
            </head>
            <body>
            <p>Click on the given link to reset your password <a href="' .$uri.'/reset.php?token='.$token.'&email='.$to.'">Reset Password</a></p>
            </body>
            </html>
            \'';
    $mail->AddAddress($to);
    if($mail->Send()==true)
    {
      echo "<script>alert('Mail Sent.... Check your mail to reset Your Password....')</script>";

    }
    else{
        echo "<script>alert('failed to send mail.....')</script>";
    }

}
?>
