<?php
@session_start();
@include_once("config.php");
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
<!-- header starts here -->
<div id="cse-Bar">
  <div id="cse-Frame">
    <div id="logo"> <a href="">SDCAC QUIZ</a> </div>
    
         
        <div id="header-main-right">
          <div id="header-main-nav" style="margin-top:20px;">
 <h4 style="color:#fff;">     <?php 
      if(islogged()){echo "Welcome ".$_SESSION['stuid']. ", <a style='text-decoration:none;color:yellow;' href='logout.php'>Logout</a>";}else{echo "Welcome Guest";} 
      ?></h4>
              </div>
          </div>
      </div>
</div>
<!-- header ends here -->
<div id="prathap">
<div class="loginbox radius">
<h2 style="color:#141823; text-align:center;">Welcome to SDCAC QUIZ</h2>
	<div class="loginboxinner radius">
    	<div class="loginheader">
    		<h4 class="title">ALL THE BEST</h4>
    		
    	</div><!--loginheader-->
        
        <div class="loginform">
			
                	<?php if(islogged()==false){ ?>
                	<br>
        	<form id="login" method="post">
				<table border="0">
			<tr><td style="padding-left:50px;">
                 <p style="font-size:14px;" class="title">University ID</p></td><td>&nbsp;</td><td> <input type="text" placeholder="ex: N130950" id="uid"  value="" class="radius mini" />
            </td></tr>
        	<tr><td  style="padding-left:50px;">
                 <p style="font-size:14px;" class="title">Password</p></td><td>&nbsp;</td><td> <input type="password" placeholder="ex: *****" id="passwd"  value="" class="radius mini" />
            </td></tr>
        <tr><td>&nbsp;</td><td colspan="3"><p>
                	<a class="button" class="radius title" onclick="login()" name="client_login" style="width:180px;padding:7px;">Sign in</a>
                	</p>
                </td></tr>
                
                </table>
            </form>
            <?php } 
            else
            {
			?>	
				
			
<table id="customers">
  <tr>
    <th>Name</th>
    <th>End Time</th>
    <th>Link</th>
  </tr>
  <tr style="height:60px;">
  <td>Quiz</td>
  <td>06:30 PM</td>
  <td><?php 
   if(mysql_num_rows(mysql_query("SELECT * FROM submits WHERE stuid='".mysql_real_escape_string($_SESSION['stuid'])."'"))>=1){echo "<a class='my-button medium blue' style='cursor:pointer;text-decoration:none;' href=javascript:alert('Submitted!!!')>Submitted</a>";}
   else{
	if($cur<$end){echo "<a class='my-button medium green' style='cursor:pointer;text-decoration:none;' onclick='startexam()'>Start Exam</a>";}   
	else{echo "<a class='my-button medium red' style='cursor:pointer;text-decoration:none;' href=javascript:alert('TimeUp!!!')>Time Up!</a>";} 
   }
	?></td>
  </tr>
  </table>	
			<?php	
			}
            ?>
            
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->


</div>



<p style="font-size:12px;">
  <center><br>
    <a href="javascript:void(0);" style="text-decoration:none;">Prathap Puppala,N130950</a>
  </center>
</p>

</body>

</html>
