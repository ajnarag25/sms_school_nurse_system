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

  $num_per_page = 10;
  $start_from = ($page-1)*10;

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

<style>
  .no-result-div {
  display: none;
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
          <a href="schedules.php" class="nav_link"> <i class='bx bx-time-five'></i> <span class="nav_name">Schedule Check-up</span> </a>
          <a href="studentlist.php" class="nav_link active"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Patients</span> </a>
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
      <br>
      <h1>Student List (from Registrar)</h1>
      <br>
      <div class="row">
        <div class="col-md-4">
          <h5>Students</h5>
        </div>
        <div class="col-md-4">
          <div class="input-group" >
            <input type="search" class="form-control rounded" placeholder="Search" onkeyup="searchStudent()" id="searchStudent" />
            <button type="button" class="btn btn-outline-primary"><i class='bx bx-search nav_icon'></i></button>
          </div>  
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#importCsv">Import</button>
        </div>

         <!-- Modal Import-->
         <div class="modal fade" id="importCsv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="functions.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <p>Please upload a csv file only.</p>
                  <input type="file" name="file" id="file" class="form-control">
                </div>
                <div class="modal-footer">
                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                </div>
                </form>
              </div>
            </div>
          </div>

        <div class="col-md-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">Add <i class='bx bx-plus nav_icon'></i></button>
        </div>

          <!-- Modal Add-->
          <div class="modal fade" id="addStudent" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="functions.php" method="POST">
                    <input type="hidden" name="id" value="">
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="fname" class="form-label">Student I.D</label>
                        <input type="text" name="sId" class="form-control" id="sId" value="" required>
                      </div>
                      <div class="col-md-6">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" id="fname" value="" required>
                      </div>
                      <div class="col-md-6">
                        <label for="fname" class="form-label">Middle Name</label>
                        <input type="text" name="mname" class="form-control" id="mname" value="" required>
                      </div>
                      <div class="col-md-6">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="lname" value="" required>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="bday" class="form-label">Birthday</label>
                          <input type="date" name="bday" class="form-control" onchange="calculate_bdays()" id="bdays" placeholder="..." required>
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
                          <input type="number" class="form-control" id="ages" placeholder="..." name="age" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="cnum" class="form-label">Contact Number</label>
                          <input type="tel" class="form-control" pattern="^(09|\+639)\d{9}$" id="cnum" name="cnum" value="" required>
                        </div>
                        <div class="col-md-6">
                          <label for="email" class="form-label">Email Address</label>
                          <input type="tel" class="form-control" id="email" name="email" value="" required>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="section" class="form-label">Year and Section</label>
                          <input type="text" class="form-control" id="section" name="section" value="" required>
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
                          <br>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer mt-4">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="addStudent" class="btn btn-primary">Add Student</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>

      <div class="table-container  mt-4 bg-body p-4">
        <div class="tableData overflow-auto">
          <?php
          $query = "SELECT * from imported ORDER BY id DESC limit $start_from,$num_per_page";
          $result = mysqli_query($conn, $query);
          $count = mysqli_num_rows($result);
          $i = 1;
          if ($count > 0) { ?>
            <table class="table" id="studentTable">
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
                    <td><?php echo $row['yr_section'] ?></td>
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
                                <label for="fname" class="form-label">Student I.D</label>
                                <input type="text" name="sId" class="form-control" id="sId" value="<?php echo $row['studentId'] ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $row['firstName'] ?>" required>
                              </div>
                              <div class="col-md-6">
                                <label for="fname" class="form-label">Middle Name</label>
                                <input type="text" name="mname" class="form-control" id="mname" value="<?php echo $row['middleName'] ?>" required>
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
                                  <input type="text" class="form-control" id="section" name="section" value="<?php echo $row['yr_section'] ?>" required>
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

                  <!-- Modal Delete-->
                  <div class="modal fade" id="delete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
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
            <div class="no-result-div mt-4 text-center" id="no-student">
              <div class="div">
                <img src="images/search.svg" width="150" height="150" alt="">
                <h4 class="mt-3">Search not found...</h4>
              </div>
            </div>
          <?php  } else { ?>
            <center>
              <h5 class="mt-5">No data to show.</h5>
            </center>
          <?php }; ?>
        </div>
      </div>
      <?php 
        $pr_query = "select * from imported ";
        $pr_result = mysqli_query($conn,$pr_query);
        $total_record = mysqli_num_rows($pr_result );
        
        $total_page = ceil($total_record/$num_per_page);

        ?>
        <br>
        <center>
          <?php
            if($page>1)
            {
                echo "<a href='studentlist.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
            }

            
            for($i=1;$i<$total_page;$i++)
            {
                echo "<a href='studentlist.php?page=".$i."' class='btn btn-primary'>$i</a>";
            }

            if($i>$page)
            {
                echo "<a href='studentlist.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
            }
          ?>
        </center>
        <br><br>
        <?php
    ?>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>
  <script>
    // search function for studentlist
    function searchStudent() {
      
      let rowCountO = 0;
      let inputO, filterO, tableO, trO, i;
      let tdO0, tdO1, tdO2;
      let txtValO0, txtValO1, txtValO2;
      inputO = $('#searchStudent').val();
      console.log(inputO)
      filterO = inputO.toUpperCase();
      tableO = document.getElementById("studentTable");
      trO = tableO.getElementsByTagName("tr");
      for (i = 0; i < trO.length; i++) {
        tdO0 = trO[i].getElementsByTagName("td")[0];
        tdO1 = trO[i].getElementsByTagName("td")[1];
        tdO2 = trO[i].getElementsByTagName("td")[2];
        tdO3 = trO[i].getElementsByTagName("td")[3];
        tdO4 = trO[i].getElementsByTagName("td")[4];
        tdO5 = trO[i].getElementsByTagName("td")[5];
        tdO6 = trO[i].getElementsByTagName("td")[6];
        tdO7 = trO[i].getElementsByTagName("td")[7];
        tdO8 = trO[i].getElementsByTagName("td")[8];
        tdO9 = trO[i].getElementsByTagName("td")[9];
        tdO10 = trO[i].getElementsByTagName("td")[10];

        if (tdO1 || tdO2 || tdO3 || tdO4 || tdO5 || tdO6 || tdO7 || tdO8 || tdO9 || tdO10 ) {
          txtValO0 = tdO0.textContent || tdO0.innerText;
          txtValO1 = tdO1.textContent || tdO1.innerText;
          txtValO2 = tdO2.textContent || tdO2.innerText;
          txtValO3 = tdO3.textContent || tdO2.innerText;
          txtValO4 = tdO4.textContent || tdO2.innerText;
          txtValO5 = tdO5.textContent || tdO2.innerText;
          txtValO6 = tdO6.textContent || tdO2.innerText;
          txtValO7 = tdO7.textContent || tdO2.innerText;
          txtValO8 = tdO8.textContent || tdO2.innerText;
          txtValO9 = tdO9.textContent || tdO2.innerText;
          txtValO10 = tdO10.textContent || tdO2.innerText;
          if (txtValO0.toUpperCase().indexOf(filterO) > -1 || txtValO1.toUpperCase().indexOf(filterO) > -1 || txtValO2.toUpperCase().indexOf(filterO) > -1 || txtValO3.toUpperCase().indexOf(filterO) > -1 || txtValO4.toUpperCase().indexOf(filterO) > -1 || txtValO5.toUpperCase().indexOf(filterO) > -1 || txtValO6.toUpperCase().indexOf(filterO) > -1 || txtValO7.toUpperCase().indexOf(filterO) > -1 || txtValO8.toUpperCase().indexOf(filterO) > -1 || txtValO9.toUpperCase().indexOf(filterO) > -1 || txtValO10.toUpperCase().indexOf(filterO) > -1) {
            trO[i].style.display = "";
            rowCountO++;
          } else {
            trO[i].style.display = "none";
          }
        };       
      };
      if (rowCountO == 0) {
        $("#no-student").css("display", "block");
      } else {
        $("#no-student").css("display", "none");
        rowCountO = 0;
      }
    };
  </script>

</body>

</html>