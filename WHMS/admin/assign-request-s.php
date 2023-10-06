<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['mhmsaid']==0)) {
  header('location:s-login.php');
  } else{


  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>Worker Hiring Management System || Assign Request</title>
   
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
                              <a href="search-booking-request.php">> <span>Booking Request</span></a>
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
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Assign Request</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Assign Request</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <tr>
                                        <th class="text-center"></th>
                                        <th>Booking ID</th>
                                        <th class="d-none d-sm-table-cell">Name</th>
                                        <th class="d-none d-sm-table-cell">Mobile Number</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-sm-table-cell">Booking Date</th>
                                        <th class="d-none d-sm-table-cell">Status</th>
                                        <th class="d-none d-sm-table-cell">Assign To</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                       
                                       </thead>
                                       <tbody>
                                          <?php
$sql="SELECT * from tblmaidbooking where Status='Approved' ORDER BY Status DESC, BookingDate DESC";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                          <tr>
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->BookingID);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->Name);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->ContactNumber);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->Email);?></td>
                                        <td class="font-w600">
                                            <span class="badge badge-primary"><?php  echo htmlentities($row->BookingDate);?></span>
                                        </td>
                                        <?php if($row->Status==""){ ?>

                     <td class="font-w600"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-primary"><?php  echo htmlentities($row->Status);?></span>
                                        </td>
<?php } ?> 
<?php if($row->Status==""){ ?>

                     <td class="font-w600"><?php echo "Not Assign Yet"; ?></td>

   <?php } if($row->Status=="Cancelled"){ ?>

                     <td class="font-w600"><?php echo "Cancelled"; ?></td>
<?php } else { ?>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge badge-primary"><?php  echo htmlentities($row->AssignTo);?></span>
                                        </td>
<?php } ?> 
                                         <td class="d-none d-sm-table-cell"><a href="view-booking-details.php?editid=<?php echo htmlentities ($row->ID);?>&&bookingid=<?php echo htmlentities ($row->BookingID);?>" class="btn btn-primary btn-sm">View Details</a></td>
                                    </tr><?php $cnt=$cnt+1;}} ?>
                                       </tbody>
                                    </table>
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
   </body>
</html><?php } ?>