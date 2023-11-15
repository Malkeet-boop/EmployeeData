<?php
session_start();
include("function.php");
include("commonFunctions.php");
$sign=new Signup();
$commonfunction=new Common();

$employee_name=$_POST["employee_name"];
$employee_code=$_POST["employee_code"];
$employee_email=$_POST["employee_email"];
$employee_mobile=$_POST["employee_mobile"];
$requesttype=$_POST["valrequesttype"];
$EmpID=$_POST["EmpID"];
$company_id=$_SESSION["company_id"];

date_default_timezone_set("Asia/Kolkata");
$date=date("Y-m-d H:i:s");
$ip_address= $commonfunction->getIPAddress();

if($requesttype=="add"){
	$qry="Select count(*) as cnt from employee_details where email='".$employee_email."' and archived!='Yes'";
	$retVal = $sign->Select($qry);
	if($retVal>0){
		echo "Exist";
	}
	else{	
		$qry1="insert into employee_details (company_id,employee_name,employee_code,mobile_number,email,archived,created_by,created_on,created_ip) values('".$company_id."','".$employee_name."','".$employee_code."','".$employee_mobile."','".$employee_email."','No','".$company_id."','".$date."','".$ip_address."')";
		$retVal1 = $sign->FunctionQuery($qry1);
	
		if($retVal1=="Success"){
			echo "Success";
		}
		else{
			echo "Error";
		} 
	}
}
else if($requesttype=="delete"){	
	$qryUpdatedelrec="update employee_details set archived='Yes',modified_by='".$company_id."',modified_on='".$date."',modified_ip='".$ip_address."' where company_id='".$company_id."' and id='".$EmpID."'";
	$responsedelemp = $sign->FunctionQuery($qryUpdatedelrec);
	
	if($responsedelemp=="Success"){	
		echo "Success";
	}
	else{
		echo "Error";
	}	
}
else{
	$qry="Select count(*) as cnt from employee_details where email='".$employee_email."' and archived!='Yes' and id!='".$EmpID."'";
	$retVal = $sign->Select($qry);
	if($retVal>0){
		echo "Exist";
	}
	else{	
		$qry1="Update employee_details set employee_name='".$employee_name."',employee_code='".$employee_code."',mobile_number='".$employee_mobile."',email='".$employee_email."',modified_by='".$company_id."',modified_on='".$date."',modified_ip='".$ip_address."' where id='".$EmpID."'"; 
		$retVal1 = $sign->FunctionQuery($qry1);
			
		if($retVal1=="Success"){
			echo "Success";	
		}
		else{
			echo "error";
		}   
	}
}
?>
