<?php 

session_start();
$username = $_POST["username"];
$password = $_POST["password"];

if ($username == "admin" && $password=="admin"){
    $_SESSION['user'] = $username;
    header("Location: admin/");

}else{
    $_SESSION['error'] = "Username or password wrong.";
    //$messages['error'] = "Username or password wrong.";
    header("Location: /");
}

?>