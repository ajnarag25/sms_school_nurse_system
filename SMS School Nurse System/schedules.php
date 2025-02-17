<!DOCTYPE html>
<html lang="en">

<?php include('connection.php'); 

if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }

    $num_per_page = 15;
    $start_from = ($page-1)*15;

?>


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

<style>
  .no-result-div {
  display: none;
}
  @media print{
    body *{
      visibility: hidden;
    }
    .print-container, .print-container *{
      visibility: visible;
    }
  }
</style>

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
          <a href="schedules.php" class="nav_link active"> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
          <a href="studentlist.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
          <a href="postponed.php" class="nav_link"> <i class='bx bx-message-square-x'></i> <span class="nav_name">Postponed Dates</span> </a>
          <a href="closeclinic.php" class="nav_link"> <i class='bx bx-calendar-x'></i> <span class="nav_name">Set Clinic Close</span> </a>
          <a href="msg_setting.php" class="nav_link"> <i class='bx bx-slider'></i> <span class="nav_name">Message Settings</span> </a>
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
      <h1>Schedules</h1>
      <h5>Schedule history of patients</h5>
      <div class="table-container  mt-4 bg-body p-4">
        <div class="tableData overflow-auto">
        <button class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#clearAll">Clear All</button>
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exportCsv">Export</button>
        <button class="btn btn-secondary" onclick="window.print()"><i class='bx bxs-printer' ></i> Print</button>
        <br><br>
        <div class="input-group w-50" >
              <input type="search" class="form-control rounded"  placeholder="Search" onkeyup="searchUsers()" id="searchUsers" />
              <button type="submit" class="btn btn-outline-primary"><i class='bx bx-search nav_icon'></i></button>
        </div>  
        <br><br>
          <?php
          $query = "SELECT * from patient ORDER BY time DESC limit $start_from,$num_per_page";
          $result = mysqli_query($conn, $query);
          $count = mysqli_num_rows($result);
          $i = 1;
          if ($count > 0) { ?>
            <table class="table table-hover print-container " id="myTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">I.D</th>
                  <th scope="col">First</th>
                  <th scope="col">Middle</th>
                  <th scope="col">Last</th>
                  <th scope="col">Sex</th>
                  <th scope="col">Check-up Date</th>
                  <th scope="col">Diagnose</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($result)) { ?>
                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['studentId'] ?></td>
                    <td><?php echo $row['firstName'] ?></td>
                    <td><?php echo $row['middleName'] ?></td>
                    <td><?php echo $row['lastName'] ?></td>
                    <td><?php echo $row['sex'] ?></td>
                    <td><?php echo $row['date'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <?php if ($row['status'] == "PENDING") { ?>
                      <td><span class="badge bg-warning"><?php echo $row['status'] ?></span></h3>
                      </td>
                    <?php } else if ($row['status'] == "CANCEL") { ?>
                      <td><span class="badge bg-danger">DID NOT VISIT</span></h3>
                      </td>
                    <?php } else if ($row['status'] == "POSTPONED") { ?>
                      <td><span class="badge bg-secondary">POSTPONED</span></h3>
                      </td>
                    <?php } else { ?>
                      <td><span class="badge bg-success"><?php echo $row['status'] ?></span></h3>
                      </td>
                    <?php } ?>
                    <td><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'] ?>">Delete</button></td>

                     <!-- Modal Delete-->
                      <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure you want to delete this?</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" href="functions.php?deleteSched=<?php echo $row["id"] ?>">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      
                  <!-- Modal Export-->
                  <div class="modal fade" id="exportCsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Export all Data?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="functions.php" method="POST" enctype="multipart/form-data">
                          <div class="modal-body text-center">
                          <button type="button" style="width: 150px" class="btn btn-secondary" data-bs-dismiss="modal">Not now</button>
                          <button type="submit" style="width: 150px" id="submit" name="Export" class="btn btn-success button-loading">Yes</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

                  </tr>
                <?php $i++;
                }; ?>
              </tbody>
            </table>
            <div class="no-result-div mt-4 text-center" id="no-search">
              <div class="div">
                <img src="images/search.svg" width="150" height="150" alt="">
                <h4 class="mt-3">Search not found...</h4>
              </div>
            </div>
          <?php  } else { ?>
            <center>
              <h5 class="mt-5">No schedule data.</h5>
            </center>
          <?php }; ?>
        </div>
      </div>
      <?php 
              $pr_query = "select * from patient ";
              $pr_result = mysqli_query($conn,$pr_query);
              $total_record = mysqli_num_rows($pr_result );
              
              $total_page = ceil($total_record/$num_per_page);

              ?>
              <br><br>
              <center>
                <?php
                  if($page>1)
                  {
                      echo "<a href='schedules.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                  }

                  
                  for($i=1;$i<$total_page;$i++)
                  {
                      echo "<a href='schedules.php?page=".$i."' class='btn btn-primary'>$i</a>";
                  }

                  if($i>$page)
                  {
                      echo "<a href='schedules.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                  }
                ?>
              </center>
              <br><br>
              <?php
          ?>
    </div>

  </div>
  

  <!-- Modal Clear All-->
  <div class="modal fade" id="clearAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete All Schedule Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to clear all data?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="functions.php" method="POST">
              <button class="btn btn-danger" name="clearAll">Delete All</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>
  <script src="js/search.js"></script>
</body>

</html>