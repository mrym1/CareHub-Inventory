<?php
include '../partials/db_conn.php';
$login = false;
$showError = false;
//Incase table is not created so create by this query 
$ADMIN_TABLE = "CREATE TABLE `ADMIN`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                  `NAME` VARCHAR(25) NOT NULL,
                                  `EMAIL` VARCHAR(50) NOT NULL,
                                  `USERNAME` VARCHAR(25) NOT NULL,
                                  `PASSWORD` VARCHAR(255) NOT NULL,
                                  `PIN_CODE` VARCHAR(50) NOT NULL,
                                  `IMAGE` text NOT NULL DEFAULT '1.png',
                                  PRIMARY KEY (`SID`))";



$Table_Query = mysqli_query($Connect_DB, $ADMIN_TABLE);
if ($Table_Query) {
    $hash = password_hash('admin', PASSWORD_DEFAULT);
    $hash1 = password_hash('1234', PASSWORD_DEFAULT);
 
    $ADMIN_INSERT = "INSERT INTO ADMIN (`NAME`,`EMAIL`,`USERNAME`,`PASSWORD`,`PIN_CODE`,`IMAGE`) VALUES('Admin','admin@gmail.com','admin','$hash','$hash','1.png')";
    $data1 = mysqli_query($Connect_DB, $ADMIN_INSERT);
}

if (isset($_POST['submit'])) {

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
$username = $_POST["username"];
$password = $_POST["password"];



$SQL = "SELECT *FROM `ADMIN` WHERE `USERNAME` = '$username'";
    $result = mysqli_query($Connect_DB, $SQL);
    $num = mysqli_num_rows($result);
    
    if ($num == 1){
        while($row = mysqli_fetch_assoc($result))
        {  
            $pw = $row['PASSWORD'];
            $sid = $row['SID']; 
            $name = $row['NAME'];
            $email = $row['EMAIL'];
            $pin = $row['PIN_CODE'];
            $image = $row['IMAGE'];    
                   
                if (password_verify($password, $pw ))
                // if ($password == 'admin' && $username == 'admin')
                { 
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['USERNAME'] = $username;
                    $_SESSION['PASSWORD'] = $password;
                    $_SESSION['SID'] = $sid;
                    $_SESSION['NAME'] = $name;
                    $_SESSION['EMAIL'] = $email;
                    $_SESSION['PIN'] = $pin;
                    $_SESSION['IMAGE'] = $image;
                    
                
                    header("location: admin-panel.php");
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

if (isset($_POST['F_Submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $F_email = $_POST['f_email'];
        
$SQL = "SELECT *FROM `ADMIN` WHERE `EMAIL` = '$F_email'";
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
            header("location:/Inventory/php/a_forget.php");
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
    <!-- <link rel="stylesheet" href="../css/apanel.css"> -->
    <?php
      include '../partials/logo.php';
    ?>
    <title> Admin Login</title>
  </head>
  <?php

if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '. $showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> ';
    }
    
?>

  <body style="background-image: url('../images/bg1.jpg');">
  <div class="d-flex p-2 justify-content-end">
     <a href="/Inventory/php/User_login.php"><button type="button" class="btn btn-block btn-primary px-3"><b>User-Panel</b></button></a>
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
                        <!-- <div class="mb-3">
                            <label for="title" class="form-label">PIN-CODE</label>
                            <input type="password" placeholder="PIN" class="form-control" id="pin_code" name="pin_code">
                        </div> -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Email</label>
                            <input type="email" placeholder="Your Email*" class="form-control" id="f_email" name="f_email">
                        </div>
                        <br>
                        <HR>
                        <div class="text-center">
                            <button type="submit" name="F_Submit" class="btn btn-primary">Submit</button>
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
                <div class=" login py-3 px-2">
                    <div class="data">
                        <div class="row">
                            <div class="row justify-content-center align-items-center d-flex">
                                <a href="#" class="head-logo">       
                            <i ><img src="../images/logo1.png" class="mt-2" alt="..." style="width:120px; height:120px;"></i>&nbsp<i><strong class="mx-4">CAREHUB</strong></i></a>
                        </div>
                        </div>
                        <form action="/Inventory/php/login.php" method="POST" class="mt-5 text-center">
                        <div class="d-flex justify-content-center">
                            <div class="mb-2 col-md-10">
                                <input type="text" class="form-control rounded" id="username" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-2 col-md-10">
                                <input type="password" class="form-control rounded"  name="password" maxlength="20" id="password" placeholder="Password">
                            </div>
                        </div>
                            <a data-bs-toggle="modal" data-bs-target="#editModal"> Forgot Password </a>
                            <div class="my-3 ">
                             <button type="submit" onkeypress="return
                                 enterKeyPressed(event)" name="submit" id="A_submit" class="btn btn-block px-5 btn-primary btn-lg"><b>LOGIN</b></button>
                             </div>

                        </form>

                    </div>

                </div>
            </div>
        <!-- </div> -->
    </div>

    
			<div class="modal fade " id="ad-Modal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminModalLabel"><strong> Create Admin Account</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/Inventory/php/login.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" minlength="4" placeholder="Your Name*"  maxlength="30" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Username</label>
                                <input type="text" minlength="4"  maxlength="30" placeholder="Your Username*" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Password</label>
                                <input type="password" minlength="4" value=" " placeholder="Password*" maxlength="30" class="form-control" required id="password" name="password" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">PIN-CODE</label>
                                <input type="password" minlength="4" maxlength="30" placeholder="Pin Code*" class="form-control" required id="pin_code" name="pin_code">
                            </div>
							<div class="mb-3">
                                <label for="title" class="form-label">Email*</label>
                                <input type="email" minlength="4" maxlength="30" placeholder="Your Username*" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="image">
                                </div>
                            </div>
                            <br>
                            <HR>
                            <div class="text-center">
                                <button type="submit" name="a_submit" class="btn btn-primary">Insert</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
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

