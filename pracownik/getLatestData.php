<?php

declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (isset($_SESSION['loggedin']) == false) {
  header('Location: /6_Semestr/CRM/pracownikLogin.php');
  exit();
}
?>
<?php
include 'dbConn.php';
$user = $_SESSION['pracowniksession'];
ini_set('display_errors', 1);
$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$conn) {
  echo " MySQL Connection error." . PHP_EOL;
  echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Error: " . mysqli_connect_error() . PHP_EOL;
  exit;
}
if (isset($_POST['temat'])) {
  $name = $_POST['temat'];
  $result = mysqli_query($link, " SELECT * from posty WHERE idz == '$name'");
  $row = mysqli_fetch_array($result);
  $value = array_shift($row);
  print $value;
}

mysqli_close($conn);
?>