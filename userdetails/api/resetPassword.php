<?php

include_once('connection.php');
$token=$_POST['token'];
$email=$_POST['email'];
$pass= $_POST['new_password'];
$res=array();
$query = 'SELECT * FROM `emailtoken` WHERE email="' . $email . '"and token="' .$token .'"';
if ($result=mysqli_query($mysqli,$query))
{

    if ($row=mysqli_fetch_array($result,MYSQLI_BOTH)) {
        $pass=md5($pass);
        $query1="update users set password='{$pass}'  where email='{$email}'";
        if(mysqli_query($mysqli,$query1)) {
              $res[] = array("status" => 1);
              echo "<script>alert('Password reset successfully'); </script>";
            header('Location: index.php');

        }
        else{
            echo "failed to reset password";
            $res[] = array("status" => 0);
        }
    }
    else{
        echo "Invalid User";
        $res[] = array("status" => 0);
    }
  }

header('Content-type: application/json');
echo json_encode($res);
mysqli_close($mysqli);
?>