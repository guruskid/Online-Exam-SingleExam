<?php
error_reporting(0);
$connect=mysql_connect("localhost","root","sf1prathap") or die("Error in connecting to Server");
mysql_select_db("sdcacquiz",$connect) or die("Error while Selecting Database");
date_default_timezone_set('Asia/Kolkata');
$ip=$_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
$teamchecking=true;
$cur=date("His");
$end=date("145850");
$endt="06:30:00 PM";
$que=30;
$valid=30;

function islogged()
{
if(isset($_SESSION['stuid']) && !empty($_SESSION['stuid'])){return true;}
else{return false;}
}


?>
