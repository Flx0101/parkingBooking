<?php
	session_start();
		$_SESSION['md_reg_no'] = $_POST['details']['md_reg_no'];
    if(empty($_SESSION) || !isset($_SESSION))  die("SESSION IS NOT SET");
    include_once("api/definations.php");

		function select_slot($lat , $long)
		{
			$sql = "Select `slot_id` from `slot_location` where `latitude` = '".($lat)."' and `longitude` = '".($long)."'";
			$con = connection();
			$result = $con->query($sql);
			if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
				return $row['slot_id'];
			}
			return 0;
		}
	}

    function addBooking($slot_id,$uid,$md_reg_no){
		echo $slot_id;
		$sql = "INSERT INTO `booking`(`slot_id`, `uid`, `status`,`md_reg_no`) VALUES ($slot_id,$uid,1,'$md_reg_no')";
		$con = connection();
		$result = $con->query($sql);
		$con->close();
		return 1;
	}
	addBooking(select_slot($_POST['details']['latitude'],$_POST['details']['longitude']),$_POST['details']['uid'],$_POST['details']['md_reg_no']);

?>
