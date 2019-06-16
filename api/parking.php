<?php
	session_start();
    if(empty($_SESSION['uid']) || !isset($_SESSION['uid']))  die("SESSION IS NOT SET");
    include_once("definations.php");

    function getParkingLocs(){
        $sql = "Select * from `slot_location` where `available` = 1";
        $con = connection();
        $result = $con->query($sql);
        $con->close();
        return $result;
    }
    function bookPark($p_uid){
        $sql = "INSERT INTO `imp_user_vehicle`(`md_name`, `md_reg_no`, `uid`,`md_icon`) VALUES ('$md_name','$md_reg_no',$uid,$md_icon)";
        $con = connection();
        $result = $con->query($sql);
        $con->close();
        return true;
    }
?>
