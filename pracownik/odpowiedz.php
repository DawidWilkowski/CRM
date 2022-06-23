<?php

declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (isset($_SESSION['loggedin']) == false) {
    header('Location: /6_Semestr/CRM/pracownik/pracownikLogin.php');
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
    $first = htmlentities($_POST['first'], ENT_QUOTES, "UTF-8");
    $odp = htmlentities($_POST['odp'], ENT_QUOTES, "UTF-8");
    $pracownik = $_SESSION['pracowniksession'];
    $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
    if (!$link) {
        echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
    } // obsługa błędu połączenia z BD
    mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków


    $result = mysqli_query($link, "SELECT idp FROM pracownicy WHERE nazwisko ='$pracownik' limit 1");
    $row = mysqli_fetch_array($result);
    $value = array_shift($row);
    print($value);
    var_dump($first);
    var_dump($_SESSION['pracowniksession']);
    $sql = "UPDATE posty SET idp ='$value', post_pracownika = '$odp' WHERE idr = '$first'";
    $link->query($sql);

    header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/pracownikDashboard.php");
    mysqli_close($link); // zamknięcie połączenia z BD


    ?>
</BODY>

</HTML>