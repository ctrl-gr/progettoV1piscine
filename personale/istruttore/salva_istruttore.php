<?php
require_once("../../index.php");

$isModifica = isset($_POST['id_istruttore']);
$cognome = $_POST['cognome'];
$nome = $_POST['nome'];
$nome_piscina = $_POST['nome_piscina'];

if ($isModifica) {
    $id_istruttore = $_POST['id_istruttore'];
    $query = "UPDATE Istruttore
              SET cognome = '$cognome',
                  nome = '$nome'
              WHERE id_istruttore = '$id_istruttore'";
} else {
    
$queryIstruttore = "INSERT INTO Istruttore (cognome, nome) VALUES ('$cognome', '$nome') RETURNING id_istruttore";
$resultIstruttore = pg_query($conn, $queryIstruttore);
$id_istruttore = pg_fetch_result($resultIstruttore, 0, 'id_istruttore');

$queryHaStorico = "INSERT INTO Ha_storico (istruttore_id_istruttore, piscina_nome_piscina) VALUES ('$id_istruttore', '$nome_piscina')";
$resultHaStorico = pg_query($conn, $queryHaStorico);
}




if ($queryIstruttore && $queryHaStorico) {
    echo "Salvataggio avvenuto con successo";
    echo '<br><a href="../lista-personale.php">Torna alla lista del personale.</a>';
} else {
    echo "Si è verificato un errore durante il salvataggio";
}
?>

