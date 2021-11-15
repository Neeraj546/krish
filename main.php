<?php
	include('dbconf.php');
	session_start();
	if ($_SESSION['krish'] === true) {
		header('location:home.php');
	}

	if (isset($_POST['login'])) {
		$ref_table = "user";
		$mail = $_POST['mail'];
		$pwd = $_POST['pwd'];
		$fetchdata = $database->getReference($ref_table)->getValue();
		if($fetchdata > 0){
			foreach($fetchdata as $key => $row){
				if ($row['Mail'] === $mail) {
					$hashed_password = $row['Password'];
					if (password_verify($pwd, $hashed_password)) {
						$msg = "Logged In";
						$_SESSION['krish'] = true;
						$_SESSION['key'] = $key;

						header('location:home.php');
					}
					else{
						$msg = "Wrong Password!!";
					}
					break;
				}
				else{
					$msg = "No Account Exists with this Mail!!";
				}
			}
		}
		else{
			$msg = "No Account Exists with this Mail!!";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Krish Works | Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
	<!--<center>
		<h3>User Profile Management</h3>
		<form>
			<input type="text" name="usn" /><br>
			<input type="Password" name="pwd" /><br>
			<input type="submit" name="login" value="Login" />
		</form>
	</center>-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						<h4>KrishWorld User Management
							<a href="register.php" class="btn float-end btn-primary">Register</a>
						</h4>
					</div>
					<div class="card-body">
							<div class="row justify-content-center">
								<div class="col-md-6">
									<form action="" method="POST">
										<div class="form-group mb-3">
											<label for="mail">Mail</label>
											<input type="text" required id="mail" class="form-control" value="<?= $mail;?>" name="mail" />
										</div>
										<div class="form-group mb-3">
											<label for="pwd">Password</label>
											<input type="password" id="pwd" required class="form-control" name="pwd" />
										</div>
										<div class="form-group mb-3">
											<a href="forgot.php">Forgot Password?</a>
										</div>
										<div class="form-group mb-3">
											<span style="color:red"><?php echo $msg; ?></span>
										</div>
										<div class="form-group mb-3">
											<input type="submit" class="btn btn-primary" name="login" value="Login" />
										</div>
									</form>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>