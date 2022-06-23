<?php
//load_data.php  
$connect = mysqli_connect("", "", "", "");
$output = '';
if (isset($_POST["idz"])) {
     if ($_POST["idz"] != '') {
          $sql = "SELECT * FROM posty WHERE idz = '" . $_POST["idz"] . "'AND post_pracownika IS NULL";
     } else {
          $sql = "SELECT * FROM posty WHERE post_pracownika IS NULL";
     }
     $result = mysqli_query($connect, $sql);
     $output .= "<option value='' selected disabled hidden>Wybierz pytanie</option>";
     while ($row = mysqli_fetch_array($result)) {
          $output .= '<option value=' . $row["idr"] . '>' . $row["post_klienta"] . '</option>';
     }
     echo $output;
}
