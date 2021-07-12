<?php
    include '../partials/db_conn.php';

    $sql = "SELECT *FROM `DONATION`";
    $result = mysqli_query($Connect_DB, $sql);

    $html = '<table><tr><td>SID</td><td>First Name</td><td>Last Name</td><td>Country</td><td>City</td><td>Address</td><td>Date</td><td>Donation_Info</td><td>Donation_Type</td><td>Phone</td><td>Amount</td><td>Email</td></tr>';

    if (mysqli_num_rows($result)) {
        if(mysqli_num_rows($result)>0){
            $i = 0;
                while($row=mysqli_fetch_assoc($result))
                {
                    $i += 1;
                    $html.='<tr><td>'.$i.'</td><td>'.$row['F_NAME'].'</td><td>'.$row['L_NAME'].'</td><td>'.$row['COUNTRY'].'</td><td>'.$row['CITY'].'</td><td>'.$row['ADDRESS'].'</td><td>'.$row['DATE'].'</td><td>'.$row['D_INFO'].'</td><td>'.$row['D_TYPE'].'</td><td>'.$row['PHONE'].'</td><td>'.$row['AMOUNT'].'</td><td>'.$row['EMAIL'].'</td></tr>';
                }
            $html.='</table>';
        }
    }

    // $html.='</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attachment;filename=Donation.xls');
    echo $html;


?>