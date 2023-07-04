<div class="main-wrapper">

<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="index.php" class="sidebar-brand">
      Nur<span>Aisyah</span>
    </a>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="index.php" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
          aria-controls="uiComponents">
          <i class="link-icon" data-feather="feather"></i>
          <span class="link-title">Product management</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="uiComponents">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="products.php" class="nav-link">Product</a>
            </li>
            <li class="nav-item">
              <a href="product-color.php" class="nav-link">Brand</a>
            </li>
           

          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false"
          aria-controls="forms">
          <i class="link-icon" data-feather="inbox"></i>
          <span class="link-title">Purchases</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="forms">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="purchase.php" class="nav-link">Payment</a>
            </li>
            <li class="nav-item">
              <a href="purchasereturn.php" class="nav-link">Purchase Return</a>
            </li>
            

          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">Pages</li>

      
     
     
    </ul>
  </div>
</nav>

<!-- partial -->

<div class="page-wrapper">

  <!-- partial:../../partials/_navbar.html -->
  <nav class="navbar">
    <a href="#" class="sidebar-toggler">
      <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
    
      <ul class="navbar-nav">


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
          </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
              <div class="mb-3">
                <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
              </div>
              <div class="text-center">
              <?php


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$username = $_SESSION['username_admin'];


$result = $conn -> query ("SELECT * FROM user WHERE username = '$username'");

while ($item = $result->fetch_assoc()){
   
?>
                <p class="tx-16 fw-bolder"><?php echo $item['username'];?></p>
                <p class="tx-12 text-muted"><?php echo $item['email'];?></p>
              </div>
              <?php
              }
              ?>
            </div>
            <ul class="list-unstyled p-1">
              
              <li class="dropdown-item py-2">
                <a href="logout.php" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </nav>