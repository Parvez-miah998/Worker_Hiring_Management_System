<?php  

require('../stripe-php-master/init.php');
include('includes/dbconnection.php');


$secretKey = "sk_test_51Ng6x2FJeRLIWboaHSRNBfm8csMgfm6YcQOSYQvULsIn3wXA4Ts3J3iF6P3eBjMpWPjbASlU7dn5iGibBIEGMtPG00p7gfgWhp";
\Stripe\Stripe::setApiKey($secretKey);

// Get the token from the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingID = $_POST["bookingID"];
    $token = $_POST["stripeToken"];
    $totalCost = $_POST["totalCost"];

try {
    
        $chargeAmountBDT = $totalCost * 100;

        $data = \Stripe\Charge::create(array(
            "amount" => $chargeAmountBDT,
            "currency" => "bdt",
            "description" => "Parvez Mosarof Desc",
            "source" => $token,
     ));


    // Display the "Thank you" message
    echo "<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <!-- Include your CSS styles here -->
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
    }
</style>

</head>
<body>
    <div class='container'>
        <h1>Thank you for your payment!</h1>
        <p>Your payment was successful.</p>
    </div>

    <!-- Include your JavaScript here -->
    <script>
        setTimeout(function() {
            window.location.href = '../home.php';
        }, 5000); // 5 seconds
    </script>
</body>
</html>";
// Update p_status in the database
if ($data->status === "succeeded") {
    $sqlUpdateStatus = "UPDATE tblmaidbooking SET p_status = :p_status WHERE BookingID = :bookingID";
    $queryUpdateStatus = $dbh->prepare($sqlUpdateStatus);
    $queryUpdateStatus->bindValue(':p_status', 'completed', PDO::PARAM_STR);
    $queryUpdateStatus->bindValue(':bookingID', $bookingID, PDO::PARAM_STR);
    
    if ($queryUpdateStatus->execute()) {
        echo " ";
    } else {
        echo "Error updating p_status: " . print_r($queryUpdateStatus->errorInfo(), true);
    }
}


} catch (\Stripe\Exception\CardException $e) {
    // Handle card payment error
    echo "Card payment error: " . $e->getMessage();
} catch (\Stripe\Exception\StripeException $e) {
    // Handle other Stripe-related errors
    echo "Stripe error: " . $e->getMessage();
} catch (Exception $e) {
    // Handle other generic errors
    echo "Error: " . $e->getMessage();
}
}

?>