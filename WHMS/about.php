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
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Worker Hiring Management System || About Us </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <?php include_once('includes/header.php');?>
    <main>

        <!-- Hero Area Start-->
        
        <!-- Hero Area End -->
        <!-- Support Company Start-->
        <div class="support-company-area fix section-padding2" style="background-color: #98e5ed">
            <div class="container" >
                <div class="row align-items-center">
                    <h4 style="font-size: 20px; font-family: Lucida Calligraphy;padding-bottom: 15px">About Company</h4>
                    <p style="font-family: Comic Sans MS; font-size: 16px">DESHI Worker Hiring Agency is a leading and reputable recruitment firm dedicated to connecting businesses with skilled and reliable workers. Our company specializes in sourcing and placing talented individuals across various industries, ranging from construction and manufacturing to hospitality and customer service.

                    What sets DESHI apart is our commitment to understanding both the needs of employers and the aspirations of job seekers. We take pride in meticulously screening and assessing candidates to ensure they possess the right skills and attitude to excel in their roles. Our team of experienced recruiters utilizes a combination of innovative technology and personalized approaches to match the perfect candidate with the right job.

                    DESHI not only focuses on short-term placements but also nurtures long-term relationships between employers and employees. We believe in fostering growth and mutual success, contributing to the development of businesses and individuals alike. Our agency's mission is to simplify the hiring process for companies while creating meaningful employment opportunities for the workforce. With DESHI Worker Hiring Agency, you're not just finding a job or an employee – you're discovering a partner in success.</p>
                    
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- missio Company Start-->
        <div class="support-company-area fix section-padding2" style="background-color: #6e8e91">
            <div class="container" >
                <div class="row align-items-center">
                    <h4 style="font-size: 20px; font-family: Times New Roman;padding-bottom: 15px;font-weight: bolder;">Mission </h4>
                    <p style="font-family: Lucida Calligraphy; font-size: 18px">DESHI Worker Hiring Agency's mission is to forge lasting partnerships by seamlessly connecting businesses with skilled workers, fostering growth, and shaping a thriving job ecosystem.</p>
                    
                </div>
            </div>
        </div>
        <!-- mission Company End-->

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