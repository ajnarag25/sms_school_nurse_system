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
 $conn->query("INSERT INTO patient (studentId, firstName, middleName,lastName, birthday, sex, age, contact_no, email, section, course, date, resched, time, description, status, texted_checkup, texted_cancel) VALUES('$studentId','$firstName','$middleName','$lastName','$birthday','$sex','$age','$contact_no','$email','$section','$course','$date', 'N/A','$time','$description','PENDING', '0', '0')") or die($conn->error);
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
 $conn->query("UPDATE imported SET studentId='$studentId', firstName='$firstName', middleName='$middleName', lastName='$lastName', birthday='$birthday', sex='$sex', age='$age', contact_no='$contact_no', email='$email', yr_section='$section', course='$course' WHERE id=$id") or die($conn->error);
 header("Location: studentlist.php");
}

// delete
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $conn->query("DELETE FROM imported WHERE id=$id") or die($conn->error);
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
 $resched = $_POST['date2'];
 $getmsg = $_POST['composemsg'];
 $query = "SELECT * FROM patient";
 $result = mysqli_query($conn, $query);
 while ($row = mysqli_fetch_array($result)) {
  if ($row['date'] == $setDate && $row['status'] == 'PENDING') {
   $id = $row['id'];
   $name = $row['firstName'] . " " . $row['lastName'];
   // send message postponed_dates
   require_once 'vendor/autoload.php';
   $messagebird = new MessageBird\Client('1M8sUxPMN3iQE3duBxL5HTfgH');
   $message = new MessageBird\Objects\Message;
   $message->originator = '+639090728988';
   $message->recipients = ['+639090728988'];
   $message->body = 'Hi ' . $name . '. '.  $getmsg;
   $response = $messagebird->messages->create($message);
   print_r(json_encode($response));
   // UPDATE DATA
   $conn->query("UPDATE patient SET status='POSTPONED', texted_cancel='1', resched='$resched' WHERE id=$id") or die($conn->error);
   $conn->query("INSERT INTO postponed_dates (date) VALUES('$setDate')") or die($conn->error);
  }
 }
 header("Location: index.php");
}


// add student
if (isset($_POST['addStudent'])) {
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

    $query_code = "SELECT * FROM imported WHERE studentId='$studentId' AND firstName='$firstName'";
    $result = $conn->query($query_code);
    
    
    if ($result->num_rows > 0) {
        echo "<script type=\"text/javascript\">
        alert(\"Data is already in the database!\");
        window.location = \"studentlist.php\"
        </script>";
    }else{
        $conn->query("INSERT INTO imported (studentId, firstName, middleName,lastName, birthday, sex, age, contact_no, email, yr_section, course) VALUES('$studentId','$firstName','$middleName','$lastName','$birthday','$sex','$age','$contact_no','$email','$section','$course')") or die($conn->error);
        header("Location: studentlist.php");
    }

   
   }



// done postponed
if (isset($_GET['done2'])) {
    $id = $_GET['done2'];
    $conn->query("UPDATE patient SET status='DONE', texted_cancel='1' WHERE id=$id") or die($conn->error);
    header("Location: postponed.php");
   }
   
// cancel postponed
if (isset($_GET['cancel2'])) {
    $id = $_GET['cancel2'];
    $conn->query("UPDATE patient SET status='CANCEL', texted_cancel='1' WHERE id=$id") or die($conn->error);
    header("Location: postponed.php");
}


// import function
if(isset($_POST["Import"])){
 
 
		echo $filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
      
                $d1 = $emapData[1];
                $d2 = $emapData[2];
                $d3 = $emapData[3];
                $d4 = $emapData[4];

                $query_code = "SELECT * FROM imported WHERE studentId='$d1' AND firstName='$d2'";
                $result2 = $conn->query($query_code);

                if ($result2->num_rows > 0) {
                    echo "<script type=\"text/javascript\">
                    alert(\"Data is already in the database!\");
                    window.location = \"studentlist.php\"
                    </script>";
                    break;
                } else {
                    $sql = "INSERT into imported (studentId, firstName, middleName,lastName, birthday, sex, age, contact_no, email, yr_section, course) 
                    values('$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]','$emapData[10]','$emapData[11]')";
    
                    $result = mysqli_query( $conn, $sql );
                    
                    if(! $result )
                    {
                        echo "<script type=\"text/javascript\">
                                alert(\"Invalid File:Please Upload CSV File.\");
                                window.location = \"studentlist.php\"
                            </script>";
                            break;
    
                    }
                }

	         }
             fclose($file);
             //throws a message if data successfully imported to mysql database from excel file
             echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"studentlist.php\"
                    </script>";
	        
 
 
			 //close of connection
			mysqli_close($conn); 
 
 
 
		 }
	}	 


// delete schedule
if (isset($_GET['deleteSched'])) {
    $id = $_GET['deleteSched'];
    $conn->query("DELETE FROM patient WHERE id=$id") or die($conn->error);
    header("Location: schedules.php");
   }
   
// clear all data
if (isset($_POST['clearAll'])) {
    $conn->query("TRUNCATE TABLE patient;") or die($conn->error);
    header("Location: schedules.php");
}

// edit msg
if (isset($_POST['editMsg'])) {
    $message = $_POST['msg'];
    $conn->query("UPDATE sms SET msg='$message' WHERE id=1") or die($conn->error);
    // $conn->query("UPDATE patient SET texted_checkup='1' WHERE id=$id") or die($conn->error);
    header("Location: msg_setting.php");
}

// get data sms
if (isset($_GET['sendMsg'])) {
    $first = $_GET['sendMsg'];
    $query = "SELECT * FROM sms where id = 1";
    $result = $conn->query($query);
    
    $get_query = "SELECT * from patient WHERE firstName='$first' AND status='PENDING'";
    $result_query = $conn->query($get_query);
    while($r = mysqli_fetch_array($result_query)){
        $dates = $r['date'];
        $times = $r['time'];
    }

    while ($row = mysqli_fetch_array($result)) {
        require_once 'vendor/autoload.php';
        $messagebird = new MessageBird\Client('1M8sUxPMN3iQE3duBxL5HTfgH');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+639090728988';
        $message->recipients = ['+639090728988'];
        $message->body = 'Hi ' . $first . '. '.'May we remind you today'.' '.$dates.', '.'you have a follow up check-up at'.$times.' as scheduled'.'. '. $row['msg'] ;
        $response = $messagebird->messages->create($message);
        print_r(json_encode($response));
        header("Location: index.php");

    }

}

// compose msg
if (isset($_POST['editMsgclinic'])) {
    $message = $_POST['msg'];
    $conn->query("UPDATE sms SET msg='$message' WHERE id=2") or die($conn->error);
    // $conn->query("UPDATE patient SET texted_checkup='1' WHERE id=$id") or die($conn->error);
    header("Location: closeclinic.php");
}


// export
if (isset($_POST['Export'])) {
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
$fileName = "sms_school_nurse_system_data_" . date('Y-m-d') . ".xls"; 
 
$fields = array('ID', 'STUDENT ID', 'FIRST NAME', 'MIDDLE NAME', 'LAST NAME', 'BIRTHDAY', 'SEX', 'AGE', 'CONTACT NO', 'EMAIL', 'YEAR & SECTION', 'COURSE', 'DATE', 'RE-SCHED', 'TIME', 'DESCRIPTION', 'STATUS'); 
 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
$query = $conn->query("SELECT * FROM patient ORDER BY id ASC"); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['id'], $row['studentId'], $row['firstName'], $row['middleName'], $row['lastName'], $row['birthday'], $row['sex'], $row['age'], $row['contact_no'], $row['email'], $row['section'], $row['course'], $row['date'], $row['resched'], $row['time'], $row['description'], $row['status']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
echo $excelData; 
 
exit;
}