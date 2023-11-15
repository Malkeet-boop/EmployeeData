<?php
session_start();
// Include class definition
include_once "function.php";
include_once "commonFunctions.php";
$sign=new Signup();
$commonfunction=new Common();

$company_id=$_SESSION["company_id"];
$type=$_POST["type"];

$table="";
$tableheading="";

if($type=="archived"){
	$qryselempdetails="Select id, employee_name, employee_code, mobile_number, email, archived from employee_details where company_id='".$company_id."' and archived='Yes'";
	$tableheading="<th>Archived</th>";
}
else{
	$qryselempdetails="Select id, employee_name, employee_code, mobile_number, email, archived from employee_details where company_id='".$company_id."' and archived='No'";
	$tableheading="<th>Edit</th><th>Delete</th>";
}

$empdetails = $sign->FunctionJSON($qryselempdetails);
$empdetailscnt = $sign->FunctionDataCount($qryselempdetails);

$decodedJSON = json_decode($empdetails);
$count = 0;
$i = 1;
$x=$empdetailscnt;
$table="";
$it=1;
	
$table.="<thead><tr><th class='text-center'>#</th><th>Employee Name</th><th>Employee Code</th><th class='text-center'>Mobile Number</th><th>Email</th>".$tableheading."</tr></thead><tbody>";

if($empdetailscnt==0){
	$table.="<tr><td colspan='7'><center>No Record Found</center></td></tr>";
}
else{
	while($x>=$i){
		$id = $decodedJSON->response[$count]->id;
		$count=$count+1;
		$employee_name = $decodedJSON->response[$count]->employee_name;
		$count=$count+1;
		$employee_code  = $decodedJSON->response[$count]->employee_code ;
		$count=$count+1;
		$mobile_number  = $decodedJSON->response[$count]->mobile_number ;
		$count=$count+1;
		$email  = $decodedJSON->response[$count]->email ;
		$count=$count+1;
		$archived  = $decodedJSON->response[$count]->archived ;
		$count=$count+1;
		
		if($type=="archived"){
			$delete="Archived";
			$edit="";
		}
		else{
			$delete="<a href='javascript:void(0);' onclick='deleterecord(".$id.");'><i class='ti-trash'></i></a>";
			$edit="<td style='text-align:center;'><a href='javascript:void(0);' onclick='editrecord(".$id.");'><i class='ti-pencil'></i></a></td>";
		}
		
		$table.="<tr>";
		$table.="<td class='text-center'>".$id."</td>"; 
		$table.="<td>".$employee_name."</td>";
		$table.="<td>".$employee_code."</td>";
		$table.="<td class='text-center'>".$mobile_number."</td>";
		$table.="<td>".$email."</td>";
		$table.=$edit;
		$table.="<td>".$delete."</td>";
		$table.="</tr>";
		
		$i=$i+1;
	}
}
echo $table;
?>
	