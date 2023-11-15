<?php 
session_start();
if(!isset($_SESSION["companyusername"])){
	header("Location:pgLogIn.php");
}
// Include class definition
include_once "function.php";
include_once "commonFunctions.php";
$sign=new Signup();
$commonfunction=new Common();

$maritalstatus = "";
$requesttype = $_REQUEST["type"];
$id = $_REQUEST["id"];
$company_id = $_SESSION["company_id"];

$employee_name = ""; 
$employee_code = "";
$mobile_number = "";
$email = "";
$archived = "";

$selcompname="Select company_name from company_details where id='".$company_id."'";
$CompanyName = $sign->SelectF($selcompname,"company_name");

if($requesttype=="edit"){
	$qry="SELECT employee_name,employee_code,mobile_number,email,archived from employee_details WHERE company_id='".$company_id."' and id='".$id."'"; 
	$retVal = $sign->FunctionJSON($qry);
	$decodedJSON = json_decode($retVal);

	$employee_name = $decodedJSON->response[0]->employee_name; 
	$employee_code = $decodedJSON->response[1]->employee_code;
	$mobile_number = $decodedJSON->response[2]->mobile_number;
	$email = $decodedJSON->response[3]->email;
	$archived = $decodedJSON->response[4]->archived;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Employee Registration Form</title>
<!-- plugins:css -->
<link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
<link rel="stylesheet" href="../assets/css/custom/tw-switch.css">
<link rel="stylesheet" href="../assets/css/custom/sweetalert2.min.css">
<link rel="stylesheet" href="../assets/css/custom/style.css">
<!-- endinject -->
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
<div class="container-fluid">
	<div class="content-wrapper min-vh-100 row-color">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
				<div class="card mx-auto align-self-center logimg">
					<div class="card-body">
						<center><h4 class="card-title c1 mt-3">Employee Registration Form</h4></center>
						<div class="forms-sample">
							<div class="row">
								<div class="col-lg-6 col-lg-6 col-sm-12 col-xs-12 col-12">
									<div class="form-group">
										<label for="txtEmpName">Employee name<code>*</code></label>
										<input type="text" class="form-control" id="txtEmpName" value="<?php echo $employee_name;?>" placeholder="Name"/>
									</div>
								</div>
								<div class="col-lg-6 col-lg-6 col-sm-12 col-xs-12 col-12">
									<div class="form-group">
										<label for="txtEmpCode">Employee Code<code>*</code></label>
										<input type="text" class="form-control" id="txtEmpCode" value="<?php echo $employee_code; ?>" placeholder="Code"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-lg-6 col-sm-12 col-xs-12 col-12">
									<div class="form-group">
									  <label for="txtEmpEmail">Employee Email<code>*</code></label>
									  <input type="text" class="form-control" id="txtEmpEmail" value="<?php echo $email; ?>" placeholder="Email"/>
									</div>
								</div>
								<div class="col-lg-6 col-lg-6 col-sm-12 col-xs-12 col-12">	
									<div class="form-group" >
										<label for="txtEmpMobile">Employee Mobile Number<code>*</code></label>
										<input type="text" class="form-control" id="txtEmpMobile" value="<?php echo $mobile_number; ?>" placeholder="Mobile Number"/>
									</div>
								</div>
							</div>
							<center><button type="button" id="btnAddrecord" style="background-color:#12448E" class="btn text-white mb-3" onclick="addrecord();"><?php if($requesttype=="add"){ ?>Add Record<?php }else{ ?>Update Record<?php } ?></button></center>
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
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<script src="../assets/css/jquery/jquery.min.js"></script>
<script src="../assets/js/custom/sweetAlert.js"></script>
<script src="../assets/js/custom/sweetAlert2.min.js"></script>
<script src="../assets/js/custom/twCommonValidation.js"></script>
<script type='text/javascript'>
var hdnIDimg="";
var EmpID="<?php echo $id; ?>";
$('input').blur(function()
{
	var valplaceholder = $(this).attr("placeholder");
	var vallblid = $(this).attr("id");
	var valid = "err" + vallblid;
	var valtext = "Please enter " + valplaceholder;
    var check = $(this).val().trim();
	var checkElementExists = document.getElementById(valid);
	if(check=='')
	{
		
		if(!checkElementExists)
		{
			$(this).parent().addClass('has-danger');
			$(this).after('<label id="' + valid + '" class="error mt-2 text-danger">'+valtext+'</label>');
		}

	}
	else
	{
		$(this).parent().removeClass('has-danger');  
		if (checkElementExists)
		{
			checkElementExists.remove();
		}
	}
});
function setErrorOnBlur(inputComponent)
{
	var valplaceholder = $("#" +inputComponent).attr("placeholder");
	var vallblid = $("#" +inputComponent).attr("id");
	var valid = "err" + vallblid;
	var valtext = "Please enter " + valplaceholder;
    var check = $("#" +inputComponent).val().trim();
	var checkElementExists = document.getElementById(valid);
	if(check=='')
	{
		if(!checkElementExists)
		{
			$("#" +inputComponent).parent().addClass('has-danger');
			$("#" +inputComponent).after('<label id="' + valid + '" class="error mt-2 text-danger">'+valtext+'</label>');
			$("#" +inputComponent).focus();

		}

	}
	else
	{
		$("#" +inputComponent).parent().removeClass('has-danger');  
		if (checkElementExists)
		{
			checkElementExists.remove();
		}
	}
}
function setError(inputComponent)
{
	var valplaceholder = $(inputComponent).attr("placeholder");
	var vallblid = $(inputComponent).attr("id");
	var valid = "errSet" + vallblid;
	var valtext = "Please enter valid " + valplaceholder;
	var checkElementExists = document.getElementById(valid);
	if(!checkElementExists)
	{
		$("#" + vallblid).parent().addClass('has-danger');
		$("#" + vallblid).after('<label id="' + valid + '" class="error mt-2 text-danger">'+valtext+'</label>');
	}
	
}
function removeError(inputComponent)
{
	var vallblid = $(inputComponent).attr("id");
	$("#" + vallblid).parent().removeClass('has-danger');
	const element = document.getElementById("errSet"+vallblid);
	if (element)
	{
		element.remove();
	}
}
$("#txtEmpEmail").blur(function()
{
	removeError(txtEmpEmail);
	if ($("#txtEmpEmail").val()!="")
	{
		if(!validateEmail($("#txtEmpEmail").val())){
			setError(txtEmpEmail);
		}
		else
		{
			removeError(txtEmpEmail);
		}
	}
});
$("#txtEmpMobile").blur(function()
{
	removeError(txtEmpMobile);
	if ($("#txtEmpMobile").val()!="")
	{
		if(!isMobile($("#txtEmpMobile").val())){
			setError(txtEmpMobile);
		}
		else
		{
			removeError(txtEmpMobile);
		}
	}
});


function addrecord(){
	if(!validateBlank($("#txtEmpName").val())){
		setErrorOnBlur("txtEmpName");	
	}
	else if(!validateBlank($("#txtEmpCode").val())){
		setErrorOnBlur("txtEmpCode");
	}
	else if(!validateBlank($("#txtEmpEmail").val())){
		setErrorOnBlur("txtEmpEmail");
	}
	else if(!validateEmail($("#txtEmpEmail").val())){
		setError("txtEmpEmail");
	}
	else if(!validateBlank($("#txtEmpMobile").val())){
		setErrorOnBlur("txtEmpMobile");
	}
	else if(!isMobile($("#txtEmpMobile").val())){
		setError("txtEmpMobile");
	}
	else{
		var valrequesttype = "<?php echo $requesttype;?>";
		disableButton('#btnAddrecord','<i class="ti-timer"></i> Processing...');
		$.ajax({
			type:"POST",
			url:"apiAddEmployee.php",
			data:{employee_name:$("#txtEmpName").val(),employee_code:$("#txtEmpCode").val(),employee_email:$("#txtEmpEmail").val(),employee_mobile:$("#txtEmpMobile").val(),valrequesttype:valrequesttype,EmpID:EmpID},
			success:function(response){
				if($.trim(response)=="Success"){
					if(valrequesttype=="add"){
						$('#btnAddrecord').html('Add Record');
						showAlertRedirect("Success","Employee Details Added Successfully","success","pgEmployeeRegistration.php");
						}
					else{
						$('#btnAddrecord').html('Update Record');
 						showAlertRedirect("Success","Employee Details Updated Successfully","success","pgEmployeeRegistration.php");
					}
				}
				else if($.trim(response)=="Exist"){
					showAlertRedirect("Warning","Record already exist","warning","pgEmployeeRegistrationForm.php?type=add&id=");
					
				}
				else{
					showAlert("Error","Something went wrong.Please try after sometime..","success");
					
				}
			}
		});
	}
}
</script>	
</body>
</html>