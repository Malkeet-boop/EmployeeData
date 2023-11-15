<?php	
// Include class definition
include("function.php");
include("commonFunctions.php");

$companyname = $_POST["companyname"];
$email = $_POST["email"];
$password = $_POST["password"];
$commonfunction=new Common();
$sign=new Signup();
$ip_address= $commonfunction->getIPAddress();

date_default_timezone_set("Asia/Kolkata");
$date=date("Y-m-d H:i:s");

$qrycheckemail="Select count(*) as cnt from company_details where email='".$email."'";
$checkemailresponse = $sign->Select($qrycheckemail);
	
if($checkemailresponse>0){
	echo "Exist";
}
else
{
	$qry1="insert into company_details (company_name,email,password,created_by,created_on,created_ip) values('".$companyname."','".$email."','','".$companyname."','".$date."','".$ip_address."')";
	$retVal1 = $sign->FunctionQuery($qry1,true);
	if($retVal1!=""){
		$qryInsertlogin="insert into company_login (company_id,username,password,created_by,created_on,created_ip) values('".$retVal1."','".md5($email)."','".md5($password)."','".$retVal1."','".$date."','".$ip_address."')";
		$Insertloginresponse = $sign->FunctionQuery($qryInsertlogin);
		if($Insertloginresponse=="Success"){
			echo "Success";
		}
		else{
			echo "error";
		}		
	}
	else{
		echo "Error";
	} 
} 	
?>
