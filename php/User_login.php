<?php
include '../partials/db_conn.php';
$login = false;
$showError = false;

if (isset($_POST['submit'])) {

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    
    
    $SQL = "SELECT *FROM `USER` WHERE `USERNAME` = '$username'";
        $result = mysqli_query($Connect_DB, $SQL);
        $num = mysqli_num_rows($result);
        
        if ($num == 1){
            while($row = mysqli_fetch_assoc($result))
            {  
                $pw = $row['PASSWORD'];
                $sid = $row['SID']; 
                $fname = $row['F_NAME'];
                $lname = $row['L_NAME'];
                $name = $fname+$lname;
                $username = $row['USERNAME'];
                $password = $row['PASSWORD'];
                $pin = $row['PIN_CODE'];
                $DOA = $row['DOA'];
                $contact = $row['CONTACT'];
                $province = $row['PROVINCE'];
                $city = $row['CITY'];
                $address = $row['ADDRESS'];
                $gender = $row['GENDER'];
                $email = $row['EMAIL'];
                $image = $row['IMAGE'];    
                       
                    if ($password == $row['PASSWORD'])
                    // if ($password == 'admin' && $username == 'admin')
                    { 
                        $login = true;
                        session_start();
                        $_SESSION['U_loggedin'] = true;
                        $_SESSION['USERNAME'] = $username;
                        $_SESSION['PASSWORD'] = $pw;
                        $_SESSION['SID'] = $sid;
                        $_SESSION['FNAME'] = $fname;
                        $_SESSION['LNAME'] = $lname;
                        $_SESSION['NAME'] = $name;
                        $_SESSION['EMAIL'] = $email;
                        $_SESSION['PIN'] = $pin;
                        $_SESSION['DOA'] = $DOA;
                        $_SESSION['CONTACT'] = $contact;
                        $_SESSION['PROVINCE'] = $province;
                        $_SESSION['CITY'] = $city;
                        $_SESSION['ADDRESS'] = $address;
                        $_SESSION['GENDER'] = $gender;
                        $_SESSION['EMAIL'] = $email;
                        $_SESSION['IMAGE'] = $image;
                        
                    
                        header("location: user_panel.php");
                    } 
                    else
                    {
                        $showError = "Invalid Password";
                    }
            }
            
        } 
        else
        {
            $showError = "Invalid UserName";
        }
    }
    }


    if (isset($_POST['UF_Submit'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $F_email = $_POST['email'];
            
    $SQL = "SELECT *FROM `USER` WHERE `EMAIL` = '$F_email'";
    $result = mysqli_query($Connect_DB, $SQL);
    $num = mysqli_num_rows($result);
    
    if ($num == 1){
        while ($row = mysqli_fetch_assoc($result)) {
            $email = $row['EMAIL'];
            $pin = $row['PIN_CODE'];
     
            if(($email == $F_email)){
                session_start();
                $_SESSION['forget_pw'] = true;
                $_SESSION['F_EMAIL'] = $email;
                $_SESSION['F_PIN'] = $pin;
                header("location:/Inventory/php/U_forget.php");
            }
        }
    }
            else{
                $showError = "Incorrect Email! Please Try Again";
    
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@1,300&display=swap" rel="stylesheet">

    <?php
      include '../partials/logo.php';
    ?>
    
    <title>User Login</title>
  </head>
  <?php

        if($showError){
            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
            }
?>

  <body style="font-family: 'Ubuntu', sans-serif; background-image: url('../images/bg1.jpg');">
    <div class="d-flex p-2 justify-content-end">            
        <a href="/Inventory/php/login.php"><button type="button" class="btn btn-block btn-primary btn-lg">Admin-Panel</button></a>
    </div> 

  <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content text-light bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><strong>Forgot Password</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Email</label>
                            <input type="email" placeholder="Your Email*" class="form-control" id="email" name="email">
                        </div>
                        <br>
                        <HR>
                        <div class="text-center">
                            <button type="submit" name="UF_Submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


<div class="container-fluid my-5 p-2 row d-flex justify-content-center align-items-center">
      
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
                        <form action="/Inventory/php/User_login.php" method="POST" class="mt-5 text-center">
                            <div class="d-flex justify-content-center"> 
                                <div class="mb-2 col-md-10 ">
                                    <input type="text" class="form-control rounded" id="username" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="mb-2 col-md-10">
                                    <input type="password" class="form-control rounded"  name="password" maxlength="20" id="password" placeholder="Password">
                                </div>
                            </div>
                            <a data-bs-toggle="modal" data-bs-target="#editModal" id="change_pass"> Forgot Password </a>
                            <!-- <button type="button" class="btn btn-block btn-primary " data-bs-toggle="modal" data-bs-target="#editModal" id="change_pass">Forgot Password</button> -->
                            <div class="my-3 ">
                                <button type="submit" onkeypress="return
                                 enterKeyPressed(event)" name="submit" id="A_submit" class="btn btn-block btn-primary btn-lg"><b>LOGIN</b></button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        <!-- </div> -->
    </div>

    <script>
     function enterKeyPressed(event) {
            if (event.keyCode == 13) {
                console.log("Enter key is pressed");
                return true;
            } else {
                return false;
            }
        }
    </script>

   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->

        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    
  </body>
</html>

