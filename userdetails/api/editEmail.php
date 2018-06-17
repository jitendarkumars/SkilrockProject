<?php
//action.php
session_start();
    include_once('connection.php');

$data = json_decode(file_get_contents('php://input'),true);
        $uid=$_SESSION['uid'];
        $email=$data["Email"];
        $res = array();
        $query = "update users set  email = '$email' where uid='$uid'";
        if (mysqli_query($mysqli, $query)) {
            $res[] = array( "email" => $email,
                "status" => 'success');
            $_SESSION['email']=$email;
            echo 'Email Updated';

        }
        else{
            $res[] =array("status"=>'failed');
            echo "failed to update";
        }

header('Content-type: application/json');
echo json_encode($res);
mysqli_close($mysqli);
?>
