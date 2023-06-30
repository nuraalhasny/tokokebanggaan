<?php
require_once 'config.php';

              if(count($_POST) > 0){ 
                
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                
                if ($conn->connect_error){
                  die("Connection failed: " . $conn->connect_error);
                }
                
                $product = $_POST['product'];
                $purchase_price = $_POST['purchase_price'];
                $detail = $_POST['detail'];
                $stok = $_POST['stok'];
                $sql = "INSERT INTO products (product, purchase_price, detail, stok) VALUES ('$product', '$purchase_price', '$detail', '$stok')";
                $conn->query($sql);
                $last_id = $conn->insert_id;

                $files = [];

                foreach ($_FILES['images'] as $key => $value) {
                  foreach ($value as $childKey => $value) {
                    $files[$childKey][$key] = $value;
                  }
                }

                foreach ($files as $key => $value) {
                  $target_file = TARGET_DIR . basename($value["name"]);
                  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                  if (move_uploaded_file($value["tmp_name"], $target_file)){
                    echo "the file".htmlspecialchars(basename($value["name"]));
                  }
                  
                  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                  if ($conn->connect_error){
                    die("Connection failed: " . $conn->connect_error);
                  }
                  $sql = "INSERT INTO images (product_id, url) VALUES ('$last_id', '$target_file')";
                  $conn->query($sql);
                }
                
                if ($result -> num_rows <= 0) {
                    header('location: products.php');
                }
                
                $conn->close();
              }
    
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

	<title>qbeauty</title>

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
	<link rel="stylesheet" href="assets/styles/stylee.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="../../../assets/images/favicon.png" />
</head>
<body>
	

		<!-- partial -->

      

<div class="edit-section">
        <div class="container">
          <div class="title">
            <h4 class="text-center">Insert Product</h4>
          </div>
      <form name="form1" method="post" enctype="multipart/form-data">
      <p><span style="color: red;">*</span>Image</p>
      <div class="input-group mb-3">
        <input type="file" name="images[]" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02"></label>
      </div>
      <div class="input-group mb-3">
        <input type="file" name="images[]" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02"></label>
      </div>
      <div class="input-group mb-3">
        <input type="file" name="images[]" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02"></label>
      </div>
      <div class="input-group mb-3">
        <input type="file" name="images[]" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02"></label>
      </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Product</label>
          <input type="text" name="product" class="form-control" value="">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Price</label>
          <input type="number" name="purchase_price" class="form-control" value="">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>stok</label>
          <input type="number" name="stok" class="form-control" value="">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Detail</label>
          <input type="text" name="detail" class="form-control">
        </div>

        <div class="py-4">
          <button  type="submit" name="submit" class="btn btn-primary"> save</button>
          <button class="btn btn-danger">cancle</button>
        </div>
      </form>
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