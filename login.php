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
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$user_id = stripslashes($user_id);
$password = stripslashes($password);
$user_id = mysql_real_escape_string($user_id);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("testdb", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from users where password='$password' AND user_id='$user_id'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$user_id; // Initializing Session
header("location: main.php"); // Redirecting To Other Page
} else {
$error = "user_id or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>
