<?php
session_start(); 

if(isset($_SESSION['user'])!="")
{
 header("Location: loc.php");
}
$connection = mysql_connect("localhost", "root","");
mysql_select_db('testdb', $connection);

if(isset($_POST['submit']))
{
 //$uid = mysql_real_escape_string($_POST['uid']);
 $email = mysql_real_escape_string($_POST['email']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $name = mysql_real_escape_string($_POST['name']);
 $age = mysql_real_escape_string($_POST['age']);
 $gender = mysql_real_escape_string($_POST['gender']);
 $org = mysql_real_escape_string($_POST['org']);
 $jd = mysql_real_escape_string($_POST['jd']);
 $ht = mysql_real_escape_string($_POST['hometown']);
 $interests = $_POST['interests'];
 $latitude=mysql_real_escape_string($_POST['lati']);
 $longitude=mysql_real_escape_string($_POST['longi']);
 
 $users_tb = "INSERT INTO users
( username, password, name, age, gender, hometown)
VALUES('$email','$upass', '$name','$age','$gender', '$ht')";
mysql_query($users_tb) or die(mysql_error());


 $users_info_tb = "INSERT INTO userprof
           (organization, job_profile)
        VALUES( '$org', '$jd')";
mysql_query($users_info_tb) or die(mysql_error());


$users_int = "INSERT INTO userint
( i1, i2, i3, i4, i5)
VALUES('$interests[0]','$interests[1]', '$interests[2]', '$interests[3]', '$interests[4]')";
mysql_query($users_int) or die(mysql_error());

$userloc_info_tb = "INSERT INTO userloc
           (lati, longi)
        VALUES( '$latitude', '$longitude')";
mysql_query($userloc_info_tb) or die(mysql_error());


printf("Please note down your USER ID number %d\n", mysql_insert_id());
echo "<br>";
echo "<br>";
echo "To login click here <a href='index.php'>Login</a>"; 

} ?>

 
<body style="background-image: url('bgr1.jpg')">



 
