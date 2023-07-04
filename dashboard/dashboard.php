<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shelly - Website" />
    <meta name="author" content="merkulove">
    <meta name="keywords" content="" />
    <link rel="icon" href="assets/img/Pink Typography Inisial Nama NK Logo (1).png">
    <link rel="stylesheet" type="text/css" href="assets/styles/stylee.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/responsive.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="icon" href="assets/images/icon.png">
    
</head>


<body>
    <section class="dashboard">
        <div class="container">
            


            <div class="row  align-items-center">
                <div class="col-lg-6">
                    <div class="dashboard-text-1">
                        <span>Nur Aisyah</span>
                        <h4>Dress as good as you like</h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dashboard-text-2 pb-3">
                        <h2>Log in</h2>
                    </div>
                    <form action="verif.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1">
                            <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <?php
                        session_start();
                        if (isset($_SESSION['message'])) {
                    ?>
                        <p><?php echo $_SESSION['message']; ?></p>
                        <?php unset($_SESSION['message']); ?>
                    <?php
                        }
                    ?>
                        <button type="submit" name="submit" class="btn btn-primary me-md-2">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>

 	
</body>

</html>