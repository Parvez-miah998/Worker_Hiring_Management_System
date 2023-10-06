<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
}
/*
error_reporting(0);
*/
include('includes/dbconnection.php');
?>
<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        
         <title>Worker Hiring Management System || Home Page </title>
        
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>

   <body>
    <!-- login page start -->

    <!-- login page End-->


   <?php include_once('includes/header.php');?>
    <main>

        <!-- slider Area Start-->
        <div class="slider-area ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active" style="max-height: 500px">
      <img class="d-block w-100" src="admin/images/layout_img/download6.jpg" alt="First slide">
    </div>
    <div class="carousel-item"style="max-height: 500px">
      <img class="d-block w-100" src="admin/images/layout_img/download5.jpg" alt="Second slide">
    </div>
    <div class="carousel-item"style="max-height: 500px">
      <img class="d-block w-100" src="admin/images/layout_img/download7.jpg" alt="Second slide">
    </div>
    <div class="carousel-item"style="max-height: 500px">
      <img class="d-block w-100" src="admin/images/layout_img/download8.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" style="background: #7e9484">
                    <div class="container">
                        <div class="row">
                            
                                <div class="hero__caption">
                                    <h2 style="text-align: center;font-family: Lucida Calligraphy"><b>WELCOME TO</b></h2><br>
                                    <h3 style="text-align: center;font-family: Lucida Calligraphy"> Worker Hiring Management System </h3><br>
                                     <p class="contact-title" style="text-align: center;color: white;font-family: Times New Roman"> <span> Worker Hiring Management System is a web application designed to connect individuals or organizations with workers based on their specific requirements or needs. This system allows users to directly hire workers rather than posting job listings. It provides a user-friendly interface where employers can outline their requirements, search for suitable candidates, and initiate the hiring process.</span></p> 
                                </div>
                            
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
    </main>
    <?php include_once('includes/footer.php');?>

  <!-- JS here -->
	
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
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>