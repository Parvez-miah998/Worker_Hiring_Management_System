<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION["user"];

$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

$userData = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Worker Hiring Management System || User Details</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!-- fancy box js -->
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
	
	<style>
		table {
			border-collapse: collapse;
		}
		th, td {
			border: 1px solid black;
			padding: 5px;
		}
	</style>
    <!-- Head content here -->
</head>
<body>
    <div class="container">
        <h3 style="font-family: Candara;text-align: center; color: blue; padding-top: 20px">User Profile</h3><br>
        <table class="table table-bordered" style="font-family: Candara;color: black;font-size: 14px">
            <tr>
                <th>Full Name</th>
                <td><?php echo $userData['full_name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $userData['email']; ?></td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td><?php echo $userData['contact_no']; ?></td>
            </tr>
            <tr>
                <th>Current Address</th>
                <td><?php echo $userData['c_address']; ?></td>
            </tr>
            <tr>
                <th>Permanent Address</th>
                <td><?php echo $userData['p_address']; ?></td>
            </tr>
        </table>
         
    </div>


            <!-- ... Your existing HTML code ... -->
        <div class="table_section padding_infor_info">
          <h3 style="text-align: center; color: blue;font-family: Candara;">Hiring Details</h3><br>
            <div class="table-responsive-sm">
                <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #a4bfb6;font-family: Candara; ">
                            <th>SL</th>
                            <th>Booking ID</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <!-- Add these two columns conditionally -->
                            <?php if ($_SESSION['user'] == 'approved_user@example.com') { ?>
                                <th>Worker Name</th>
                                <th>Wroker Contact No</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch user's hiring details based on logged-in user's email
                        $userEmail = $_SESSION['user'];
                        $sqlHiringDetails = "SELECT * FROM tblmaidbooking WHERE Email = :email";
                        $queryHiringDetails = $dbh->prepare($sqlHiringDetails);
                        $queryHiringDetails->bindParam(':email', $userEmail, PDO::PARAM_STR);
                        $queryHiringDetails->execute();
                        $hiringDetails = $queryHiringDetails->fetchAll(PDO::FETCH_ASSOC);

                        $cnt = 1;
                        foreach ($hiringDetails as $row) {
                            echo '<tr>';
                            echo '<td>' . $cnt . '</td>';
                            echo '<td>' . htmlentities($row['BookingID']) . '</td>';
                            echo '<td>' . htmlentities($row['Name']) . '</td>';
                            echo '<td>' . htmlentities($row['ContactNumber']) . '</td>';
                            echo '<td>' . htmlentities($row['Email']) . '</td>';
                            echo '<td>' . htmlentities($row['BookingDate']) . '</td>';
                            echo '<td>';
                    

                            if ($row['Status'] == 'Approved') {
                                if ($row['p_status'] == 'completed' || $row['p_status'] == 'cash') {
                                    echo '<button class="btn btn-info print-report-btn" data-booking-id="' . $row['BookingID'] . '">Print Report</button>';
                                    }
                                    else {
                                        echo '<a href="payment.php?bookingID=' . $row['BookingID'] . '"                     class="btn btn-success">Make Payment</a>';
                                    }
                                } elseif ($row['Status'] == 'Cancelled') {
                                echo 'Cancelled';
                                } else {
                                // Display the cancel button
                                echo '<button class="btn btn-danger cancel-btn" data-booking-id="' . $row['BookingID'] . '">Cancel Request</button>';
                            }



                            
                            echo '</tr>';
                            $cnt++; 
                        }
                        ?>
                    </tbody>
                </table>
                

<!-- JavaScript code for displaying the modal and fetching details -->
<script>
    $('.print-report-btn').click(function() {
    console.log("Print Report button clicked");
        console.log("Button clicked"); // Add this line
        var bookingID = $(this).data('booking-id');
         // Show the report in a new window
    var win = window.open('report.php?bookingID=' + bookingID, '_blank');

        // Fetch additional details from the server using AJAX
        $.ajax({
            url: 'fetch-details.php', // Update the URL to the appropriate path
            type: 'GET',
            data: { bookingID: bookingID },
            dataType: 'json',
            // Inside the AJAX success and error handlers
            success: function(response) {
                console.log("AJAX success:", response);
                console.log(response); // Add this line
                if (response.success) {
                    var details = response.details;
                    var detailsHTML = `
                        <p><strong>Name:</strong> ${details.name}</p>
                        <p><strong>Contact Number:</strong> ${details.contno}</p>
                        <p><strong>Email:</strong> ${details.email}</p>
                        <p><strong>Address:</strong> ${details.address}</p>
                        <p><strong>Category ID:</strong> ${details.catid}</p>
                        <p><strong>Working Shift From:</strong> ${details.working_shift_from}</p>
                        <p><strong>Working Shift To:</strong> ${details.working_shift_to}</p>
                        <p><strong>Total Work Time:</strong> ${details.total_time_hours} hours ${details.total_time_minutes} minutes</p>
                        <p><strong>Unit Price:</strong> ${details.unit_price}</p>
                        <p><strong>Total Cost:</strong> ${details.total_cost}</p>
                        <p><strong>Start Date:</strong> ${details.start_date}</p>
                        <p><strong>Notes:</strong> ${details.notes}</p>
                        <!-- ... Add more details here ... -->
                    `;

                    // Display the details in the modal
                    $('#myModal .modal-body').html(detailsHTML);
                    $('#myModal').modal('show');
                } else {
                    console.error('Failed to fetch details.');
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX error:", error);
                }
        });
    });
</script>
<!-- ... End existing JavaScript code ... -->

        <!--script for delete request from table and database-->
                <script>
        $(document).ready(function() {
            $('.cancel-btn').click(function() {
                var bookingID = $(this).data('booking-id');
                var row = $(this).closest('tr'); // Get the table row
                
                // Make AJAX request to deny.php to delete the booking
                $.ajax({
                    url: 'deny.php',
                    type: 'POST',
                    data: { bookingID: bookingID },
                    success: function(response) {
                        if (response === 'success') {
                            // If the request is successfully deleted, remove the row from the table
                            row.remove();
                        } else {
                            console.error('Deletion failed.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
        </script>

            </div>
        </div>
        <!-- ... End existing HTML code ... -->


<!-- Include the script for handling the cancel button -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php include_once('includes/footer.php');?>


</body>
</html>

