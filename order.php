<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nur Aisyah</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
	<div class="container">
		<article class="card">
			<header class="card-header"> My Orders / Tracking </header>
			<div class="card-body">
				<h6>Order ID: OD45345345435</h6>
				<article class="card">
					<div class="card-body row">
					<?php
                        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                        $result = $conn->query("SELECT *, (
                          SELECT username FROM users WHERE users.id = invoices.user_id
                        ) AS user_name, 
                        payments.status AS payment_status, 
                        invoices.status AS order_status
                        FROM invoices 
                        INNER JOIN payments ON invoices.id = payments.invoice_id");
                        $i = 1;
                        while ($item = $result->fetch_assoc()) {
                      ?>
						<div class="col"> <strong>Estimated Delivery time:</strong> <br>29 Mei 2023 </div>
						<div class="col"> <strong>Shipping BY:</strong> <br> Jnt, | <i class="fa fa-phone"></i> +628965337837 </div>
						<div class="col"> <strong>Status:</strong> <br> Picked by the courier </div>
						<div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
					</div>
					<?php
						}
						?>
				</article>
				<div class="track">
					<div class="step active"> <span class="icon"> <i class="bi bi-check-lg"></i></span> <span class="text">Order confirmed</span> </div>
					<div class="step active"> <span class="icon"> <i class="bi bi-person-fill"></i> </span> <span class="text"> Picked by courier</span> </div>
					<div class="step"> <span class="icon"><i class="bi bi-truck"></i> </span> <span class="text"> On the way </span> </div>
					<div class="step"> <span class="icon"> <i class="bi bi-box"></i> </span> <span class="text">Ready for pickup</span> </div>
				</div>
				<hr>
				<ul class="row">
					<li class="col-md-4">
						<figure class="itemside mb-3">
							<div class="aside"><img src="assets/img/bajju1.jpg" class="img-fluid "></div>
							<figcaption class="info align-self-center">
								<p class="title">V-neck Kaftan Dress <br></p> 
								<span class="text-muted">Rp.399000 <br></span>
								<p> Warna: Hijau <br></p>
								<p>Size: L</p>
							</figcaption>
						</figure>
					</li>
					<li class="col-md-4">
						<figure class="itemside mb-3">
							<div class="aside"><img src="assets/img/bajju1.jpg" class="img-fluid "></div>
							<figcaption class="info align-self-center">
								<p class="title">V-neck Kaftan Dress <br></p> 
								
								<span class="text-muted">Rp.399000 <br></span>
								<p> Warna: Hijau <br></p>
								<p>Size: L</p>
							</figcaption>
						</figure>
					</li>
					<li class="col-md-4">
						<figure class="itemside mb-3">
							<div class="aside"><img src="assets/img/bajju1.jpg" class="img-fluid "></div>
							<figcaption class="info align-self-center">
								<p class="title">V-neck Kaftan Dress <br></p>  
								<span class="text-muted">Rp.399000 <br></span>
								<p> Warna: Hijau <br></p>
								<p>Size: L</p>
							</figcaption>
						</figure>
					</li>
					
				
				</ul>
				<hr>
				<a href="product.php" class="btn btn-primary" > <i class="bi bi-arrow-left"></i> Back to orders</a>
			</div>
		</article>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
 <script src="assets/js/addtocart.js"></script>
</body>
</html>
