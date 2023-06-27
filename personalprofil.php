<?php
require_once 'config.php';
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



</head>

<body>
	<?php require_once("assets/components/header.php") ?>
	<?php require_once("assets/components/second-header.php") ?>

	<section class="profil-detail">
		<div class="container mt-5">

			<div class="row d-flex justify-content-center">

				<div class="col-md-4">

					<div class="card  p-3 py-4">

						<div class="text-center">
							<img src="assets/img/blank-profile-picture-973460_960_720-1.png" width="100"
								class="rounded-circle">
						</div>

						<div class="text-center py-4 ">
							<span class="bg-secondary p-1 px-4 rounded text-white fw-bold">Personal Profile</span>
							<p class="mt-2 py-2 fw-bold">Name : <span class="fw-normal">RIKI ADI</span></p>

							<p class="mt-2 py-2 fw-bold">Username : <span class="fw-normal">Rikiadi</span></p>
							<p class="mt-2 py-2 fw-bold">Email : <span class="fw-normal">Rikiadi@gmail.com</span></p>


							<p class="mt-2 py-2 fw-bold">Phone Number : <span class="fw-normal">085857XXXXXX</span></p>



							<div class="buttons py-4">

								<button class="btn btn-outline-primary px-4" style="
	background-color: #007bff;
"><a href="edit-profil.php" style="
	color: #fff;
	text-decoration: none;
">Edit</a></button>

							</div>


						</div>




					</div>

				</div>

			</div>

		</div>
	</section>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
 "></script>
	<script src="assets/js/addtocart.js"></script>
</body>

</html>