<?php
include '../partials/db_conn.php';

if(isset($_GET['delete']))
{
    $sno = $_GET['delete'];
    echo $sno;
    $sql2 = "DELETE FROM `DONATION` WHERE `DONATION`.`SID` = $sno";
    $result2 = mysqli_query($Connect_DB,$sql2);
    if($result2)
    {
        header("location:/Inventory/php/user_donation.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['snoEdit1']))
    {
        $SNO = $_POST['snoEdit1'];
        $F_NAME = $_POST['f_name1'];
        $L_NAME = $_POST['l_name1'];
        $EMAIL  = $_POST['email1'];
        $DONATION_INFO  = $_POST['d_info1'];
        $DONATION_TYPE  = $_POST['d_type1'];
        $COUNTRY = $_POST['country1'];
        $CITY = $_POST['city1'];
        $ADDRESS  = $_POST['address1'];
        $PHONE_NUMBER  = $_POST['phone1'];
        $AMOUNT_DONATE  = $_POST['amount1'];

        $query = "UPDATE `DONATION` SET `F_NAME` = '$F_NAME', `L_NAME` = '$L_NAME', `EMAIL` = '$EMAIL', `D_INFO` = '$DONATION_INFO',`D_TYPE` = '$DONATION_TYPE', `COUNTRY` = '$COUNTRY',`CITY` = '$CITY', `ADDRESS` = '$ADDRESS', `PHONE` = '$PHONE_NUMBER', `AMOUNT` = '$AMOUNT_DONATE' WHERE `DONATION`.`SID` = $SNO";
        $result = mysqli_query($Connect_DB,$query);

        if ($result)
        {
            header("location:/Inventory/php/user_donation.php");
        }

    }
}
?>