<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Users Logs</title>
<link rel="stylesheet" type="text/css" href="css/userslog.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script> 

<script src="js/user_log.js"></script>
<script>
  $(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>

<script>
  $(document).ready(function(){
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 1,
        }
      });
    setInterval(function(){
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 0,
        }
        }).done(function(data) {
          $('#userslog').html(data);
        });
    },5000);
  });
</script>
</head>
<body>
<?php include'header.php'; ?> 
<main>
  <section>
  <!--User table-->
  <h1 class="slideInDown animated">Here are the Users daily logs</h1>
  	<div class="form-style-5 slideInDown animated">
  		<form method="POST" action="Export_Excel.php">
                      <label for="Start-Date"><b>Select from this Date:</b></label>
                      <input type="date" name="date_sel" id="date_sel">
                      <label for="End -Date"><b>To End of this Date:</b></label>
                      <input type="date" name="date_sel_end" id="date_sel_end">
                     <button type="button" name="user_log" id="user_log">Select Date</button> 
  			<input type="submit" name="To_Excel" value="Export to Excel">
  		</form>
  	</div>
  <div class="tbl-header slideInRight animated">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone Number</th>
          <th>Fingerprint ID</th>
          <th>Date In</th>
          <th>Time IN</th>
          <th>Date Out</th>
          <th>Time Out</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content slideInRight animated">
    <div id="userslog"></div>
  </div>
</section>
</main>
</body>
</html>
