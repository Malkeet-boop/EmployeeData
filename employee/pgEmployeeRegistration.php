<?php 
session_start();
if(!isset($_SESSION["companyusername"])){
	header("Location:pgLogIn.php");
}
include_once "function.php";
include_once "commonFunctions.php";
$sign=new Signup();
$commonfunction=new Common();
$company_id = $_SESSION["company_id"];

$selcompname="Select company_name from company_details where id='".$company_id."'";
$CompanyName = $sign->SelectF($selcompname,"company_name");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Employee Registration</title>
<!-- plugins:css -->
<link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
<link rel="stylesheet" href="../assets/css/custom/sweetalert2.min.css">
<link rel="stylesheet" href="../assets/css/custom/style.css">
<link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<nav class="navbar justify-content-between navstyle">
<a class="text-white" href="pgEmployeeRegistration.php"><?php echo $CompanyName; ?></a>
  <a class="navbar-brand"></a>
  <form class="form-inline">
	<a class="dropdown-item text-white logoutsize" href="pgLogIn.php" ><i class="ti-power-off icolor"></i> <span class="icolor">Logout</span></a>
  </form>
</nav>
<div class="container-fluid ">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
			<div class="content-wrapper min-vh-100 row-color">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
						<h4 class="card-title c1 mt-3">Employee Registration</h4>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 mb-3 mt-3">
						<button type="button" title="Add New Employee" onclick="location.href='pgEmployeeRegistrationForm.php?type=add&id=';" class="btn btn-light bg-white btn-icon float-right"><i class="ti-plus text-muted"></i></button>
						<button type="button" title="Archived Employee" onclick="showdata('archived');" class="btn btn-light bg-white btn-icon float-right"><i class="ti-archive text-muted"></i></button>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 grid-margin stretch-card">
										<div class="card">
											<div class="card-body">
												 <div class="table-responsive">
													<table id="tableData" class="expandable-table table-bordered tw_tableData_width"></table>
												 </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  
		</div>  
	</div>  
	<footer class="footer">
	  <div class="d-sm-flex justify-content-center justify-content-sm-between">
		<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.</span>
		<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Contact Us | Privacy Policy | Terms</span>
	  </div>
	</footer> 
</div>   
<script src="../assets/css/jquery/jquery.min.js"></script>
<script src="../assets/js/custom/sweetAlert.js"></script>
<script src="../assets/js/custom/sweetAlert2.min.js"></script> 
<script type='text/javascript'>
$(document).ready(function(){
	showdata('');
});
function showdata(archived){
	$.ajax({
		type:"POST",
		url:"apiGetEmployeeDetails.php",
		data:{type:archived},
		success:function(response){
			$("#tableData").html(response);
		}
	}); 
}
function editrecord(id){
	window.location.href = "pgEmployeeRegistrationForm.php?type=edit&id="+id;

}
var valrequesttype='delete';
function deleterecord(id){
	showConfirmAlert('Confirm action!', 'Are you sure you want to delete this record?','question', function (confirmed){
		if(confirmed==true){
			$.ajax({
				type:"POST",
				url:"apiAddEmployee.php",
				data:{employee_name:"",employee_code:"",employee_email:"",employee_mobile:"",valrequesttype:valrequesttype,EmpID:id},	
				success:function(response){
					if($.trim(response)=="Success"){	
						showAlert("Success","Employee Deleted Successfully and is visible in the Archived Employees section.","success");
						showdata('');	
					}
					else{
						showAlert("Error","Something Went wrong","error");
							
					}
				}
			});
		}		
	});
}
</script>	
</body>
</html>