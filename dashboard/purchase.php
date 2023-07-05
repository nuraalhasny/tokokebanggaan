<?php
  require_once 'config.php';
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

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

    
      <!-- partial -->

      <div class="page-content">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Purchases</h6>
                <p class="text-muted mb-3"><a href="index.html">Dashboard</a> <code>Purchase</code></p>
                <div class="table-responsive pt-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Purchase Date</th>
                        <th>User</th>
                        <th>Courier</th>
                        <th>Services</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Fraud Status</th>
                        <th>Type</th>
                        <th>Order Status</th>
                        <th>Detail</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                        $result = $conn->query("SELECT *, (
                          SELECT username FROM users WHERE users.id = invoices.user_id
                        ) AS user_name, 
                        payments.status AS payment_status, 
                        invoices.status AS order_status, 
                        invoices.id AS invoices_id
                        FROM invoices 
                        INNER JOIN payments ON invoices.id = payments.invoice_id");
                        $i = 1;
                        while ($item = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item['order_id']; ?></td>
                        <td><?php echo date('d, M Y', strtotime($item['purchase_date'])); ?></td>
                        <td><?php echo $item['user_name']; ?></td>
                        <td><?php echo strtoupper($item['courier']); ?></td>
                        <td><?php echo $item['service']; ?></td>
                        <td>Rp.<?php echo number_format($item['total'], 0, '', '.'); ?></td>
                        <td><?php echo strtoupper($item['payment_status']); ?></td>
                        <td><?php echo strtoupper($item['fraud_status'] ?? '-'); ?></td>
                        <td><?php echo strtoupper($item['type'] ?? '-'); ?></td>
                        <td>
                          <form action="change-status.php" method="POST" id="form-<?php echo $item['id']; ?>">
                            <input type="hidden" name="id" value="<?php echo $item['invoices_id']; ?>">
                            <select name="order_status" onchange="document.querySelector('#form-<?php echo $item['id']; ?>').submit()">
                              <option value="Waiting Confirmation" <?php echo $item['order_status'] == 'Waiting Confirmation' ? 'selected="true"' : '' ?> disabled>Waiting Confirmation</option>
                              <option value="Order confirmed" <?php echo $item['order_status'] == 'Order Confirmed' ? 'selected="true"' : '' ?> >Order Confirmed</option>
                              <option value="Picked by courier" <?php echo $item['order_status'] == 'Picked by courier' ? 'selected="true"' : '' ?>>Picked by courier</option>
                              <option value="On the way" <?php echo $item['order_status'] == 'On the way' ? 'selected="true"' : '' ?>>On the way</option>
                              <option value="Ready for pickup" <?php echo $item['order_status'] == 'Ready for pickup' ? 'selected="true"' : '' ?>>Ready for pickup</option>
                            </select>
                          </form>
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary" onclick="openModal('#detailInvoice-<?php echo $i; ?>')">
                            Detail
                          </button>
                        </td>
                      </tr>
                      
                      <?php $i++; } ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>




        <!-- partial:../../partials/_footer.html -->
        
        <!-- partial -->

      </div>
    </div>
    
    <?php
      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
      $result = $conn->query("SELECT *, (
        SELECT username FROM users WHERE users.id = invoices.user_id
      ) AS user_name
      FROM invoices 
      INNER JOIN payments ON invoices.id = payments.invoice_id");
      $i = 1;
      while ($item = $result->fetch_assoc()) {
    ?>
      <div class="modal fade" id="detailInvoice-<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="detailInvoiceLabel-<?php echo $i; ?>"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailInvoiceLabel-<?php echo $i; ?>">Detail Invoice - <?php echo $item['order_id']; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal('#detailInvoice-<?php echo $i; ?>')">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Order Id : <?php echo $item['order_id']; ?></p>
              <p>Courier : <?php echo strtoupper($item['courier']); ?></p>
              <p>Address : <?php echo $item['address']; ?></p>
              <p>Grand Total : Rp.<?php echo number_format($item['total'], 0, '', '.'); ?></p>

              <table class="table table-bordered mt-2">
                <thead>
                  <tr>
                    <td>Image</td>
                    <td>Product Name</td>
                    <td>Size</td>
                    <td>Qty</td>
                    <td>Total</td>
                  </tr>
                </thead>
                <tbody>
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
                    FROM product_checkouts WHERE invoice_id = '".$item['id']."'");
                    while ($productItem = $resultProduct->fetch_assoc()){
                  ?>
                    <tr>
                      <td>
                        <img src="<?php echo $productItem['image']; ?>" alt="">
                      </td>
                      <td><?php echo $productItem['product'];?></td>
                      <td><?php echo $productItem['size'];?></td>
                      <td><?php echo $productItem['qty'];?></td>
                      <td>Rp.<?php echo number_format($productItem['total'], 0, '', '.');?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal('#detailInvoice-<?php echo $i; ?>')">Close</button>
            </div>
          </div>
        </div>
      </div>
    <?php $i++; } ?>
    <?php require_once("assets/componen/footer.php") ?>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <script src="/assets/js/helper.js"></script>

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