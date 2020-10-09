<?php
session_start(); 

if(isset($_SESSION['user'])!="")
{
 header("Location: loc.php");
}
$connection = mysqli_connect("localhost", "root","password");
mysqli_select_db($connection,'testdb');

if(isset($_POST['submit']))
{
 //$uid = mysqli_real_escape_string($connection,$_POST['uid']);
 $email = mysqli_real_escape_string($connection,$_POST['email']);
 $upass = mysqli_real_escape_string($connection,$_POST['pass']);
 $name = mysqli_real_escape_string($connection,$_POST['name']);
 $age = mysqli_real_escape_string($connection,$_POST['age']);
 $gender = mysqli_real_escape_string($connection,$_POST['gender']);
 $org = mysqli_real_escape_string($connection,$_POST['org']);
 $jd = mysqli_real_escape_string($connection,$_POST['jd']);
 $ht = mysqli_real_escape_string($connection,$_POST['hometown']);
 $interests = $_POST['interests'];
 $latitude=mysqli_real_escape_string($connection,$_POST['lati']);
 $longitude=mysqli_real_escape_string($connection,$_POST['longi']);
 
 $users_tb = "INSERT INTO users
( username, password, name, age, gender, hometown)
VALUES('$email','$upass', '$name','$age','$gender', '$ht')";
mysqli_query($connection,$users_tb) or die(mysqli_error($connection));


 $users_info_tb = "INSERT INTO userprof
           (organization, job_profile)
        VALUES( '$org', '$jd')";
mysqli_query($connection,$users_info_tb) or die(mysqli_error($connection));


$users_int = "INSERT INTO userint
( i1, i2, i3, i4, i5)
VALUES('$interests[0]','$interests[1]', '$interests[2]', '$interests[3]', '$interests[4]')";
mysqli_query($connection,$users_int) or die(mysqli_error($connection));

$userloc_info_tb = "INSERT INTO userloc
           (lati, longi)
        VALUES( '$latitude', '$longitude')";
mysqli_query($connection,$userloc_info_tb) or die(mysqli_error($connection));


printf("Please note down your USER ID number %d\n", mysqli_insert_id($connection));
echo "<br>";
echo "<br>";
echo "To login click here <a href='index.php'>Login</a>"; 

} ?>

 
<body style="background-image: url('bgr1.jpg')">

