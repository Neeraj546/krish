<?php
	include('dbconf.php');

	$msg = "";
	/*$reference = $database->getReference('users');
	echo $reference->getValue();*/
	if(isset($_POST['register'])){
		$mail = $_POST['mail'];
		$name = $_POST['name'];
		$pwd = $_POST['pwd'];
		$cpwd = $_POST['cpwd'];
		if ($pwd != $cpwd) {
			$msg = "Password does not Match!!";
		}
		else{
			// Database
			$pwdhash = password_hash($pwd, PASSWORD_DEFAULT);
			$postData = [
				'Name' => $name,
				'Mail' => $mail,
				'Password' => $pwdhash,
				'Address' => "",
				'DOB' => 0,
				'Picture' => 'data/img/avatar.jpg',
			];

			$ref_table = "user";
			$postRef = $database->getReference($ref_table)->push($postData);
			if ($postRef) {
				$msg = "Account Created Successfully!!";
				$mail = "";
				$name = "";
			}
			else{
				$msg = "Something Went Wrong!!";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Krish Works | Register</title>
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
							<a href="main.php" class="btn float-end btn-primary">Login</a>
						</h4>
					</div>
					<div class="card-body">
							<div class="row justify-content-center">
								<div class="col-md-6">
									<form action="" method="POST">
										<div class="form-group mb-3">
											<label for="name">Name</label>
											<input type="text" required id="name" value="<?= $name;?>" class="form-control" name="name" />
										</div>
										<div class="form-group mb-3">
											<label for="mail">Mail</label>
											<input type="text" required id="mail" value="<?= $mail;?>" class="form-control" name="mail" />
										</div>
										<div class="form-group mb-3">
											<label for="pwd">Password</label>
											<input type="password" required id="pwd" class="form-control" name="pwd" />
										</div>
										<div class="form-group mb-3">
											<label for="cpwd">Confirm Password</label>
											<input type="password" required id="cpwd" class="form-control" name="cpwd" />
										</div>
										<div class="form-group mb-3">
											<span style="color:red"><?php echo $msg; ?></span>
										</div>
										<div class="form-group mb-3">
											<input type="submit" class="btn btn-primary" name="register" value="Register" />
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