<?php
@session_start();
@include_once("config.php");
if($cur<$end)
{
if(islogged())
{
$flag=0;
$che=0;
if($teamchecking==true){
	$teams=mysql_query("SELECT * FROM teams");
	while($te=mysql_fetch_array($teams))
	{
	$arr=explode("~",$te['ids']); 
	if(in_array($_SESSION['stuid'],$arr)){
		$flag=1;
	
	for($i=0;$i<count($arr);$i++)
	{
	if($arr[$i]!=$_SESSION['stuid']){
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

	if(mysql_num_rows(mysql_query("SELECT * FROM submits WHERE stuid='".$_SESSION['stuid']."'"))<1){
		?>
		<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>SDCAC QUIZ</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/message_default.css" type="text/css" />
<script src="js/Jquery.js"></script>
<script src="js/script.js"></script>
<script src="js/message.js"></script>
</head>

<body class="login">

<script src="countdown.js" type="text/javascript"></script>		
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
	{
	$('#clock').load('Time.php');
	},1000);
	
var t=<?php echo $end-$cur;?>;
setInterval(function(){
	t--;
	if(t==0)
	{
submitexam('<?php echo $que;?>','auto');	
	}
	
},1000);


	</script>
<center>
	<table width="90%" style="background:#fff;" id="customers">
	<th colspan="3">SDCAC QUIZ - <b><?php echo $_SESSION['stuid'];?></b></th>
	<tr><td>Clock: <b id="clock"></b></td><td width="200px">End Time: <b id="remain"><?php echo $endt;?></b></td><td  style='text-align:center;'><b>Remaining :</b><center><script type="application/javascript">
var myCountdown2 = new Countdown({
									time: <?php echo $end-$cur?>, 
									width:150, 
									height:55, 
									rangeHi:"minute"	// <- no comma on last item!
									});

</script></center>
</td></tr>
    <tr><td colspan="2"><iframe src="papers/quiz.pdf" width="100%" height="385px" frameborder="0"></iframe></td>
    <td style="width:250px;">
    <div style="height:405px;overflow:scroll;position:relative;margin-top:00px;">
    <?php
    
									echo "<table style='position:relative;margin-top:-200px;'>";
									for($i=1;$i<=$que;$i++)
									{
									$options=array("a","b","c","d");
									shuffle($options);
								
									echo "<tr><td>".$i.".</td><td><input type='button' id='q".$i.$options[0]."' onclick=\"change('q".$i.$options[0]."','q".$i."')\" style='border:1px;background-color:#D8D8D8;' value='".strtoupper($options[0])."'></td><td><input type='button' id='q".$i.$options[1]."' onclick=\"change('q".$i.$options[1]."','q".$i."')\" style='border:1px;background-color:#D8D8D8;' value='".strtoupper($options[1])."'></td><td><input type='button' onclick=\"change('q".$i.$options[2]."','q".$i."')\" id='q".$i.$options[2]."' style='border:1px;background-color:#D8D8D8;' value='".strtoupper($options[2])."'></td><td><input type='button' id='q".$i.$options[3]."' onclick=\"change('q".$i.$options[3]."','q".$i."')\" style='border:1px;background-color:#D8D8D8;' value='".strtoupper($options[3])."'></td><td><div id='deselq".$i."' style='display:none;'><input type='button'  onclick=deselect('q".$i."') style='border:1px;background-color:red;color:green;cursor:pointer;' value='X'></div></td></tr>";	
									echo "
									<input type='radio' id='q".$i."ar' value='a'  style='visibility:hidden;' name='q".$i."' >
									<input type='radio' id='q".$i."br' value='b' style='visibility:hidden;' name='q".$i."'  >
									<input type='radio' id='q".$i."cr' value='c' style='visibility:hidden;'  name='q".$i."' >
									<input type='radio' id='q".$i."dr' value='d' style='visibility:hidden;'  name='q".$i."'  >
									
									";
									}
									echo "</table>";
									?>
		</div>							
    </td>
    </tr>
    <tr><td colspan="2">Answered <b id="progress">0</b>/<?php echo $que;?></td>
    <td><span id='load' style='display:none;'><img src='ajax-loading.gif'></span><span  id="subex"><a class='my-button medium green' style='cursor:pointer;text-decoration:none;' onclick=submitexam('<?php echo $que;?>','manual')>Submit Exam</a></span></td></tr>
<tr><td colspan="3">Prathap Puppala,N130950</td></tr>
 	</table>
 	</center>
 	<script>
function submitexam(num,cat)
{		
var opt="";
var co=1;
for(var i=1;i<=num;i++)
{
if($("input[name=q"+i+"]:checked").val()!=undefined)
{
	opt=opt+$("input[name=q"+i+"]:checked").val().toUpperCase();
	co++;
	if(co<=num){opt=opt+"~";}
	
}

else
{
opt=opt+"pp";	
co++;
if(co<=num){opt=opt+"~";}
}		
}

var cansub=0;
if(cat!="auto"){if(confirm("Are you Sure to submit?")){cansub=1;}else{return false;}}
else{cansub=1;}
		
if(cansub==1)
{
$("#subex").hide();
$("#load").show();
$.post("submitexam.php",{opt:opt},function(data){if(data.indexOf("submitted")!=-1){alert("Submited Successfully");$("#load").hide();window.location='index.php';}else{alert(data);$("#subex").show();}});
}
else
{
	return false;
}
}		

var complete="";
var count=0;
function change(qtno,qt)
{
	var k=0;
	if(complete.search(qt)>=0)
		count=count;
	else
		count++;
	$("#optdone").html(count);
	var allopt=["a","b","c","d"];
	for(k;k<4;k++)
		{
			$("#"+qt+allopt[k]).css("background-color","#D8D8D8 ");
			$("#"+qt+allopt[k]).css("color","#000");
			
		}
    $("#desel"+qt).css("display","block");
	$("#"+qtno).css({"background-color":"#9900FF"});
	$("#"+qtno).css({"color":"yellow"});
	$("#"+qtno+"r").attr("checked","true");
	complete=complete+qt;
document.getElementById("progress").innerHTML=count;
}

function deselect(qtno)
{
complete=complete.replace(qtno,"");
	var k=0;
	count--;
$("#optdone").html(count);
	var allopt=["a","b","c","d"];
	for(k;k<4;k++)
		{
			$("#"+qtno+allopt[k]).css("background-color","#D8D8D8 ");
			$("#"+qtno+allopt[k]).css("color","#000");
			$("#"+qtno+allopt[k]+"r").removeAttr("checked");
			
		}
    $("#desel"+qtno).css("display","none");
    
document.getElementById("progress").innerHTML=count;
	
}
</script>
</body>
</html>
		<?php
		}

}
else if($flag==0)
{
echo "<script>alert('Please Register Team');</script>";
}
else if($flag==1)
{
echo "<script>alert('We found One of your friend activity in thi site');</script>";
}
	
	
	
	
}
}
else
{
echo "<script>alert('Timeup');window.location='index.php';</script>";	
}
?>
