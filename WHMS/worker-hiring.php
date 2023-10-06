<?php

session_start();
error_reporting(0);
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
include('includes/dbconnection.php');

        // Fetch user's data from the database based on the logged-in user's email.
        $userEmail = $_SESSION['user'];
        $sqlUser = "SELECT full_name, email, contact_no, c_address FROM users WHERE email = :email";
        $queryUser = $dbh->prepare($sqlUser);
        $queryUser->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $queryUser->execute();

        if ($queryUser->rowCount() > 0) {
            $userData = $queryUser->fetch(PDO::FETCH_ASSOC);

            // Set the values of the worker hiring form fields with the data from the users table.
            $name = $userData['full_name'];
            $email = $userData['email'];
            $contact = $userData['contact_no'];
            $address = $userData['c_address'];
        }

        // Initialize the error flag for "Work Shift To" input
            $errorFlag = false;

        if(isset($_POST['submit']))
          {
            $catid=$_POST['catid'];
         $name=$_POST['name'];
         $contno=$_POST['contno'];
         $email=$_POST['email'];
         $address=$_POST['address'];
         $gender=$_POST['gender'];
         $wsf=$_POST['wsf'];

         
         // Automatically set the "Work Shift To" to a maximum of 8 hours from "Work Shift From."
    $maxWorkHours = 8;
    $wst = date('H:i:s', strtotime($wsf) + ($maxWorkHours * 60 * 60));

    // Check if the input exceeds 8 hours and set the error flag
    if (strtotime($wst) > strtotime('20:00:00')) {
        $wst = '20:00:00';
        $errorFlag = true;
    }


         $wst=$_POST['wst'];
         $startdate=$_POST['startdate'];
         $notes=$_POST['notes'];
         $bookingid=mt_rand(100000000, 999999999);

        $sql="insert into tblmaidbooking(BookingID,CatID,Name,ContactNumber,Email,Address,Gender,WorkingShiftFrom,WorkingShiftTo,StartDate,Notes)values(:bookingid,:catid,:name,:contno,:email,:address,:gender,:wsf,:wst,:startdate,:notes)";
        $query=$dbh->prepare($sql);
        $query->bindParam(':bookingid',$bookingid,PDO::PARAM_STR);
        $query->bindParam(':catid',$catid,PDO::PARAM_STR);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':contno',$contno,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':gender',$gender,PDO::PARAM_STR);
        $query->bindParam(':wsf',$wsf,PDO::PARAM_STR);
        $query->bindParam(':wst',$wst,PDO::PARAM_STR);
        $query->bindParam(':startdate',$startdate,PDO::PARAM_STR);
        $query->bindParam(':notes',$notes,PDO::PARAM_STR);
         $query->execute();
           $LastInsertId=$dbh->lastInsertId();
           if ($LastInsertId>0 && !$errorFlag) {
            echo '<script>alert("Your Booking Request Has Been Send. We Will Contact You Soon")</script>';
        echo "<script>window.location.href ='worker-hiring.php'</script>";
          }
          else
            {
                if ($errorFlag) {
                    echo '<div style="color: red;">You cannot hire a worker for more than 8 hours.</div>';
                } else {
                    echo '<script>alert("Something Went Wrong. Please try again.")</script>';
                }
                 //echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }

        }

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   
     <title>Worker Hiring Management System || Hiring Form</title>
    

   <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/price_rangs.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <?php include_once('includes/header.php');?>
    
    <!-- ================ contact section start ================= -->

    <section class="contact-section" style="background-color: #94cae3">
    <div class="container" style="max-width: 500px;max-height: auto; font-family: Candara; background-color: #bfe0e0; border-radius: 15px;">
        
            <div class="form-group">
                <h2 class="contact-title" style="text-align: center;color: #3f76eb;font-family: Candara;padding-top: 10px">WORKER HIRING FORM</h2>
            </div>
            <div class="cool">

                <form class="form-contact contact_form" action="" method="post">
                    
                            <div class="form-group" style="padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin: 0px">
                                <label style="color:blue ;font-weight: bold;font-size: 14px;font-family: Candara ! important;">Name</label>
                                <!-- Use the fetched user's full name as the default value -->
                               <input class="form-control" name="name" id="name" type="text" style="font-family: Candara ! important;border-left: 0;border-top: 0;border-right: 0" placeholder="Enter your name" value="<?php echo $userData['full_name']; ?>" required>
                            </div> 
                        <br>
                        
                            <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Contact Number</label>
                                <!-- Use the fetched user's contact number as the default value -->
                                <input type="text" style="font-family: Candara ! important;border-left: 0;border-top: 0;border-right: 0" name="contno" value="<?php echo $userData['contact_no']; ?>"required  class="form-control" required='true' maxlength="10" pattern="[0-9]+">
                            </div>
                        
                        
                            <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Email</label>
                                <!-- Use the fetched user's email as the default value -->
                                <input class="form-control" name="email" id="email" type="email" style="font-family: Candara ! important;border-left: 0;border-top: 0;border-right: 0" placeholder="Email" value="<?php echo $userData['email']; ?>"required = 'true'>
                            </div>
                        
                        
                            <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Address (to be hired)</label>
                                <!-- Use the fetched user's current address as the default value -->
                                <input type="text" style="font-family: Candara ! important;border-left: 0;border-top: 0;border-right: 0;" class="form-control" name="address" id="address" placeholder="Your Address" value="<?php echo $userData['c_address']; ?>"required='true' >
                            </div>
                       
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label style="color: red;font-weight: bold;font-size: 20px; padding-left: 0px;">Worker's Gender</label><br>
                                       <select name="gender" class="form-control" required='true'>
                                 <option value="">Select Gender</option>
                                 <option value="Female">Female</option>
                                 <option value="Male">Male</option>
                             </select>
                                    </div>
                                </div> -->

                                
                                    <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                        <label style="color: blue;font-weight: bold;font-size: 14px;padding-left: 0px;">Select Service</label><br>
                                       <select name="catid" class="form-control" style="border-radius: 15px;font-family: Candara" required='true'>
                                 <option value="">Select Service</option>
                                  <?php 

$sql2 = "SELECT * from   tblcategory ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row2)
{          
    ?>  
   
<option value="<?php echo htmlentities($row2->ID);?>"><?php echo htmlentities($row2->CategoryName
    );?></option>
 <?php } ?></select>
                                    </div>
                                    <br>
                                   <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-top: 20px">
                                        <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Work Shift From</label>
                                        <input class="form-control" name="wsf" id="wsf" type="time" style="font-family: Candara !important; border-left: 0; border-top: 0; border-right: 0" required='true'>
                                    </div>

                                    <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                        <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Work Shift To</label>
                                        <input class="form-control" name="wst" id="wst" type="time" style="font-family: Candara !important; border-left: 0; border-top: 0; border-right: 0" required='true'> 
                                        <div class="error-message" style="color: red;"></div>
                                        <div class="total-time" style="color: green;"></div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 15px">
                                <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara;">Start Date</label>
                                <input class="form-control" name="startdate" id="startdate" type="date" style="font-family: Candara !important;border-left: 0;border-top: 0;border-right: 0;background-color:#bfe0e0;" required='true'>
                            </div>

                            <script>
                                // Get the input element by its ID
                                var startDateInput = document.getElementById("startdate");

                                // Get the current date and format it as "YYYY-MM-DD"
                                var currentDate = new Date().toISOString().split('T')[0];

                                // Set the minimum attribute to the current date, which will prevent past dates from being selected
                                startDateInput.setAttribute("min", currentDate);
                            </script>

                            
                                
                                
                                    <div class="form-group" style="padding-top:0px; padding-left:50px;padding-right: 100px;padding-bottom: 0px;margin-bottom: 0px">
                                        <label style="color: blue;font-weight: bold;font-size: 14px;font-family: Candara">Notes</label>
                                        <div class="box" style="border-radius: 15px">
                                        <textarea class="form-control" name="notes" id="notes" type="text" placeholder="Enter Some Notes"style="font-family: Candara ! important;margin-bottom: 20px;border-left: 0;border-top: 0;border-right: 0;background-color:#bfe0e0; "></textarea>
                                        </div>
                                    </div>
                                
                            
                            <div class="form-button"style="padding-bottom: 25px;margin: 15px">
                                <button type="submit" class="btn btn-primary" style="font-family: Candara ! important;box-sizing: 20px;border-radius: 10px" name="submit">Send</button>
                            </div>
                            
                        </form>
                    </div>
                 <style type="text/css">
                     .form-control{
                        font-family: Candara ! important; 
                        border-radius: 10px ! important;
                        border-left: 0 ! important;
                        border-top: 0 ! important;
                        border-right: 0 ! important;
                        border-bottom: 0 ! important;
                        box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.2) ! important;
                     }
                     .btn{
                        background-color: #607981 ! important;
                     }
                 </style>
                
            </div>
            
        </section>
    <!-- ================ contact section end ================= -->
  <?php include_once('includes/footer.php');?>

	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <script src="./assets/js/price_rangs.js"></script>
        
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
		
		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        <!-- JS here -->
<script>
    // Function to update the total time and show error if it exceeds 8 hours
    const workShiftFromInput = document.getElementById('wsf');
const workShiftToInput = document.getElementById('wst');

const updateTotalTime = function () {
  const errorMessage = workShiftToInput.closest('.form-group').querySelector('.error-message');
  const totalHoursDisplay = workShiftToInput.closest('.form-group').querySelector('.total-time');

  if (workShiftFromInput.value !== '') {
    const maxWorkHours = 8;
    const workShiftFromTime = new Date(`1970-01-01T${workShiftFromInput.value}`);
    const workShiftToTime = new Date(`1970-01-01T${workShiftToInput.value}`);
    const formattedWorkShiftTo = workShiftToTime.toTimeString().slice(0, 5);
    if (workShiftToTime < workShiftFromTime) {
    const oneDayMilliseconds = 24 * 60 * 60 * 1000; // Number of milliseconds in a day
    const timeDifference = workShiftFromTime - workShiftToTime;
    const numberOfDays = Math.ceil(timeDifference / oneDayMilliseconds);
    workShiftToTime.setDate(workShiftToTime.getDate() + numberOfDays); // Increment the date by the number of days
}

    const totalTimeInHours = (workShiftToTime - workShiftFromTime) / (60 * 60 * 1000); // in hours
    const totalTimeInMinutes = (workShiftToTime - workShiftFromTime) / (60 * 1000); // in minutes

    // Convert time to 12 hour format
    const workShiftFromTime12Hour = workShiftFromTime.toLocaleString('en-US', { hour12: true });
    const workShiftToTime12Hour = workShiftToTime.toLocaleString('en-US', { hour12: true });

    if (totalTimeInHours > maxWorkHours) {
      errorMessage.textContent = 'You cannot hire a worker for more than 8 hours. If you need more you have to explain.';
      const totalHours = Math.floor(totalTimeInHours);
      const totalMinutes = (totalTimeInHours - totalHours) * 60;
      totalHoursDisplay.textContent = `Total time: ${totalHours.toFixed(0)} hours ${totalMinutes.toFixed(0)} minutes`;
    } else if (workShiftFromTime12Hour === workShiftToTime12Hour) {
      errorMessage.textContent = 'Work shift start and end time cannot be the same.';
      totalHoursDisplay.textContent = '';
    } else {
      errorMessage.textContent = '';
      const totalHours = Math.floor(totalTimeInHours);
      const totalMinutes = (totalTimeInHours - totalHours) * 60;
      totalHoursDisplay.textContent = `Total time: ${totalHours.toFixed(0)} hours ${totalMinutes.toFixed(0)} minutes`;
    }
  }
};

workShiftFromInput.addEventListener('change', function () {
  updateTotalTime();
});

workShiftToInput.addEventListener('change', function () {
  updateTotalTime();
});

// Add a condition to update "Work Shift To" automatically when user inserts "Work Shift From"
workShiftFromInput.addEventListener('change', function () {
  const workShiftFromTime = new Date(`1970-01-01T${workShiftFromInput.value}`);
  const workShiftToTime = new Date(workShiftFromTime.getTime() + (8 * 60 * 60 * 1000)); // in milliseconds
  const formattedWorkShiftTo = workShiftToTime.toTimeString().slice(0, 5);
  workShiftToInput.value = formattedWorkShiftTo;

  updateTotalTime(); // Update total time as "Work Shift To" is also changing
});

</script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
    
    </html>