<?php
$index = $_POST['idd'];
//To establish a link to the database
$link = new mysqli('localhost','root','','testdb');
//For a select query
$result_profile = $link->query("SELECT * FROM users WHERE user_id=$index");
$result_work = $link->query("SELECT * FROM userprof WHERE user_id=$index");
$result_interest = $link->query("SELECT * FROM userint WHERE user_id=$index");
//Each row of the result will be fetched one by one
while($row = $result_profile->fetch_array(MYSQLI_ASSOC))
{
	$hometown = $row['hometown'];
	$name = $row['name'];
	$age = $row['age'];
	$gender = $row['gender'];
	echo "<div id='profile-div'><div class='user-profile'><span class='name'>$name</span><span class='age'>$age</span><span class='gender'>$gender</span><span class='hometown'>$hometown</span></div>";
}
while($row = $result_work->fetch_array(MYSQLI_ASSOC))
{
	$organization = $row['organization'];
	$job_profile = $row['job_profile'];
	echo "<div class='profile-job-div'>Working at <span class='organization'>$organization</span> as <span class='designation'>$job_profile</span></div>";
}
while($row = $result_interest->fetch_array(MYSQLI_ASSOC))
{
	$i1 = $row['i1'];
	$i2 = $row['i2'];
	$i3 = $row['i3'];
	$i4 = $row['i4'];
	$i5 = $row['i5'];
	echo "<div class='user-interests-div'>Likes $i1, $i2, $i3, $i4, $i5</div></div>";
}
?>