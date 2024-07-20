<?php
$servername = "localhost";
$username = "kamaltest";
$password = "kamal";
$dbname = "ninja_pizza";

//connect to database
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    echo 'Connection error: ' . mysqli_connect_error();
}
