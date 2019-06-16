<?php
include_once("api/users.php");
include_once("api/definations.php");
if (!isset($_SESSION['uid'])) {
	header("Location:	index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<?php include "css/css.html"; ?>
</head>
<body>
<?php include 'include/navbar.php'; ?>
<?php include 'js/java-script.html'; ?>

<?php
function check_status($md_reg_no)
{
	$sql = "SELECT * from `booking` WHERE `md_reg_no`='$md_reg_no'";
	$con = connection();
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		return "booked";
	}
}

function check_paid($md_reg_no)
{
	$sql = "SELECT * from `user_card_details` WHERE `md_reg_no`='$md_reg_no'";
	$con = connection();
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		return "paid";
	}
}

?>
<div class="container">
	<div class="row valign-wrapper">
		<?php while ($row = $vehicle_obj->fetch_assoc()) : ?>
		<div class="col s12 m4 l5">
			<div class="card">
            <div class="card-content">
            	<h5>Vehicle Number</h5>
              <span class="card-title"><?= $row['md_reg_no']; ?></span>
             	
            </div>

            <div class="card-action center-align">
              <a class="btn waves waves-effect waves-light black" id = "park_<?= $row['md_reg_no']; ?>">Park</a>
              <span id="park_<?php $row['md_reg_no']; ?>"></span>
            </div>
            	<div class = "source_loc center-align" id = "<?= $row['md_reg_no'] ?>" >
						<form action = "map.php" method="post">
						<input type=text placeholder ='Enter the name of the city' id = 'parking_pos' name = "parking_source" required >
						<input name = "md_reg_no" type="hidden" value = "<?= $row['md_reg_no']; ?>">
						<button type = "submit" class='card center-align btn waves waves-effect waves-light black' id ="proceed">Proceed</button>

					</form>
		</div>	
          </div>		
		</div>
		<script>
			$(this).on("click",function(x){
				var loc = "#"+x['target']['id'].substring(5,x.length);
				console.log(loc);
				$(loc).show();
			});
			var x = "#park_"+"<?= $row['md_reg_no']; ?>";
			var y = "<?= check_status($row['md_reg_no']); ?>";
			console.log(y);
			if(y == "booked"){
				$(x).html("<a style='color: currentColor;cursor: not-allowed;  opacity: 0.5;text-decoration: none;'>Booked</a><a href = 'actual_payment.php?veh_num=<?= $row['md_reg_no']; ?>'>Pay</a>");	
				}
			var z = "<?= check_paid($row['md_reg_no']); ?>";
			if(z == "paid")
			{
				$(x).html("<a style='color: currentColor;cursor: not-allowed;  opacity: 0.5;text-decoration: none;'>Booked</a><a>Paid</a>");
				$(x).html("<a href='route.php?veh_num=<?= $row['md_reg_no']; ?>' id='park_<?php $row['md_reg_no']; ?>'><span class='glyphicon glyphicon-eye-open'></span>View Status</a>");
			}
			

		</script>
	<?php endwhile; ?>
	<div id="add_veh_card" class="col s12 m4 l4 center-align">
		<a id="add_veh_btn" class="btn-floating black btn-large waves-effect waves-light red">
			<i class="material-icons">add</i>
		</a>
		<div style="display: none;" id="veh_card_values">
			<div class="card">
            <div class="card-content">
            	<div class="input-field">
            		<input type="text" id="md_reg_no">
            		<label for="md_reg_no">Vehicle Number</label>
            		<span class="emsg hidden">Not a valid number</span>
            	</div>
            	<uid style = "display:none;"><?= $_SESSION['uid']; ?></uid>
            	<div class="input-field">
            		<select id="md_name">
				      <option value="" disabled selected>Choose your option</option>
				      <option id="two_wheeler" value="two wheeler">Two Wheeler</option>
				      <option id="four wheeler" value="four wheeler">Four Wheeler</option>
				      <option id="truck" value="truck">Truck</option>
				    </select>
            	</div>
            </div>
            <div class="card-action center-align">
              <a class="btn waves waves-effect waves-light black" id="sel_veh_btn">Add</a>
            </div>
          </div>
		</div>
	</div>
	</div>
</div>


<script type="text/javascript">

	$(document).ready(function() {
		// body...

		$(".button-collapse").sideNav();
		$('select').material_select();

		$("#logout_link").show();
		$("#login_link").hide();

		var details = {};

		$("#add_veh_btn").on("click", function(){
			$("#add_veh_btn").hide();
			$("#veh_card_values").show();
		});

		$("#sel_veh_btn").on("click", function(){
			details.uid = $("uid").html();
			details.function = "add_vehicle";
			details.md_reg_no = $("#md_reg_no").val();
			details.md_name = $("#md_name").val();
			console.log(details);
			$.post("api/users.php",{'details':details}, function(page){
				console.log("Page"+page);
			});

			location.reload();
		});

		var $regexname = /^[A-Z]{2}[0-9]{1,2}(?:[A-Z])?(?:[A-Z]*)?[0-9]{4}$/;
		$('#md_reg_no').on('keypress keydown keyup',function(){
             if (!$(this).val().match($regexname)) {
                 $('.emsg').removeClass('hidden');
                 $('.emsg').show();
                 $("#sel_veh_btn").hide();

             }
           else{
                $('.emsg').addClass('hidden');
                $("#sel_veh_btn").show();
               }
         });
});

</script>
</body>
<?php include_once("include/footer.php"); ?>
</html>
