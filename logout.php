<?php
session_start();
unset($_SESSION['login_user']); //unset will work fine for a specifik session variable. If you want to get rid of all **your** active sessions for your domain use session_destroy();
session_destroy();
header("Location: index.php");
exit;
?>
