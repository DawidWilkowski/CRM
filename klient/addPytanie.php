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
    $post = htmlentities($_POST['post'], ENT_QUOTES, "UTF-8");
    $temat = htmlentities($_POST['temat'], ENT_QUOTES, "UTF-8");

    $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
    if (!$link) {
        echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    } // obsługa błędu połączenia z BD
    mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
    $user = $_SESSION['usersession'];
    $result = mysqli_query($link, "SELECT idk from klienci WHERE nazwisko = '$user' limit 1");
    $row = mysqli_fetch_array($result);
    $value = array_shift($row);
    $sql = "INSERT INTO posty (idr,idk,idz, post_klienta) VALUES (NULL,'$value','$temat', '$post')";
    $link->query($sql);

    header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/klient/klientDashboard.php");
    mysqli_close($link); // zamknięcie połączenia z BD


    ?>
</BODY>

</HTML>