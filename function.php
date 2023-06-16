<?php
session_start();
require 'qr.php'; // importing QR LIB functionality
require 'db_con.php'; // importing Database functionality
require 'config.php'; // importing Application Configuration File

/*Registration*/
if(isset($_POST['Register'])){
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$email = $_POST['email'];
	$createdAt = date('Y-m-d H:i:s');
	$updatedAt = date('Y-m-d H:i:s');
	$token = md5(time().$email);
	$checkEmail = mysqli_query($connection,"SELECT * FROM users WHERE user_email = '$email'");
	$user = mysqli_fetch_array($checkEmail);
	if(!empty($user)){
		$message = setAlertMessage('warning','Duplicate','email Already Exist');
		echo $message;
		exit();
	}
	$query = mysqli_query($connection,"INSERT INTO users(`user_first_name`,`user_last_name`,`user_email`,`user_created_at`,`user_updated_at`,`user_token`) VALUES('$firstName','$lastName','$email','$createdAt','$updatedAt','$token')");
	if(mysqli_insert_id($connection)){
		$message = setAlertMessage('success','Registered','You Are Registered Successfully Click <a href="login.php">Here</a> To Login');
		echo $message;
	}
	else{
		$message = setAlertMessage('danger','Opps','Anything is Going Wrong With System');
		echo $message;
	}
}

/*Login Functionality*/

if(isset($_POST['Login'])){
	$email = $_POST['email'];
	$checkEmail = mysqli_query($connection,"SELECT * FROM users WHERE user_email = '$email'");
	$user = mysqli_fetch_array($checkEmail);
	if(empty($user)){
		$message = setAlertMessage('warning','Duplicate','email Not Found <a href="login.php">Reload</a>');
		echo $message;
		exit();
	}
	$qrcode = returnQr('http://'.constant('MYIP').'/webconnect/update-profile.php?token='.$user['user_token']);
	echo '<img src="'.$qrcode.'"><br>Or Copy http://localhost/webconnect/update-profile.php?token='.$user['user_token'];
}

/*Update Profile Functioanlity*/
	
if(isset($_POST['Update'])){
	
	$firstName = $_POST['first_name'];
	$lastName = $_POST['last_name'];
	$updatedAt = date('Y-m-d H:i:s');
	$token = $_POST['token'];
	
	$checkUser = mysqli_query($connection,"SELECT * FROM users WHERE user_token = '$token'");
	$user = mysqli_fetch_array($checkUser);
	
	if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] !=''){
		$profilePic = $_FILES['profile_pic'];
		$temp = explode(".", $profilePic["name"]);
		$newfilename = time().'.'.end($temp);
		move_uploaded_file($profilePic["tmp_name"], "profile-pics/".$newfilename);
		$uploadFileAddress = "profile-pics/".$newfilename;

	}
	else{
		$uploadFileAddress = $user['user_profile_pic'];
	}
	
	$query = mysqli_query($connection,"UPDATE users SET user_first_name = '$firstName', user_last_name = '$lastName', user_updated_at = '$updatedAt',user_profile_pic = '$uploadFileAddress' WHERE user_token = '$token'");
	
	if($query){
		$message = setAlertMessage('success','Updated','Your profile Updated Successfully');
		echo $message;
	}
	else{
		$message = setAlertMessage('danger','Opps','Anything is Going Wrong With System');
		echo $message;
	}
}

/*/////*/

/*Common Function For Return Messsage Alert Box*/
function setAlertMessage($alert_type,$indicator,$message){
	$html = '<div class="alert alert-'.$alert_type.' alert-dismissible fade show" role="alert">
	  <strong>'.$indicator.'!</strong> '.$message.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>';
	return $html;
}
?>