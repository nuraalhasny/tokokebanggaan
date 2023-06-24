<?php
    require_once 'config.php';
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM products WHERE id = $id";
        $query = mysqli_query($conn, $sql);
      }
    
      if ($result -> num_rows <= 0) {
        header('location: products.php');
    }
    
    $conn->close();
      

    ?>
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