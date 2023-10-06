<?php
// Include your database connection
include('includes/dbconnection.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>Worker Hiring Management System</title>
</head>
<body>
    

	<div class="container" style="padding: 20px;background-color: #c2edce; color: #181a19; font-weight: bolder;font-family: Candara; text-align: left;border-radius: 10px; overflow: hidden;max-width: 600px;">
		<?php
        require_once(__DIR__ . '/vendor/autoload.php');
		// Get the booking ID from the URL parameter
// $bookingID = $_GET['bookingID'];
         $bookingID = isset($_GET['bookingID']) ? $_GET['bookingID'] : '';



// Fetch the booking details
$sql = "SELECT * FROM tblmaidbooking WHERE BookingID = :bookingID";
$query = $dbh->prepare($sql);
$query->bindParam(':bookingID', $bookingID, PDO::PARAM_STR);
$query->execute();

$bookingDetails = $query->fetch(PDO::FETCH_ASSOC);

// Generate the report
$html = '<h1 style="background-color: #bfe0e0;text-align:center;">Report for Booking ID ' . $bookingID . '</h1>';
$html .= '<p><strong>Name: </strong>' . $bookingDetails['Name'] . '</p>';
$html .= '<p><strong>Contact Number: </strong>' . $bookingDetails['ContactNumber'] . '</p>';
$html .= '<p><strong>Email: </strong>' . $bookingDetails['Email'] . '</p>';
$html .= '<p><strong>Address: </strong>' . $bookingDetails['Address'] . '</p>';

// Get the booking ID from the URL parameter
$bookingID = $_GET['bookingID'];

// Get the supervisor name and contact number
$sqlSupervisor = "SELECT full_name, contact_no FROM supervisor WHERE sw_id = (SELECT sw_id FROM tblmaidbooking WHERE BookingID = :bookingID)";
$querySupervisor = $dbh->prepare($sqlSupervisor);
$querySupervisor->bindParam(':bookingID', $bookingID, PDO::PARAM_STR);
$querySupervisor->execute();
$supervisorDetails = $querySupervisor->fetch(PDO::FETCH_ASSOC);

// Print the supervisor name and contact number
if ($supervisorDetails) {
    $html .= '<p><strong>Supervisor Name: </strong>' . $supervisorDetails['full_name'] . '</p>';
    $html .= '<p><strong>Supervisor Contact Number: </strong>' . $supervisorDetails['contact_no'] . '</p>';
} else {
    $html .= '<p>No supervisor details found</p>';
}


$html .= '<p><strong>Category ID: </strong>' . $bookingDetails['CatID'] . '</p>';

// Get the working shift from and working shift to times
$workingShiftFrom = '20:25:00';
$workingShiftTo = '04:25:00';


// Get the working shift from and working shift to times from the database
$workingShiftFrom = $bookingDetails['WorkingShiftFrom'];
$workingShiftTo = $bookingDetails['WorkingShiftTo'];

// Convert the working shift from and working shift to times to PHP timestamps
$wsfTimestamp = strtotime($workingShiftFrom);
$wstTimestamp = strtotime($workingShiftTo);

// Format the working shift from and working shift to times
$workingShiftFromFormatted = date('h:i a', $wsfTimestamp);
$workingShiftToFormatted = date('h:i a', $wstTimestamp);

// Print the working shift from and working shift to times
$html .= '<p><strong>Working Shift From: </strong>' . $workingShiftFromFormatted . '</p>';
$html .= '<p><strong>Working Shift To: </strong>' . $workingShiftToFormatted . '</p>';

$bookingDetails['TotalTimeMinutes'] = $query->fetchColumn(3);
// Calculate the total time difference in seconds
$wsfTimestamp = strtotime($bookingDetails['WorkingShiftFrom']);
$wstTimestamp = strtotime($bookingDetails['WorkingShiftTo']);

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
$queryUnitPrice->bindParam(':catid', $bookingDetails['CatID'], PDO::PARAM_INT);
$queryUnitPrice->execute();
$unitPriceData = $queryUnitPrice->fetch(PDO::FETCH_ASSOC);

if ($unitPriceData) {
    $unitPrice = $unitPriceData['UnitPrice'];

    // Calculate the total cost
    $totalCost = $unitPrice * ($totalTimeHours + ($totalTimeMinutes / 60));

    // Add the total time and total amount to the report
    $html .= '<p><strong>Total Time: </strong>' . $totalTimeHours . ' hours ' . $totalTimeMinutes . ' minutes</p>';
    // Add the unit price to the report
    $html .= '<p><strong>Unit Price: </strong>' . $unitPrice . '</p>';
    $html .= '<p><strong>Total Payment: </strong>' . $totalCost . '</p>';

    // Add the payment status to the report
    if ($bookingDetails['p_status'] == 'cash') {
        $paymentStatus = 'Cash payment';
    } elseif ($bookingDetails['p_status'] == 'completed') {
        $paymentStatus = 'Online Payment';
    } else {
        $paymentStatus = 'Payment status unknown';
    }
    $html .= '<p><strong>Payment Status: </strong>' . $paymentStatus . '</p>';
}

$html .= '<p><strong>Total Amount: </strong>' . $bookingDetails['total_pay'] . '</p>';
$html .= '<p><strong>Extra Payment by Cash: </strong>' . $bookingDetails['extra_pay'] . '</p>';
$html .= '<p><strong>Extra Hour: </strong>' . $bookingDetails['extra_h'] . '</p>';
$html .= '<p><strong>Complain: </strong>' . $bookingDetails['complain'] . '</p>';
$html .= '<p><strong>Start Date: </strong>' . $bookingDetails['StartDate'] . '</p>';
$html .= '<p><strong>Notes: </strong>' . $bookingDetails['Notes'] . '</p>';

// Write the report to the output
//echo $html;
// Create an mPDF instance
$mpdf = new \Mpdf\Mpdf();

// Generate PDF content from the HTML
$mpdf->WriteHTML($html);

// Set the file name
$file = 'payment_' . $bookingID . '.pdf';

// Output the PDF for download or display
$mpdf->output($file, 'I');

		?>

		
	</div>


	<style type="text/css">
		body{
			background-color: #cfe8e1;
			font-family: Candara;
			margin: 30px;
			padding-left: 50px;
		}
	</style>
	

</body>
</html>

