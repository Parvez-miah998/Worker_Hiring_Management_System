<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$sql = "SELECT id, full_name, email, contact_no, c_address, p_address ,sw_id FROM supervisor";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$supervisor = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
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
</head>
<body class="inner_page tables_page" style="font-family: Candara">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
              <?php include_once('includes/header.php');?>
               <!-- end topbar -->

               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Supervisor Details</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Supervisor Details</h2>
                                 </div>
                              </div>
                              <div class="table_section padding_infor_info">
                                 <div class="table-responsive-sm">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
												<!-- <th>SL</th> -->
												<th>Full Name</th>
												<th>Email</th>
												<th>Contact No</th>
												<th>Current Address</th>
												<th>Permanent Address</th>
                                    <th>Work ID</th>
											</tr>
                                       </thead>
                                       <tbody>
											<?php foreach ($supervisor as $supervisors): ?>
												<tr>
													<!-- <td><?php echo $supervisors['id']; ?></td> -->
													<td><?php echo $supervisors['full_name']; ?></td>
													<td><?php echo $supervisors['email']; ?></td>
													<td><?php echo $supervisors['contact_no']; ?></td>
													<td><?php echo $supervisors['c_address']; ?></td>
													<td><?php echo $supervisors['p_address']; ?></td>
                                       <td><?php echo $supervisors['sw_id']; ?></td>
												</tr>
											<?php endforeach; ?>
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
</html>