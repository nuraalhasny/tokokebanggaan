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
			<?php
				$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
				$user_id = $_SESSION['user_id'];
				$result = $conn->query("SELECT *, (
					SELECT username FROM users WHERE users.id = invoices.user_id
				) AS user_name, 
				payments.status AS payment_status, 
				invoices.status AS order_status,
				invoices.id AS invoice_id
				FROM invoices 
				INNER JOIN payments ON invoices.id = payments.invoice_id
				INNER JOIN users ON users.id = invoices.user_id
				WHERE invoices.user_id = '$user_id'");
				$i = 1;
				while ($item = $result->fetch_assoc()) {
			?>
				<div class="card-body">
					<h6>Order ID: <?php echo $item['order_id']; ?></h6>
					<article class="card">
						<div class="card-body row">
							<div class="col"> <strong>Shipping BY:</strong> <br> <?php echo strtoupper($item['courier']); ?> | <i class="fa fa-phone"></i> <?php echo $item['phone_number'] ?> </div>
							<div class="col"> <strong>Status:</strong> <br> <?php echo $item['order_status']; ?></div>
						</div>
					</article>
					<div class="track">
						<div class="step <?php 
							if ($item['order_status'] != 'Waiting Confirmation') {
								echo 'active';
							}
						?>"> <span class="icon"> <i class="bi bi-check-lg"></i></span> <span class="text">Order confirmed</span> </div>
						<div class="step <?php 
							if (!in_array($item['order_status'], ['Waiting Confirmation', 'Order confirmed'])) {
								echo 'active';
							}
						?>"> <span class="icon"> <i class="bi bi-person-fill"></i> </span> <span class="text"> Picked by courier</span> </div>
						<div class="step <?php 
							if (!in_array($item['order_status'], ['Waiting Confirmation', 'Order confirmed', 'Picked by courier'])) {
								echo 'active';
							}
						?>"> <span class="icon"><i class="bi bi-truck"></i> </span> <span class="text"> On the way </span> </div>
						<div class="step <?php 
							if ($item['order_status'] == 'Ready for pickup') {
								echo 'active';
							}
						?>"> <span class="icon"> <i class="bi bi-box"></i> </span> <span class="text">Ready for pickup</span> </div>
					</div>
					<hr>
					<ul class="row">
					<?php
						$connProduct = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
						$resultProduct = $connProduct -> query ("
						SELECT *, (
						SELECT product FROM products WHERE products.id = product_checkouts.product_id LIMIT 1
						) AS product, (
						SELECT url FROM images WHERE product_id = product_checkouts.product_id LIMIT 1 
						) AS image, (
						SELECT nama FROM sizes WHERE sizes.id = product_checkouts.size_id LIMIT 1
						) AS size
						FROM product_checkouts WHERE invoice_id = '".$item['invoice_id']."'");
						while ($productItem = $resultProduct->fetch_assoc()){
					?>
						<li class="col-md-4">
							<figure class="itemside mb-3">
								<div class="aside"><img src="<?php echo 'dashboard/'.$productItem['image']; ?>" class="img-fluid "></div>
								<figcaption class="info align-self-center">
									<p class="title"><?php echo $productItem['product'];?><br></p> 
									<span class="text-muted">Rp.<?php echo number_format($productItem['total'], 0, '', '.');?><br></span>
									<p>Size: <?php echo $productItem['size'];?></p>
								</figcaption>
							</figure>
						</li>
					<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</article>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
 <script src="assets/js/addtocart.js"></script>
</body>
</html>
