<?php
require_once 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Qbeauty</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shelly - Website" />
    <meta name="author" content="merkulove">
    <meta name="keywords" content="" />
    <link rel="icon" href="assets/img/Pink Typography Inisial Nama NK Logo (1).png">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">



</head>

<body>
    <?php require_once('assets/components/header.php'); ?>

    <section class="sproduct">
        <div class="container">
        <form action="addtocart.php">
            <div class="row  py-3 py-md-5">
                <?php

                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $id = $_REQUEST['id'];
                $result = $conn->query("SELECT *, (SELECT nama FROM colors WHERE id = color_id) AS color_nama FROM products WHERE id = '$id'");
               
                $conn_size = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $result_sizes = $conn_size->query("SELECT * FROM sizes ");
                $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $images = $conn->query("SELECT * FROM images WHERE product_id = '$id'");
                $i = 0;
                while ($item = $result->fetch_assoc()) {

                    ?>
                    <div class="col-md-5">
                        <div class="detail-img">
                            <?php while ($image = $images->fetch_assoc()) {
                                if ($i == 0) { ?>
                                    <img src="<?php echo FILE_PATH . $image['url'] ?>" id="myimg" class="img-fluid pb-1">
                                    <div class="small-img-group d-flex justify-content-between">
                                    <?php } ?>
                                    <div class="small-img-col ">
                                        <img src="<?php echo FILE_PATH . $image['url'] ?>" alt="" class="small-img pb-1"
                                            width="100px">
                                    </div>
                                    <?php $i++;
                            } ?>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 offset-md-1">


                        <div class="product-headline" id="item">
                            <h6>Home /<span> Product </span></h6>
                            <h3 class="text-black-1">
                                <?php echo $item['product'] ?>
                            </h3>
                            <hr>
                            <h6 class="price">
                                Rp.
                                <?php echo $item['purchase_price'] ?>
                            </h6>

                            <h5 class="mt-4 mb-3">Product Details</h5>
                            <p>
                                <?php echo $item['detail'] ?>
                            </p>
                            <h6 class="stok">
                                Stok :
                                <?php echo $item['stok'] ?>
                            </h6>

                            <h6 class="stok">
                                Warna :
                                <?php 
                                    echo $item['color_nama'].' ';
                                
                                    ?>
                            </h6>
                                
                            <hr>

                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <h6>Size</h6>
                                    <select name="size" class="form-select">
                                        <?php
                                        while ($item_size = $result_sizes->fetch_assoc()) 
                                        {
                                            ?>
    
                                            <option value="<?php echo $item_size['id']?>"><?php echo $item_size['nama']?></option>
                                        
                                        <?php
                                        }
                                        
                                        ?>  
                                        
                                        
                                    </select>
                                </div>
                                <div class="col-md-4 p-3">
                                        <input name="id" type="hidden" value="<?php echo $item['id']; ?>">
                                        <button class="shop-btn" type="submit">Add To Cart</button>
                                    </div>
                            </div>
                            
                        </div>
                        <?php
                            }
                        ?>
                </div>
            </div>
        </form>
    </section>
    <section class="product">
        <div class="header text-center">
            <h2>You May also Like</h2>
        </div>
        <div class="row">
            <?php



            $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
            $result = $conn->query("SELECT *, (SELECT url FROM images WHERE product_id = products.id LIMIT 1 ) AS image FROM products");
            while ($item = $result->fetch_assoc()) {
                ?>
                <div class="col-md-3 ">
                    <div class="product-grid">
                        <div class="product-image">

                            <img class="img-img" src="<?php echo FILE_PATH . $item['image'] ?>">
                            </a>
                            <ul class="product-links">
                                <li><a href="#"><i class="bi bi-cart"></i></a></li>
                                <li><a href="detail-product.php?id=<?php echo $item['id']; ?>"><i class="bi bi-eye"></i></a>
                                </li>

                            </ul>
                        </div>
                        <div class="product-content">
                            <div class="price">
                                <?php echo $item['purchase_price'] ?>
                            </div>
                            <h3 class="title"><a href="#">
                                    <?php echo $item['product'] ?>
                                </a></h3>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>

    <?php require_once('assets/components/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/addtocart.js"></script>
    <script>
        const handleQtyChange = (value, price) => {
            const total = value * price;
            document.querySelector('#price').innerText = `Rp. ${total}`;
        }
    </script>

</body>

</html>