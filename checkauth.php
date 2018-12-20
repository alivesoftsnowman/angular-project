<?php
$data = json_decode(file_get_contents("php://input"));
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "angularuser";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM user_list where user_name='".$data->user_name."' and password='".$data->user_pass."'";
// echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
   echo "yes";
} else {
    echo "no";
}
$conn->close();
