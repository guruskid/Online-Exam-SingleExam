
function pick(field)
		{
			return document.getElementById(field).value;
		}
		

function login()
{
	var uid=pick("uid");
	var passwd=pick("passwd");

 if(uid.length==7 && passwd.length>=1)
{dhtmlx.message("Authenticating <b>"+uid+"</b>...");
	$.post("login_check.php",{uid:uid,passwd:passwd},function(data){if(data.indexOf("invalid")!=-1){dhtmlx.message({ type:"error", text:"Invalid Credentials" })} else if(data.indexOf("success")!=-1){dhtmlx.message("<font style='color:green;font-weight:bold;'>Login successful</font>");location.reload();}else if(data.indexOf("not a student")!=-1){dhtmlx.message({ type:"error", text:"Not a PUC Student" })}else{dhtmlx.message({ type:"error", text:data })} });

}
else
{
	dhtmlx.message({ type:"error", text:"*All fields are required" });
	return false;
}
}

function startexam()
{
$("body").html("<center><br><br><div style='width:250px;padding:14px;background:#fff;'><img src='loading.gif'><h3>Loading...</h3></div></center>");
window.location='startexam.php';	
}


function teamreg()
{
var ids="";
ids=ids+$("#uid1").val()+"~";	
ids=ids+$("#uid2").val()+"~";	
ids=ids+$("#uid3").val();	

if(ids!="" && ids!=undefined)
{
dhtmlx.message("Checking...");
$.post("teamregdb.php",{ids:ids},function(data){if(data.indexOf("regdone")!=-1){alert("Registered...");window.location='index.php';}else{dhtmlx.message({ type:"error", text:data })}});	
}
else
{
dhtmlx.message({ type:"error", text:"Please check form" })}	
}
