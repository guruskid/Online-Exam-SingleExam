<?php
@session_start();
@include_once("config.php");
if(isset($_POST['ids']) && !empty($_POST['ids']))
{
$ids=strip_tags(trim($_POST['ids']));
$neids=array();
$neids=explode("~",$ids);
$error=0;
for($i=0;$i<count($neids);$i++)
{
if(mysql_num_rows(mysql_query("SELECT * FROM data WHERE stuid='".mysql_real_escape_string($neids[$i])."'"))<1){$error++;}	
}	
if($error>0)
{
echo "Invalid ID Numbers";
}
else if($error==0)
{
$teams=mysql_query("SELECT * FROM teams");
$che=3;
	while($te=mysql_fetch_array($teams))
	{
	$arr=explode("~",$te['ids']); 
	
for($i=0;$i<count($neids);$i++)
{
if(in_array($neids[$i],$arr)){$che--;}
}	
}
if($che==3){mysql_query("INSERT INTO teams(ids,ip) VALUES('$ids','$ip')");echo "regdone";}
else{echo "Already Registered";}	
}



}

?>
