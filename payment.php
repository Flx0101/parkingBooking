<?php
include_once("api/users.php");
include_once("api/definations.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include("css/css.html"); ?>
    <?php include("fonts/fonts.html"); ?>

<script type="text/javascript" src="js/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<?php include 'js/java-script.html'; ?>
<script type = "text/javascript">
  $(document).ready(function(){
  console.log("Hello");
  $("#booking_submit").on('click',function(){
    console.log("CLicked");
    var details = {};
    details.md_reg_no = $('#md_reg_no').html();
    details.start_time = $('#start_time').val();
    details.end_time = $('#end_time').val();
    $.post("booking_timing.php",{'details':details},function(page){
      console.log(page);
      window.location.href = "profile.php";
    });
  });

    $("#logout_link").show();
    $("#login_link").hide();
});
</script>
</head>
<body>
<?php include "include/navbar.php"; ?>
<div class="container">
  <font color="white">
  <h2>Booking details:</h2>
  <div>
    <div class = "form-group">
        <label for="email">Vehicle Number:</label>
      <span id = "md_reg_no"><?php echo $_SESSION['md_reg_no']; ?></span>
    </div>
    <div class="form-group">
      <label for="time">Start time:</label>
      <input type="time" class="form-control" id="start_time" placeholder="Enter start_time" name="start_time" required>
    </div>
    <div class="form-group">
      <label for="pwd">End_time:</label>
      <input type="time" class="form-control" id="end_time" placeholder="Enter end_time" name="end_time" required>
    </div>
    <button type="submit" class="btn btn-default" id="booking_submit">Submit</button>
  </font>
</div>
</font>
</div>
</body>
</html>
