<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['login_id'])) {
  header("location:login.php");
}
include('connection.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- cdns -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Nurse Clinic | Message Settings</title>
</head>
<body id="body-pd" style="background-color: #eef7fe;">
  <header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_img"> <img src="images/nurse.png" alt=""> </div>
  </header>
  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div> <a href="#" class="nav_logo"> <i class='bx bx-plus-medical'></i> <span class="nav_logo-name">Patient Reminder</span> </a>
        <div class="nav_list">
          <a href="index.php" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
          <a href="addpatient.php" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Add Patient</span> </a>
          <a href="schedules.php" class="nav_link"> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
          <a href="studentlist.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
          <a href="postponed.php" class="nav_link"> <i class='bx bx-message-square-x'></i> <span class="nav_name">Postponed Dates</span> </a>
          <a href="closeclinic.php" class="nav_link "> <i class='bx bx-calendar-x'></i> <span class="nav_name">Set Clinic Close</span> </a>
          <a href="msg_setting.php" class="nav_link active"> <i class='bx bx-slider'></i> <span class="nav_name">Message Settings</span> </a>
          <!--<a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
          <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> -->
        </div>
      </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
    </nav>
  </div>
  <!--Container Main start-->
  <br><br>
    
        <br><br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>

</body>
</html>