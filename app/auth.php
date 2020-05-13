<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>

<?php
session_start();
if(!isset($_SESSION["riyousha"])){
header("Location: ".$base_url."login.php");
exit(); }
?>
