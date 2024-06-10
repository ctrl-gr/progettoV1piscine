<?php
   
    global $strconn, $conn;
    $strconn = "host=localhost port=5432 dbname=piscine_comune_db user=postgres password=yourpsw-";
    $conn = pg_connect($strconn);
    if (!$conn) {
        echo "Connection to DB failed";
        exit;
    }
    
    echo "</BODY>";
    echo "</HTML>";

    ?>
