<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: main.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="stylelogin.css" rel="stylesheet" type="text/css">
<style type="text/css">
.auto-style1 {
	font-size: medium;
	color: #0000FF;
}
.auto-style2 {
	margin-left: 16px;
}
.auto-style4 {
	color: #FFBC00;
	text-decoration: underline;
	font-weight: normal;
	font-style: italic;
}
</style>
</head>
<body background="bgr.jpg">
<div id="main">
<h1 align="center" class="auto-style4">Conneting People to the Similar ones</h1>
<div id="login" align="center" style="width: 915px; height: 396px;">
<h2 style="width: 306px; float: none; background-color: #FFBC00; height: 41px;">Login Form</h2>
<form action=""  method="post" style="height: 270px">
<br>
<label><br><span class="auto-style1">  UserID :</span></label>
<input id="name" name="user_id" placeholder="UserID" type="text" class="auto-style2">
<label><br><br><span class="auto-style1">Password :</span></label>
<input id="password" name="password" placeholder="**********" type="password"><br>
&nbsp;<br>
<input name="submit" type="submit" value=" Login "><br><br>
<a href="reg.php">New User ? </a>
 <span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>
