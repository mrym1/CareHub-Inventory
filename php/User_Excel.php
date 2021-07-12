<?php
    include '../partials/db_conn.php';

    $sql1 = "SELECT *FROM `USER`";
    $result1 = mysqli_query($Connect_DB, $sql1);

    $html = '<table><tr><td>SID</td><td>First Name</td><td>Last Name</td><td>UserName</td><td>Password</td><td>PinCode</td><td>Age</td><td>Contact</td><td>Province</td><td>City</td><td>Address</td><td>Gender</td><td>Email</td></tr>';

    if (mysqli_num_rows($result1)) {
        if(mysqli_num_rows($result1)>0){
            $i = 0;
                while($row=mysqli_fetch_assoc($result1))
                {
                    $i += 1;
                    $html.='<tr><td>'.$i.'</td><td>'.$row['F_NAME'].'</td><td>'.$row['L_NAME'].'</td><td>'.$row['USERNAME'].'</td><td>'.$row['PASSWORD'].'</td><td>'.$row['PIN_CODE'].'</td><td>'.$row['DOB'].'</td><td>'.$row['CONTACT'].'</td><td>'.$row['PROVINCE'].'</td><td>'.$row['CITY'].'</td><td>'.$row['ADDRESS'].'</td><td>'.$row['GENDER'].'</td><td>'.$row['EMAIL'].'</td></tr>';
                }
            $html.='</table>';
        }
    }

    // $html.='</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=Users.xls');
    echo $html;


?>