<?php  
//Connect to database
require 'connectDB.php';

if (isset($_GET['FingerID'])) {
    
    $fingerID = $_GET['FingerID'];

   // echo .$Number;
    $sql = "SELECT * FROM users WHERE fingerprint_id=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_card";
        exit();
    }
    else{

        mysqli_stmt_bind_param($result, "s", $fingerID);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){
         
            //*****************************************************
            //An existed fingerprint has been detected for Login or Logout
            if ($row['username'] != "Name"){
                $Uname = $row['username'];
                $Number = $row['phone_number'];
                $sql = "SELECT * FROM users_logs WHERE  fingerprint_id=? AND checkindate=CURDATE() AND timeout=0";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_logs";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $fingerID);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //*****************************************************
                    //Login
                    if (!$row = mysqli_fetch_assoc($resultl)){

                        $sql = "INSERT INTO users_logs (username, phone_number, fingerprint_id, checkindate, timein, timeout) VALUES (? ,?, ?, CURDATE(), CURTIME(), ?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_login1";
                            exit();
                        }
                        else{
                            $timeout = "0";
                            mysqli_stmt_bind_param($result, "ssis", $Uname, $Number, $fingerID, $timeout);
                            mysqli_stmt_execute($result);

                            echo "login".$Uname;

                            exit();
                        }
                    }
                    //*****************************************************
                    //Logout
                    else{
                        $sql="UPDATE users_logs SET timeout=CURTIME(), checkoutdate=CURDATE() WHERE fingerprint_id=? AND timeout=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_logout1";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $fingerID);
                            mysqli_stmt_execute($result);

                            echo "logout".$Uname;
                            exit();
                        }
                    }
                }
            }
            //*****************************************************
            //An available Fingerprint has been detected
            else{
                $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    
                    if ($row = mysqli_fetch_assoc($resultl)) {
                        $sql="UPDATE users SET fingerprint_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);

                            $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_insert_An_available_card";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "i", $fingerID);
                                mysqli_stmt_execute($result);

                                echo "available";
                                exit();
                            }
                        }
                    }
                    else{
                        $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_An_available_card";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $finger_sel, $fingerID);
                            mysqli_stmt_execute($result);

                            echo "available";
                            exit();
                        }
                    }
                }
            }
        }
        //*****************************************************
        //New Fingerprint has been added
        else{
            $Uname = "Name";
            $Number = "000000";
            $Email= " Email";

            $Pass = "08";
            $Gender= "Gender";


            $sql="UPDATE users SET fingerprint_select=0";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_insert";
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                $sql = "INSERT INTO users ( username, phone_number, gender, email, password, fingerprint_id, fingerprint_select, user_date, add_fingerid) VALUES (?, ?, ?, ?, ?, ?, 1, CURDATE(), 0)";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_add";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "ssssis", $Uname, $Number, $Gender, $Email, $fingerID, $Pass );
                    mysqli_stmt_execute($result);

                    echo "succesful1";
                    exit();
                }
            }
        }
    }
}
if (isset($_GET['Get_Fingerid'])) {
    
    if ($_GET['Get_Fingerid'] == "get_id") {
        $sql= "SELECT fingerprint_id FROM users WHERE add_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                echo "add-id".$row['fingerprint_id'];
                exit();
            }
            else{
                echo "Nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}

if (!empty($_GET['confirm_id'])) {

    $fingerid = $_GET['confirm_id'];

    $sql="UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        
        $sql="UPDATE users SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "s", $fingerid);
            mysqli_stmt_execute($result);
            echo "Fingerprint has been added!";
            exit();
        }
    }  
}
if (isset($_GET['pass'])) {

    $Pass = $_GET['pass'];
    $sql="SELECT * FROM users WHERE password='$Pass'";
$result=mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      echo  $row["password"];
       echo  $row["fingerprint_id"];
  
}
}
}
if (isset($_GET['user'])) {

    $Pass = $_GET['user'];
   $fingerids= $Pass;
    $sql="SELECT * FROM users WHERE fingerprint_id='$Pass'";
$result=mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      echo  $row["fingerprint_id"];
      $fingerids=$row["fingerprint_id"];
}
}
}
if (isset($_GET['userid'])) {

    $Pass = $_GET['userid'];
   $fingerids= $Pass;
    $sql="SELECT * FROM users WHERE fingerprint_id='$Pass'";
$result=mysqli_query($conn,$sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {    
      echo  $row["fingerprint_id"];
      $fingeridss=$row["fingerprint_id"];
}
}
}

if (isset($_GET['DeleteID'])) {

    if ($_GET['DeleteID'] == "check") {
        $sql = "SELECT fingerprint_id FROM users WHERE del_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                
                echo "del-id".$row['fingerprint_id'];

                $sql = "DELETE FROM users WHERE del_fingerid=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_delete";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    exit();
                }
            }
            else{
                echo "nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>
