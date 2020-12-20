<?php
//Connect to database
require'connectDB.php';
$date = date("Y-m-d");
$output = '';

if(isset($_POST["To_Excel"])){
  
    if ( empty($_POST['date_sel'])) {

        $Start_date = date("Y-m-d");
    }
    else if ( !empty($_POST['date_sel'])) {

        $Start_date = $_POST['date_sel']; 
    }
    if ( empty($_POST['date_sel_end'])) {

        $End_date = date("Y-m-d");
    }
    else if ( !empty($_POST['date_sel_end'])) {

        $End_date = $_POST['date_sel_end']; 
    }
        $sql = "SELECT * FROM users_logs WHERE checkindate BETWEEN '$Start_date' AND '$End_date' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        if($result->num_rows > 0){
            $output .= '
                        <table class="table" bordered="1">  
                          <TR>
                            <TH>ID</TH>
                            <TH>Nama</TH>
                            <TH>No HP</TH>
                            <TH>ID Sidik Jari</TH>
                            <TH>Date In</TH>
                            <TH>Time In</TH>
                            <TH>Date Out</TH>
                            <TH>Time Out</TH>
                          </TR>';
              while($row=$result->fetch_assoc()) {
                  $output .= '
                              <TR> 
                                  <TD> '.$row['id'].'</TD>
                                  <TD> '.$row['username'].'</TD>
                                  <TD> '.$row['phone_number'].'</TD>
                                  <TD> '.$row['fingerprint_id'].'</TD>
                                  <TD> '.$row['checkindate'].'</TD>
                                  <TD> '.$row['timein'].'</TD>
                                  <TD> '.$row['checkoutdate'].'</TD>
                                  <TD> '.$row['timeout'].'</TD>
                              </TR>';
              }
              $output .= '</table>';
              header('Content-Type: application/xls');
              header('Content-Disposition: attachment; filename=User_Log'.$date.'.xls');
              
              echo $output;
              exit();
        }
        else{
            header( "location: UsersLog.php" );
            exit();
        }
}
?>