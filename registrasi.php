<?php
require_once 'config.php';

if(isset($_POST['submit'])){
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $password = password_hash($password, PASSWORD_DEFAULT);
   
    $sql = "INSERT INTO users VALUES('', '$email', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script> 
        alert('New record created successfully')
        </script>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nur Aisyah</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Shelly - Website" />
	<meta name="author" content="merkulove">
	<meta name="keywords" content="" />
    <link rel="icon" href="assets/img/Black White Minimalist Aesthetic Letter Initial Name Monogram Logo.png">
	<link rel="stylesheet" type="text/css" href="assets/styles/style.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="content-user">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="login-title">
                        <span>Nur Aisyah Store</span>
                        <h4>Dress as good as you like</h4>
                    </div>
                </div>
                <div class="col-md-5 contents" >
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h2>Sign Up</h2>
                                <p class="mb-4">Create your Account</p>

                            </div>
                            <form action="" method="post">
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="align-items-center justify-content-between">
                                   
                                
                                    
                                <p>Already have an account? <a href="login.php" class="link-info">Log In here</a></p>
                                </div>
                                <input type="submit" value="Sign In" name="submit" class="btn btn-block btn-primary">
                            </form>

                            <div class=" justify-content-center text-center p-4">
                                <p>or sign up with: </p>
                                <ul class="links">
                                <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                <li><a href="#"><i class="bi bi-google"></i></a></li>
                                <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                                </ul>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
</body>

</html>