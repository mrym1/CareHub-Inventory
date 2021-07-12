<?php
session_start();
include '../partials/db_conn.php';
if (!isset($_SESSION['U_loggedin']) || $_SESSION['U_loggedin'] != true) {
    header("Location:/inventory/php/login.php");
    exit;
}

$check = 0;
$check1 = 0;
if (isset($_POST['User_Submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$SNO = $_SESSION['SID'];
        $fname = $_POST['f_name1'];
		$lname = $_POST['l_name1'];
		$name = ($fname . ' '. $lname);
        $username = $_POST['username1'];
        $password = $_POST['password1'];
        $pin = $_POST['pin1'];
		$contact = $_POST['contact1'];
		$province = $_POST['province1'];
		$city = $_POST['city1'];
		$address = $_POST['address1'];
        $email = $_POST['email1'];
		
		$USER_INSERT = "UPDATE `USER` SET `F_NAME` = '$fname', `L_NAME` = '$lname', `USERNAME` = '$username', `PASSWORD` = '$password', `PIN_CODE` = '$pin',`CONTACT` = '$contact', `PROVINCE` = '$province', `CITY` = '$city', `ADDRESS` = '$address',`EMAIL` = '$email' WHERE `USER`.`SID` = $SNO ";
        $result = mysqli_query($Connect_DB,$USER_INSERT);
                   
        if ($result) {

			$_SESSION['NAME'] = $name;
			$_SESSION['FNAME'] = $fname;
			$_SESSION['LNAME'] = $lname;
            $_SESSION['USERNAME'] = $username;
            $_SESSION['PASSWORD'] = $password;
            $_SESSION['EMAIL'] = $email;
        	$_SESSION['PIN'] = $pin;
            $_SESSION['CONTACT'] = $contact;
            $_SESSION['PROVINCE'] = $province;
            $_SESSION['CITY'] = $city;
            $_SESSION['ADDRESS'] = $address;
            $_SESSION['EMAIL'] = $email;

				$check = 1;
        } 
		else {
			
			$check = 1;
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
    <link rel="stylesheet" href="../css/apanel.css">
	<link rel="stylesheet" href="../css/style.css">
	<?php
      include '../partials/logo.php';
    ?>
    <title>User Panel</title>
  </head>
  <body id="body-pd" class="bg-secondary">
	<?php
		include('../partials/U_side.php');

		if ($check == true) {
            
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Dear ' . strtoupper($name) . ' your Account Updated<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
        }
        if ($check1 == true) {

			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Dear '. strtoupper($name) .' Something went Wrong! Please Try Again
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
        }
	?>

        <!-- /#sidebar-wrapper -->


<!-- Page Content -->
<div id="page-content-wrapper">	
	
<div id="content">

			<!-- Button trigger modal -->
			<div class="modal fade " id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel"><strong> Account Settings</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
				<div class="modal-body">
				<form action="/Inventory/php/user_panel.php" method="POST"  class="container">
					<div class="mb-3">
						<strong class="mx-2 py-5"><?php echo strtoupper($_SESSION['FNAME']) ?></strong><?php echo  '<p class="card-text text-center"><img src="/Inventory/uploads/' . $_SESSION['IMAGE'] ?>" class="card-img p-size-admin" alt="..."></p>
					
						</div>
                                    <fieldset>
                                            <input type="hidden" name="snoEdit" id="snoEdit">
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your First Name*" value=<?php echo $_SESSION['FNAME']; ?> class="form-control" name="f_name1" id="f_name1" required aria-describedby="emailHelp">
                                                </div>
                                                <div class="col">
                                                    <input type="text" placeholder="Your Last Name*" value=<?php echo $_SESSION['LNAME']; ?> name="l_name1" id="l_name1" class="form-control" aria-describedby="nameHelp" required >
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your Username*" value=<?php echo $_SESSION['USERNAME']; ?> name="username1" id="username1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                                <div class="col">
                                                    <input type="password" min-length="4" placeholder="Password*" value=<?php echo $_SESSION['PASSWORD']; ?> name="password1" id="password1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="password" min-length="4" placeholder="Pin Code*" value=<?php echo $_SESSION['PIN']; ?>  name="pin1" id="pin1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
												<div class="col">
                                                    <input type="text" placeholder="Your Contact*" value=<?php echo $_SESSION['CONTACT']; ?> name="contact1"  id="contact1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                               
                                            </div>
                                            <div class="mb-3 row">
                                                <!-- <div class="col">
                                                    <input type="text" placeholder="Your Contact*" value=<?php echo $_SESSION['CONTACT']; ?> name="contact1"  id="contact1" class="form-control" aria-describedby="nameHelp" required>
                                                </div> -->
                                                <div class="col">
                                                    <input class="form-control bg-light" list="province" placeholder="Select Province*" value=<?php echo $_SESSION['PROVINCE']; ?> name="province1" id="province1" required>
                                                    <datalist id="province">
                                                        <option value="Punjab">
                                                        <option value="Sindh">
                                                        <option value="KPK">
                                                        <option value="Gilgit-Baltistan">
                                                        <option value="Balochistan">
                                                        <option value="Azad Jummu & Kashmir">
                                                </div>
												<div class="col">
                                                    <input type="text" placeholder="Your City*" value=<?php echo $_SESSION['CITY']; ?> name="city1" id="city1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <!-- <div class="col">
                                                    <input type="text" placeholder="Your City*" value=<?php echo $_SESSION['CITY']; ?> name="city1" id="city1" class="form-control" aria-describedby="nameHelp" required>
                                                </div> -->
                                                <div class="col">
                                                    <input type="text" placeholder="Address*" value=<?php echo $_SESSION['ADDRESS']; ?> class="form-control" name="address1" id="address1" aria-describedby="nameHelp" required>
                                                </div>
												<div class="col">
                                                    <input type="email" placeholder="Your Email*" value=<?php echo $_SESSION['EMAIL']; ?> name="email1" id="email1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            
											<div class="text-center">
												<button type="submit" name="User_Submit" class="btn btn-primary">Update</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</div>
                                    </fieldset>
                                </form>
				</div>
				</div>
			</div>
			</div>

	<div class="container px-lg-4 my-1 pt-5 ">
		<div class="row d-flex justify-content-evenly">
			<!-- Button trigger modal -->
			<div class="modal fade " id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
	
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center pt-2 pb-5 flex-wrap" data-aos="fade-right">
            
            <div class="card bg-dark text-white mx-2 my-3 hove w_login" style="width: 18rem;">
                <img src="../images/a1.png" class="card-img" alt="...">
                <div class="card-img-overlay d-flex flex-row">
				<?php echo  '<p class="card-text text-center mx-5 ps-4"><img src="/Inventory/uploads/' . $_SESSION['IMAGE'] ?>" class="card-img p-size-admin" alt="..."></p>
					<div class="card-img-overlay card-text d-flex align-items-end justify-content-center text-center">
						<button type="button" class="btn btn-outline-info btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#updateModal">Update Account</button>
                    
					</div>
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
						<a href="/Inventory/php/user_donation.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View Donations</button></a>
					</div>
				</div>
			
			

			
			<div class="card bg-dark text-white mx-2 my-2 hove w_login" style="width: 18rem;">
					<img src="../images/a1.png" class="card-img" alt="...">
					<div class="card-img-overlay d-flex justify-content-end">
						<i class="las la-list la-4x card-img-top A_size"></i>
					</div>
					<div class="card-img-overlay d-flex justify-content-start F_Size counter">
						<?php
						$sql = "SELECT *FROM `contact_us`";
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
						<a href="/Inventory/php/User_contact.php"><button type="button" class="btn btn-outline-info btn-sm mx-2">View Report</button></a>
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

