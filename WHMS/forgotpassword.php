<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $errors = array();

    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        array_push($errors, "All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format.");
    }

    if (strlen($newPassword) < 6) {
        array_push($errors, "Password should be at least 6 characters long.");
    }

    if ($newPassword !== $confirmPassword) {
        array_push($errors, "Password confirmation does not match.");
    }

    if (count($errors) === 0) {
        require_once "includes/dbconnection.php";

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password = :password WHERE email = :email";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            echo "<div class='alert alert-success'>Password has been changed successfully.</div>";
        } else {
            echo "<div class='alert alert-danger'>User not found.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Hiring Management System || Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3>Worker Hiring Management System</h3>
        <h4>Forgot Password</h4><br>

        <form action="forgotpassword.php" method="POST">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="new_password" placeholder="New Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Save Password">
            </div>
        </form>
        <div class="form-btn">
            <a href="index.php">Back to Login</a>
        </div><br>

        <style type="text/css">
            
body {

  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-image: url(admin/images/layout_img/login_image.jpg);
    background-size: cover;
}

.container {
  width: 500px;
  padding: 20px;
  background-color: #c1e6cc;
  border-radius: 15px;
  box-shadow: 0 0 30px 10px rgba(0, 0, 0, 0.2);
}
h3{
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
}black
        </style>


    </div>
</body>
</html>

