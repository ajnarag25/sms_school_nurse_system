<?php
include('connection.php');

// add patient
if (isset($_POST['addpatient'])) {
 $firstName = $_POST['fname'];
 $studentId = $_POST['sId'];
 $middleName = $_POST['mname'];
 $lastName = $_POST['lname'];
 $birthday = $_POST['bday'];
 $sex = $_POST['sex'];
 $age = $_POST['age'];
 $contact_no = $_POST['cnum'];
 $email = $_POST['email'];
 $section = $_POST['section'];
 $course = $_POST['course'];
 $date = $_POST['date'];

 $time = $_POST['time'];
 $timeSplit = explode(":", $time);
 $hours = $timeSplit[0];
 $minutes = $timeSplit[1];
 $meridian = "";
 if ($hours > 12) {
  $meridian = 'PM';
  $hours -= 12;
  if (strlen($hours) == 1) {
   $hours = "0" . $hours;
  }
 } else if ($hours < 12) {
  $meridian = 'AM';
  if ($hours == 0) {
   $hours = 12;
  }
 } else {
  $meridian = 'AM';
 }
 $time = $hours . ":" . $minutes . " " . $meridian;

 $description = $_POST['description'];
 $conn->query("INSERT INTO patient (studentId, firstName, middleName,lastName, birthday, sex, age, contact_no, email, section, course, date, time, description, status, texted_checkup, texted_cancel) VALUES('$studentId','$firstName','$middleName','$lastName','$birthday','$sex','$age','$contact_no','$email','$section','$course','$date','$time','$description','PENDING', '0', '0')") or die($conn->error);
 header("Location: addpatient.php");
}

// edit patient
if (isset($_POST['updatePatient'])) {
 $id = $_POST['id'];
 $studentId = $_POST['sId'];
 $firstName = $_POST['fname'];
 $middleName = $_POST['mname'];
 $lastName = $_POST['lname'];
 $birthday = $_POST['bday'];
 $sex = $_POST['sex'];
 $age = $_POST['age'];
 $contact_no = $_POST['cnum'];
 $email = $_POST['email'];
 $section = $_POST['section'];
 $course = $_POST['course'];
 $conn->query("UPDATE patient SET studentId='$studentId', firstName='$firstName', middleName='$middleName', lastName='$lastName', birthday='$birthday', sex='$sex', age='$age', contact_no='$contact_no', email='$email', section='$section', course='$course' WHERE id=$id") or die($conn->error);
 header("Location: studentlist.php");
}

// delete
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $conn->query("DELETE FROM patient WHERE id=$id") or die($conn->error);
 header("Location: studentlist.php");
}

// done
if (isset($_GET['done'])) {
 $id = $_GET['done'];
 $conn->query("UPDATE patient SET status='DONE', texted_cancel='1' WHERE id=$id") or die($conn->error);
 header("Location: index.php");
}

// cancel
if (isset($_GET['cancel'])) {
 $id = $_GET['cancel'];
 $conn->query("UPDATE patient SET status='CANCEL', texted_cancel='1' WHERE id=$id") or die($conn->error);
 header("Location: index.php");
}

// set clinic close
if (isset($_POST['dateCancel'])) {
 $setDate = $_POST['date1'];
 $query = "SELECT * FROM patient";
 $result = mysqli_query($conn, $query);
 while ($row = mysqli_fetch_array($result)) {
  if ($row['date'] == $setDate && $row['status'] == 'PENDING') {
   $id = $row['id'];
   $name = $row['firstName'] . " " . $row['lastName'];
   // send message postponed_dates
   require_once 'vendor/autoload.php';
   $messagebird = new MessageBird\Client('jZ7bsnUBaNxKrEwh8oWiNcxCp');
   $message = new MessageBird\Objects\Message;
   $message->originator = '+639633071367';
   $message->recipients = ['+639633071367'];
   $message->body = 'Hi ' . $name . '! Im sorry your checkup was postponed because the clinic is closed';
   $response = $messagebird->messages->create($message);
   print_r(json_encode($response));
   // UPDATE DATA
   $conn->query("UPDATE patient SET status='POSTPONED', texted_cancel='1' WHERE id=$id") or die($conn->error);
   $conn->query("INSERT INTO postponed_dates (date) VALUES('$setDate')") or die($conn->error);
  }
 }
 header("Location: index.php");
}


// // search patient
// if (isset($_POST['findPatient'])) {
//     $getData = $_POST['searchPatient'];
//     $sql = "SELECT * FROM patient WHERE firstname = '$getData'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // output data of each row
//         while($row = $result->fetch_assoc()) {
//         $first = $row['firstName'];
//         $middle = $row['middleName'];
//         }
//     } else {
//         echo "0 results";
//     }
// }
