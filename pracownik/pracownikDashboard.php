<?php

declare(strict_types=1); // włączenie typowania zmiennych w PHP >=7
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku
if (isset($_SESSION['loggedin']) == false) {
     header('Location: /6_Semestr/CRM/pracownikLogin.php');
     exit();
}
?>
<?php
//load_data_select.php  

$connect = mysqli_connect("", "", "", "");
function fill_brand($connect)
{
     $output = '';
     $sql = "SELECT * FROM zagadnienia";
     $result = mysqli_query($connect, $sql);
     while ($row = mysqli_fetch_array($result)) {
          $output .= '<option value="' . $row["idz"] . '">' . $row["nazwa"] . '</option>';
     }
     return $output;
}
function fill_product($connect)
{
     $output = '';
     $sql = "SELECT post_klienta FROM posty WHERE post_pracownika is NULL";
     $result = mysqli_query($connect, $sql);
     while ($row = mysqli_fetch_array($result)) {
          $output .= '<option value="' . $row["idr"] . '">' . $row["post_klienta"] . '</option>';
     }
     return $output;
}
?>
<!DOCTYPE html>
<html>

<head>
     Witaj <?php echo $_SESSION['pracowniksession'] ?>!
     <a href="pracownikLogin.php">Wyloguj</a>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />


</head>

<body onload="getSelectValue();">
     <!-- tu dodac on load wykonanie funkcji select value -->
     <!-- jesli nic nie wybrane to wylacz show zagadnienie -->
     <br /><br />
     Pokaż zagadnienia z :
     <div class="container">
          <h3>
               <select name="zagadnienie" id="zagadnienie" onchange="getSelectValue();">
                    <option value="">Wybierz zagadnienie</option>
                    <?php echo fill_brand($connect); ?>
               </select>

               <select disabled name="row" id="show_zagadnienie" onchange="getSelectValue();">
                    <option value="--" selected disabled hidden>Wybierz pytanie</option>
                    <?php echo fill_product($connect); ?>
               </select>
          </h3>

     </div>
     <form id="info" method="post" action="odpowiedz.php">
          Odpowiedz: <br>
          <input type="hidden" name="first" value="" size="40" />
          <input type="text" name="odp" maxlength="100" size="100"><br>
          <input type="submit" value="Wyślij" onclick="addPostData();" />
     </form>



     <?php
     if ($_SESSION['pracowniksession'] == 'admin') {
          print "<br> STATYSTYKI ADMINA";
          include "dbConn.php";
          $link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
          $result = mysqli_query($link, "SELECT COUNT(idr) FROM posty");
          $row = mysqli_fetch_array($result);
          $value = array_shift($row);
          print "<br>ILOŚĆ PYTAŃ: " . $value;
          $result = mysqli_query($link, "SELECT COUNT(idr) FROM posty WHERE post_pracownika IS NOT NULL");
          $row = mysqli_fetch_array($result);
          $value = array_shift($row);
          print "<br>ILOŚĆ ODPOWIEDZI: " . $value;
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 1 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<br><br>";
          echo "Średnia ocen:";
          print "<div class= 'w-25 p-3'><table class='table table-striped table-sm'> <thead><tr><th> ID</th><th>Ocena</th></tr></thead><tbody><tr><th> " . $row["idp"] . "</th><th>" . $row["AVG (ocena)"] . "</th></tr>";
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 2 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr>";

          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 3 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr>";
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 4 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr>";
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 5 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr>";
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 6 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr>";
          $result = mysqli_query($link, "SELECT idp, AVG (ocena) FROM posty WHERE idp = 7 GROUP BY idp");
          $row = mysqli_fetch_array($result);
          print "<tr><th>" . $row["idp"] . "</th><th> " . $row["AVG (ocena)"] . "</th></tr></tbody></table></div>";
     }

     ?>


</body>

</html>

<script>
     var selectedValue;

     function getSelectValue() {

          selectedValue = document.getElementById("show_zagadnienie").value;
          console.log(selectedValue);
     }


     function addPostData() {

          var formInfo = document.forms['info'];
          formInfo.first.value = document.getElementById("show_zagadnienie").value;


     }
</script>
<script>
     $(document).ready(function() {

          $('#zagadnienie').change(function() {
               if ($(this).val() != "") {
                    $("#show_zagadnienie").removeAttr("disabled");
               }
               var idz = $(this).val();
               $.ajax({
                    url: "load_data.php",
                    method: "POST",
                    data: {
                         idz: idz
                    },
                    success: function(data) {
                         $('#show_zagadnienie').html(data);
                    }
               });
          });
     });
</script>