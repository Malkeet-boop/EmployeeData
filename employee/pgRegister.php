<?php 
// Include class definition
include_once "function.php";
include_once "commonFunctions.php";
$sign=new Signup();
$commonfunction=new Common();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Register </title>
<!-- plugins:css -->
<link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../assets/css/custom/sweetalert2.min.css">
<link rel="stylesheet" href="../assets/css/custom/style.css">
<link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
<!-- endinject -->
<link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth px-0">
			<div class="row w-100 mx-0">
				<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 mx-auto">
					<div class="cardradius auth-form-light text-left py-5 px-4 px-sm-5">
						<center ><img src="../assets/images/registration.png" class="regimg" alt="logo" ></center>
						<h4>New here?</h4>
						<h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
						<div class="pt-3">
							<div class="form-sample">
								<div class="form-group">
									<div class="row" >
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12  mb-4">
											<input type="text" class="form-control" maxlength="50" id="txtCompanyName" placeholder="Company Name">
										</div>
									
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-4">
											<input type="email" class="form-control" id="txtEmail" value="" placeholder="Email"/>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-4">
											<input type="password" class="form-control" id="txtPassword" onkeyup="triggerPasswordStrength();" placeholder="Password" />
											<div class="indicator" id="indicator">
												<span class="weak"></span>
												<span class="medium"></span>
												<span class="strong"></span>
											</div>
											<small class="passwordtext" id="passwordtext"></small>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-4">
											<input type="password" class="form-control" id="txtConfirmPassword" placeholder="Confirm Password"/>
											<span class="ti-eye view-password" onmousedown="viewPassword('#txtConfirmPassword');" onmouseup="viewPassword('#txtConfirmPassword');"></span>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 mb-4 ">
											<button class="btn btn-block btn-lg font-weight-medium auth-form-btn text-white" style="background-color:#12448E;"onclick="register();" ><strong>REGISTER</strong></button>
										</div>
									</div>
									<div class="text-center mt-4 font-weight-light">
									  Already Registered? <a href="pgLogin.php" class="text-primary">Login</a>
									</div>
								</div>
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
<!-- endinject -->
<script src="../assets/css/jquery/jquery.min.js"></script>
<script src="../assets/js/custom/sweetAlert.js"></script>
<script src="../assets/js/custom/sweetalert2.min.js"></script>
<script src="../assets/js/custom/twCommonValidation.js"></script>
<script>
var valcheck = "";
$(document).ready(function(){
	valcheck = "";
	disableButton('#btncreate','CREATE ACCOUNT');
});
$("#txtPassword").focus(function(){
	$("#indicator").css("display", "flex");
	$("#passwordtext").css("display", "block");
}); 
$("#txtPassword").blur(function(){
	if($("#txtPassword").val()!="")
	{
		if(!passwordLength($("#txtPassword").val())){
			$("#txtPassword").focus();
		}
		else
		{
			$("#indicator").css("display", "none");
			$("#passwordtext").css("display", "none");
		}
	}
}); 
$('input[type="checkbox"]').click(function(){
	if($(this).prop("checked") == true){
		valcheck = "checked";
		enableButton('#btncreate','CREATE ACCOUNT');
	}
	else if($(this).prop("checked") == false){
		valcheck = "";
		disableButton('#btncreate','CREATE ACCOUNT');
	}
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
$("#txtEmail").blur(function()
{
	removeError(txtEmail);
	if ($("#txtEmail").val()!="")
	{
		if(!validateEmail($("#txtEmail").val())){
			setError(txtEmail);
		}
		else
		{
			removeError(txtEmail);
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
function triggerPasswordStrength()
{
	const indicator = document.querySelector(".indicator");
	const input = document.querySelector("#txtPassword");
	const weak = document.querySelector(".weak");
	const medium = document.querySelector(".medium");
	const strong = document.querySelector(".strong");
	const text = document.querySelector(".passwordtext");
	checkPasswordStrength(indicator,input,weak,medium,strong,text);
}
function register(){
	if(!validateBlank($("#txtCompanyName").val())){
		setErrorOnBlur("txtCompanyName");
	}
	else if(!validateBlank($("#txtEmail").val())){
		setErrorOnBlur("txtEmail");
	} 
	else if(!validateEmail($("#txtEmail").val())){
		setError(txtEmail);
		$("#txtEmail").focus();
	}
	else if(!validateBlank($("#txtPassword").val())){
		setErrorOnBlur("txtPassword");
	} 
	else if(!passwordLength($("#txtPassword").val())){
		$("#txtPassword").focus();
	}
	else if(!validateBlank($("#txtConfirmPassword").val())){
		setErrorOnBlur("txtConfirmPassword");
	} 
	else if($("#txtPassword").val()!=$("#txtConfirmPassword").val()){
		$("#txtConfirmPassword").val("");
		$("#txtConfirmPassword").focus();
	}
	else{
		$.ajax({
			type:"POST",
			url:"apiSaveRegisterData.php",
			data:{companyname:$("#txtCompanyName").val(),email:$("#txtEmail").val(),password:$("#txtPassword").val()},
				success:function(response){
				if($.trim(response)=="Success"){
					showAlertRedirect("Success","Registered Successfully","success","pgLogin.php");
				}  
				else if($.trim(response)=="Exist"){
					showAlert("Warning","Email is already present","warning");
					$("#txtPassword").val("");
					$("#txtConfirmPassword").val("");
				}  
				else if($.trim(response)=="MobileExist"){
					showAlert("Warning","Mobile is already present","warning");
					$("#txtPassword").val("");
					$("#txtConfirmPassword").val("");
				}
				else{
					showAlert("Error","Invalid Username/Password","error");
					$("#txtPassword").val("");
					$("#txtConfirmPassword").val("");
				} 
			}
		}); 
	}  
}
</script>
</body>
</html>
