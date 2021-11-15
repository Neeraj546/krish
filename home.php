<?php
	session_start();
	if ($_SESSION['krish'] === true) {
		//Nothing need to be done
	}
	else{
		header('location:main.php');
	}
	/*echo $_SESSION['name'];
	echo $_SESSION['mail'];
	echo $_SESSION['address'];
	echo $_SESSION['dob'];*/

	include('dbconf.php');
	$id = $_SESSION['key'];
	$ref_table = "user";
	$editdata = $database->getReference($ref_table)->getChild($id)->getValue();

	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$dob = $_POST['dob'];
		$address = $_POST['address'];
		$pic = $_FILES['pic']['name'];

		$random_no = rand(1111,9999);
		$newimg = $random_no.$pic;
		$oldimg = $editdata['Picture'];

		if ($pic != NULL) {
			$picture = "data/img/".$newimg;
			move_uploaded_file($_FILES['pic']['tmp_name'], "data/img/".$newimg);
			if ($oldimg != "data/img/avatar.jpg") {
				unlink($oldimg);
			}
		}
		else{
			$picture = $oldimg;
		}

		$updatedata = [
			'Name' => $name,
			'Mail' => $mail,
			'DOB' => $dob,
			'Address' => $address,
			'Picture' => $picture,
		];
		$update_table = 'user/'.$id;
		$updateuser = $database->getReference($update_table)->update($updatedata);
		if ($updateuser) {
			// code...
		}
	}
	$editdata = $database->getReference($ref_table)->getChild($id)->getValue();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title>Krish Works</title>
	<script type="text/javascript">
		function picdisplay(){
			if( document.getElementById("pic").files.length == 0 ){
    			
			}
			else{
				document.getElementById('newimg').innerHTML = "New Image : "+document.getElementById("pic").files[0].name;
			}
		}
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card mt-4">
					<div class="card-header">
						<h4>Welcome, <?= $editdata['Name']; ?>
							<a href="logout.php" class="btn float-end btn-danger">Logout</a>
						</h4>
					</div>
					<div class="card-body">
							<div class="row justify-content-center">
								<div class="col-md-6">
									<form action="" method="POST" enctype="multipart/form-data">
										<div class="form-group mb-3">
											<label for="pic"><img src="<?= $editdata['Picture'];?>" style="border-radius: 50%;border: 1px solid #000;cursor: pointer;" width="100" height="100"/></label>
											<input type="file" class="form-control" style="display: none;" onchange="picdisplay();" name="pic" id="pic"/>
											<span id="newimg"></span>
										</div>
										<div class="form-group mb-3">
											<label for="">Name</label>
											<input type="text" required class="form-control" value="<?= $editdata['Name'];?>" name="name" />
										</div>
										<div class="form-group mb-3">
											<label for="">Mail</label>
											<input type="text" required class="form-control" value="<?= $editdata['Mail'];?>" name="mail" />
										</div>
										<div class="form-group mb-3">
											<label for="">Date of Birth</label>
											<input type="date" required class="form-control" value="<?= $editdata['DOB'];?>" name="dob" />
										</div>
										<div class="form-group mb-3">
											<label for="">Address</label>
											<input type="text" required class="form-control" value="<?= $editdata['Address'];?>" name="address" />
										</div>
										<div class="form-group mb-3">
											<input type="submit" class="btn btn-primary" name="update" value="Update" />
											<a href="reset.php" class="btn float-end btn-danger">Reset Password</a>
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