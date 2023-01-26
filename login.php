<?php
include "config/database.php";
$conn = new mysqli('127.0.0.1', 'admin', 'admin', 'storedb');
if ($conn->connect_error) {
	die('connection failed: ' . $conn->connect_error);
}
session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {
	if (empty($_POST["email"])) {
		header('location: login.php?error=User name is required');
	} elseif (empty($_POST["password"])) {
		header('location: login.php?error=password is required');
	} else {
		$email = $_POST["email"];
		$pass = $_POST["password"];
		$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			print_r($row);
			if ($email == $row['email'] && $pass == $row['password']) {
				$_SESSION['Username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['Password'] = $row['password'];
				$_SESSION['id'] = $row['id'];
				header('location: index.php');
			} else {
				header('location: login.php?error=Incorrect user name or password');
			}
		} else {
			header('location: login.php?error=Incorrect user name or password');
		}
	}
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Bootstrap 5 Login Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="./assets/icon.jpg" alt="logo" width="100">
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
										<a href="forgot.html" class="float-end">
											Forgot Password?
										</a>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="d-flex align-items-center">
									<div class="form-check">
										<input type="checkbox" name="remember" id="remember" class="form-check-input">
										<label for="remember" class="form-check-label">Remember Me</label>
									</div>

									<?php if (isset($_GET['error'])) { ?>
										<p class="error"><?php echo $_GET['error']; ?></p>
									<?php } ?>

									<button type="submit" class="btn btn-primary ms-auto" name="login">
										Login
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Don't have an account? <a href="register.php" class="text-dark">Create One</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2017-2021 &mdash; Your Company
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>

</html>