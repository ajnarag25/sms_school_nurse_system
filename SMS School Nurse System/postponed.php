<!DOCTYPE html>
<html lang="en">

<?php include('connection.php'); ?>

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- cdns -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
      <link rel="stylesheet" href="css/styles.css">
      <title>Nurse Clinic | Schedules</title>
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
                              <a href="schedules.php" class="nav_link "> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
                              <a href="studentlist.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
                              <a href="postponed.php" class="nav_link active"> <i class='bx bx-message-square-x'></i> <span class="nav_name">Postponed Dates</span> </a>
                              <!-- <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Bookmark</span> </a>
          <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a>
          <a href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> -->
                        </div>
                  </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
            </nav>
      </div>
      <!--Container Main start-->
      <div class="height-100">
            <div class="content-title">
                  <br>
                  <h1>Postponed Check-up</h1>
                  <h5>Patient Info</h5>
                  <div class="table-container  mt-4 bg-body p-4">
                        <div class="tableData overflow-auto">
                              <?php
                              $query = "SELECT * FROM postponed_dates ORDER BY date DESC";
                              $result = mysqli_query($conn, $query);
                              $count = mysqli_num_rows($result);
                              $i = 1;
                              ?>
                              <table class="table table-hover">
                                    <thead>
                                          <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Lastname</th>
                                                <th scope="col">Firstname</th>
                                                <th scope="col">Middlename</th>
                                                <th scope="col">Yr & Section</th>
                                                <th scope="col">Diagnose</th>
                                                <th scope="col">Postpone Date</th>
                                                <th scope="col">Reschedule Date</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php while ($row = mysqli_fetch_array($result)) { ?>
                                                <tr>
                                                      <th scope="row"><?php echo $i ?></th>
                                                      <th><?php echo date('l', strtotime($row['date'])); ?></th>
                                                      <td><?php echo $row['date'] ?></td>
                                                </tr>
                                          <?php $i++;
                                          }; ?>
                                    </tbody>
                              </table>
                        </div>
                  </div>

            </div>

      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
      <script src="js/app.js"></script>
</body>

</html>