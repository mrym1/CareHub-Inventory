<?php
session_start();
include '../partials/db_conn.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location:/inventory/php/login.php");
    exit;
}

$Table = "CREATE TABLE `CONTACT_US`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                  `EMAIL` VARCHAR(25) UNIQUE DEFAULT 'NONE',
                                  `COUNTRY` VARCHAR(50) NOT NULL DEFAULT 'NONE',
                                  `MSG` VARCHAR(255) NOT NULL DEFAULT 'NONE',
                                  PRIMARY KEY (`SID`))";
$Query = mysqli_query($Connect_DB, $Table);
$check = 0;
if (isset($_POST['form_submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['_email'];
        $country = $_POST['_country'];
        $msg = $_POST['_msg'];
        $INSERT = "INSERT INTO CONTACT_US (`EMAIL`,`COUNTRY`,`MSG`) VALUES('$email','$country','$msg')";
        $err = mysqli_query($Connect_DB, $INSERT);
        header("Location:/Inventory/index.php");
        if (!$err) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Lost Server Connection! TRY AGAIN LATER.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
         
        }
    }
}

if (isset($_POST['_submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['_email'];
        $country = $_POST['_country'];
        $msg = $_POST['_msg'];
        $INSERT = "INSERT INTO CONTACT_US (`EMAIL`,`COUNTRY`,`MSG`) VALUES('$email','$country','$msg')";
        $err = mysqli_query($Connect_DB, $INSERT);
        if (!$err) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../css/apanel.css">
	<link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                // "scrollX": true
            });
        });
    </script>
    <!-- <style>
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
    </style> -->
    <?php
      include '../partials/logo.php';
    ?>
    <title>Contact Us Report</title>
</head>

<body class="bg-secondary">
<?php
		include('../partials/sidebar.php');
	?>
    <header>
        <?php
        // include "partials/nav.php";
        if ($check) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Lost Server Connection! TRY AGAIN LATER.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
        ?>
    </header>
    <main>
        <!-- modal 1 -->
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contact Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/Inventory/php/contact.php" method="POST">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email*" id="_email" name="_email" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" list="datalistOptions" id="_country" name="_country" placeholder="Enter Your Country...">
                                <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                                </datalist>
                            </div>
                            <div class="mb-3">
                            <textarea class="form-control" id="_msg" name="_msg" rows="3" placeholder="Type Your Msg here..."></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="_submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal 1 -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/Inventory/php/D_Contact.php" method="POST">
                            <input type="hidden" name="snoEdit" id="snoEdit">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email*" id="_email1" name="_email1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <input class="form-control" list="datalistOptions" id="_country1" name="_country1" placeholder="Enter Your Country...">
                                <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                                </datalist>
                            </div>
                            <div class="mb-3">
                            <textarea class="form-control" id="_msg1" name="_msg1" rows="3" placeholder="Type Your Msg here..."></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="_submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info hov btn-lg mx-2 m-5 me-5" data-bs-toggle="modal" data-bs-target="#exampleModal" id="change_pass">
                    <i class="las la-plus-circle"></i>ADD
                </button>
            </div>
        
        <div class=" d-flex justify-content-center p-2 m-5 rounded">
            <div class="bf-info">
                <table class="table table-dark table-striped table-responsive" style="width: 1000px;" id="myTable">
                    <!-- #SR Username Iteam Name Date Description Quantity Estimated Cost -->

                    <thead>
                        <tr>
                            <th scope="col"><small>SR#</small></th>
                            <th scope="col"><small>Email</small></th>
                            <th scope="col"><small>Country</small></th>
                            <th scope="col"><small>Message</small></th>
                            <th scope="col"><small>Action</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="table">
                            <?php
                            $sql1 = "SELECT *FROM `CONTACT_US`";
                            $result1 = mysqli_query($Connect_DB, $sql1);
                            $num = 0;
                            $form = 0;
                            if ($result1) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $form += 1;
                                    echo "<tr>
                                <th scope='row'><small>" . $form . "</small></th>
                                <td><small>" . $row['EMAIL'] . "</small></td>
                                <td><small>" . $row['COUNTRY'] . "</small></td>
                                <td><small>" . $row['MSG'] . "</small></td>
                                <td><i type='button' id=" . $row['SID'] . " class='edit las la-edit' ></i>&nbsp <i type='button' id=d" . $row['SID'] . " class='delete las la-trash'></i></td>
                                
                                </tr>";
                                }
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script>
        edits = document.getElementsByClassName('edit');
        // console.log(edits);
        // <!-- #SR Username Iteam Name Date Description Quantity Estimated Cost -->
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                email = tr.getElementsByTagName("td")[0].innerText;
                country = tr.getElementsByTagName("td")[1].innerText;
                msg = tr.getElementsByTagName("td")[2].innerText;
                _email1.value = email;
                _country1.value = country;
                _msg1.value = msg;
                snoEdit.value = e.target.id;
                $('#editModal').modal('toggle');
            })
        })
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id.substr(1, );
                if (confirm("You want to delete this record?")) {
                    window.location = `/Inventory/php/D_Contact.php?delete=${sno}`;
                }

            })
        })
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>