<?php
include '../partials/db_conn.php';
session_start();
if (!isset($_SESSION['forget_pw']) || $_SESSION['forget_pw'] != true) {
    header("Location:/Inventory/php/a_forget.php");
    exit;
}

if (isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_Password = $_POST['new_password'];
        $c_Password = $_POST['c_password'];
        if ($new_Password == $c_Password) {
            $h_Password = password_hash($new_Password, PASSWORD_DEFAULT);

            $email = $_SESSION['F_EMAIL'];
            $pin = $_SESSION['F_PIN'];
            $update_pw = "UPDATE `ADMIN` SET `PASSWORD` = '$h_Password' WHERE `ADMIN`.`PIN_CODE`= '$pin' ";
            $F_update = mysqli_query($Connect_DB, $update_pw);
            if ($F_update)
            {
                session_unset();
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Dear Your Password Change Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                header("location:/Inventory/php/login.php?error=0");
            } 
            else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Server Issue -- Please try again later.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        } 
        else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Wrong Password -- Both Passwords are not same.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }

    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Forget Password</title>
  </head>
  <body style="background-image: url('../images/bg1.jpg');">
    


<div class="container-fluid my-5 p-5 row d-flex justify-content-center align-items-center">
      
        <!-- <div class="row main_div d-flex justify-content-center align-items-center "> -->
            <div class="col-12 col-lg-5 col-md-8 col-xxl-5">
                <div class="login py-3 px-2">
                    <div class="data">
                        <div class="row">
                        <div class="row justify-content-center align-items-center d-flex">
                            <a href="#" class="head-logo">
                            <i ><img src="../images/logo1.png" class="mt-2" alt="..." style="width:120px; height:120px;"></i>&nbsp<i><strong class="mx-4">CAREHUB</strong></i></a>
                        </div>
                        </div>
                        <form action="/Inventory/php/a_forget.php" method="POST" class="mt-5 text-center">
                            <div class="d-flex justify-content-center">
                                <div class="mb-2 col-md-10">
                                    <input type="password" placeholder="New Password" class="form-control rounded" size="35" id="new_password" maxlength="25" name="new_password" aria-describedby="emailHelp ">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="mb-2 col-md-10">
                                    <input type="password" maxlength="20" placeholder="Confirm Password" class="form-control rounded" id="c_password" name="c_password">
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" onkeypress="return
                                    enterKeyPressed(event)" name="submit" id="A_submit" class="btn btn-primary btn-block">
                                    <b>CONFIRM PASSWORD</b></button>
                                <a href="/Inventory/php/login.php"><button type="button" class="btn btn-primary btn-block"><b>GO BACK</b></button></a>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        <!-- </div> -->
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>