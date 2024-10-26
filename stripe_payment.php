<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "watchvibe";

// Create connection
$con = new mysqli($server, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$payment_id = $statusMsg = ''; 
$ordStatus = 'error';

// Check whether stripe token is not empty
if (!empty($_POST['stripeToken'])) {
    // Get Token, Card, and User Info from Form
    $token = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subscription = $_POST['subscription'];
    $price = (int)$_POST['amount']; // Ensure price is an integer

    // Include STRIPE PHP Library
    require_once('stripe-php/init.php');

    // Set API Key
    \Stripe\Stripe::setApiKey("sk_test_51QEGuDBVWGzQwNrdd3BHp8IZHCvvO9OlTGICk3mDS941YFBZaIguuv9vMPYADSmRl4NJYQ7GpnRTXBugIG3fG60400MmP3jjbs");

    // Add customer to Stripe 
    try {
        $customer = \Stripe\Customer::create(array( 
            'email' => $email, 
            'source' => $token,
            'name' => $name,
            'description' => $subscription
        ));

        // Generate Unique order ID 
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

        // Convert price to cents 
        $itemPrice = $price * 100; // Multiply by 100 for Stripe

        // Charge a credit or debit card 
        $charge = \Stripe\Charge::create(array( 
            'customer' => $customer->id, 
            'amount' => $itemPrice, 
            'currency' => "inr", // Change to your required currency
            'description' => $subscription, 
            'metadata' => array( 
                'order_id' => $orderID 
            ) 
        ));

        // Retrieve charge details 
        $chargeJson = $charge->jsonSerialize();

        // Check whether the charge is successful 
        if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) { 
            // Order details 
            $transactionID = $chargeJson['id']; 
            $paidAmount = $chargeJson['amount']; 
            $paidCurrency = $chargeJson['currency']; 
            $payment_status = $chargeJson['status'];
            $dt_tm = date('Y-m-d H:i:s');

            // Insert transaction data into the database using prepared statements
            $stmt = $con->prepare("INSERT INTO transactions (user_id, subscription, amount, transaction_id, payment_status, added_date) 
                                    VALUES ((SELECT id FROM users WHERE email = ?), ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiss", $email, $subscription, $price, $transactionID, $payment_status, $dt_tm); // Adjust types accordingly

            if ($stmt->execute()) {
                // If the order is successful 
                if ($payment_status == 'succeeded') { 
                    $ordStatus = 'success'; 
                    $statusMsg = 'Your Payment has been Successful!'; 
                } else { 
                    $statusMsg = "Your Payment has Failed!"; 
                }
            } else {
                $statusMsg = "Database Error: " . $stmt->error;
            }

            $stmt->close();
        } else { 
            $statusMsg = "Transaction has failed!"; 
        }
    } catch (Exception $e) {
        $statusMsg = "Stripe Error: " . $e->getMessage();
    }
} else { 
    $statusMsg = "Error on form submission."; 
} 
?>

<!DOCTYPE html>
<html>
<head>
    <title>WatchVibe Payment Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/stripe.css">
</head>
<body>
<div class="container">
    <h2 style="text-align: center; color: blue;">WatchVibe Payment Result</h2>
    <h4 style="text-align: center;">This is - Payment Result Page</h4>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="status">
                <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>
                <h4 class="heading">Payment Information - </h4>
                <br>
                <p><b>Transaction ID:</b> <?php echo isset($transactionID) ? $transactionID : ''; ?></p>
                <p><b>Paid Amount:</b> <?php echo isset($paidAmount) ? $paidAmount . ' ' . $paidCurrency : ''; ?></p>
                <p><b>Payment Status:</b> <?php echo isset($payment_status) ? $payment_status : ''; ?></p>
                <h4 class="heading">Subscription Information - </h4>
                <br>
                <p><b>Subscription:</b> <?php echo isset($subscription) ? $subscription : ''; ?></p>
                <p><b>Price:</b> <?php echo isset($price) ? $price . ' INR' : ''; ?></p>
            </div>
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
</div>
</body>
</html>
