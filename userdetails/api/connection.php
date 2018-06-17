<?php

$mysqli = new mysqli("localhost","root","","userdetails");
if($mysqli->connect_errno){
printf('connection failed %s ',$mysqli->connect_errno());
exit();
}
?>