<?php

require_once("../../index.php");

$isModifica = isset($_POST['id_responsabile']);
$cognome = $_POST['cognome'];
$nome = $_POST['nome'];
$nome_piscina = $_POST['nome_piscina'];


if ($isModifica) {
    $id_responsabile = $_POST['id_responsabile'];
    $query = "UPDATE Responsabile
              SET cognome = '$cognome',
                  nome = '$nome'
              WHERE id_responsabile = '$id_responsabile'";
} else {
   
$queryResponsabile = "INSERT INTO Responsabile (cognome, nome) VALUES ('$cognome', '$nome') RETURNING id_responsabile";
$resultResponsabile = pg_query($conn, $queryResponsabile);
$id_responsabile = pg_fetch_result($resultResponsabile, 0, 'id_responsabile');

$queryDirige = "INSERT INTO Dirige (responsabile_id_responsabile, piscina_nome_piscina) VALUES ('$id_responsabile', '$nome_piscina')";
$resultDirige = pg_query($conn, $queryDirige);
}




if ($queryResponsabile && $queryDirige) {
    echo "Salvataggio avvenuto con successo";
    echo '<br><a href="../lista-personale.php">Torna alla lista del personale</a>';
} else {
    echo "Si è verificato un errore durante il salvataggio";
}
?>

