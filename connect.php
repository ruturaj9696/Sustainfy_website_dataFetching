<!-- <?php
    $con=mysqli_connect('localhost','root','','crud_series');
    if(!$con){
        die(mysqli_error("Error"+$con));
    }
    else{
        echo "connection is established";
    }
?> -->


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_series";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Test the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Rest of your code for fetching data
?>
