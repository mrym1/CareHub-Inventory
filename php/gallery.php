<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location:/Inventory/php/login.php");
    exit;
}
include '../partials/db_conn.php';
$gallery_Table = "CREATE TABLE `Gallery`(`SID` INT(6) NOT NULL AUTO_INCREMENT,
                                  `image_url` text NOT NULL DEFAULT 'g6.jpeg',
                                 PRIMARY KEY (`SID`))";

$F_Table_Query = mysqli_query($Connect_DB, $gallery_Table);

$check = false;
$check = 0;
$check1 = 0;
$check2 = 0;
$check3 = 0;

if (isset($_GET['delete'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $sql = "SELECT * FROM `Gallery` WHERE `gallery`.`SID` = $_GET[delete]";
        $res = mysqli_query($Connect_DB,  $sql);
        $images = mysqli_fetch_assoc($res);
        $id = $images['SID'];
        $img = $images['image_url'];
        $err = "DELETE FROM `gallery` WHERE `gallery`.`SID` = $id";
        $run = mysqli_query($Connect_DB, $err);
        if ($err) {
            $FE = file_exists("../gallery/" . $img);
            if ($FE && $img <> "g6.jpeg" && $img <> "g5.jpeg" && $img <> "g4.jpeg") {
                unlink("../gallery/" . $img);
            }
            $check5 = 1;
            header("location:/Inventory/php/gallery.php");
        } else {
            $check3 = 1;
        }
    }
}
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $img_url1 = $_FILES['my_image'];
        // echo "<pre>";
        // print_r($_FILES['my_image']);
        // echo "</pre>";
        $img_name1 = $_FILES['my_image']['name'];
        $img_size1 = $_FILES['my_image']['size'];
        $tmp_name1 = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0 || $_FILES['my_image']['size'] == 0) {
            if ($img_size1 > 350000) { //200000KB => 200MB
                $check = 1;
            } else {
                $img_ex = pathinfo($img_name1, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../gallery/' . $new_img_name;
                    move_uploaded_file($tmp_name1, $img_upload_path);

                    // Insert into Database
                    $Gallery_FIRST_INSERT = "INSERT INTO Gallery (`image_url`) VALUES('$new_img_name')";
                    $err = mysqli_query($Connect_DB, $Gallery_FIRST_INSERT);
                    if ($err) {
                        $check1 = 1;
                    } else {
                        $check3 = 1;
                    }
                } else {
                    $check2 = 1;
                }
            }
        } else {
            $check3 = 1;
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
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    
    <link rel="stylesheet" href="../css/apanel.css">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
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
    <title>Gallery-Table</title>
</head>


<body style="font-family: 'Playfair', sans-serif;" id="body-pd" class="bg-secondary">
    <header>
        <?php
        if ($check) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Sorry, your file is too large.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if ($check1) {
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
            Successfully Updated<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if ($check2) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Dear You cant upload files of this type!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if ($check3) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Dear There have some Server issue please try again later!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
     
        ?>
    </header>
    <?php
    include('../partials/sidebar.php');
?>
    <main>
        <form action="/Inventory/php/gallery.php" class="d-flex justify-content-center" method="post" enctype="multipart/form-data">

            <div class="mb-3 text-center">
                <label for="formFile" class="form-label mt-2"><h2><strong><i>ADD NEW PICTURE</i></strong></h2></label>
                <div class="d-flex">
                    <input class="form-control  bg-dark text-light" type="file" id="my_image" name="my_image">
                    <input type="submit" class=" mx-2 fw-bold" name="submit" value="Upload">
                </div>
            </div>

        </form>

        <div class="d-flex justify-content-center flex-wrap p-3">
            <?php
            $sql = "SELECT * FROM `Gallery` ORDER BY `SID` DESC";
            $res = mysqli_query($Connect_DB,  $sql);

            if (mysqli_num_rows($res) > 0) {
                while ($images = mysqli_fetch_assoc($res)) {
                    // $count = $images['SID'];
                    echo '<div class="card text-center bg-dark m-2 " style="width: 273px;">
                            <input type="hidden" name="sid" id=' . $images['image_url'] . '>
                            <img src="../gallery/' . $images['image_url'] . '" class="card-img-top" style="height:200px; width:273px;" alt="...">
                            <div class="card-body"><button type="button" name="delete" class="btn btn-info  delete" id=' . $images['SID'] . '><i>Delete</i></button>
                            </div>
                        </div>';
                }
            } ?>
        </div>

    </main>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log(e.target.id.substr(1, ));
                sno = e.target.id;
                console.log(sno);
                if (confirm("You want to delete this record?")) {
                    window.location = `/Inventory/php/gallery.php?delete=${sno}`;
                }

            })
        })
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>