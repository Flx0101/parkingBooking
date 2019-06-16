<?php
  include_once("api/definations.php");
function add_booking_time($md_reg_no , $start_time , $end_time){
$sql = "INSERT INTO `booking_timing`(`md_reg_no`, `start_time`, `end_time`) VALUES ('$md_reg_no','$start_time','$end_time')";
$con = connection();
$result = $con->query($sql);
$con->close();
return 1;
}
add_booking_time($_POST['details']['md_reg_no'],$_POST['details']['start_time'],$_POST['details']['end_time'])
?>
