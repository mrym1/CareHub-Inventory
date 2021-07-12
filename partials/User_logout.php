<?php
session_start();
// session_unset();
session_destroy();
header("Location:/Inventory/php/User_login.php" );
exit();
?>