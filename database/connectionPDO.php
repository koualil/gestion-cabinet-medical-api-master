<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cabinet_medical_db";

  try {
     $conn = new PDO("mysql:host=$hostname;dbname=$dbname",$username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
   } catch (PDOException $e) {
     echo "Connection feild ".$e->getMessage();
  }
?>