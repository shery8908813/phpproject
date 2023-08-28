<?php 
$emailerror = "";
$passerror = "";
$img = "";
$success = "";

$con = mysqli_connect("localhost","root","","crud_db") or die("connection failed");

if(isset($_POST['submit']))
{
  $email = htmlspecialchars($_POST['EMAIL']);
  $pass  =   htmlspecialchars($_POST['PASSWORD']);

 
  if(empty($email))
  {
    $emailerror = "please Enter Your Email...";
  }
  elseif(empty($pass))
  {
    $passerror = "please Enter Your Password...";

  }
  elseif($_FILES['file']['error'] != 0)
  {
    $img = "Select Image...";
  }
  else
  {
    $image_name = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $end      = explode('.',$image_name);
    $ext  = strtolower(end($end));
    $allowed_ext = ["jpg","jpeg","png"];
    if(in_array($ext,$allowed_ext))
    {
      $new_name =  rand('10000','9999999999').'pragrammer'.microtime(). $image_name;
      $upload_folder = "./images/". $new_name;

      if(move_uploaded_file($tmp_name,$upload_folder))
      {
       $sql = "INSERT INTO `users_tbl`(`email`, `password`, `image`) VALUES ('{$email}','{$pass}','{$upload_folder}')";
       if( mysqli_query($con,$sql))
       {
        header('location: table.php');
       }
      }
    }
    else
    {
      echo "invalid image";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>REGISTRATION FORM</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>


<body class="bg-dark">
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1   class="h2 text-primary ">WELCOME</h1>
							<p id="p1" class="lead text-primary">
								KINDLY ADD THE FOLLOWING INFORMATION
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
                <form class="text-primary " class="bg-dark" id="frm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
										<div class="mb-3">
                                        <p class="text-danger"><?php echo $emailerror?></p>
											<label class="form-label">EMAIL</label>
											<input class="form-control form-control-lg" type="text" name="EMAIL" placeholder="Enter your name" />
										</div>
										<div class="mb-3">
                                        <p  class="text-danger"><?php echo $passerror ?></p>
											<label class="form-label">PASSWORD</label>
											<input class="form-control form-control-lg" type="password" name="PASSWORD" placeholder="Enter your password" />
										</div>
										<div class="mb-3">
              <p  class="text-danger"><?php echo $img ?></p>
              <label for="exampleInputPassword1" class="form-label">Select Image</label>
              <input type="file"  class="form-control" name="file">
            </div>
            <p id="succes" class="text-info"><?php echo $success ?></p>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
										
										
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>