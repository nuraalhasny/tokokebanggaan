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
    <?php require_once("assets/components/banner.php")?>
  
    <section class="contact">
        <div class="container">
            <div class="contact-wrap">
                <div class="contact-form">
                    <div class="row">
                       <form name="contact" method="post">
                       <div class="col-lg-8 col-sm-6">
                            <div class="form-group">
                                <p><i class="bi bi-person"></i> Name</p>
                                <input type="text" name="nama" id="name" class="form-control"
                                    placeholder="Please enter your name">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6">
                            <div class="form-group">
                                <p><i class="bi bi-person"></i> E-mail</p>
                                <input type="email" name="email" id="name" class="form-control"
                                    placeholder="Please enter your email">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6">
                            <div class="form-group">
                                <p><i class="bi bi-telephone"></i> phone</p>
                                <input type="text" name="phone" id="name" class="form-control"
                                    placeholder="Please enter your phone number">
                            </div>
                        </div>
                       
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <p><i class="bi bi-envelope"></i> Message</p>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="8"
                                    placeholder="Your message"></textarea>
                            </div>
                        </div>
                        <button class="btn" type="submit">Send</button>
                       </form>
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    <div id="googleMap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4878844131!2d106.68942906412296!3d-6.229728025430837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1666154341866!5m2!1sid!2sid"></iframe>
    </div>
</div>
    <footer>
        <div class="container">
            <div class="top-footer">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget-about">
                            <h2>About us</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                                numquam </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget-contact">
                            <ul class="contact-add">
                                <li>
                                    <div class="contact-info">
                                        <img src="assets/img/telephone.png">
                                        <div class="contact-tt">
                                            <h4>Call</h4>
                                            <span>+6285775030175</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-info">
                                        <img src="assets/img/time.png">
                                        <div class="contact-tt">
                                            <h4>Time</h4>
                                            <span>mon-sun</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact-info">
                                        <img src="assets/img/address.png">
                                        <div class="contact-tt">
                                            <h4>Address</h4>
                                            <span>Jakarta Barat </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget-links">
                            <h3 class="widget-title">Quick Links</h3>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">Treatment</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget widget-iframe">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4878844131!2d106.68942906412296!3d-6.229728025430837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1666154341866!5m2!1sid!2sid"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="bottom-footer">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <p>© 2022 Copyright Qbeauty All Rights Reserved </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <ul class="social-links">
                                    <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                                    <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                                    <li><a href="#"><i class="bi bi-envelope"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>