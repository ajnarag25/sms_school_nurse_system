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
    <title>Nurse Clinic | Patients</title>
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
          <a href="index.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
          <a href="addpatient.php" class="nav_link"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Add Patient</span> </a>
          <a href="schedules.php" class="nav_link"> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
          <a href="studentlist.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
          <a href="postponed.php" class="nav_link"> <i class='bx bx-message-square-x'></i> <span class="nav_name">Postponed Dates</span> </a>
          <a href="closeclinic.php" class="nav_link"> <i class='bx bx-calendar-x'></i> <span class="nav_name">Set Clinic Close</span> </a>
          <!--<a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
          <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> -->
        </div>
      </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
    </nav>
  </div>
  <!--Container Main start-->
  <br><br>
    <div class="col">
        <div class="sched-today">
        <h3>Scheduled for today</h3>
        <div class="tableData overflow-auto">
            <?php
            $query = "SELECT * FROM patient ORDER BY time ASC";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            $i = 1;
            if ($count > 0) { ?>
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Time</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

                <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <?php $date = new DateTime("now", new DateTimeZone('Asia/Manila'));
                    $d = $date->format('Y-m-d');

                    if ($d == $row['date'] && $row['status'] == 'PENDING') {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $row['firstName'] . " " . $row['lastName'] ?></td>
                        <td><?php echo $row['contact_no'] ?></td>
                        <td><?php echo $row['time'] ?></td>
                        <td>
                        <a class="btn btn-outline-success" href="functions.php?done=<?php echo $row["id"] ?>">Done</a>
                        <a class="btn btn-outline-danger" href="functions.php?cancel=<?php echo $row["id"] ?>">Did not visit</a>
                        <a class="btn btn-outline-primary" href="functions.php?sendMsg=<?php echo $row['firstName'];?>">Send</a>
                        <a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#compose<?php echo $row['id'] ?>">Edit Message</a>
                        </td>
                    </tr>
                        <!-- Modal Compose Message-->
                        <div class="modal fade" id="compose<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="functions.php" method="POST">
                          <div class="modal-dialog">
                              <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <?php 
                                    $querys = "SELECT * FROM sms WHERE id=1";
                                    $results = $conn->query($querys);
                                    while ($rows = mysqli_fetch_array($results)) {
                                ?>
                                  <p>Compose Message for <?php echo $row['firstName']?>:</p>
                                  <textarea class="form-control" name="msg" id="" cols="30" rows="5" value="<?php echo $rows['msg']; ?>"><?php echo $rows['msg']; ?></textarea>
                                  <?php };?>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-success" name="editMsg">Edit</button>
                              </div>
                              </div>
                          </div>
                        </form>
                        </div>
                <?php $i++;
                    };
                }; ?>
                </tbody>
            </table>
              <?php  } else { ?>
                <center>
                  <h5 class="mt-5">No schedule for today</h5>
                </center>
              <?php }; ?>
            </div>

            <a href="schedules.php" class="btn btn-primary mt-4 w-100">See All Schedule</a>
          </div>
        </div>
      </div>
    </div>
    


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>

</body>
</html>