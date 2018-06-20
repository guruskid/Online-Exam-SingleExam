<?php
@session_start();
require_once("config.php");
if(islogged())
{
if(isset($_POST['opt']))
{
$opt=strip_tags(trim($_POST['opt']));	
$realans=array("A","B","C","D","A","B","C","D","A","B","C","D","A","B","C","D","A","B","C","D","A","B","C","D","A","B","C","D","A","B");
$userans=array();
$userans=explode("~",$opt);
$marks=0;
$noatem=0;
$correct=0;
$wrong=0;
if(count($realans)==$valid)
{
for($i=0;$i<$valid;$i++)
{
if($userans[$i]=="pp"){$marks=$marks;$noatem++;}
else if($userans[$i]==$realans[$i]){$marks=$marks+3;$correct++;}	
else if($userans[$i]!=$realans[$i]){$marks=$marks-1;$wrong++;}	
}
if($cur<$end+10){
mysql_query("INSERT INTO submits(stuid,options,marks,notattempted,correct,wrong,ip) VALUES('".mysql_real_escape_string($_SESSION['stuid'])."','$opt','$marks','$noatem','$correct','$wrong','$ip')");
echo "submitted";
}
else
{
echo "Time Up";	
}
}
else
{
echo "Problem in Evalution";	
}
}
}
?>
