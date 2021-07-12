<?php
include '../partials/db_conn.php';
if(isset($_GET['delete']))
{
    $sno = $_GET['delete'];
    echo $sno;
    $sql2 = "DELETE FROM `CONTACT_US` WHERE `CONTACT_US`.`SID` = $sno";
    $result2 = mysqli_query($Connect_DB,$sql2);
    if($result2)
    {
        header("location:/Inventory/php/contact.php");
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if(isset($_POST['snoEdit']))
{
    $SNO = $_POST['snoEdit'];
    $EMAIL  = $_POST['_email1'];
    $COUNTRY  = $_POST['_country1'];
    $MSG  = $_POST['_msg1'];
    echo $SNO;
    $sql = "UPDATE `CONTACT_US` SET `EMAIL` = '$EMAIL', `COUNTRY` = '$COUNTRY', `MSG` = '$MSG' WHERE `CONTACT_US`.`SID` = $SNO";
    $result = mysqli_query($Connect_DB,$sql);
    if ($result)
    {
        header("location:/Inventory/php/contact.php");
    }
    else
    {
        header("location:/Inventory/php/contact.php");
    }

}
}
?>