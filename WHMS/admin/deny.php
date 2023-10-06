<?php
// Include your database connection code

session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (isset($_POST['bookingID'])) {
    $bookingID = $_POST['bookingID'];

    // Delete the booking from the database
    $sqlDeleteBooking = "DELETE FROM tblmaidbooking WHERE BookingID = :bookingID";
    $stmt = $dbh->prepare($sqlDeleteBooking);
    $stmt->bindParam(':bookingID', $bookingID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo 'success'; // Send success response back to the client
    } else {
        echo 'error'; // Send error response back to the client
    }
} else {
    echo 'error'; // Send error response back to the client
}
?>
