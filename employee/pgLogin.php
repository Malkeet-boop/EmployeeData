<?php
include_once "commonFunctions.php";
$commonfunction=new Common();
$CommonDataValueCommonImagePath =$commonfunction->getCommonDataValue("CommonImagePath");
$MainLogo=$commonfunction->getCommonDataValue("MainLogo");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Login </title>
<!-- plugins:css -->
<link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../assets/css/custom/sweetalert2.min.css">
<link rel="stylesheet" href="../assets/css/custom/style.css">
<!-- endinject -->
<link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
<link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
	<div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 mx-auto">
					<div class="cardradius auth-form-light text-left py-5 px-4 px-sm-5" >
						<center><img src="../assets/images/login.png" alt="logo" class="logimg mb-3"></center>
						<h4>Hello Company! let's get started</h4>
						<h6 class="font-weight-light">Sign in to continue.</h6>
						<div class="pt-3">
							<div class="form-group">
								<input type="email" class="form-control" id="txtUsername" placeholder="Username"/>
							</div>	
							<div class="form-group">	
								<input type="password" class="form-control" id="txtPassword" placeholder="Password"/>
								<span class="ti-eye view-password" onmousedown="viewPassword('#txtPassword');" onmouseup="viewPassword('#txtPassword');"></span>
							</div>   
							<div class="mt-3 mb-3">
								<button class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" style="background-color:#12448E" id="btnSignIn"  onclick="adminWindow();">SIGN IN</button>
							</div>
							<div class="card card-inverse-danger" id="ERROR">	
								<div class="card-body">
									<p class="card-text"> Invalid username or password</p>
								</div>
							</div>
							<div class="text-center mt-4 font-weight-light">
							  Don't have an account? <a href="pgRegister.php?u1=&&v2=" class="text-primary">Create</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/custom/sweetAlert.js"></script>
<script src="../assets/js/custom/sweetalert2.min.js"></script>
<script src="../assets/css/jquery/jquery.min.js"></script>
<script src="../assets/js/custom/twCommonValidation.js"></script>
<script>
$(document).keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		adminWindow();
	}
});
$(document).ready(function(){
   $("#ERROR").css("display", "none");
});
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
$("#txtUsername").blur(function()
{
	removeError(txtUsername);
	if ($("#txtUsername").val()!="")
	{
		if(!validateEmail($("#txtUsername").val())){
			setError(txtUsername);
		}
		else
		{
			removeError(txtUsername);
		}
	}
});
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
function adminWindow(){
	if(!validateBlank($("#txtUsername").val())){
		setErrorOnBlur("txtUsername");
	}
	else if(!validateEmail($("#txtUsername").val())){
		setError(txtUsername);
		$("#txtUsername").focus();
	}
	else if(!validateBlank($("#txtPassword").val())){
		setErrorOnBlur("txtPassword");
	} 
	else{
		disableButton('#btnSignIn','<i class="ti-timer"></i> Processing...');
		$.ajax({
			type:"POST",
			url:"apiCheckCompanyLogin.php",
			data:{username:$("#txtUsername").val(),password:$("#txtPassword").val()},
			success:function(response){
				enableButton('#btnSignIn','Sign In');
				if($.trim(response)=="Success"){
					showAlertRedirect("Success","Login Successfully","success","pgEmployeeRegistration.php");
				}  
				else{
					
					$("#ERROR").fadeIn();
				    $("#ERROR").fadeOut(5000);
					$("#txtPassword").val("");
					$("#txtPassword").focus();
				}
			}
		});
	}
 }
  
</script>
</body>
</html>
