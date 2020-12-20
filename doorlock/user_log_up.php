<?php  
session_start();
?>
<table cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <?php
      //Connect to database
      require'connectDB.php';

      if (isset($_POST['log_date'])) {
        if ($_POST['date_sel'] != 0) {
            $_SESSION['seldate'] = $_POST['date_sel'];
        }
        else{
            $_SESSION['seldate'] = date("Y-m-d");
        }
      }
      if (isset($_POST['log_date2'])) {
      if ($_POST['date_sel_end'] != 0) {
              $_SESSION['seldateend'] = $_POST['date_sel_end'];
          }
       else{
            $_SESSION['seldateend'] = date("Y-m-d");
        }
      }
      if ($_POST['select_date'] == 1) {
          $_SESSION['seldate'] = date("Y-m-d");
      }
      else if ($_POST['select_date'] == 0) {
          $seldate = $_SESSION['seldate'];
          $seldateend = $_SESSION['seldateend'];
         //echo $seldate;
          //echo $seldateend;
      }
      $sql = "SELECT * FROM users_logs WHERE checkindate BETWEEN '$seldate' AND '$seldateend' ORDER BY id DESC";
      $result = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($result, $sql)) {
          echo '<p class="error">SQL Error</p>';
      }
      else{
        mysqli_stmt_execute($result);
          $resultl = mysqli_stmt_get_result($result);
        if (mysqli_num_rows($resultl) > 0){
            while ($row = mysqli_fetch_assoc($resultl)){
      ?>
                  <TR>
                  <TD><?php echo $row['id'];?></TD>
                  <TD><?php echo $row['username'];?></TD>
                  <TD><?php echo $row['phone_number'];?></TD>
                  <TD><?php echo $row['fingerprint_id'];?></TD>
                  <TD><?php echo $row['checkindate'];?></TD>
                  <TD><?php echo $row['timein'];?></TD>
                  <TD><?php echo $row['checkoutdate'];?></TD>
                  <TD><?php echo $row['timeout'];?></TD>
                  </TR>
    <?php
            }   
        }
      }
    ?>
  </tbody>
</table>
