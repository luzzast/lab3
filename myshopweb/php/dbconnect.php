<?php
$servername = "sql305.epizy.com";
$username = "epiz_28228874";
$password = "CKSThcCBQ9";
$dbname = "epiz_28228874_myshopdb";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
