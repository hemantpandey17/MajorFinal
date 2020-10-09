<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$lat = $_POST['lt'];
$lon = $_POST['ln'];
$uid = $_POST['id'];
$rad = $_POST['rd'];
#$lat = "28.674558";
#$lon = "77.274202";
#$uid = "1";
#$rad = "1";

#$outs = shell_exec("python C:\Python27\ recommend.py $uid $lat ##$lon $rad");
#echo $outs;
#echo '<script>console.log("I am here")</script>';

$outs = '/Users/hemant/anaconda2/bin/python recommend.py ' . $uid . ' ' . $lat . ' ' . $lon . ' ' . $rad;
$output = shell_exec($outs);
#echo '<script>console.log($output)</script>';
echo $output;
?>
