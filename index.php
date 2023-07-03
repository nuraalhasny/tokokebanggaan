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
    <section class="main-banner">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active text-center">
                <img src="assets/img/young-woman-beautiful-red-dress-removebg-preview.png" class="img" alt="">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Daster Super Nyaman</h5>
                  <p>Daster ternyaman dengan harga terjangkau</p>
                </div>
              </div>
              <div class="carousel-item text-center">
                <img src="assets/img/young-woman-beautiful-red-dress-removebg-preview.png" class="img" alt="">
                <div class="carousel-caption d-none d-md-block">
                <h5>Daster Super Murah</h5>
                  <p>Daster ternyaman dengan harga terjangkau</p>
                </div>
              </div>
              
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>

   
    <section>
        <div class="treatment-section">
            <div class="container">
                <div class="treatment-text">
                    <h2>Categories of The Month<h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="banner-img">
                        <img src="assets/img/hnm-card.jpg" class="hnm-card" >

                    </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="banner-img">
                        <img src="assets/img/hnm-card.jpg" class="hnm-card" >

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product">
        <div class="header text-center">
            <h2>FEATURES PRODUCT</h2>
            </div>
        <div class="text-end">
            <a href="product.php">View All</a>
        </div>

        <div class="row">
            <?php


            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            $result = $conn -> query ("SELECT *, (SELECT url FROM images WHERE product_id = products.id LIMIT 1 ) AS image FROM products");
            while ($item = $result->fetch_assoc()){
            ?>
            <div class="col-md-3 ">
                <div class="product-grid">
                    <div class="product-image">
                        <a>
                            <img class="img-img" src="<?php echo FILE_PATH.$item['image']?>">
                        </a>
                        <ul class="product-links">
                            <li><a href="#"><i class="bi bi-cart"></i></a></li>
                            <li><a href="detail-product.php?id=<?php echo $item['id'];?>"><i class="bi bi-eye"></i></a></li>
                            
                        </ul>
                    </div>
                    <div class="product-content">
                        <div class="price">Rp.<?php echo  $item['purchase_price']?></div>
                        <h3 class="title"><a href="#"><?php echo $item['product']?></a></h3>
                        
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        </section>
    <?php require_once("assets/components/footer.php") ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
</body>
</html>
