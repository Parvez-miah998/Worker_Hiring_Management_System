<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['mhmsaid']==0)) {
  header('location:s-login.php');
  } else{
if(isset($_POST['submit']))
  {


$eid=$_GET['editid'];
    $bookingid=$_GET['bookingid'];
    $status=$_POST['status'];
   $remark=$_POST['remark'];
   $assignee=$_POST['assignee'];
  

$sql= "update tblmaidbooking set Status=:status,Remark=:remark,AssignTo=:assignee where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':assignee',$assignee,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);

 $query->execute();

  echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-request.php'</script>";
}

  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>Worker Hiring Management System || View Worker Booking Details</title>
   
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      
   </head>
   <body class="inner_page tables_page" style="font-family: Candara">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
           <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="#"><img class="logo_icon img-responsive" src="images/logo/logo_icon.png" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="images/layout_img/user_img.jpg" alt="#" /></div>
                        <div class="user_info">
                           <?php
$aid=$_SESSION['mhmsaid'];
$sql="SELECT full_name,Email from  supervisor where ID=:sw_id";
$query = $dbh -> prepare($sql);
$query->bindParam(':sw_id',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                           <h6><?php  echo $row->full_name;?></h6>
                           <p><span class="online_animation"></span> <?php  echo $row->Email;?></p><?php $cnt=$cnt+1;}} ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                    
                     <li><a href="#"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>
                     <li><a href="#"><i class="fa fa-users golden_color"></i> <span>User Details</span></a></li>
                     <li class="active">
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clock-o orange_color"></i> <span>Category</span></a>
                        <ul class="collapse list-unstyled" id="dashboard1">
                           <li>
                              <a href="#">> <span>Add</span></a>
                           </li>
                           <li>
                              <a href="#">> <span>Manage</span></a>
                           </li>
                        </ul>
                     </li>
                     
                     <li>
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users purple_color"></i> <span>Worker</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="#">> <span>Add Worker</span></a></li>
                           <li><a href="#">> <span>Manage Worker</span></a></li>
                           
                        </ul>
                     </li>
                     
                     <li>
                        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-files-o blue2_color"></i> <span>Worker Hiring Request</span></a>
                        <ul class="collapse list-unstyled" id="apps">
                           <li><a href="#">> <span>New Request</span></a></li>
                           <li><a href="assign-request-s.php">> <span>Assign Request</span></a></li>
                          <li><a href="#">> <span>Cancel Request</span></a></li>
                          <li><a href="#">> <span>All Request</span></a></li>
                        </ul>
                     </li>
                    
                     <li class="active">
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span> Pages</span></a>
                        <ul class="collapse list-unstyled" id="additional_page">
                           <li>
                              <a href="#">> <span>About Us</span></a>
                           </li>
                           <li>
                              <a href="#">> <span>Contact Us</span></a>
                           </li>
                           
                        </ul>
                     </li>
                     <li class="active">
                        <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone red_color"></i> <span> Search</span></a>
                        <ul class="collapse list-unstyled" id="additional_page1">
                           <li>
                              <a href="#">> <span>Booking Request</span></a>
                           </li>
                           <li>
                              <a href="#">> <span>Search Worker</span></a>
                           </li>
                           
                        </ul>
                     </li>
                     <li><a href="logout-s.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
                    
                  </ul>
               </div>
            </nav>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
              <!-- topbar -->
              <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="#"><h3 style="color: white;padding-top: 20px;padding-left: 10px;">Worker Hiring Management System</h3></a>
                        </div>
                        
                  </nav>
               </div>
               <!-- end topbar -->
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>View Worker Booking Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>View Worker Booking Details</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">

  <?php
                  $eid=$_GET['editid'];

$sql="SELECT tblmaidbooking.BookingID,tblmaidbooking.CatID,tblmaidbooking.Name,tblmaidbooking.ContactNumber,tblmaidbooking.Email,tblmaidbooking.Address,tblmaidbooking.Gender,tblmaidbooking.WorkingShiftFrom,tblmaidbooking.WorkingShiftTo,tblmaidbooking.StartDate,tblmaidbooking.Notes,tblmaidbooking.BookingDate,tblmaidbooking.Remark,tblmaidbooking.Status,tblmaidbooking.p_status,tblmaidbooking.TotalAmount,tblmaidbooking.extra_h,tblmaidbooking.extra_pay,tblmaidbooking.total_pay,tblmaidbooking.complain,tblmaidbooking.comp_by,tblmaidbooking.AssignTo,tblmaidbooking.UpdationDate,tblcategory.ID,tblcategory.CategoryName from tblmaidbooking join tblcategory on tblmaidbooking.CatID=tblcategory.ID  where tblmaidbooking.ID=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  
$assignto=$row->AssignTo;
             ?> 
                                   <table class="table table-bordered">
                                    <tr>
    <th colspan="6" style="color: black;font-weight: bold;font-size: 20px;text-align: center;">Worker Booking Details </th>
  </tr>
  <tr>
    <th>Booking ID</th>
    <td><?php  echo $row->BookingID;?></td>
     <th>Service Required</th>
    <td><?php  echo $row->CategoryName;?></td>
  </tr>
  <tr>
    <th>Name</th>
    <td><?php  echo $row->Name;?></td>
     <th>Contact Number</th>
    <td><?php  echo $row->ContactNumber;?></td>
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
     <th>Address(to be hired)</th>
    <td><?php  echo $row->Address;?></td>
  </tr>
  <tr>
    <th>Gender Required</th>
    <td><?php  echo $row->Gender;?></td>
     <th>Working Shift From</th>
    <td><?php  echo date("g:i A", strtotime($row->WorkingShiftFrom));?></td>
  </tr>
  <tr>
  <th>Booking Date</th>
  <td><?php  echo $row->BookingDate;?></td>
  <th>Working Shift To</th>
  <td><?php echo date("g:i A", strtotime($row->WorkingShiftTo)); ?></td>
</tr>
<tr>
  <th>Booking Status</th>

    <td> <?php  $status=$row->Status;
    
if($row->Status=="Approved")
{
  echo "Worker booking request has been approved";
}

if($row->Status=="Cancelled")
{
 echo "Worker booking request has been cancelled";
}


if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>
  <th>Work Start Date</th>
  <td><?php  echo $row->StartDate;?></td>
  
     
  </tr>
  <tr>
  <th >Admin Remark</th>
    <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>

<?php } else { ?>                 
 <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>
  <th>Total Time</th>
  <td>
  <?php
        $startTime = strtotime($row->WorkingShiftFrom);
        $endTime = strtotime($row->WorkingShiftTo);

        if ($endTime < $startTime) {
            $endTime += 86400; 
        }
        $totalTime = $endTime - $startTime;
        $hours = floor($totalTime / 3600);
        $minutes = floor(($totalTime % 3600) / 60);
        echo sprintf("%02d:%02d", $hours, $minutes);
    ?>
</td>
     
  </tr>
  <tr>
    <th>Notes(if any)</th>
    <td><?php  echo $row->Notes;?></td>
    <th>Complain <?php  echo $row->comp_by;?></th>
    <td><?php  echo $row->complain;?></td>
     
  </tr> 

  <?php $cnt=$cnt+1;}} ?>
</table>


<div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">

  <?php
                  $eid=$_GET['editid'];

$sql="SELECT tblmaidbooking.BookingID,tblmaidbooking.CatID,tblmaidbooking.Name,tblmaidbooking.ContactNumber,tblmaidbooking.Email,tblmaidbooking.Address,tblmaidbooking.Gender,tblmaidbooking.WorkingShiftFrom,tblmaidbooking.WorkingShiftTo,tblmaidbooking.StartDate,tblmaidbooking.Notes,tblmaidbooking.BookingDate,tblmaidbooking.Remark,tblmaidbooking.Status,tblmaidbooking.p_status,tblmaidbooking.TotalAmount,tblmaidbooking.extra_h,tblmaidbooking.extra_pay,tblmaidbooking.total_pay,tblmaidbooking.complain,tblmaidbooking.comp_by,tblmaidbooking.AssignTo,tblmaidbooking.UpdationDate,tblcategory.ID,tblcategory.CategoryName from tblmaidbooking join tblcategory on tblmaidbooking.CatID=tblcategory.ID  where tblmaidbooking.ID=:eid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  
$assignto=$row->AssignTo;
             ?> 
                                   <table class="table table-bordered">
                                    <tr>
    <th colspan="6" style="color: black;font-weight: bold;font-size: 20px;text-align: center;">Payment Details </th>
  <tr>
  <th>Payment Status</th>
    <td><?php if ($row->p_status == "cash") {
    echo "Payment by Cash ";
  } else if ($row->p_status == "completed") {
    echo "Payment by Card ";
  } else {
    echo "Payment Status is Pending ";
  }?><?php  echo $row->TotalAmount;?> </td>
  <th>Extra Payment by Cash</th>
  <td><?php  echo $row->extra_pay;?></td>
</tr>
  <tr>
  <th>Total Payment</th>
  <td><?php  echo $row->total_pay;?></td>
  <th>Extra Hours</th>
  <td><?php  echo $row->extra_h;?></td>
     
  </tr>
  
  

  <?php $cnt=$cnt+1;}} ?>
</table>


<?php if ($row->AssignTo != '') : ?>
    <table class="table table-bordered">
        <tr>
            <th colspan="4" style="color: blue; font-size: 20px;text-align: center;">Assigned Supervisor Details</th>
        </tr>
        <?php
        // Fetch supervisor details based on AssignTo
        $supervisorId = $row->AssignTo; // Use $row instead of $rows
        $sqlSupervisor = "SELECT * FROM supervisor WHERE sw_id = :supervisorId";
        $querySupervisor = $dbh->prepare($sqlSupervisor);
        $querySupervisor->bindParam(':supervisorId', $supervisorId, PDO::PARAM_INT);
        $querySupervisor->execute();
        $supervisor = $querySupervisor->fetch(PDO::FETCH_ASSOC);
        ?>
        <tr>
            <th>Supervisor Name</th>
            <td><?php echo $supervisor['full_name']; ?></td>
            <th>Contact Number</th>
            <td><?php echo $supervisor['contact_no']; ?></td>
        </tr>
        <tr>
            <th>Email Id</th>
            <td><?php echo $supervisor['email']; ?></td>
            <th>Address</th>
            <td><?php echo $supervisor['c_address']; ?></td>
        </tr>
    </table>
<?php endif ?>


<?php if($assignto!=''):?>
    <table class="table table-bordered">
<?php 
$stmt = $dbh -> prepare("SELECT * from tblmaid where MaidId='$assignto'");
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
foreach($resultss as $rows)
{  ?>
    <tr>
        <th colspan="4" style="color:blue; font-size:20px;text-align: center;">Worker Details</th>
    </tr>
<tr>
    <th>Worker Name</th>
    <td><?php echo $rows->Name;?></td>
    <th>Email Id</th>
    <td><?php echo $rows->Email;?></td>
</tr>

<tr>
    <th>Contact no.</th>
    <td><?php echo $rows->ContactNumber;?></td>
    <th>Gender</th>
    <td><?php echo $rows->Gender;?></td>
</tr>

<tr>
    <th>Exp.</th>
    <td><?php echo $rows->Experience;?></td>
    <th>DOB</th>
    <td><?php echo $rows->Dateofbirth;?></td>
</tr>


<tr>
    <th>Address</th>
    <td><?php echo $rows->Address;?></td>
    <th>Photo</th>
    <td><img src="images/<?php echo $rows->ProfilePic;?>" width="100" height="100"></td>
</tr>


<tr>
    <th>ID Proof</th>
    <td><img src="idproofimages/<?php echo $rows->IdProof;?>" width="100" height="100"></td>
</tr>
<?php } ?>
    </table>

 <?php endif?> 


<?php
if(isset($_POST['updateExtraHoursSubmit'])) {
   $updatedExtraHours = $_POST['updatedExtraHours'];

   // Get unit price from tblcategory based on the selected category (You might need to fetch this)
   $categoryId = $row->CatID; // Assuming you have the category ID available in $row
   $queryCategory = $dbh->prepare("SELECT UnitPrice FROM tblcategory WHERE ID = :categoryId");
   $queryCategory->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
   $queryCategory->execute();
   $category = $queryCategory->fetch(PDO::FETCH_ASSOC);
   $unitPrice = $category['UnitPrice'];

   // Calculate extra_pay as extra_h multiplied by unitPrice
   $extraPay = $updatedExtraHours * $unitPrice;

   // Calculate total_pay as TotalAmount + extra_pay
   $totalPay = $extraPay + $row->TotalAmount;

   // Update database
   $updateSql = "UPDATE tblmaidbooking SET extra_h = :updatedExtraHours, extra_pay = :extraPay, total_pay = :totalPay WHERE ID = :eid";
   $updateQuery = $dbh->prepare($updateSql);
   $updateQuery->bindParam(':updatedExtraHours', $updatedExtraHours, PDO::PARAM_STR);
   $updateQuery->bindParam(':extraPay', $extraPay, PDO::PARAM_STR);
   $updateQuery->bindParam(':totalPay', $totalPay, PDO::PARAM_STR);
   $updateQuery->bindParam(':eid', $eid, PDO::PARAM_STR);
   $updateQuery->execute();

// Display updated data in worker hiring details table
   echo '<script>alert("Extra Hours and Pay updated successfully");</script>';
   echo "<script>window.location.href ='view-booking-details.php?editid=$eid';</script>"; // Redirect back to the details page
}


?>


<button class="btn btn-primary" id="editExtraPayBtn" style="margin-left: 250px">Edit Extra Pay</button>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
      $("#editExtraPayBtn").click(function() {
         $("#editFormContainer").show(); // Show the editing form
         // Populate user details and extra_pay input fields
         $("#userName").text("<?php echo $row->Name; ?>");
         $("#userAddress").text("<?php echo $row->Address; ?>");
         $("#currentExtraPay").text("<?php echo $row->extra_pay; ?>");
         $("#extraPayInput").val("<?php echo $row->extra_pay; ?>");
      });
   });
</script>

<div id="editFormContainer" style="display: none; position: center;margin-left: 250px">
   <br><h5>Edit Extra Pay</h5>
   <p>User: <?php echo $row->Name; ?></p>
   <p>Address: <?php echo $row->Address; ?></p>
   <form action="" method="POST">
      <label for="updatedExtraHours">Updated Extra Hours:</label><br>
      <input type="number" name="updatedExtraHours" id="updatedExtraHours" step="0.01" placeholder="Updated Extra Hours" required = 'true' style="margin-top: 10px;margin-bottom: 10px"><br>
      <input type="submit" name="updateExtraHoursSubmit" value="Update Extra Hours" style="background-color: #16b3ea; color: white; padding: 6px; border-radius: 4px">
   </form>
</div> 


<?php
if(isset($_POST['submitComplaint'])) {
    $complainBy = $_POST['complainBy'];
    $complainComment = $_POST['complainComment'];

    // Update the comp_by and complain columns in the database
    $updateComplainSql = "UPDATE tblmaidbooking SET comp_by = :complainBy, complain = :complainComment WHERE ID = :eid";
    $updateComplainQuery = $dbh->prepare($updateComplainSql);
    $updateComplainQuery->bindParam(':complainBy', $complainBy, PDO::PARAM_STR);
    $updateComplainQuery->bindParam(':complainComment', $complainComment, PDO::PARAM_STR);
    $updateComplainQuery->bindParam(':eid', $eid, PDO::PARAM_STR);
    $updateComplainQuery->execute();
 // Display a success message
    echo '<script>alert("Complaint submitted successfully");</script>';
    echo "<script>window.location.href ='view-booking-details.php?editid=$eid';</script>"; // Redirect back to the details page
}


?>
<br><br>
<button class="btn btn-primary" id="complainButton" style="margin-left: 250px">Complain</button>
<div id="complainFormContainer" style="display: none; margin-left: 250px">
    <br><h5>Complain</h5>
    <form action="" method="POST">
        <label for="complainBy">Complain By:</label><br>
        <select name="complainBy" id="complainBy">
            <option value="User">User</option>
            <option value="Worker">Worker</option>
        </select><br>
        <label for="complainComment">Complaint Comment:</label><br>
        <textarea name="complainComment" id="complainComment" rows="4" cols="50" placeholder="Enter your complaint" required></textarea><br>
        <input type="submit" name="submitComplaint" value="Submit Complain" style="background-color: #16b3ea; color: white; padding: 6px; border-radius: 4px">
    </form>
</div>


<script>
document.getElementById('complainButton').addEventListener('click', function() {
    document.getElementById('complainFormContainer').style.display = 'block';
});
</script>




</div> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- footer -->
                 <?php include_once('includes/footer.php');?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
       
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- fancy box js -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>

<script type="text/javascript">

  //For report file
  $('#assigntoo').hide();
  $(document).ready(function(){
  $('#status').change(function(){
  if($('#status').val()=='Approved')
  {
  $('#assigntoo').show();
  jQuery("#assignee").prop('required',true);  
  }
  else{
  $('#assigntoo').hide();
    jQuery("#assignee").prop('required',false);  
  }
})}) 
</script>



   </body>
</html><?php } ?>