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
          <a href="index.php" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
          <a href="schedules.php" class="nav_link"> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
          <a href="patients.php" class="nav_link active"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
          <a href="postponed.php" class="nav_link"> <i class='bx bx-message-square-x'></i> <span class="nav_name">Postponed Dates</span> </a>
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
      <h1>Clinic Patients</h1>
      <h5>ISU Clinic patients</h5>
      <div class="table-container  mt-4 bg-body p-4">
        <div class="tableData overflow-auto">
          <?php
          $query = "SELECT * FROM patient";
          $result = mysqli_query($conn, $query);
          $count = mysqli_num_rows($result);
          $i = 1;
          if ($count > 0) { ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">I.D</th>
                  <th scope="col">First</th>
                  <th scope="col">Middle</th>
                  <th scope="col">Last</th>
                  <th scope="col">Birthday</th>
                  <th scope="col">Sex</th>
                  <th scope="col">Age</th>
                  <th scope="col">Contact No.</th>
                  <th scope="col">Email Address</th>
                  <th scope="col">Section</th>
                  <th scope="col">Course</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['studentId'] ?></td>
                    <td><?php echo $row['firstName'] ?></td>
                    <td><?php echo $row['middleName'] ?></td>
                    <td><?php echo $row['lastName'] ?></td>
                    <td><?php echo $row['birthday'] ?></td>
                    <td><?php echo $row['sex'] ?></td>
                    <td><?php echo $row['age'] ?></td>
                    <td><?php echo $row['contact_no'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['section'] ?></td>
                    <td><?php echo $row['course'] ?></td>
                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $row['id'] ?>">Edit</button>
                      <br>
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $row['id'] ?>">Delete</button>
                    </td>
                  </tr>
                  <div class="modal fade" id="edit<?php echo $row['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="functions.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $row['firstName'] ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $row['lastName'] ?>" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <div class="row">
                                <div class="col-md-4">
                                  <label for="bday" class="form-label">Birthday</label>
                                  <input type="date" name="bday" class="form-control" onchange="calculate_bday()" id="bday" value="<?php echo $row['birthday'] ?>" required>
                                </div>
                                <div class="col-md-4">
                                  <label for="" class="form-label">Sex</label>
                                  <select class="form-select" aria-label=".form-select-sm example" name="sex" required>
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                  </select>
                                </div>
                                <div class="col-md-4">
                                  <label for="age" class="form-label">Age</label>
                                  <input type="number" class="form-control" id="age" value="<?php echo $row['age'] ?>" name="age" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="mb-3">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="cnum" class="form-label">Contact Number</label>
                                  <input type="tel" class="form-control" pattern="^(09|\+639)\d{9}$" id="cnum" name="cnum" value="<?php echo $row['contact_no'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                  <label for="email" class="form-label">Email Address</label>
                                  <input type="tel" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="mb-3">
                              <div class="row">
                                <div class="col-md-6">
                                  <label for="section" class="form-label">Year and Section</label>
                                  <input type="text" class="form-control" id="section" name="section" value="<?php echo $row['section'] ?>" required>
                                </div>
                                <div class="col-md-6">
                                  <label for="course" class="form-label">Course</label>
                                  <?php
                                  $query1 = "SELECT * FROM courses";
                                  $result1 = mysqli_query($conn, $query1); ?>

                                  <select class="form-select" name="course" aria-label="Default select example" required>
                                    <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                                      <?php if ($row['course'] != $row1['course_name']) { ?>
                                        <option value="<?php echo $row1['course_name'] ?>"><?php echo $row1['course_name'] ?></option>
                                      <?php } else { ?>
                                        <option value="<?php echo $row['course'] ?>" selected><?php echo $row['course'] ?></option>
                                    <?php };
                                    } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer mt-4">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" name="updatePatient" class="btn btn-primary">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Patient</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete this?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <a class="btn btn-danger" href="functions.php?delete=<?php echo $row["id"] ?>">Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php $i++;
                }; ?>
              </tbody>
            </table>
          <?php  } else { ?>
            <center>
              <h5 class="mt-5">No data to show.</h5>
            </center>
          <?php }; ?>

        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>
</body>

</html>