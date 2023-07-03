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
    
<?php require_once("assets/components/banner.php")?>

    <section class="product">
        <div class="row">
            <?php


                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $result = $conn -> query ("SELECT *, (SELECT url FROM images WHERE product_id = products.id LIMIT 1 ) AS image FROM products WHERE stok > 0");
                while ($item = $result->fetch_assoc()){
                ?>
            <div class="col-md-3 col-sm-6">
                <div class="product-grid">

                    <div class="product-image">
                        <a>
                            <img class="img-fluid" src="<?php echo FILE_PATH. $item ['image']?>">
                        </a>
                        <ul class="product-links">
                            <li><a href="#"><i class="bi bi-cart"></i></a></li>
                            <li><a href="detail-product.php?id=<?php echo $item['id']; ?>"><i class="bi bi-eye"></i></a></li>
                        </ul>
                    </div>
                    <div class="product-content">
                        <h3 class="price">Rp. <?php echo $item ['purchase_price']?></h3>
                        <h3 class="title"><?php echo $item ['product']?></h3>

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