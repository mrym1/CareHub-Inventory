<?php
 session_start();
include '../partials/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['snoEdit1']))

    {   
        
        $SNO = $_POST['snoEdit1'];

        $F_NAME = $_POST['f_name1'];
        $L_NAME = $_POST['l_name1'];
        $USERNAME = $_POST['username1'];
        $PASSWORD  = $_POST['password1'];
        $PIN  = $_POST['pin1'];
        $DOB1 = $_POST['DOB1'];
        $CONTACT  = $_POST['contact1'];
        $PROVINCE = $_POST['province1'];
        $CITY = $_POST['city1'];
        $ADDRESS = $_POST['address1'];
        $GENDER  = $_POST['gender1'];
        $EMAIL  = $_POST['email1'];
        //  $IMAGE = $_FILES['image1'];

        // $msg = "";
        // $IMAGE = $_FILES['image1']['name'];
        // // $target = "images/".basename($IMAGE);

        // if (move_uploaded_file($_FILES['_Image']['tmp_name'], "uploads/".$_FILES["_Image"]["name"]);) {
        // 	$msg = "Image uploaded successfully";
        // }else{
        // 	$msg = "Failed to upload image";
        // }


        echo $SNO;
        $sql = "UPDATE `USER` SET `F_NAME` = '$F_NAME', `L_NAME` = '$L_NAME', `USERNAME` = '$USERNAME', `PASSWORD` = '$PASSWORD', `PIN_CODE` = '$PIN', `DOB` = '$DOB1', `CONTACT` = '$CONTACT', `PROVINCE` = '$PROVINCE', `CITY` = '$CITY', `ADDRESS` = '$ADDRESS', `GENDER` = '$GENDER', `EMAIL` = '$EMAIL' WHERE `USER`.`SID` = $SNO";
        $result = mysqli_query($Connect_DB,$sql);
        if ($result)
        {
            header("location: /Inventory/php/User_Table.php");
        }
        else
        {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Something went wrong!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        
        }

    }
}

// Delete Row
if(isset($_GET['delete']))
{
    $sno = $_GET['delete'];
    echo $sno;
    $sql2 = "DELETE FROM `USER` WHERE `USER`.`SID` = $sno";
    $result2 = mysqli_query($Connect_DB,$sql2);
    if($result2)
    {   
        // unlink('../uploads/'.$IMAGE);
        $_SESSION['status'] = "Account Deleted Successfully";
        header("location: /Inventory/php/User_Table.php");
    }
    else{
        $_SESSION['status'] = "Account Did Not Deleted";
        header("location: /Inventory/php/User_Table.php");

    }
}

?>