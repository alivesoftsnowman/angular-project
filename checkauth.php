<?php
session_start();
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
if($data->log_type=="login"){
    $sql = "SELECT * FROM user_list where user_name='".$data->user_name."' and password='".$data->user_pass."'";
    // echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        $_SESSION["user_name"]=$data->user_name;
    echo "yes";
    } else {
        echo "no";
    }
}elseif($data->log_type=="register"){
    $sql = "INSERT INTO user_list (full_name, user_name, password) VALUES ('$data->full_name', '$data->user_name', '$data->user_pass')";
    // echo $sql;
    $result = $conn->query($sql);
        // output data of each row
    echo "yes";
}elseif($data->log_type=="session_check"){
    if(isset($_SESSION['user_name']))
        echo 'yes';
    else
        echo "fail";
}elseif($data->log_type=="session_destroy"){
    session_destroy();
        echo 'yes';
 
}

$conn->close();
