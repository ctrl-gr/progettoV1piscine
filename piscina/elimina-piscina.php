<?php

require_once("../index.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "DELETE FROM Piscina WHERE nome_piscina = '$id'";
    $delete_query = pg_query($conn, $query);


    if ($delete_query) {
        echo "Eliminazione avvenuta con successo";
        echo '<br><a href="lista-piscine.php">Torna alla lista di piscine</a>';
    } else {
        echo "Si è verificato un errore durante l'eliminazione";
    }
}

?>