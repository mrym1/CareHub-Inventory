<?php
session_start();
if (!isset($_SESSION['U_loggedin']) || $_SESSION['U_loggedin'] != true) {
    header("Location:/Inventory/php/User_login.php");
    exit;
}


include '../partials/db_conn.php';

$D_Table = "CREATE TABLE `DONATION`(`SID` INT(6) AUTO_INCREMENT,
                                    `F_NAME` VARCHAR(50) NOT NULL,
                                    `L_NAME` VARCHAR(50) NOT NULL,
                                    `EMAIL` VARCHAR(50) UNIQUE NOT NULL,
                                    `D_INFO` VARCHAR(150)  DEFAULT 'NONE',
                                    `D_TYPE` VARCHAR(150)  DEFAULT 'NONE',
                                    `COUNTRY` VARCHAR(50) NOT NULL,
                                    `CITY` VARCHAR(50) NOT NULL,
                                    `ADDRESS` VARCHAR(150)  DEFAULT 'NONE',
                                    `DATE` DATE NOT NULL,
                                    `PHONE` VARCHAR(20)  UNIQUE NOT NULL,
                                    `AMOUNT` INT NOT NULL,
                                    PRIMARY KEY (`SID`))";

$D_Query = mysqli_query($Connect_DB, $D_Table);
if ($D_Query) {
    $date = date('Y-m-d');
    $DF_INSERT = "INSERT INTO `DONATION` (`F_NAME`,`L_NAME`, `EMAIL`, `D_INFO`,`D_TYPE`,`COUNTRY`,`CITY`, `ADDRESS`,`DATE`,`PHONE`,`AMOUNT`) VALUES('NONE','NONE','NONE','NONE','NONE','NONE','NONE','NONE','$date','NONE','NONE')";
    mysqli_query($Connect_DB, $DF_INSERT);
}
$check = 0;
$check1 = 0;


if (isset($_POST['D_Submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $d_info = $_POST['d_info'];
        $d_type = $_POST['d_type'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $amount = $_POST['amount'];
        $date = date('Y-m-d');

        $DTable_INSERT1 = "INSERT INTO `DONATION` (`F_NAME`,`L_NAME`, `EMAIL`, `D_INFO`,`D_TYPE`,`COUNTRY`,`CITY`, `ADDRESS`,`DATE`,`PHONE`,`AMOUNT`) VALUES('$f_name','$l_name','$email','$d_info','$d_type','$country','$city','$address','$date','$phone','$amount')";
        $RUN = mysqli_query($Connect_DB, $DTable_INSERT1);

        if($RUN)
        {
            // $_SESSION['status'] = "Account Created Successfully";
            $check = 1;
            // header("location: /Inventory/php/User_Table.php");

        }
        else
        {
            // $_SESSION['status'] = " Something Went Wrong! Please Try Again..";
            $check1 = 1;
            // header('Location: /Inventory/php/User_Table.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/apanel.css">
    
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
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

        @media screen and (max-width: 1040px) {

            div.dataTables_wrapper {
                width: 100%;
                margin: 0 auto;
                display: nowrap;
            }
        }
    </style> 
     <?php
      include '../partials/logo.php';
    ?>
    <title>Donation-Table</title>
</head>

<body class="bg-secondary" id="body-pd">
    <header>
        <?php
        include '../partials/u_side.php';

        if ($check == true) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Account Created Successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if ($check1 == true) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Something Went Wrong! Please Try Again..
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
    </header>

    <section>
    
        <!-- Modal 1 for insert with button -->
        <div class="bd-highlight mt-5 px-5">

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info hov btn-lg mx-2" data-bs-toggle="modal" data-bs-target="#insertModal" id="change_pass">
                    <i class="las la-plus-circle"></i>ADD
                </button>
                <a href="User_D_Excel.php"> <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info btn-lg hov">
                <i class="las la-list"></i>&nbspGenerate-Report
                </button></a>
            </div>

            <!-- Modal -->

            <div class="modal fade " id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content text-light bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertModalLabel"><strong>ADD-DONATION</strong></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                      
                            <form action="/Inventory/php/user_donation.php" method="POST">
                                <fieldset>
                                    <input type="hidden" name="snoEdit" id="snoEdit">
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your First Name*" class="form-control" id="f_name" name="f_name" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Last Name*" name="l_name" id="l_name" class="form-control" aria-describedby="nameHelp" required>
                                        </div>
                                       
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="email" placeholder="Your Email*" maxlength="40" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Country" name="country" class="form-control" id="country" name="country" aria-describedby="nameHelp" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your City" name="city" id="city" class="form-control" aria-describedby="nameHelp">
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Address" maxlength="100" class="form-control" id="address" name="address" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Info" placeholder="Select Donation Info*" name="d_info" id="d_info" required>
                                            <datalist id="Donation_Info">
                                                <option value="For Children Eduction">
                                                <option value="For Food">
                                        </div>
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Type" placeholder="Select Donation Type*" name="d_type" id="d_type" required>
                                            <datalist id="Donation_Type">
                                                <option value="Cash">
                                                <option value="PayPal">
                                                <option value="Easy Pasia">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Enter Phone No*" minlength="11" maxlength="18" class="form-control" id="phone" name="phone" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" placeholder=" Amount*" maxlength="40" class="form-control" id="amount" name="amount" required>
                                        </div>
                                    </div>

                                    <br>
                                    <HR>
                                    <div class="text-center">
                                        <button type="submit" NAME="D_Submit" class="btn btn-primary">ADD</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 for Update or Delete -->
        <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content text-light bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel"><strong>UPDATE-DONATION</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/Inventory/php/User_D_Script.php" method="POST">
                            <fieldset>
                                <input type="hidden" name="snoEdit1" id="snoEdit1">
                                <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your First Name*" class="form-control"  name="f_name1" id="f_name1" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Last Name*" name="l_name1" id="l_name1" class="form-control" aria-describedby="nameHelp" required>
                                        </div>
                                       
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="email" placeholder="Your Email*" maxlength="40" class="form-control" id="email1" name="email1" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Country" name="country1" class="form-control" id="country1" name="country" aria-describedby="nameHelp" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Your City" name="city1" id="city1" class="form-control" aria-describedby="nameHelp">
                                        </div>
                                        <div class="col">
                                            <input type="text" placeholder="Your Address" maxlength="100" class="form-control" id="address1" name="address1" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Info" placeholder="Select Donation Info*" name="d_info1" id="d_info1" required>
                                            <datalist id="Donation_Info">
                                                <option value="For Children Eduction">
                                                <option value="For Food">
                                        </div>
                                        <div class="col">
                                            <input class="form-control bg-light" list="Donation_Type" placeholder="Select Donation Type*" name="d_type1" id="d_type1" required>
                                            <datalist id="Donation_Type">
                                                <option value="Cash">
                                                <option value="PayPal">
                                                <option value="Easy Pasia">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <input type="text" placeholder="Enter Phone No*" minlength="11" maxlength="18" class="form-control" id="phone1" name="phone1" required>
                                        </div>
                                        <div class="col">
                                            <input type="number" placeholder=" Amount*" maxlength="40" class="form-control" id="amount1" name="amount1" required>
                                        </div>
                                    </div>
                                <br>
                                <HR>
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
           <div class="mx-3 my-5 py-2 text-center">
            <table class="table table-dark table-striped table-responsive text-light table-hover" style="width: 1000px;" id="myTable">
                <thead>
                    <tr>
                        <th scope="col"><small>SR#</small></th>
                        <th scope="col"><small>First Name</small></th>
                        <th scope="col"><small>Last Name</small></th>
                        <th scope="col"><small>Email</small></th>
                        <th scope="col"><small>Donation Info</small></th>
                        <th scope="col"><small>Donation Type</small></th>
                        <th scope="col"><small>Country</small></th>
                        <th scope="col"><small>City</small></th>
                        <th scope="col"><small>Address</small></th>
                        <th scope="col"><small>Date</small></th>
                        <th scope="col"><small>Phone No</small></th>
                        <th scope="col"><small>Donation Amount</small></th>
                        <th scope="col"><small>Action</small></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="table">
                        <div class="table table-striped table-responsive">
                            <?php
                                $sql1 = "SELECT *FROM `DONATION`";
                                $result1 = mysqli_query($Connect_DB, $sql1);
                                $form = 0;
                                if ($result1) {
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        $form += 1;
                                        echo "<tr>
                                            <th scope='row'><small>" . $form . "</small></th>
                                            <td><small>" . $row['F_NAME'] . "</small></td>
                                            <td><small>" . $row['L_NAME'] . "</small></td>
                                            <td><small>" . $row['EMAIL'] . "</small></td>
                                            <td><small>" . $row['D_INFO'] . "</small></td>
                                            <td><small>" . $row['D_TYPE'] . "</small></td>
                                            <td><small>" . $row['COUNTRY'] . "</small></td>
                                            <td><small>" . $row['CITY'] . "</small></td>
                                            <td><small>" . $row['ADDRESS'] . "</small></td>
                                            <td><small>" . $row['DATE'] . "</small></td>
                                            <td><small>" . $row['PHONE'] . "</small></td>
                                            <td><small>" . $row['AMOUNT'] . "</small></td>
                                            <td><i type='button' id=" . $row['SID'] . " class='edit las la-edit' ></i>&nbsp <i type='button' id=d" . $row['SID'] . " class='delete las la-trash'></i></td>
                                
                                        </tr>";
                                    }
                                }
                            ?>
                    </tbody>
                </div>
            </table>
        </div>

        <div class="text-center">
            <a href="/Inventory/php/user_panel.php"><button type="button" class="btn btn-outline-light text-dark mb-3"><strong>
            <i class="las la-arrow-alt-circle-left"></i>
            </strong></button></a>
        </div>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        
    <script>
            edits = document.getElementsByClassName('edit');
            Array.from(edits).forEach((element) => {
                element.addEventListener("click", (e) => {
                    tr = e.target.parentNode.parentNode;
                    // image = tr.getElementsByTagName("td")[0].innerText;
                    f_name = tr.getElementsByTagName("td")[0].innerText;
                    l_name = tr.getElementsByTagName("td")[1].innerText;
                    email = tr.getElementsByTagName("td")[2].innerText;
                    donation_info = tr.getElementsByTagName("td")[3].innerText;
                    donation_type = tr.getElementsByTagName("td")[4].innerText;
                    country = tr.getElementsByTagName("td")[5].innerText;
                    city = tr.getElementsByTagName("td")[6].innerText;
                    address = tr.getElementsByTagName("td")[7].innerText;
                    date = tr.getElementsByTagName("td")[8].innerText;
                    phone_number = tr.getElementsByTagName("td")[9].innerText;
                    amount_donated = tr.getElementsByTagName("td")[10].innerText;
                    f_name1.value = f_name;
                    l_name1.value = l_name;
                    email1.value = email;
                    d_info1.value = donation_info;
                    d_type1.value = donation_type;
                    country1.value = country;
                    city1.value = city;
                    address1.value = address;
                    phone1.value = phone_number;
                    amount1.value = amount_donated;
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
                        window.location = `/Inventory/php/User_D_Script.php?delete=${sno}`;
                    }

                })
            })
        </script>
        
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

    </section>
</body>

</html>


