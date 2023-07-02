<?php
require_once 'config.php';

 if(count($_REQUEST) > 0){
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	if ($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	$nama = $_REQUEST['nama'];
    $phone =$_REQUEST['phone'];
	$email = $_REQUEST['email'];
	$message = $_REQUEST['message'];
	$sql = "INSERT INTO contacs (nama, phone,  email, message) VALUES ('$nama', '$phone', '$email', '$message')";

	if ($conn->query($sql) === TRUE){
		echo "New record created successfully";
	}else{
		echo "Error: " .$sql . "<br>" .$conn->error;
	}
	$conn->close();
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
    <?php require_once("assets/components/header.php") ?>
   <?php require_once("assets/components/second-header.php")?>
  
    <section class="contact">
        <div class="container">
            <div class="contact-wrap">
                <div class="contact-form">
                    <div class="row">
                        <form name="address" method="post">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <p>Name</p>
                                    <input type="text" name="nama" id="name" class="form-control"
                                        >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <p>Username</p>
                                    <input type="text" name="username" id="name" class="form-control"
                                        >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <p>Email</p>
                                    <input type="email" name="email" id="name" class="form-control"
                                        >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <p>Phone Number</p>
                                    <input type="text" name="number" id="name" class="form-control"
                                        >
                                </div>
                            </div>   
                        </form>
                    </div>
                    <button class="btn" type="submit"><a href="">Edit</a></button>
                </div>
            </div>
        </div>
    </section>
    <div id="googleMap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4878844131!2d106.68942906412296!3d-6.229728025430837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1666154341866!5m2!1sid!2sid"></iframe>
    </div>
</div>
   <?php require_once("assets/components/footer.php")?>
</body>

</html>