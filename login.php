<?php 
session_start();

if(isset($_SESSION['email'])) {
    header('location: table.php');
    exit();
}

$emailerror = "";
$passerror = "";
$success = "";

include('./db_con.php');

if(isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $pass  = htmlspecialchars($_POST['pass']);

    if(empty($email)) {
        $emailerror = "Please Enter Your Email...";
    } elseif(empty($pass)) {
        $passerror = "Please Enter Your Password...";
    } else {
        $sql = "SELECT * FROM `users_tbl` where `email` = '{$email}' and `password` = '{$pass}'";
        $res = mysqli_query($con, $sql);

        if(mysqli_num_rows($res) > 0) {
            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;

            header('location: table.php');
            exit();
        } else {
            $success = "Invalid Credentials";
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
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Sign In | AdminKit Demo</title>

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

                        <div class="text-center mt-4 text-primary">
                            <?php if(isset($_SESSION['email'])): ?>
                                <h1 class="h2">Welcome back, <?php echo $_SESSION['email']; ?></h1>
                            <?php else: ?>
                                <h1 class="h2">Welcome back</h1>
                            <?php endif; ?>
                            <p class="lead">
                                Log in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    
                                    <form id="frm" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <p class="text-danger"><?php echo $emailerror?></p>
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="text" name="email" placeholder="Enter your email" />
                                        </div>
                                        <div class="mb-3">
                                            <p  class="text-danger"><?php echo $passerror ?></p>
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" type="password" name="pass" placeholder="Enter your password" />
                                            <small>
                                                <a href="index.php">Forgot password?</a>
                                            </small>
                                        </div>
                                        <p id="success" class="text-info"><?php echo $success ?></p>
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