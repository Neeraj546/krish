<?php
	session_start();
	
	/*echo $_SESSION['name'];
	echo $_SESSION['mail'];
	echo $_SESSION['address'];
	echo $_SESSION['dob'];*/

	include('dbconf.php');
	if (isset($_POST['send'])) {

	$ref_table = "user";
	$fetchdata = $database->getReference($ref_table)->getValue();
	$mail = $_POST['mail'];
		if($fetchdata > 0){
			foreach($fetchdata as $key => $row){
				if ($row['Mail'] === $mail) {
					$url = 'location:https://neeraj546.000webhostapp.com/data/php/mail.php?id='.$mail;
					header($url);
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title>Krish Works</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						<h4>Welcome, <?= $editdata['Name']; ?>
							<a href="main.php" class="btn float-end btn-danger">Back</a>
						</h4>
					</div>
					<div class="card-body">
							<div class="row justify-content-center">
								<div class="col-md-6">
									<form action="" method="POST">
										<div class="form-group mb-3">
											<label for="">Mail</label>
											<input type="text" required class="form-control" name="mail" />
										</div>
										<div class="form-group mb-3">
											<span style="color:red"><?php echo $msg; ?></span>
										</div>
										<div class="form-group mb-3">
											<input type="submit" class="btn btn-primary" name="send" value="Confirm" />
											<!---<a href="home.php" class="btn float-end btn-danger">Cancel</a>--->
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