


<!DOCTYPE html>
<html lang="en">
<?php include('./partials/head.php')  ?>
  <body class="bg-dark">
    <main class="d-flex w-100">
      <div class="container d-flex flex-column">
        <div class="row vh-100">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
              <div class="text-center mt-4">
                <h1 class="h2 text-primary">WELCOME BACK</h1>
                <p id="p1" class="lead text-primary">
                  KINDLY EDIT THE FOLLOWING INFORMATION
                </p>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="m-sm-4">
                    <form id="frm" action="edit.php" method="post" enctype="multipart/form-data">
                      <?php 
                        if(isset($_GET['uid']))
                        {
                            $id = $_GET['uid'];
                        }
                        include('./db_con.php');
                        $sql = "SELECT * FROM `users_tbl` WHERE `id` = $id";
                        $res = mysqli_query($con, $sql);
                        $result = mysqli_fetch_assoc($res);
                      ?>
                      <input type="hidden" name="id" value="<?php echo $result['id'] ?>">
                      <div class="mb-3">
                        <label class="form-label">EMAIL</label>
                        <input class="form-control form-control-lg" type="text" name="EMAIL" value="<?php echo $result['email'] ?>" />
                      </div>
                      <div class="mb-3">
                        <label class="form-label">PASSWORD</label>
                        <input class="form-control form-control-lg" type="password" name="PASSWORD" value="<?php echo $result['password'] ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Select Image</label>
                        <input type="file" class="form-control" name="file">
                      </div>
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