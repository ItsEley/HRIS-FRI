<?php

// print_r($_POST);


$emp_id = $_POST['emp_num'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test-db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$response = array();

$sql = "SELECT `name`
FROM `employee` 
WHERE id = '$emp_id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $name = $row["name"];  

  }
}else{
  echo "Employee ID not found. Please try again.<br>
   If you are a new employee, please contact HR. <br>
   If you are an existing employee, please contact your supervisor. <br>";
  exit();
}



$sql = "SELECT *
FROM `attendance_logs` 
WHERE emp_id = '$emp_id'
AND DATE(timestamp) = CURRENT_DATE()
ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $type = $row["type"];
  }
} else {
  $type = "0";
}


if($type == "0" || $type == "time_out"){
    $type = "time_in";
}else if($type == "time_in"){
    $type = "time_out";
}

$sql = "INSERT INTO `attendance_logs`(`emp_id`, `type`) 
VALUES ('$emp_id','$type');";

if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
date_default_timezone_set('Asia/Manila');

$response = array(
    'name' => $name,
    'type' => $type,
    'timestamp' => date('F j, Y, g:i A')
);



echo json_encode($response);
