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
  <title>Nurse Clinic | Dashboard</title>
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
          <a href="addpatient.php" class="nav_link active"> <i class='bx bx-add-to-queue nav_icon'></i> <span class="nav_name">Add Patient</span> </a>
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
  <div class="height-100">
    <div class="content-title">
      <br><br>
      <div class="d-flex"> 
        <form action="searchpatient.php" method="POST">
          <div class="input-group" >
              <input type="search" class="form-control rounded" name="searchPatient" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
              <button type="submit" name="findPatient" class="btn btn-outline-primary"><i class='bx bx-search nav_icon'></i></button>
          </div>  
        </form>
      </div>
      <div class="row mt-5">
        <div class="col">
          <div class="form-add">
            <form action="functions.php" method="POST">
              <h3>Add Patient</h3>
              <div class="row mb-3 mt-4">
                <div class="col-md-6">
                  <label for="fname" class="form-label">Student I.D</label>
                  <input type="text" name="sId" class="form-control" id="sId" placeholder="...." required>
                </div>
                <div class="col-md-6">
                  <label for="fname" class="form-label">First Name</label>
                  <input type="text" name="fname" class="form-control" id="fname" placeholder="...." required>
                </div>
                <div class="col-md-6">
                  <label for="fname" class="form-label">Middle Name</label>
                  <input type="text" name="mname" class="form-control" id="mname" placeholder="...." required>
                </div>
                <div class="col-md-6">
                  <label for="lname" class="form-label">Last Name</label>
                  <input type="text" name="lname" class="form-control" id="lname" placeholder="..." required>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-4">
                    <label for="bday" class="form-label">Birthday</label>
                    <input type="date" name="bday" class="form-control" onchange="calculate_bday()" id="bday" placeholder="..." required>
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
                    <input type="number" class="form-control" id="age" placeholder="..." name="age" readonly>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-6">
                    <label for="cnum" class="form-label">Contact Number</label>
                    <input type="tel" class="form-control" pattern="^(09|\+639)\d{9}$" id="cnum" name="cnum" placeholder="+63..." required>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="tel" class="form-control" id="email" name="email" placeholder="..." required>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-md-6">
                    <label for="section" class="form-label">Year and Section</label>
                    <input type="text" class="form-control" id="section" name="section" placeholder="..." required>
                  </div>
                  <div class="col-md-6">
                    <label for="course" class="form-label">Course</label>
                    <?php
                    $query1 = "SELECT * FROM courses";
                    $result1 = mysqli_query($conn, $query1); ?>
                    <select class="form-select" name="course" aria-label="Default select example" required>
                      <?php while ($row1 = mysqli_fetch_array($result1)) { ?>
                        <option value="<?php echo $row1['course_name'] ?>"><?php echo $row1['course_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                <h3>Check-Up Schedule</h3>
              </div>
              <div class="row mb-3 mt-4">
                <div class="col-md-6">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="col-md-6">
                  <label for="time" class="form-label">Time</label>
                  <input type="time" class="form-control" id="time" onchange="onTimeChange()" name="time" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
              </div>
              <div class="col-auto">
                <button type="submit" name="addpatient" class="btn btn-primary w-100">Add Patient</button>
              </div>
            </form>
          </div>
          <br><br>
        </div>
      </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/app.js"></script>

</body>

</html>