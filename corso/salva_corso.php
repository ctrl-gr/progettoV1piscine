<?php

require_once("../index.php");

$isModifica = isset($_POST['id_corso']);
$tipo = $_POST['tipo'];
$costo = $_POST['costo'];
$partecipantiMin = $_POST['partecipantiMin'];
$partecipantiMax = $_POST['partecipantiMax'];


if ($isModifica) {
    $id_corso = $_POST['id_corso'];
    $query = "UPDATE Corso
              SET tipo = '$tipo',
                  costo = '$costo',
                  partecipanti_min = '$partecipantiMin',
                  partecipanti_max = '$partecipantiMax'
              WHERE id_corso = '$id_corso'";
} else {
    $query = "INSERT INTO Corso (tipo, costo, partecipanti_min, partecipanti_max)
              VALUES ('$tipo', '$costo', '$partecipantiMin', '$partecipantiMax')";
}

$insert_query = pg_query($conn, $query);


if ($insert_query) {
    echo "Salvataggio avvenuto con successo";
    echo '<br><a href="lista-corsi.php">Torna alla lista di corsi</a>';
} else {
    echo "Si è verificato un errore durante il salvataggio";
}
?>

