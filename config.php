<?php

$server = "localhost";
$username = "root";
$password = "";

$mySqli = new mysqli($server, $username, $password);

if (!$mySqli) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}



?>