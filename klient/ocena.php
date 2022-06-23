<?php

declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (isset($_SESSION['loggedin']) == false) {
   header('Location: /6_Semestr/CRM/klientLogin.php');
   exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<HEAD>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>

<BODY>
   <?php
   ini_set('display_errors', 1);
   include 'dbConn.php';
   $ocena = htmlentities($_POST['ocena'], ENT_QUOTES, "UTF-8");
   $zagID = htmlentities($_POST['zagID'], ENT_QUOTES, "UTF-8");

   $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
   if (!$link) {
      echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
   } // obsługa błędu połączenia z BD
   mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków


   $sql = "UPDATE posty SET ocena = '$ocena' WHERE idr = '$zagID'";
   $link->query($sql);

   header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/klient/klientDashboard.php");
   mysqli_close($link); // zamknięcie połączenia z BD


   ?>
</BODY>

</HTML>