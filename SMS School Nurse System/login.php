<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (isset($_SESSION['login_id'])) {
  header('location:index.php');
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
  <title>Nurse Clinic |Login</title>
</head>

<body id="body-pd" style="background-color: #eef7fe;">
  <div class="form">
    <form action="login.php" method="POST">
      <h1>Login</h1>
      <div class="mb-3 mt-4">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="....">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="....">
      </div>
      <div class="col-auto">
        <button type="submit" name="login" class="btn btn-primary mb-3 w-100">Login</button>
      </div>
      <div class="col-auto text-center mt-4">
        <p class="footer-log">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos veniam sit similique error ad sed ab neque recusandae,</p>
      </div>

    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
  <?php
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'") or die($conn->error);
    $row = $qry->fetch_assoc();

    if (is_array($row)) {
      $_SESSION['username'] = $row['username'];
      $_SESSION['password'] = $row['password'];
    } else {
      echo '<script type = "text/javascript">;';
      echo 'alert("Invalid username or password");';
      echo 'window.location.href = "login.php";';
      echo '</script>';
    }
  }
  if (isset($_SESSION['username'])) {
    $_SESSION['login_id'] = 'admin';

    header("Location:index.php");
  }

  ?>
</body>

</html>