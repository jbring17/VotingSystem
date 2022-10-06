<?php
  $servername = "localhost";
  $username = "jerry";
  $password = "password1";
  $dbname = "votingsystem";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?> 