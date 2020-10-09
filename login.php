<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['user_id']) || empty($_POST['password'])) {
$error = "user_id or Password is invalid";
}
else
{
// Define $user_id and $password
$user_id=$_POST['user_id'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "password");
// To protect MySQL injection for Security purpose
$user_id = stripslashes($user_id);
$password = stripslashes($password);
$user_id = mysqli_real_escape_string($connection,$user_id);
$password = mysqli_real_escape_string($connection,$password);
// Selecting Database
$db = mysqli_select_db($connection,"testdb");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection,"select * from users where password='$password' AND user_id='$user_id'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$user_id; // Initializing Session
header("location: main.php"); // Redirecting To Other Page
} else {
$error = "user_id or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
}
?>
