<?php
session_start();
error_reporting(0);
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

include('includes/dbconnection.php');

// Check if the bookingID is provided in the URL
if (isset($_GET['bookingID'])) {
    $bookingID = $_GET['bookingID'];

    // Fetch booking data from the tblmaidbooking table based on the provided bookingID
    $sqlBooking = "SELECT * FROM tblmaidbooking WHERE BookingID = :bookingID";
    $queryBooking = $dbh->prepare($sqlBooking);
    $queryBooking->bindParam(':bookingID', $bookingID, PDO::PARAM_STR);
    $queryBooking->execute();

    if ($queryBooking->rowCount() > 0) {
        $bookingData = $queryBooking->fetch(PDO::FETCH_ASSOC);

        // Now you can use $bookingData to display the relevant information on the payment page
        $catid = $bookingData['CatID'];
        $name = $bookingData['Name'];
        $contno = $bookingData['ContactNumber'];
        $email = $bookingData['Email'];
        $address = $bookingData['Address'];
        // $gender = $bookingData['Gender'];
        $wsf = $bookingData['WorkingShiftFrom'];
        $wst = $bookingData['WorkingShiftTo'];

        // Calculate the total time difference in seconds
        $wsfTimestamp = strtotime($wsf);
        $wstTimestamp = strtotime($wst);

        // If the working shift end time is earlier than the start time, it means the shift goes into the next day
        // Adjust the end time to reflect this
        if ($wstTimestamp < $wsfTimestamp) {
            $wstTimestamp += 24 * 3600; // Add 24 hours to the end time
        }

        $totalTimeDifference = $wstTimestamp - $wsfTimestamp;

        // Convert the total time difference back to hours and minutes
        $totalTimeHours = floor($totalTimeDifference / 3600);
        $totalTimeMinutes = floor(($totalTimeDifference % 3600) / 60);

        // Fetch the unit price from tblcategory based on the provided category ID ($catid)
        $sqlUnitPrice = "SELECT UnitPrice FROM tblcategory WHERE ID = :catid";
        $queryUnitPrice = $dbh->prepare($sqlUnitPrice);
        $queryUnitPrice->bindParam(':catid', $catid, PDO::PARAM_INT);
        $queryUnitPrice->execute();
        $unitPriceData = $queryUnitPrice->fetch(PDO::FETCH_ASSOC);

        if ($unitPriceData) {
            $unitPrice = $unitPriceData['UnitPrice'];

            // Calculate the total cost
            $totalCost = $unitPrice * ($totalTimeHours + ($totalTimeMinutes / 60));

            // Update the totalAmount column in the tblmaidbooking table
            $sqlUpdateTotalAmount = "UPDATE tblmaidbooking SET totalAmount = :totalCost WHERE BookingID = :bookingID";
            $queryUpdateTotalAmount = $dbh->prepare($sqlUpdateTotalAmount);
            $queryUpdateTotalAmount->bindParam(':totalCost', $totalCost, PDO::PARAM_INT);
            $queryUpdateTotalAmount->bindParam(':bookingID', $bookingID, PDO::PARAM_STR);
            $queryUpdateTotalAmount->execute();

            // Display the total cost on the payment page
            //echo '<p><strong>Total Cost:</strong> ' . $totalCost . '</p>';
        }

        $startdate = $bookingData['StartDate'];
        $notes = $bookingData['Notes'];

    } else {
        echo "Booking not found.";
    }
} else {
    echo "Booking ID not provided in the URL.";
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Worker Hiring Management System</title>
    <!-- Your HTML head content here -->
</head>
<body>
    <div class="container" style="padding: 20px;background-color: #58e8ce; color: #181a19; font-weight: bolder;font-family: Lucida Calligraphy; text-align: center;border-radius: 10px; overflow: hidden;"><h2>Worker Hiring Management System</h2></div>
    <div class="form-container" style="margin-left: 100px;margin-top: 30px; padding-top: 30px;padding-left: 50px; text-align: left;border: 3px solid black; max-height: auto; max-width: 400px;background: #b7bbc7;border-radius: 15px; box-shadow: 0 0 30px 10px rgba(0, 0, 0, 0.2);">
    <h1 style="color: green;font-family: Lucida Calligraphy">Payment Details</h1><br>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Contact Number:</strong> <?php echo $contno; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Category ID:</strong> <?php echo $catid; ?></p>
    <!-- <p><strong>Gender:</strong> <?php echo $gender; ?></p> -->
    <p><strong>Working Shift From:</strong> <?php echo date("g:i A", strtotime($wsf)); ?></p>
    <p><strong>Working Shift To:</strong> <?php echo date("g:i A", strtotime($wst)); ?></p>


    <p><strong>Total Work Time:</strong> <?php echo $totalTimeHours . ' hours ' . $totalTimeMinutes . ' minutes'; ?></p>

    <p><strong>Unit Price:</strong> <?php echo $unitPrice; ?></p>
    <p><strong>Total Cost:</strong> <?php echo $totalCost; ?></p>

    <p><strong>Start Date:</strong> <?php echo $startdate; ?></p>
    <p><strong>Notes:</strong> <?php echo $notes; ?></p>

    <!--Stripe payment method start-->

        <?php
        require('../stripe-php-master/init.php');

        $publishableKey="pk_test_51Ng6x2FJeRLIWboacdQpUcwrXETauECsXheDLPU3IVR0oO2qKKajcjCscg3eIB7wzdP8Rjwdm4JkkyJCzrGj3MYq00YLjSywZA";
        $secretKey="sk_test_51Ng6x2FJeRLIWboaHSRNBfm8csMgfm6YcQOSYQvULsIn3wXA4Ts3J3iF6P3eBjMpWPjbASlU7dn5iGibBIEGMtPG00p7gfgWhp";
        \Stripe\Stripe::setApiKey($secretKey);

        ?>
    <!--Stripe payment method end-->


    <!-- Payment form with a payment button -->
        <form action="update_status.php" method="post" id="paymentForm">
    <input type="hidden" name="bookingID" value="<?php echo $bookingID; ?>">
    <button type="submit" name="submitPayment" id="paymentCashButton" style="margin-bottom: 10px;padding-top:6px;padding-bottom:6px;padding-left:20px;padding-right:20px; background-color: #607981;border-radius: 4px;cursor: pointer;font-family: Candara;font-weight: bold; font-size: 14px;transition: 0.3s;color: white">Pay By Cash</button>

    </form>


        <form action="submit.php" method="post">
            <input type="hidden" name="bookingID" value="<?php echo $bookingID; ?>">
            <input type="hidden" name="totalCost" value="<?php echo $totalCost; ?>">

            <script type="text/javascript" src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
            data-key ="<?php echo $publishableKey ?>"
            data-amount="<?php echo $totalCost * 100; ?>"
            data-name="Parve Mosarof"
            data-description="Worker Hiring Management System"
            data-image="admin/images/layout_img/american-express.png"
            data-currency="bdt"
                >
                
            </script>
        </form>
    
<p id="paymentMessage"></p>


<script>
document.getElementById("paymentForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting normally

    // Display thank you message
    document.getElementById("paymentMessage").innerHTML = "Thank you for your payment!";

    // Update p_status in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Redirect to home.php after 3 seconds
            setTimeout(function () {
                window.location.href = "../home.php";
            }, 3000);
        }
    };

    // Get the bookingID from the hidden input field
    var bookingID = document.querySelector("input[name='bookingID']").value;

    // Check which payment button was clicked
    if (event.submitter.name === "submitPayment") {
        var p_status = "cash"; // Set p_status for cash payment
    } else {
        var p_status = "completed"; // Set p_status for Stripe payment
    }

    var params = "bookingID=" + encodeURIComponent(bookingID) + "&p_status=" + encodeURIComponent(p_status);

    xhr.send(params);
});
</script>



</div>
<style type="text/css">
    body {
        background-color: #d7e6c1;
}
</style>


</body>
</html>