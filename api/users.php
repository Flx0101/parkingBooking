<?php
session_start();

include_once("definations.php");

if (!isset($_POST['details'])) {
	if (empty($_SESSION['uid']) || !isset($_SESSION['uid'])) {
		header("Location:http://127.0.0.1/index.php");
		die("");
	}
	$user_obj = getUser($_SESSION['uid']);
	$vehicle_obj = getVehicle($_SESSION['uid']);
} else {
	$details = $_POST['details'];
	callFunction($details);
}
	/*
 *	to register a user
 */
function register($details)
{
	$name = $details['imp_name'];
	$password = md5($details['imp_password']);
	$email = $details['imp_email'];
	$phone = $details['imp_phone'];

	$sql = "INSERT INTO `imp_user`(`name`, `password`, `email`,`phone`) VALUES ('$name','$password','$email','$phone')";
	$con = connection();
	$result = $con->query($sql);
	$lastid = $con->insert_id;
	$con->close();
	if (addVehicle($lastid, $details))
		return true;
	return false;
}
	/*
 *	to add vehicle
 */
function addVehicle($uid, $details)
{
	$md_name = $details['md_name'];

	$md_reg_no = $details['md_reg_no'];
	switch ($md_name) {
		case 'two wheeler':
				# code...
			$md_icon = "two.png";
			break;
		case 'four wheeler':
			$md_icon = "four.png";
			break;
		case 'truck':
				# code...
			$md_icon = "truck.png";
			break;
		default:
				# code...
			$md_icon = "none";
			break;
	}

	$sql = "INSERT INTO `imp_user_vehicle`(`md_name`, `md_reg_no`, `uid`,`md_icon`) VALUES ('$md_name','$md_reg_no',$uid,'$md_icon')";
	$con = connection();
	$result = $con->query($sql);
	$con->close();
	return true;
}

function login($details)
{
	$password = md5($details['imp_pass']);
	$username = $details['imp_email'];
	$con = connection();

	$sql = "Select `id` from `imp_user` where `email` = '" . $username . "' and `password` = '" . $password . "'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$_SESSION['uid'] = $row['id'];
		return true;
	}
	$con->close();
	return false;
}

function checkEmail($details)
{
	$sql = "Select 1 from `imp_user` where `email` = '" . $details['imp_email'] . "'";
	$con = connection();
	$result = $con->query($sql);
	$con->close();
	$row = ($result->num_rows) ? "1" : "0";
	return $row;
}

function getVehicle($uid)
{
	$sql = "Select * from `imp_user_vehicle` where `uid` = $uid";
	$con = connection();
	$result = $con->query($sql);
	$con->close();
	return $result;
}

function getUser($uid)
{
	$sql = "Select `name`,`email`,`phone` from `imp_user` where `id` = $uid";
	$con = connection();
	$result = $con->query($sql);
	$con->close();
	return $result->fetch_assoc();
}
function callFunction($details)
{
	switch ($details['function']) {
		case 'register':
				# code...
			$result = (register($details)) ? "profile.php" : "error.php";
			break;
		case 'add_vehicle':
				#code...
			$result = addVehicle($details['uid'], $details);
			break;
		case 'get_vehicle':
				#code...
			$result = getVehicle($details['uid']);
			break;
		case 'check_email':
				# code...
			$result = checkEmail($details);
			break;
		case 'login':
				# code...
			$result = login($details) ? "profile.php" : "error.php";
			break;
		default:
				# code...
			$result = false;
			break;
	}
	die($result);
	return $result;
}
?>
