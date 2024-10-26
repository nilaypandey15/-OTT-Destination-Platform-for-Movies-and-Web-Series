<!DOCTYPE html>
<html lang="en">
<head>
  <title>WatchVibe Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Registration Form</h2>
  <form action="stripe_payment.php" method="POST" name="cardpayment" id="payment-form">
  
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
      <div class="invalid-feedback" id="name-error"></div>
    </div>
  
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
      <div class="invalid-feedback" id="email-error"></div>
    </div>
   
    <div class="mb-3 mt-3">
      <label for="subscription">Subscription Plan:</label>
      <input type="text" class="form-control" id="subscription" placeholder="Enter subscription plan" name="subscription" required>
      <div class="invalid-feedback" id="subscription-error"></div>
    </div>
	
	<div class="mb-3 mt-3">
      <label for="amount">Fees Amount (in INR):</label>
      <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount" required>
      <div class="invalid-feedback" id="amount-error"></div>
    </div>
	
	<div class="mb-3">
      <label for="card_number">CARD NUMBER</label>
      <input type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
      <div class="invalid-feedback" id="card-number-error"></div>
    </div>

    <div class="row">
      <div class="col-xs-4 col-md-4">
        <div class="form-group">
          <label for="card_exp_month">EXPIRY MONTH</label>
          <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
            <option value="">Select Month</option>
            <option value="01">01 ( JAN )</option>
            <option value="02">02 ( FEB )</option>
            <option value="03">03 ( MAR )</option>
            <option value="04">04 ( APR )</option>
            <option value="05">05 ( MAY )</option>
            <option value="06">06 ( JUN )</option>
            <option value="07">07 ( JUL )</option>
            <option value="08">08 ( AUG )</option>
            <option value="09">09 ( SEP )</option>
            <option value="10">10 ( OCT )</option>
            <option value="11">11 ( NOV )</option>
            <option value="12">12 ( DEC )</option>
          </select>
          <div class="invalid-feedback" id="exp-month-error"></div>
        </div>
      </div>

      <div class="col-xs-4 col-md-4">
        <div class="form-group">
          <label for="card_exp_year">EXPIRY YEAR</label>
          <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year" required>
            <option value="">Select Year</option>
            <option value="24">2024</option>
            <option value="25">2025</option>
            <option value="26">2026</option>
            <option value="27">2027</option>
            <option value="28">2028</option>
            <option value="29">2029</option>
            <option value="30">2030</option>
            <option value="31">2031</option>
            <option value="32">2032</option>
            <option value="33">2033</option>
            <option value="34">2034</option>
            <option value="35">2035</option>
            <option value="36">2036</option>
          </select>
          <div class="invalid-feedback" id="exp-year-error"></div>
        </div>
      </div>

      <div class="col-xs-4 col-md-4">
        <div class="form-group">
          <label for="card_cvc">CVC CODE</label>
          <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
          <div class="invalid-feedback" id="cvc-error"></div>
        </div>
      </div>
    </div>
   
    <button type="submit" id="payBtn" class="btn btn-primary">Submit</button>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>

<script>
    // Set your publishable key
    Stripe.setPublishableKey('pk_test_51QEGuDBVWGzQwNrdDJoycMzwigpvg6VcTZz0mt06Omt6FRMIPeWwXoJQOKHJqoW4d5UxfaUPUW9WuNBjfIrFTrjY000qLd0QoA');

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#payBtn').removeAttr("disabled");
            alert(response.error.message);
        } else {
            var form$ = $("#payment-form");
            var token = response.id;
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#payment-form").submit(function() {
            $('#payBtn').attr("disabled", "disabled");

            Stripe.createToken({
                number: $('#card_number').val(),
                exp_month: $('#card_exp_month').val(),
                exp_year: $('#card_exp_year').val(),
                cvc: $('#card_cvc').val()
            }, stripeResponseHandler);
            
            return false; // Prevent default form submission
        });
    });
</script>

</body>
</html>
