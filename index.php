<?php

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
</head>
<body>
<?php include "include/navbar.php"; ?>

<section id="imp_section1" class="h-100" style="margin-top:5%">
	<div id="imp_container1" class="container valign-wrapper h-100">
		<div class="row">
			<div class="col s12 m8 l8 valign-wrapper">
				<h2 class="imp_heading" style="text-decoration: bold;margin-top: 200px; padding-bottom: 30px;">
					Don't waste your Holiday,<br>
					<span style="text-decoration: underline;">searching for Parking.</span>
				</h2>
			</div>
			<div class="col s12 m6 l4 valign-wrapper">
				<!-- Register Form -->
				<div class="card form" id="reg_log_form">
					<div class="card-tabs">
						<ul class="tabs tabs-fixed-width">
							<li class="tab"><a href="#imp_reg_form">Register</a></li>
							<li class="tab"><a href="#imp_login_form">Login</a></li>
						</ul>
					</div>
				<form method="post" class="card-content" class="center-align" id="imp_reg_form">

					<h3 class="center-align" style="font-family: 'Raleway', sans-serif;">Register<br></h3>

					<div class="input-field">
						<input type="text" class="validate" id="imp_name" required="required" />
						<label for="imp_name">Name</label>
					</div>

					<div class="input-field">
						<input type="email" id="imp_email" class="validate" name="imp_email" required="required" />
						<label for="email">Email</label>
					</div>
					<span id="imp_user_exist"></span>

					<div class="input-field">
						<input type="password" class="validate" id="imp_password" required="required" />
						<label for="password">Password</label>
					</div>

					<div class="input-field">
						<input type="tel" class="validate" id="imp_phone" required="required" />
						<label for="imp_phone">Phone</label>
					</div>
					<br>
					<div class="col s12 m12 l12 center-align">
						<input class="btn center-align" value="submit" type="submit" name="submit" />
					</div>
					<br>
					<div class="preloader-wrapper small active">

				    <div id="imp_spinner" class="spinner-layer spinner-red-only center-align">
				      <div class="circle-clipper left">
				        <div class="circle"></div>
				      </div><div class="gap-patch">
				        <div class="circle"></div>
				      </div><div class="circle-clipper right">
				        <div class="circle"></div>
				      </div>
				    </div>

				  </div>
				</form>

				<form id="imp_login_form" class="card-content">
					<h3 class="center-align" style="font-family: 'Raleway', sans-serif;">login<br></h3>
					<div class="input-field">
						<input type="email" id="imp_email_log" class="validate" required="required" />
						<label for="email">Email</label>
					</div>
					<span id="imp_user_exist"></span>

					<div class="input-field">
						<input type="password" class="validate" id="imp_password_log" required="required" />
						<label for="password">Pwd</label>
					</div>
					<div class="col s12 m12 l12 center-align">
						<input class="btn center-align" type="submit" id="submit_login" />
					</div>
				</form>
				</div>

				<!-- Car Forms -->
				<div class="card form center-align" id="imp_veh_form" style="display: 	none;" >
					<h3 class="center-align" style="margin-bottom: 10px;font-family: 'Raleway', sans-serif;">Add Vehicle</h3>

					<div class="input-field">
						<input type="text" class="validate" id="md_name" />
						<label for="md_name">Model Number : Honda City, Pulsar</label>
					</div>

					<div class="input-field">
						<input type="text" class="validate" id="md_reg_no" />
						<label for="md_reg_no">Ex : MH01AY8004</label>
						<span class="emsg hidden">Not a valid number</span>
					</div>

          <div class="input-field">
            <select id="md_name">
          <option value="" disabled selected>Choose your option</option>
          <option id="two_wheeler" value="two wheeler">Two Wheeler</option>
          <option id="four_wheeler" value="four wheeler">Four Wheeler</option>
          <option id="truck" value="truck">Truck</option>
        </select>
          </div>

					<br>
					<div class="col s12 m12 l12 center-align">
						<button class="btn center-align" type="submit" id="submit_veh" >Submit</button>
					</div>
					<br>
				</div>

			</div>
		</div>
	</div>
</section>

<?php include("js/java-script.html"); ?>

<script type="text/javascript">
	$(document).ready(function(){

		// Side Nav Bar for mobile
		$(".button-collapse").sideNav();

		var details;

		// Hide Spinner in load
		$("#imp_spinner").hide();

		// Prevent Default Functionality on form submission
		$("#imp_reg_form").on("submit", function(event){

			details = {
				'imp_name':$('#imp_name').val(),
				'imp_email':$('#imp_email').val(),
				'imp_password':$('#imp_password').val(),
				'imp_phone':$('#imp_phone').val(),
				'function':'check_email',
			};
			console.log(details);
			event.preventDefault();
			// Check if Email Exists.
			$.post("api/users.php",{'details':details}, function(bool_exist){
				console.log(parseInt(bool_exist));
				if(bool_exist == 1){
					$('#imp_user_exist').html("User Already Exists.");
				} else if(bool_exist == 0){
					$("#reg_log_form").delay(2000).hide();
					$("#imp_spinner").show(2000);
					$("#imp_veh_form").show();
				}
			});
		});

		$("#submit_veh").on("click", function(event){

			details.function = "register";
			details.md_name = $("#md_name").val();
			details.md_reg_no = $("#md_reg_no").val();
			event.preventDefault();
			// Check if Email Exists.
			console.log(details);
			$.post("api/users.php",{'details':details}, function(page){
				console.log(page);
			});
			$("#imp_veh_form").hide();
			$("#reg_log_form").show();
		});

		$("#submit_login").on("click", function(event){
			event.preventDefault();
			details = {};
			details.function = "login";
			details.imp_email = $("#imp_email_log").val();
			details.imp_pass = $("#imp_password_log").val();
			event.preventDefault();
			// Check if Email Exists.
			console.log(details);
			$.post("api/users.php",{'details':details}, function(page){
				window.location.href = page;
			});
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
<?php include "include/footer.php"; ?>
</html>
