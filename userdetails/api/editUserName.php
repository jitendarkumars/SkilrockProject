<?php
//action.php
session_start();
include_once('connection.php');

$data = json_decode(file_get_contents('php://input'),true);
$uid=$_SESSION['uid'];
$userName=$data["userName"];
$res = array();
$query = "update users set  username = '$userName' where uid='$uid'";
if (mysqli_query($mysqli, $query)) {
    $res[] = array( "userName" => $userName,
        "status" => 'success');
    $_SESSION['username']=$userName;
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
