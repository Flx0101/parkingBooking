<?php
session_start();
include_once('core.php');
if(!isset($_SESSION['uid']))
{
	header("Location:../profile.php");
	alert('Payment for a vehicle failed');
}

include_once('definations.php');
var_dump($_POST['cred_details']);

function insert_cred($md_reg_no , $card_number , $card_exp , $card_cvc , $cop_code)
{

	$sql = "INSERT INTO `user_card_details`(`md_reg_no`,`card_number`,`exp_date`,`cv_code`,`coupon_code`) VALUES ('$md_reg_no','$card_number','$card_exp','$card_cvc','$cop_code')";
	$con = connection();
	$result = $con->query($sql);
	$con->close();
	return 1;
}

insert_cred($_POST['cred_details']['md_reg_no'],$_POST['cred_details']['card_number'],$_POST['cred_details']['card_exp'],$_POST['cred_details']['card_cvc'],$_POST['cred_details']['cop_code']);


?>