<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
include 'dbConn.php';

ini_set('display_errors', 1);

$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8"); 
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8"); 
$link = mysqli_connect( $dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); } // obsługa błędu połączenia z BD
 mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
 $result = mysqli_query($link, "SELECT * FROM pracownicy WHERE nazwisko='$user'"); // wiersza, w którym login=login z formularza
 $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
 if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
 {
 mysqli_close($link); // zamknięcie połączenia z BD
 header('Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/pracownikLogin.php'); 
 }
 else
 { // jeśli $rekord istnieje
 if($rekord['haslo']==$pass) // czy hasło zgadza się z BD
 {
 session_start();
 $_SESSION ['loggedin'] = true;
 $_SESSION ['pracowniksession'] = $user;
 header('Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/pracownikDashboard.php');
 }
 else
 {
 mysqli_close($link);
 header('Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/pracownikLogin.php');
}
 }
?>
</BODY>
</HTML>