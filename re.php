<?php
@session_start();
require_once("config.php");
$qu=mysql_query("SELECT * FROM submits");
$realans=array("D","B","C","D","D","A","C","B","A","B","D","A","B","D","A","B","B","B","C","A","B","A","D","B","A","C","C","B","C","B");
while($re=mysql_fetch_array($qu))
{
$opt=$re['options'];
$userans=array();
$userans=explode("~",$opt);
$marks=0;
$noatem=0;
$correct=0;
$wrong=0;

for($i=0;$i<30;$i++)
{
if($i==8){$marks=$marks+3;$correct++;continue;}
if($userans[$i]=="pp"){$marks=$marks;$noatem++;}
else if($userans[$i]==$realans[$i]){$marks=$marks+3;$correct++;}	
else if($userans[$i]!=$realans[$i]){$marks=$marks-1;$wrong++;}	
}
if(mysql_num_rows(mysql_query("SELECT * FROM submits_new WHERE stuid='".$re['stuid']."'"))!=1)
{
if(mysql_query("INSERT INTO submits_new(stuid,options,marks,notattempted,correct,wrong,ip) VALUES('".mysql_real_escape_string($re['stuid'])."','$opt','$marks','$noatem','$correct','$wrong','$ip')") or die(mysql_error()))
{echo $re['stuid']." Inserted<br>";}
}
}

?>
