<?php
include_once('connection.php');
$data = json_decode(file_get_contents('php://input'),true);
 $query = 'SELECT * FROM `users` WHERE email="' . $data['email'] . '" AND password="' . md5($data['password'] ). '"';
    $res = array();
    if ($result = mysqli_query($mysqli, $query)) {
        if ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            $res[] = array("userName" => $row['UserName'],
                "uid" => $row['uid'], "email" => $data['email'],
                "status" => 'success');
            session_start();
            $_SESSION['loggedIn'] = 1;
            $_SESSION['uid'] =  $row['uid'];
            $_SESSION['username']=$row['UserName'];
        } else {
            $res[] = array("status" => 'Failed');
        }
    } else {
        $res[] = array("status" => 'Failed');

    }

header('Content-type: application/json');
echo json_encode($res);
mysqli_close($mysqli);
?>
