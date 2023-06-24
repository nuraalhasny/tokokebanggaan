<?php
    require_once 'config.php';
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if (isset($_REQUEST['submit'])) {
    $id = $_REQUEST['id'];
    $product = $_REQUEST['product'];
    $detail = $_REQUEST['detail'];
    $purchase_price = $_REQUEST['purchase_price'];
    $stok = $_REQUEST['stok'];
    $target_file = TARGET_DIR . basename($_FILES["images"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)){
      
    }
        $sql = "UPDATE products SET product='$product', detail='$detail', purchase_price='$purchase_price', stok='$stok'";
        if ($target_file != TARGET_DIR) $sql .= ", images='$target_file'";
        $sql .= "WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>alert('sukses update data');</script>";
            header("location: products.php");
        } else {
            echo "ERROR: Could not able to execute $sql. " 
                                    . mysqli_error($conn);
        } 
        mysqli_close($conn);
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

	<title>Lightsome</title>

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
      <?php
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $result = $conn->query("SELECT * FROM products WHERE id = '$id'");
                while ($item = $result->fetch_assoc()) {

                    

        ?>

      <p><span style="color: red;">*</span>image</p>
      <div class="input-group mb-3">
        <input type="file" name="images" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02"></label>
      </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Product</label>
          <input type="text" name="product" class="form-control" value="<?php echo $item ['product']?>">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Price</label>
          <input type="text" name="purchase_price" class="form-control" value="<?php echo $item ['purchase_price']?>">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>stok</label>
          <input type="text" name="stok" class="form-control" value="<?php echo $item ['stok']?>">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword1" class="form-label"><span style="color: red;">*</span>Detail</label>
          <input type="text" name="detail" class="form-control" value="<?php echo $item['detail']?>">
        </div>

        <div class="py-4">
          <button  type="submit" name="submit" class="btn btn-primary"> save</button>
          <button class="btn btn-danger">cancle</button>
        </div>
        <?php
                }
            }
        ?>
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