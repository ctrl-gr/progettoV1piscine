<?php

require_once("../../index.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "DELETE FROM Corso WHERE id_corso = '$id'";
    $delete_query = pg_query($conn, $query);


    if ($delete_query) {
        echo "Eliminazione avvenuta con successo";
        echo '<br><a href="lista-corsi.php">Torna alla lista di corsi</a>';
    } else {
        echo "Si è verificato un errore durante l'eliminazione";
    }
}

?>