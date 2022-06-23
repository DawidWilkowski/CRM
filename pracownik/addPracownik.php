<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<HEAD>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>

<BODY>
   <?php
   include 'dbConn.php';
   $user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8");
   $pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
   $passagain = htmlentities($_POST['passagain'], ENT_QUOTES, "UTF-8");
   if ($passagain != $pass) {
      header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/errorhaslopowtorz.php");
      die('Passwords do not match');
   }
   $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname); // połączenie z BD – wpisać swoje dane
   if (!$link) {
      echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
   } // obsługa błędu połączenia z BD
   mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
   $sql_u = "SELECT * FROM pracownicy WHERE nazwisko='$user'";
   $res_u = mysqli_query($link, $sql_u);
   if (mysqli_num_rows($res_u) > 0) {
      header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/errorLoginZajety.php");
      die('Login already exists');
   }
   $result = mysqli_query($link, "SELECT * FROM pracownicy WHERE (nazwisko='$user') and (haslo='$pass')"); // wiersza, w którym login=login z formularza
   $rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
   mkdir($user);
   $sql = "INSERT INTO pracownicy (nazwisko, haslo) VALUES ('$user', '$pass')";
   $link->query($sql);

   header("Location: http://wilkowskidawid.pl/6_Semestr/CRM/pracownik/pracownikLogin.php");
   mysqli_close($link); // zamknięcie połączenia z BD


   ?>
</BODY>

</HTML>