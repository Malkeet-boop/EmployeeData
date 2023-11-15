<?php
session_start();
$unenc_email=$_POST["username"];
$password=$_POST["password"];
// Include class definition
include_once "function.php";
include_once "commonFunctions.php";
$commonfunction=new Common();
$sign=new Signup();

$qryselcompcnt="select count(*) as cnt from company_login where username='".md5($unenc_email)."' and password='".md5($password)."'" ;
$responsecompcnt = $sign->Select($qryselcompcnt);

if($responsecompcnt==1){
	
	$qryselcompid="select company_id from company_login where username='".md5($unenc_email)."' and password='".md5($password)."'";
	$valuecompid = $sign->SelectF($qryselcompid,"company_id"); 
		
	$qryEmailCnt="select count(*) as cnt from company_details where email='".$unenc_email."'";
	$ValqryEmailCnt = $sign->Select($qryEmailCnt);
	if($ValqryEmailCnt==1){ 
	$_SESSION["companyusername"]=$unenc_email;
		$_SESSION["company_id"]=$valuecompid; 
		echo "Success";	
	}
	else{
		echo "Error";
	} 
}
else{
	echo "Count greater than 1";
}	
?>