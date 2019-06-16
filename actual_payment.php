<?php
include_once("api/users.php");
if (!isset($_SESSION['uid'])) {
    header('index.php');
}

$_SESSION['md_reg_no'] = $_GET['veh_num'];
?>

<html>
<style>
    input
    {
        color:white;
    }
</style>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment</title>
    <meta id="viewport" content="width=device-width, initial-scale=1">
    <?php include("css/css.html"); ?>
    <?php include("fonts/fonts.html"); ?>

<?php include 'js/java-script.html'; ?>


<script type="text/javascript">
		$(document).ready(function(){
		
		

    $("#logout_link").show();
    $("#login_link").hide();


      $('[data-numeric]').payment('restrictNumeric');
      $('.cc-number').payment('formatCardNumber');
      $('.cc-exp').payment('formatCardExpiry');
      $('.cc-cvc').payment('formatCardCVC');

      $.fn.toggleInputError = function(erred) {
        this.parent('.form-group').toggleClass('has-error', erred);
        return this;
      };

      $('form').submit(function(e) {
        e.preventDefault();

        var cardType = $.payment.cardType($('.cc-number').val());
        $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));
        $('.cc-exp').toggleInputError(!$.payment.validateCardExpiry($('.cc-exp').payment('cardExpiryVal')));
        $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
        $('.cc-brand').text(cardType);

        $('#pay_btn').on('click',function(){

        var cred_details;
        cred_details = {
            'md_reg_no' : "<?= $_GET['veh_num']; ?>",
            'card_number' : $('#cc-number').val(),
            'card_exp' : $('#cc-exp').val(),
            'card_cvc' : $("#cc-cvc").val(),
            'cop_code' : $('#couponCode').val()
        };
            $.post('api/add_user_credits.php',{'cred_details':cred_details},function(page){
                window.location.href = "profile.php";
                console.log(page)
            });
        });
        //$('.validation').removeClass('text-danger text-success');
        //$('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
      });

    });


</script>
</head>
<body>
<?php include "include/navbar.php"; ?>


 <div class="container">
    <h1> Payment Details</h1>
    <form novalidate autocomplete="on" method="POST">
        <font color="white">
      <div class="form-group">
        <label for="cc-number" class="control-label">Card number formatting <small class="text-muted">[<span class="cc-brand"></span>]</small></label>
        <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="•••• •••• •••• ••••" required>
      </div>

      <div class="form-group">
        <label for="cc-exp" class="control-label">Card expiry formatting</label>
        <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="•• / ••" required>
      </div>

      <div class="form-group">
        <label for="cc-cvc" class="control-label">Card CVC formatting</label>
        <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="•••" required>
      </div>

      <div class="form-group">
        <label for="numeric" class="control-label">Coupon Code</label>
        <input id="couponCode" type="tel" class="input-lg form-control" data-numeric>
      </div>

      <button type="submit" class="btn btn-lg btn-primary" id="pay_btn">Submit</button>

      <h2 class="validation"></h2>
  </font>
    </form>

  </div>











<!--<div class="container" style="text:white;input, select, textarea:
    color: white;">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>CARD NUMBER</label>
                                    <div class="input-group">
                                        <input 
                                            type="text"
                                            class="form-control"
                                            id="cardNumber"
                                            placeholder="Valid Card Number"
                                            required autofocus 
                                        >
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="cardExpiry"
                                        placeholder="MM / YY"
                                        required 
                                    />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label>CV CODE</label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        id="cardCVC"
                                        placeholder="CVC"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>COUPON CODE</label>
                                    <input type="text" class="form-control" id="couponCode" />
                                </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-xs-12 ">
                                <button class="subscribe btn btn-success btn-lg btn-block" type="button" id="pay_btn">Pay</button>

            				<bold>Will be automatically deducted on parking</bold>
                            </div>

                        </div>

                    </form>

                </div>
            </div>            
            
        </div>            
    </div>
</div>-->

</body>
</html>