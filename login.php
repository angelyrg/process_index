<?php 

session_start();
$username = $_POST["username"];
$password = $_POST["password"];

if ($username == "admin" && $password=="admin"){
    $_SESSION['user'] = $username;

    $_SESSION['success'] = "Login successfuly";
    header("Location: admin/");

}else{
    $_SESSION['error'] = "Username or password wrong.";
    header("Location: /");
}

?>