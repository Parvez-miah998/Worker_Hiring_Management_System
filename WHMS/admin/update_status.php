<?php
include('includes/dbconnection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingID = $_POST["bookingID"];
    $p_status = isset($_POST["p_status"]) ? $_POST["p_status"] : ""; // Ensure p_status is set
    
    // Update the p_status column in the tblmaidbooking table
    $sqlUpdateStatus = "UPDATE tblmaidbooking SET p_status = :p_status WHERE BookingID = :bookingID";
    $queryUpdateStatus = $dbh->prepare($sqlUpdateStatus);
    $queryUpdateStatus->bindParam(':p_status', $p_status, PDO::PARAM_STR);
    $queryUpdateStatus->bindParam(':bookingID', $bookingID, PDO::PARAM_STR);
    $queryUpdateStatus->execute();
}

?>
