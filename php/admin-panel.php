<?php
session_start();
include '../partials/db_conn.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location:/inventory/php/login.php");
    exit;
}

if (isset($_POST['Admin_Submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$SNO = $_SESSION['SID'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pin = $_POST['pin'];
        $email = $_POST['email'];
        $hash1 = password_hash($password, PASSWORD_DEFAULT);
        $hashp = password_hash($pin, PASSWORD_DEFAULT);
                    
		$err = 0;
                   
        $ADMIN_INSERT = "UPDATE `ADMIN` SET `NAME` = '$name', `EMAIL` = '$email',`USERNAME` = '$username', `PASSWORD` = '$hash1', `PIN_CODE` = '$hashp' WHERE `ADMIN`.`SID` = $SNO";
        $sql = mysqli_query($Connect_DB, $ADMIN_INSERT);
                   
        if ($sql) {
            $_SESSION['NAME'] = $name;
            $_SESSION['USERNAME'] = $username;
            $_SESSION['PASSWORD'] = $password;
            $_SESSION['PIN'] = $pin;
            $_SESSION['EMAIL'] = $email;
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Dear ' . strtoupper($name) . ' your Account Updated<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
        } 
		else {
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Dear . strtoupper($name) . Something went Wrong! Please Try Again
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/apanel.css">
	<!-- <link rel="stylesheet" href="../css/style.css"> -->
	<?php
      include '../partials/logo.php';
    ?>
    <title>Admin Panel</title>
  </head>
  <body id="body-pd" style="background-color:#ccc">
	<?php
		include('../partials/sidebar.php');
	?>

        <!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">	
	
    <div id="content">
	<!-- ******************** --><link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
	<div class="container px-lg-4 my-1 pt-5 ">
		<div class="row d-flex justify-content-evenly">
			
			<!-- Button trigger modal -->
			<div class="modal fade " id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel"><strong> Account Settings</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/Inventory/php/admin-panel.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="snoEdit1" id="snoEdit1">
                            <div class="mb-3">
                                <?php echo  '<p class="card-text text-center"><img src="/Inventory/admin/' . $_SESSION['IMAGE']; ?>" class="card-img p-size-admin1" alt="..."><br><strong><?php echo strtoupper($_SESSION['NAME']); ?></strong></p>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" minlength="4" placeholder="Your Name*" value=<?php echo $_SESSION['NAME']; ?> maxlength="30" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Username</label>
                                <input type="text" minlength="4" value=<?php echo $_SESSION['USERNAME']; ?> maxlength="30" placeholder="Your Username*" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Password</label>
                                <input type="password" minlength="4" value=" <?php echo ($_SESSION['PIN']); ?>" placeholder="Password*" maxlength="30" class="form-control" required id="password" name="password" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">PIN-CODE</label>
                                <input type="password" minlength="4" value=<?php echo ($_SESSION['PIN']); ?> maxlength="30" placeholder="Pin Code*" class="form-control" required id="pin" name="pin">
                            </div>
							<div class="mb-3">
                                <label for="title" class="form-label">Email*</label>
                                <input type="email" minlength="4" value=<?php echo ($_SESSION['EMAIL']); ?> maxlength="30" placeholder="Your Username*" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                            </div>
                            <!-- <div class="mb-3 row">
                                <div class="col">
                                    <label for="formFile" class="form-label"><strong>Change Picture</strong>(optional)</label>
                                    <input class="form-control" type="file" value=" <?php echo ($_SESSION['IMAGE']); ?>" name="image">
                                </div>
                            </div> -->
                            <br>
                            <HR>
                            <div class="text-center">
                                <button type="submit" name="Admin_Submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center pt-2 pb-5 flex-wrap" data-aos="fade-right">
            <div class="card bg-dark text-white mx-2 my-3 hove w_login" style="width: 18rem;">
                <img src="../images/a1.png" class="card-img" alt="...">
                <div class="card-img-overlay">
				<?php echo  '<p class="card-text text-center"><img src="/Inventory/admin/' . $_SESSION['IMAGE'] ?>" class="card-img p-size-admin" alt="..."> <strong ><br><?php echo strtoupper($_SESSION['NAME']) ?></strong></p>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<button type="button" class="btn btn-outline-info btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#updateModal">Update Account</button>
                    
					</div>
                </div>
            </div>
			<div class="card bg-dark text-white mx-2 my-2 hove w_login" style="width: 18rem;">
					<img src="../images/a1.png" class="card-img" alt="...">
					<div class="card-img-overlay d-flex justify-content-end">
						<i class="las la-users la-4x card-img-top A_size"></i>
					</div>
					<div class="card-img-overlay d-flex justify-content-start F_Size counter">
						<?php
							$sql = "SELECT *FROM `USER`";
							$RESULT = mysqli_query($Connect_DB, $sql);
							if ($RESULT) {
								$NUM = mysqli_num_rows($RESULT);
								echo $NUM;
							} 
							else {
								echo "0";
							}
						?>
					</div>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<a href="/Inventory/php/User_Table.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View User</button></a>
					</div>
				</div>
			

			

			<div class="card bg-dark text-white mx-2 my-2 hove w_login" style="width: 18rem;">
					<img src="../images/a1.png" class="card-img" alt="...">
					<div class="card-img-overlay d-flex justify-content-end">
						<i class="las la-donate la-4x card-img-top A_size"></i>
					</div>
					<div class="card-img-overlay d-flex justify-content-start F_Size counter">
						<?php
							$sql = "SELECT *FROM `DONATION`";
							$RESULT = mysqli_query($Connect_DB, $sql);
							if ($RESULT) {
								$NUM = mysqli_num_rows($RESULT);
								echo $NUM;
							} 
							else {
								echo "0";
							}
						?>
					</div>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<a href="/Inventory/php/donation_Table.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View Donations</button></a>
					</div>
				</div>
			
			<div class="card bg-dark text-white mx-2 my-2 hove w_login" style="width: 18rem;">
					<img src="../images/a1.png" class="card-img" alt="...">
					<div class="card-img-overlay d-flex justify-content-end">
						<i class="las la-image la-4x card-img-top A_size"></i>
					</div>
					<div class="card-img-overlay d-flex justify-content-start F_Size counter">
						<?php
							$sql = "SELECT *FROM `GALLERY`";
							$RESULT = mysqli_query($Connect_DB, $sql);
							if ($RESULT) {
								$NUM = mysqli_num_rows($RESULT);
								echo $NUM;
							} 
							else 
							{
								echo "0";
							}
						?>
					</div>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<a href="/Inventory/php/gallery.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View Gallery</button></a>
					</div>
				</div>

			
			<div class="card bg-dark text-white mx-2 my-2 hove w_login" style="width: 18rem;">
					<img src="../images/a1.png" class="card-img" alt="...">
					<div class="card-img-overlay d-flex justify-content-end">
						<i class="las la-list la-4x card-img-top A_size"></i>
					</div>
					<div class="card-img-overlay d-flex justify-content-start F_Size counter">
						<?php
						$sql = "SELECT *FROM `CONTACT_US`";
						$RESULT = mysqli_query($Connect_DB, $sql);
						if ($RESULT) {
							$NUM = mysqli_num_rows($RESULT);
							echo $NUM;
						} else {
							echo "0";
						}
						?>
					</div>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<a href="/Inventory/php/contact.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View Report</button></a>
					</div>
				</div>
		</div>
		
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

