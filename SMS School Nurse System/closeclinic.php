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
    <title>Nurse Clinic | Set Clinic Close</title>
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
          <a href="closeclinic.php" class="nav_link active"> <i class='bx bx-calendar-x'></i> <span class="nav_name">Set Clinic Close</span> </a>
          <a href="msg_setting.php" class="nav_link"> <i class='bx bx-slider'></i> <span class="nav_name">Message Settings</span> </a>
          <!--<a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
          <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> -->
        </div>
      </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
    </nav>
  </div>
  <!--Container Main start-->
  <br><br>
    <div class="close-clinic">
        <h3>Set Clinic Close</h3>
        <p>If you set the date for clinic to be closed it will message all the patient scheduled that day that their checkup will be postponed.</p>
        <form action="functions.php" method="POST">
            <div class="mb-3">
            <label for="date1" class="form-label">Set Date for Closing</label>
            <input type="date" class="form-control" id="date1" name="date1" >
            </div>
            <div class="mb-3">
            <label for="date2" class="form-label">Set Date for Rescheduling</label>
            <input type="date" class="form-control" id="date2" name="date2"  >
            </div>
            <div class="mb-3">
                <label for="">Message</label>
                <?php 
                    $querys = "SELECT * FROM sms WHERE id=2";
                    $results = $conn->query($querys);
                    while ($rows = mysqli_fetch_array($results)) {
                ?>
                <textarea readonly class="form-control" name="composemsg" id="" cols="30" rows="5" value="<?php echo $rows['msg']; ?>"><?php echo $rows['msg']; ?></textarea>
            </div>

            <div class="mt-3">
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $rows['id']?>">
                Edit Message
            </button>
             <!-- Edit Modal -->
             <div class="modal fade" id="editModal<?php echo $rows['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <textarea required class="form-control" name="msg" id="" cols="30" rows="5" value="<?php echo $rows['msg']; ?>"><?php echo $rows['msg']; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="editMsgclinic">Edit</button>
                </div>
                </div>
            </div>
            </div>
            <?php };?>
            <br>
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Set clinic close
            </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to set the clinic close to the date you input?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="dateCancel">Yes</button>
                </div>
                </div>
         
            </div>
            </div>

        </form>
        </div>
        <br><br>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>

</body>
</html>