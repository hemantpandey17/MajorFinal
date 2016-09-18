<?php
session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: loc.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="C:\EasyPHP-12.1\www\GRS\RS\css\style.css" type="text/css" />

</head>
<body background="bgr.jpg">
<center>
<div id="login-form">
<form method="post" action='reg_submit.php'>
<table align="center" width="30%" border="0">
<!--<tr>
<td><input type="text" name="uid" placeholder="User ID (Any preferable Number)" required /></td>
</tr>-->
<tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><input type="text" name="name" placeholder="Name(Full Name)" required /></td>
</tr>
<tr>
<td><input type="number" name="age" placeholder="Age" required /></td>
</tr>
<tr>
<td>
<input type="radio" name="gender" value="male" checked> Male<br>
<input type="radio" name="gender" value="female"> Female<br>
<input type="radio" name="gender" value="other"> Other  
</td></tr>
<tr>
<td><input type="text" name="hometown" placeholder="Hometown(In Delhi)" required /></td>
</tr>
<tr>
<td>
<a href="http://www.latlong.net/" target="_blank"> Click here to determine exact location of your address </a>
</td>
</tr>
<tr>
<td>
<input type="text" name="lati" placeholder="Latitude" required />
</td>
</tr>
<br>
<tr>
<td>
<input type="text" name="longi" placeholder="Longitude" required />
</td>
</tr>






<tr>
<td><input type="text" name="org" placeholder="Organisation" required /></td>
</tr>
<tr>
<td><input type="text" name="jd" placeholder="Job Profile" required /></td>
</tr>
<tr><td colspan = "2">
<h3>Interests (Top 5 from high to low)</h3>
</td></tr>

<tr>
<td><input type="checkbox" name="interests[]" value="Badminton" />Badminton</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Cooking" />Cooking</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Yoga" />Yoga</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Chess" />Chess</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Cricket" />Cricket</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Gardening" />Gardening</td></tr>
<td><input type="checkbox" name="interests[]" value="Travelling" />Travelling</td>
<tr><td><input type="checkbox" name="interests[]" value="Computer Programming" />Computer Programming</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Writing" />Writing</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Soccer" />Soccer</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Singing" />Singing</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Dancing" />Dancing</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Soccer" />Soccer</td></tr>
<tr><td><input type="checkbox" name="interests[]" value="Body Building" />Body Building</td></tr>



<tr><td></td></tr>







<tr>
<td><button type="submit" name="submit">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>