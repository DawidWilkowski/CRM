<?php
            $dbhost=""; $dbuser=""; $dbpassword=""; $dbname="";
            $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
            if (!$conn) {
                echo "Błąd połączenia z MySQL." . PHP_EOL;
                echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Error: " . mysqli_connect_error() . PHP_EOL;
                exit;
            }
