<?php
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Nur Aisyah</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	<!-- core:css -->
	<link rel="stylesheet" href="../../../assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="../../../assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="../../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->

  <!-- Layout styles -->  
	<link rel="stylesheet" href="assets/styles/style.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="../../../assets/images/favicon.png" />
</head>
<body>
<?php require_once("assets/componen/header.php") ?>
			<!-- partial -->

			<div class="page-content">
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h6 class="card-title">Products</h6>
								<p class="text-muted mb-3"><a href="index.html">Dashboard</a> <code>Product</code></p>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="insert.php"><button class="btn btn-primary me-md-2" type="button">+ Add New Brand</button></a>
                                </div>
								<div class="table-responsive pt-3">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
                        <th>Image</th>
												<th>Product</th>
												<th>Purchases Price</th>
                        <th>stok</th>
                        <th>Detail</th>
                        <th>Action</th>
											</tr>
										</thead>
                    
										<tbody>
                    <?php


                      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                      $result = $conn -> query ("SELECT *, (SELECT url FROM images WHERE product_id = products.id LIMIT 1 ) AS image FROM products");
                      while ($item = $result->fetch_assoc()){
                      ?>
                     <tr>
												<td><?php echo $item['id']; ?></td>
												<td>
                          <img src="<?php echo $item['image']; ?>" alt="">
                        </td>
												<td><?php echo $item['product'];?></td>
												<td><?php echo $item['purchase_price'];?></td>
                        <td><?php echo $item['stok'];?></td>
                        <td><?php echo $item['detail'];?></td>
                        <td><div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                            
                              <a class="dropdown-item d-flex align-items-center" href="edit.php?id=<?php echo $item['id'];?>"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                              <a class="dropdown-item d-flex align-items-center" href="delete.php?id=<?php echo $item['id'];?>"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>        
                                        
                            </div>
                          </div></td>
											</tr>
                        <?php
                        }
                        ?>
											
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
				</div>

				

				
			<!-- partial:../../partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
				<p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>.</p>
				
			</footer>
			<!-- partial -->
	
		</div>
	</div>

	<!-- core:js -->
	<script src="assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
  <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="assets/vendors/feather-icons/feather.min.js"></script>
	<script src="assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script src="assets/js/dashboard-light.js"></script>
	<!-- End custom js for this page -->


</body>
</html>