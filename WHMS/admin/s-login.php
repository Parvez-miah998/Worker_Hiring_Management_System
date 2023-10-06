<?php
session_start();
if (isset($_SESSION["supervisors"])) {
    header("Location: assign-request-s.php");
}

error_reporting(0);

include('includes/dbconnection.php');

if (isset($_POST['login'])) {

      $email = $_POST['email'];
      $password = $_POST['password'];

      require_once 'includes/dbconnection.php';

      $sql = "SELECT * FROM supervisor WHERE email = :email";
      $stmt = $dbh->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);


      if ($user) {

        $hashedPassword = $user["password"];
        if (password_verify($password, $hashedPassword)) {
          session_start();
          $_SESSION["supervisors"] = "yes";
          $_SESSION["supervisors"] = $email;
          header('Location: assign-request-s.php');
          die();
        }
        else {
          echo '<div class="alert alert-danger" style = " max-width: 600px; margin: 0 auto; padding: 0px;border-radius: 5px; text-align: center; color: yellow;font-size:25px">Invalid email or password</div>';
        }
      } 
      else {
        echo '<div class="alert alert-danger" style = " max-width: 600px; margin: 0 auto; padding: 0px;border-radius: 5px; text-align: center; color: blue;font-size:25px">Email Does Not Exist !</div>';
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Worker Hiring Management System || Supervisor Login Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body style=" padding: 50px; background-image: url(images/layout_img/login_image.jpg); background-size: cover">
   <div class="container" style=" max-width: 600px; margin: 0 auto; padding: 50px;border-radius: 15px;">

    <h3 style=" text-align: center; color: black;font-family: Algerian">Worker Hiring Management System</h3>
    <h3 style="text-align: center; color: black;font-family: Lucida Calligraphy">Supervisor Login</h3> <br>

    <form action="s-login.php" method="post">
      <div class="form-group">
        <input type="email" placeholder="Enter Email or UserName" name="email" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" placeholder="Enter Password" name="password" class="form-control">
      </div>
      <div class="form-btn">
        <input type="submit" value ="Login" name="login" class="btn btn-primary">
      </div>
      <br>
      
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
  font-size: 20px;
  text-decoration: none;
  color: #1938e6;
}

.login-form {
  margin-top: 30px;
}

.already-have-account {
  text-align: right;
  color: white;
  font-size: 20px;
}
    </style>

</body>
</html>