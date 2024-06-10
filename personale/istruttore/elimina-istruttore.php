<?php

require_once("../../index.php");


if (isset($_POST['id_personale'])) {
    $id = $_POST['id_personale'];

    
    $query = "DELETE FROM Istruttore WHERE id_istruttore = '$id'";
    $delete_query = pg_query($conn, $query);


    if ($delete_query) {
        echo "Eliminazione avvenuta con successo";
        echo '<br><a href="../lista-personale.php">Torna alla lista del personale.</a>';
    } else {
        echo "Si è verificato un errore durante l'eliminazione";
    }
}

?>