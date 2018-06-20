<?php
session_start();
require_once("config.php");
if(isset($_POST['uid']) && isset($_POST['passwd']))
{
$uid=mysql_real_escape_string(strip_tags(htmlspecialchars(addslashes(strtoupper($_POST['uid'])))));
$passwd=mysql_real_escape_string(strip_tags(htmlspecialchars(addslashes($_POST['passwd']))));

if(mysql_num_rows(mysql_query("SELECT * FROM data WHERE stuid='$uid'"))>=1)
	{
$dup=mysql_query("SELECT * FROM data WHERE stuid='$uid' AND password='$passwd'");
if(mysql_num_rows($dup)==1)
{
$flag=0;
$che=0;
if($teamchecking==true){
	$teams=mysql_query("SELECT * FROM teams");
	while($te=mysql_fetch_array($teams))
	{
	$arr=explode("~",$te['ids']); 
	if(in_array($uid,$arr)){
		$flag=1;
	
	for($i=0;$i<count($arr);$i++)
	{
	if($arr[$i]!=$uid){
	if(mysql_num_rows(mysql_query("SELECT * FROM submits WHERE stuid='".$arr[$i]."'"))>=1){$che=$che+1;}
    }
     }
     }
    }
    if($che==0){$flag=$flag+1;}
	
	}
else{$flag=2;}
if($flag==2)
{
$dup_fet=mysql_fetch_array($dup);
$_SESSION['stuid']=$uid;

echo "success";
}
else if($flag==0)
{
echo "Please Register your team";
}
else if($flag==1)
{
echo "Some error Occured";
}
}
else
{
echo "invalid";
}
	}
	else
	{
	echo "not a student";
	}
}

else
{
header("location:index.php");
}
?>
