
<?php
//action.php
session_start();
if(isset($_POST["action"])) {
    include_once('connection.php');
    if ($_POST["action"] == "fetch") {
        $uid= $_SESSION['uid'];
        $query = "SELECT * FROM users where  uid='$uid' ";
        $result = mysqli_query($mysqli, $query);
$output='';
        if ($row = mysqli_fetch_array($result)) {
            $output .= '
      <img src="data:image/jpeg;base64,' . base64_encode($row['photo']) . '" alt="Select Your Profile Picture" style="height:150px; width:150px" />
   ';
        }
        echo $output;
    }
    if ($_POST["action"] == "update") {
        $uid=$_SESSION['uid'];
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $query = "update users set  photo = '$file' where uid='$uid'";
        if (mysqli_query($mysqli, $query)) {
            echo 'Image Inserted into Database';
        }
       else{
            echo "failed to upload";
       }
    }
}
?>












