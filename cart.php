<!-- Check Is Login -->
<?php 
  require_once 'config.php';
  session_start();

  if(!isset($_SESSION['username'])) {
      $_SESSION['message'] = 'Login Dulu Untuk Melanjutkan';
      header('location: login.php');
  }
?>

<!-- Count Total -->
<?php
$total = 0;
$items = $_SESSION['items'] ?? null;
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

foreach($items as $item) {
    $result = $conn->query("SELECT *, (
      SELECT nama FROM colors WHERE colors.id = color_id
    ) AS color_name, (
      SELECT nama FROM sizes WHERE id = ".$item['size']."
    ) AS size, (
      SELECT url FROM images WHERE product_id = products.id ORDER BY id LIMIT 1
    ) AS image
    FROM products WHERE id = '".$item['id']."'");

    while ($childItem = $result->fetch_assoc()) { 
        $total += $item['qty'] * $childItem['purchase_price'];
    }
} ?>


<!-- Midtrans Setup -->
<?php

require_once dirname(__FILE__) . '/midtrans-config.php';
require_once dirname(__FILE__) . '/midtrans/Midtrans.php';

if ($total > 0 && isset($_SESSION['shipping']['price'])) {
  try {
      // Set your Merchant Server Key
      \Midtrans\Config::$serverKey = MT_SERVER_KEY;
      // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
      \Midtrans\Config::$isProduction = false;
      // Set sanitization on (default)
      \Midtrans\Config::$isSanitized = true;
      // Set 3DS transaction for credit card to true
      \Midtrans\Config::$is3ds = true;
  
      $username = $_SESSION['username'];
      $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
      
      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      $result = $conn -> query ($sql);

      $grand_total = $total + $_SESSION['shipping']['price'];
  
      while($row = $result -> fetch_assoc()){
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $grand_total,
            ),
            'customer_details' => array(
                'first_name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone_number'],
            ),
        );
    
        $snapToken = \Midtrans\Snap::getSnapToken($params);
      }
  
  } catch (\Throwable $th) {
      print_r($th);
      die;
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="<?php echo MT_CLIENT_KEY ?>"></script>
  <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    
	
</head>
<body>
<?php require_once("assets/components/header.php") ?> 
      <main class="page">
        <section class="shopping-cart ">
          <div class="container">
              <div class="block-heading">
                <h4>SHOPPING CART</h4>
              </div>
              <div class="content">
                <?php if ($total > 0) { ?>
                  <div class="row">
                    <div class="col-md-12 col-lg-8">
                      <div class="items">
                        <div class="product">
                          <div class="row">
                            <?php
                              require_once 'config.php';
                              $items = $_SESSION['items'] ?? null;
                              $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                              foreach($items as $item) {
                                $result = $conn->query("SELECT *, (
                                  SELECT nama FROM colors WHERE colors.id = color_id
                                ) AS color_name, (
                                  SELECT nama FROM sizes WHERE id = ".$item['size']."
                                ) AS size, (
                                  SELECT url FROM images WHERE product_id = products.id ORDER BY id LIMIT 1
                                ) AS image
                                FROM products WHERE id = '".$item['id']."'");
                                  while ($childItem = $result->fetch_assoc()) { ?>
                                    <div class="col-md-3 mb-4">
                                      <img class="img-fluid mx-auto d-block image" src="dashboard/<?php echo $childItem['image'];?>">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="info">
                                        <div class="row">
                                          <div class="col-md-4 product-name">
                                            <div class="product-name">
                                              <a href="#"><?php echo $childItem['product']; ?></a>
                                              <div class="product-info">
                                                <div>Warna: <span class="value"><?php echo $childItem['color_name']; ?></span></div>
                                                <div>Ukuran: <span class="value"><?php echo $childItem['size']; ?></span></div>
                                                <div>Stok: <span class="value"><?php echo $item['qty'] ?></span></div>
                                              </div>
                                            </div>
                                          </div>
                                          <form class="col-md-3" action="changeqtyproduct.php" id="change-qty-product-<?php echo $childItem['id']; ?>">
                                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                            <div class="quantity">
                                              <label for="quantity">Quantity:</label>
                                              <input id="quantity" name="qty" type="number" onchange="document.querySelector('#change-qty-product-<?php echo $childItem['id']; ?>').submit();" value="<?php echo $item['qty'] ?>" min="1" class="form-control quantity-input">
                                            </div>
                                          </form>
                                          <div class="col-md-3 price">
                                            <span>Rp.<?php echo ($item['qty'] * $childItem['purchase_price'])?></span>
                                          </div>
                                          <form class="col-md-2" action="removetocart.php" id="remove-to-cart-<?php echo $childItem['id'] ?>">
                                              <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                              <div class="remove" style="cursor: pointer;" onclick="document.querySelector('#remove-to-cart-<?php echo $childItem['id'] ?>').submit();">
                                                <i class="bi bi-x-lg"></i>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                            <?php
                              }}
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
<<<<<<< HEAD
                  </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="summary">
                      <h3>Summary</h3>
                      <div class="summary-item"><span class="text">Subtotal</span><span class="price">Rp.<?php echo $total;?></span></div>
                      <div class="summary-item"><span class="text">Shipping</span><span class="price">Rp.15000</span></div>
                      <div class="summary-price"><span class="text">Total</span><span class="total-price"> Rp. <?php echo $total;?></span></div>
                      <button type="button" class="btn-purchase" id="checkout">Checkout</button>
=======
                    <div class="col-md-12 col-lg-4">
                        <div class="summary">
                          <?php if(isset($_SESSION['shipping'])) { ?>
                            <h3>Summary</h3>
                            <div class="summary-item"><span class="text">Subtotal</span><span class="price">Rp.<?php echo $total;?></span></div>
                            <div class="summary-item"><span class="text">Shipping</span><span class="price">Rp.<?php echo $_SESSION['shipping']['price'] ?? 0 ?></span></div>
                            <div class="summary-price"><span class="text">Total</span><span class="total-price"> Rp. <?php echo $total+$_SESSION['shipping']['price'];?></span></div>
                            <button type="button" class="btn-purchase btn-primary btn-lg btn-block" id="checkout">Checkout</button>
                          <?php } else { ?>
                            <form action="/shipping/shipping.php" method="POST">
                              <h3>Shipping</h3>
                              <label for="prov_id">Provinsi</label>
                              <br>
                              <select class="js-example-basic-single" name="prov_id" id="prov_id" required>
                                <option value="" disabled>Pilih Provinsi Kamu</option>
                              </select>
                              <br><br>
                              <label for="city_id">Kota</label>
                              <br>
                              <select class="js-example-basic-single" name="city_id" id="city_id" required>
                                <option value="" disabled>Pilih Kota Kamu</option>
                              </select>
                              
                              <br><br>
                              <label for="city_id">Ekspedisi</label>
                              <br>
                              <select name="courier" id="courier" required>
                                <option value="" disabled>Pilih Ekspedisi Kamu</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS Indonesia</option>
                              </select>
                              
                              <br><br>
                              <label for="service">Service</label>
                              <br>
                              <select name="service" id="service" required>
                                <option value="" disabled>Pilih Service Kamu</option>
                              </select>
                              <br><br>
                              <label for="address">Alamat</label>
                              <textarea class="mt-2" name="address" id="address" cols="30" rows="10" required></textarea>
                              <button class="btn btn-primary" id="submit" disabled>Submit</button>
                            </form>
                          <?php } ?>
                        </div>
>>>>>>> 092305e0a27b087832c219a10e2cbc41e2e2d43d
                    </div>
                  </div> 
                <?php } else { ?>
                  <div class="row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                      <h3>Yahh! Kamu Belum Memiliki Barang Di Keranjangmu</h3>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-2">
                      <a href="product.php">
                        <button class="btn btn-primary">Yuk Belanja!</button>
                      </a>
                    </div>
                  </div>
                <?php } ?>
              </div>
          </div>
       </section>
     </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/addtocart.js"></script>
  <script type="text/javascript">
      const checkoutButton = document.getElementById('checkout');
      if (checkoutButton) {
        checkoutButton.addEventListener('click', function () {
            window.snap.pay('<?php echo $snapToken; ?>');
        });
      }
  </script>
  <script src="assets/js/helper.js"></script>
  <script src="assets/js/shipping.js"></script>

</body>
</html>
