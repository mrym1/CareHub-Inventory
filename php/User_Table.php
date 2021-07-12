<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header("Location:/Inventory/php/login.php");
        exit;
}

include ('../partials/db_conn.php');

$User_Table = "CREATE TABLE `USER`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                    `F_NAME` VARCHAR(50) NOT NULL,
                                    `L_NAME` VARCHAR(50) NOT NULL,
                                    `USERNAME` VARCHAR(50) UNIQUE,
                                    `PASSWORD` VARCHAR(255) NOT NULL,
                                    `PIN_CODE` VARCHAR(50) NOT NULL,
                                    `DOB` DATE NOT NULL,
                                    `CONTACT` VARCHAR(20) UNIQUE DEFAULT 'NONE',
                                    `PROVINCE` VARCHAR(50) NOT NULL,
                                    `CITY` VARCHAR(50) NOT NULL,
                                    `ADDRESS` VARCHAR(50) NOT NULL,
                                    `GENDER` VARCHAR(10) DEFAULT 'NONE',
                                    `EMAIL` VARCHAR(50) UNIQUE NOT NULL DEFAULT 'NONE',
                                    `IMAGE` TEXT NOT NULL DEFAULT '1.png',
                                    PRIMARY KEY (`SID`))";
$UTable_Query = mysqli_query($Connect_DB, $User_Table);

if ($UTable_Query) {
    $DOB = date("Y/m/d");
    $User_FIRST_INSERT = "INSERT INTO USER (`F_NAME`,`L_NAME`,`USERNAME`,`PASSWORD`,`PIN_CODE`,`DOB`,`CONTACT`,`PROVINCE`,`CITY`,`ADDRESS`,`GENDER`,`EMAIL`,`IMAGE`) VALUES('NONE','NONE','user','user','1234','$DOB','NONE','NONE','NONE','NONE','NONE','***@gmail.com','1.png')";
    mysqli_query($Connect_DB, $User_FIRST_INSERT);
      
}
$error = 0;
$check = 0;
$check1 = 0;
$check2 = 0;
$check3 = 0;
$check4 = 0;

if (isset($_POST['U_Submit'])) 
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $f_name = $_POST['F_name'];
        $l_name = $_POST['L_name'];
        $user = $_POST['Username'];
        $pass = $_POST['Password'];
        $pin = $_POST['Pin'];
        $DOB1 = $_POST['DOB'];
        $contact = $_POST['Contact'];
        $province = $_POST['Province'];
        $city = $_POST['City'];
        $address = $_POST['Address'];
        $gender = $_POST['Gender'];
        $email = $_POST['Email'];
        $images = $_FILES["Image"]['name'];


        if ($error === 0 || $_FILES['Image']['name'] == 0) {
            if ($images > 350000) { 
                $check = 1;
            } 
            else 
            {

                $image_ext = array('.gif','png','jpg','jpeg');
                $filename = $_FILES['Image']['name'];
                $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

                if(!in_array($file_ext, $image_ext))
                {
                    $check1 = 1;
                    // $_SESSION['status'] = "Only .gif, .png, .jpg & .jpeg formet are allowed!";
                    // header('Location: /Inventory/php/User_Table.php');
                }

                else
                {

                    if(file_exists("../uploads/".$_FILES['Image']['name']))
                    {
                        $store = $_FILES['Image']['name'];
                        $check2 = 1;
                        // $_SESSION['status'] = "Image already Exists ". $store;
                        // header('Location: /Inventory/php/User_Table.php');
                    }
                    else
                    {
                        $User_DATA_INSERT = "INSERT INTO USER (`F_NAME`,`L_NAME`,`USERNAME`,`PASSWORD`,`PIN_CODE`,`DOB`,`CONTACT`,`PROVINCE`,`CITY`,`ADDRESS`,`GENDER`,`EMAIL`,`IMAGE`) VALUES('$f_name','$l_name','$user','$pass','$pin','$DOB1','$contact','$province','$city','$address','$gender','$email','$images')";
                        $RUN = mysqli_query($Connect_DB, $User_DATA_INSERT);
                        if($RUN)
                        {
                            move_uploaded_file($_FILES['Image']['tmp_name'], "../uploads/".$_FILES["Image"]["name"]);
                            // $_SESSION['status'] = "Account Created Successfully";
                            $check3 = 1;
                            // header("location: /Inventory/php/User_Table.php");

                        }
                        else
                        {
                            // $_SESSION['status'] = " Something Went Wrong! Please Try Again..";
                            $check4 = 1;
                            // header('Location: /Inventory/php/User_Table.php');
                        }

                    }

               } 
            }  
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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital@1&display=swap" rel="stylesheet">
  
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/apanel.css">

    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- <script src="/Inventory/js/jquery.js"></script>
    <script src="/Inventory/media/js/jquery.dataTables.min.js"></script>
    <link href="/Inventory/media/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <?php
      include '../partials/logo.php';
    ?>
    <title>User Table</title>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                 "scrollX": true
            });
        });
    </script>
    <style>
        @media screen and (max-width: 500px) {

            div.dataTables_wrapper {
                width: 50px;
                margin: 0 auto;
                display: nowrap;
            }
        }

        @media screen and (max-width: 700px) {

            div.dataTables_wrapper {
                width: 100%;
                margin: 0 auto;
                display: nowrap;
            }
        }
    </style>
   
</head>
        <?php
             include ('../partials/sidebar.php');
        ?>

<body class="bg-secondary" style="font-family: 'Ubuntu', sans-serif;" id="body-pd">

    <header>
        <?php
            if($check1){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Sorry, your file is too large.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
            }
            if($check1){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Only .gif, .png, .jpg & .jpeg formet are allowed!
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
            if($check2){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Image already Exists 
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
            if($check3){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Account Created Successfully
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
            if($check4){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Something Went Wrong! Please Try Again..
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
        ?>

        <?php
        if(isset($_SESSION['status']) && $_SESSION != '')
        {   
            ?>
          
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <?php 
                    echo $_SESSION['status'];
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['status']);
        }
        ?>
    </header>
    <!-- <main> -->

    <section>

        <!-- Modal 1 for insert -->

        <div class="bd-highlight mt-5 px-5">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info hov btn-lg mx-2" data-bs-toggle="modal" data-bs-target="#insertModal" id="change_pass">
                    <i class="las la-plus-circle"></i>ADD
                </button>
                <a href="User_Excel.php"> <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-lg hov">
                <i class="las la-list"></i>&nbspGenerate-Report
                </button></a>
            </div>

            <!-- Modal -->
            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Monthly Report&nbsp<ion-icon name="calendar"></ion-icon>
                            </h5>
                            <button type="button" class="btn-close gb-dark rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/Inventory/php/User_Excel.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Start To</label>
                                    <input type="number" placeholder="Start to*" class="form-control" id="aage" name="aage" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">End To</label>
                                    <input type="number" placeholder="End From*" class="form-control" id="eage" name="eage">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Generate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- <div class="d-flex flex-row-reverse bd-highlight mt-5 px-5">
            <button type="button" class="btn btn-danger btn-lg mx-2" data-bs-toggle="modal" data-bs-target="#insertModal" id="change_pass">ADD</button>
            <a href="User_Excel.php"><button type="button"  class="btn btn-primary btn-lg">Download-Report</button></a>
        </div> -->
        <div class="modal fade " id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertModalLabel"><strong>INSERT-USER-DATA</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="User_Table.php" method="POST" enctype="multipart/form-data" class="container">
                            <fieldset>
                                <!-- <input type="hidden" name="snoEdit" id="snoEdit"> -->
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input type="text" placeholder="Your First Name*" class="form-control" id="exampleInputname1" name="F_name" aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" placeholder="Your Last Name*" name="L_name" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input type="text" placeholder="Your Username*" name="Username" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                    <div class="col">
                                        <input type="password" min-length="4" placeholder="Password*" name="Password" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input type="password" min-length="4" placeholder="Pin Code*" name="Pin" id="pin" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                    <div class="col">
                                        <!-- <label for="birthday">Date of Birth:</label> -->
                                        <input type="date" value="2000-01-01" class="form-control" name="DOB" id="exampleInputdate1" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input type="text" placeholder="Your Contact*" name="Contact" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                    <div class="col">
                                        <input class="form-control bg-light" list="province" placeholder="Select Province*" name="Province" required>
                                        <datalist id="province">
                                            <option value="Punjab">
                                            <option value="Sindh">
                                            <option value="KPK">
                                            <option value="Gilgit-Baltistan">
                                            <option value="Balochistan">
                                            <option value="Azad Jummu & Kashmir">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input type="text" placeholder="Your City*" name="City" class="form-control" aria-describedby="nameHelp" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" placeholder="Address*" class="form-control" name="Address" aria-describedby="nameHelp" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <input class="form-control bg-light" list="Gender" placeholder="Select Gender*" name="Gender" required>
                                        <datalist id="Gender">
                                            <option value="Male">
                                            <option value="Female">
                                    </div>
                                    <div class="col">
                                        <input type="email" placeholder="Your Email*" name="Email" id="email" class="form-control" aria-describedby="nameHelp" required>
                                    </div>

                                </div>
                            
                                <div class="mb-3">
                                            <input type="file" name="Image" accept="image/*" id="Image" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="U_Submit" class="btn btn-secondary">Insert</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal 2 for Update or Delete -->
                <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content text-light bg-dark">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel"><strong>USER-DATA-SET</strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            <?php if (isset($_GET['error'])): ?>
                                <p><?php echo $_GET['error']; ?></p>
                            <?php endif ?>

                                <form action="/Inventory/php/User_Script.php" method="POST" enctype="multipart/form-data" class="container">
                                    <fieldset>
                                            <input type="hidden" name="snoEdit1" id="snoEdit1">
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your First Name*" class="form-control" name="f_name1" id="f_name1" required aria-describedby="emailHelp">
                                                </div>
                                                <div class="col">
                                                    <input type="text" placeholder="Your Last Name*" name="l_name1" id="l_name1" class="form-control" aria-describedby="nameHelp" required >
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your Username*" name="username1" id="username1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                                <div class="col">
                                                    <input type="password" min-length="4" placeholder="Password*" name="password1" id="password1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="password" min-length="4" placeholder="Pin Code*" name="pin1" id="pin1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                                <div class="col">
                                                    <input type="date" value="2000-01-01" class="form-control" name="DOB1" id="DOB1" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your Contact*" name="contact1"  id="contact1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                                <div class="col">
                                                    <input class="form-control bg-light" list="province" placeholder="Select Province*" name="province1" id="province1" required>
                                                    <datalist id="province">
                                                        <option value="Punjab">
                                                        <option value="Sindh">
                                                        <option value="KPK">
                                                        <option value="Gilgit-Baltistan">
                                                        <option value="Balochistan">
                                                        <option value="Azad Jummu & Kashmir">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input type="text" placeholder="Your City*" name="city1" id="city1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                                <div class="col">
                                                    <input type="text" placeholder="Address*" class="form-control" name="address1" id="address1" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <div class="col">
                                                    <input class="form-control bg-light" list="Gender" placeholder="Select Gender*" name="gender1" id="gender1" required>
                                                    <datalist id="Gender">
                                                        <option value="Male">
                                                        <option value="Female">
                                                </div>
                                                <div class="col">
                                                    <input type="email" placeholder="Your Email*" name="email1" id="email1" class="form-control" aria-describedby="nameHelp" required>
                                                </div>
                                            </div>

                                        <!-- <div class="mb-3">
                                                <input type="file" name="image1">
                                                
                                        </div> -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

        <!-- Table -->
        <div class="mx-1 my-3 py-3 text-center">
            <table class="table table-dark table-striped table-responsive table-hover" id="myTable">
                <thead>
                    <tr>
                        <th scope="col"><small>SR#</small></th>
                        <th scope="col"><small>Image</small></th>
                        <th scope="col"><small>First Name</small></th>
                        <th scope="col"><small>Last Name</small></th>
                        <th scope="col"><small>Username</small></th>
                        <th scope="col"><small>Password</small></th>
                        <th scope="col"><small>PIN-CODE</small></th>
                        <th scope="col"><small>Age</small></th>
                        <th scope="col"><small>Contact</small></th>
                        <th scope="col"><small>Province</small></th>
                        <th scope="col"><small>City</small></th>
                        <th scope="col"><small>Address</small></th>
                        <th scope="col"><small>Gender</small></th>
                        <th scope="col"><small>Email</small></th>
                        <th scope="col"><small>Action</small></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="table">
                        <?php
                            $USER_VIEW = "SELECT *FROM `USER`";
                            $result1 = mysqli_query($Connect_DB, $USER_VIEW);
                            
                            $form = 0;
                            if ($result1) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $picture = "../uploads/$row[IMAGE]";
                                    $diff = (int)date('Y-m-d') - (int)$row['DOB'];
                                    $form += 1;
                                    echo "<tr>
                                    <th scope='row'>" . $form . "</th>
                                        <td><small><img src=" . $picture . " class='img rounded-circle s_image'  alt='...'></small></td>
                                        <td><small>" . $row['F_NAME'] . "</small></td>
                                        <td><small>" . $row['L_NAME'] . "</small></td>
                                        <td><small>" . $row['USERNAME'] . "</small></td>
                                        <td><small>" . $row['PASSWORD'] . "</small></td>
                                        <td><small>" . $row['PIN_CODE'] . "</small></td>
                                        <td><small>" . $diff . "</small></td>
                                        <td><small>" . $row['CONTACT'] . "</small></td>
                                        <td><small>" . $row['PROVINCE'] . "</small></td>
                                        <td><small>" . $row['CITY'] . "</small></td>
                                        <td><small>" . $row['ADDRESS'] . "</small></td>
                                        <td><small>" . $row['GENDER'] . "</small></td>
                                        <td><small>" . $row['EMAIL'] . "</small></td>
                                        <td><i type='button' id=" . $row['SID'] . " class='edit las la-edit' ></i>&nbsp <i type='button' id=d" . $row['SID'] . " class='delete las la-trash'></i></td>
                                    </tr>";
                                }
                            }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <a href="/Inventory/php/admin-panel.php"><button type="button" class="btn btn-outline-light text-dark mb-3"><strong>
            <i class="las la-arrow-alt-circle-left"></i>
            </strong></button></a>
        </div>

        
    <!-- </main> -->
 <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

        <script>
                edits = document.getElementsByClassName('edit');
                Array.from(edits).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        tr = e.target.parentNode.parentNode;
                        // image = tr.getElementsByTagName("td")[0].innerText;
                        f_name = tr.getElementsByTagName("td")[1].innerText;
                        l_name = tr.getElementsByTagName("td")[2].innerText;
                        username = tr.getElementsByTagName("td")[3].innerText;
                        password = tr.getElementsByTagName("td")[4].innerText;
                        pin = tr.getElementsByTagName("td")[5].innerText;
                        contact = tr.getElementsByTagName("td")[7].innerText;
                        province = tr.getElementsByTagName("td")[8].innerText;
                        city = tr.getElementsByTagName("td")[9].innerText;
                        address = tr.getElementsByTagName("td")[10].innerText;5
                        gender = tr.getElementsByTagName("td")[11].innerText;
                        email = tr.getElementsByTagName("td")[12].innerText;
                        // image1.value = image;
                        f_name1.value = f_name;
                        l_name1.value = l_name;
                        username1.value = username;
                        password1.value = password;
                        pin1.value = pin;
                        contact1.value = contact;
                        province1.value = province;
                        city1.value = city;
                        address1.value = address;
                        gender1.value = gender;
                        email1.value = email;
                        snoEdit1.value = e.target.id;
                        $('#editModal').modal('toggle');
                        
                    })
                })
                deletes = document.getElementsByClassName('delete');
                Array.from(deletes).forEach((element) => {
                    element.addEventListener("click", (e) => {
                        // console.log(e.target.id.substr(1, ));
                        sno = e.target.id.substr(1, );
                        if (confirm("You want to delete this record?")) {
                            console.log("yes");
                            window.location = `/Inventory/php/User_Script.php?delete=${sno}`;
                        }

                    })
                })
        </script>
    </section>
</body>

</html> 

 
