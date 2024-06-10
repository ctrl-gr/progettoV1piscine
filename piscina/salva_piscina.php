<?php

require_once("../index.php");

function unisciPeriodoApertura($da, $a) {
    $periodoDa = substr($da, 0, 3);
    $periodoA = substr($a, 0, 3);
    return $periodoDa . " - " . $periodoA;
}

function unisciRecapiti($recapito1, $recapito2, $recapito3) {
    return $recapito1 . "-" . $recapito2 . "-" . $recapito3;
}
$isModifica = isset($_POST['isModifica']) && $_POST['isModifica'] === 'true';
$nome = $_POST['nome'];
$indirizzo = $_POST['indirizzo'];
$periodoDa = $_POST['periodoDa'];
$periodoA = $_POST['periodoA'];
$recapito1 = $_POST['recapito1'];
$recapito2 = $_POST['recapito2'];
$recapito3 = $_POST['recapito3'];
$periodoApertura = unisciPeriodoApertura($periodoDa, $periodoA);
$recapitiTelefonici = unisciRecapiti($recapito1, $recapito2, $recapito3);

if ($isModifica) {
    
    $query = "UPDATE Piscina
              SET indirizzo = '$indirizzo',
                  periodo_apertura = '$periodoApertura',
                  recapititelefonici = '$recapitiTelefonici'
              WHERE nome_piscina = '$nome'";
} else {
    
    $query = "INSERT INTO Piscina (nome_piscina, indirizzo, periodo_apertura, recapititelefonici)
              VALUES ('$nome', '$indirizzo', '$periodoApertura', '$recapitiTelefonici')";
}

$insert_query = pg_query($conn, $query);


if ($insert_query) {
    echo "Salvataggio avvenuto con successo";
    echo '<br><a href="lista-piscine.php">Torna alla lista di piscine</a>';
} else {
    echo "Si è verificato un errore durante il salvataggio";
}
?>
