<?php

require_once('../vendor/autoload.php');
use \Firebase\JWT\JWT;
define('SECRET_KEY','Your-Secret-Key');  /// secret key can be a random string and keep in secret from anyone
define('ALGORITHM','HS512') ;  // Algorithm used to sign the token, see
                               https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
//// Suppose you have submitted your form data here with username and password

            $tokenId    = base64_encode(random_bytes(32));
            $issuedAt   = time();
            $notBefore  = $issuedAt + 10;  //Adding 10 seconds
            $expire     = $notBefore + 7200; // Adding 60 seconds
            $serverName = 'http://localhost/userdetails/'; /// set your domain name
            $data = [
                'iat'  => $issuedAt,         // Issued at: time when the token was generated
                'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                'iss'  => $serverName,       // Issuer
                'nbf'  => $notBefore,        // Not before
                'exp'  => $expire,           // Expire
            ];
            $secretKey = base64_decode(SECRET_KEY);
            /// Here we will transform this array into JWT:
            $jwt = JWT::encode(
                $data, //Data to be encoded in the JWT
                $secretKey, // The signing key
                ALGORITHM
            );
            $unencodedArray = ['jwt' => $jwt];
            echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";

session_start();
include_once('connection.php');
$data = json_decode(file_get_contents('php://input'),true);
$username = $data['username'];
$email = $data['email'];
$password = $data['password'];
$mobile = $data['mobile'];
$pass=md5($password);
$query = 'INSERT INTO users(username,email,password,mobile,token)  VAlUES ("' . $username . '","' . $email . '","' . $pass . '","' . $mobile . '","' . implode($unencodedArray) . '")';
if (mysqli_query($mysqli, $query)) {
    echo "New record created successfully";
    $_SESSION['loggedIn'] = 1;
    $query1= "select uid from users where username='$username'";
    if($res= mysqli_query($mysqli,$query1)){
        if ($row=mysqli_fetch_array($res,MYSQLI_BOTH)) {
            $_SESSION['uid']=$row['uid'];
            $_SESSION['email']=$email;
            $_SESSION['username']=$username;
        }
    }
}
else {
    echo "Error: " . $query . "" . mysqli_error($mysqli);
}
?>