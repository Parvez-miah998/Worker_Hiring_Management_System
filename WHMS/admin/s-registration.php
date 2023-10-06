<?php
session_start();
if (isset($_SESSION["supervisors"])) {
    header("Location: dashboard.php");
}

error_reporting(0);

include('includes/dbconnection.php');

if (isset($_POST["submit"])) {
			$fullName = $_POST["fullname"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$passwordRepeat = $_POST["repeat_password"];
			$contact = $_POST["contact_no"];
			$cAddress = $_POST["c_address"];
			$pAddress = $_POST["p_address"];
			$sworkid = $_POST["sworkid"];

			$passwordHash = password_hash($password, PASSWORD_DEFAULT);
			$errors = array();

			if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($contact) OR empty($cAddress) OR empty($pAddress) OR empty($sworkid)) {
				array_push($errors, "All The Fields Are Requires !!!");
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Email is Not Valid !");
			}

			if (strlen($password) < 6) {
				array_push($errors, "Password at least 6 Character Long !");
			}

			if ($password !== $passwordRepeat) {
				array_push($errors, "Password Does Not Match !");
			}

			require_once "includes/dbconnection.php";
			
			$sql = "INSERT INTO supervisor (full_name, email, password, contact_no, c_address, p_address, sw_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $fullName);
			$stmt->bindParam(2, $email);
			$stmt->bindParam(3, $passwordHash);
			$stmt->bindParam(4, $contact);
			$stmt->bindParam(5, $cAddress);
			$stmt->bindParam(6, $pAddress);
			$stmt->bindParam(7, $sworkid);

			$prepareStmt = $stmt->execute();

			if ($prepareStmt) {
				$lastInsertId = $dbh->lastInsertId();
				echo "<div class = 'alert alert-success'>You are Register Successfully !</div>";
				$_SESSION["supervisors"] = $email;
				header('Location: assign-request-s.php');
    				exit();
			}
			else{
				die("Somthing Went Wrong !!");
			}
		}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale.0">
	<title>Worker Hiring Management System || Supervisor Registration Page</title>
	


</head>
<body>
	<div class="container">
		

		<h2>Worker Hiring Management System</h2>
		<h4>Supervisor Registration</h4> <br>

		<form action="s-registration.php" method="post">
			<div class="form-group">
				<input type="text" class="form-control" name="fullname" placeholder="Full Name">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="contact_no" placeholder="Contact Number">
			</div>
			<div class="form-group">
    			<input type="text" class="form-control" name="sworkid" placeholder="Supervisor Work Id">
			</div>

			<div class="form-group">
				<input type="text" class="form-control" name="c_address" placeholder="Current Address">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="p_address" placeholder="Permanent Address">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" name="repeat_password" placeholder="Confirm Password">
			</div>
			<div class="form-btn">
				<input type="submit" class="btn btn-primary" value ="Register" name="submit"> 
			
			</div>

			<br>
	      <div class="form-btn">
	        <a href="forgot-password-s.php"> Forgotten Password?</a>
	      </div>
			<br>
			<div class="form-btn">
            <a href="dashboard.php"> Back to DashBoard </a>
        </div><br>

		</form>

		<style type="text/css">
			

body {

  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-image: url(images/layout_img/login_image.jpg);
    background-size: cover;
}

.container {
  width: 500px;
  padding: 20px;
  background-color: #a2f5e1;
  border-radius: 15px;
  box-shadow: 0 0 30px 10px rgba(0, 0, 0, 0.2);
}
h2{
  text-align: center; 
  color: black;
  font-family: Algerian;
}
h4{
  text-align: center; 
  color: black;
  font-family: Lucida Calligraphy;
}

.form-group {
  margin-bottom: 10px;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 14px;
  font-family: Candara;
  background: transparent;
}

.form-control:focus {
  border-color: #000;
  outline: none;
}

.btn {
  background-color: #000;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  transition: 0.3s;

  &:hover {
    background: linear-gradient(to top right,#d5f0dc,#83b8d4,#6d76c2,#cf515b);
  }
}
.form-btn a {
	font-family: Candara;
	font-weight: bolder;
	font-size: 20px;
  text-decoration: none;
  color: black;
  
}

.login-form {
  margin-top: 30px;
}


		</style>
		

	</div>

</body>
</html>
