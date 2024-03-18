<?php


$server_Name = "localhost";
$user_Name = "root";
$password = "Murali@1234";
$database = "E_commercer";

$conn = mysqli_connect($server_Name, $user_Name, $password, $database);
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
