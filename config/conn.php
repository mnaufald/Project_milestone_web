<?php
  $host = "localhost:3306";
  $user = "root";
  $password = "";
  $database = "plazanet";
  $conn = new mysqli($host, $user, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>