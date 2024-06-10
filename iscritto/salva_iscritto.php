<?php

require_once("../index.php");

$isModifica = isset($_POST['numero_tessera']);
$cognome = $_POST['cognome'];
$nome = $_POST['nome'];
$cognomeMadre = $_POST['cognomeMadre'];
$nomeMadre = $_POST['nomeMadre'];
$cognomePadre = $_POST['cognomePadre'];
$nomePadre = $_POST['nomePadre'];


if ($isModifica) {
    $numero_tessera = $_POST['numero_tessera'];
    $query = "UPDATE Iscritto
              SET cognome = '$cognome',
                  nome = '$nome',
              WHERE numero_tessera = '$numero_tessera'";

$insert_query = pg_query($conn, $query);
} else {
        $queryIscritto = "INSERT INTO Iscritto (cognome, nome)
        VALUES ('$cognome', '$nome') RETURNING numero_tessera";
        $resultIscritto = pg_query($conn, $queryIscritto);

            if($resultIscritto) {
    
               // Ottieni l'ID dell'iscritto appena inserito
$rowIscritto = pg_fetch_row($resultIscritto);
if (!$rowIscritto) {
    echo "Errore nell'ottenere l'ID dell'iscritto.";
    exit;
}
$iscrittoID = $rowIscritto[0];

                $queryMadre = "INSERT INTO Genitore (cognome, nome)
                   VALUES ('$cognomeMadre', '$nomeMadre') RETURNING id_genitore";
                 $resultMadre = pg_query($conn, $queryMadre);

                 
            if($resultMadre) {
      
                $rowMadre = pg_fetch_assoc($resultMadre);
$madreID = $rowMadre['id_genitore'];
            
                $queryPadre = "INSERT INTO Genitore (cognome, nome)
                       VALUES ('$cognomePadre', '$nomePadre') RETURNING id_genitore";
                $resultPadre = pg_query($conn, $queryPadre);

      
                if($resultPadre) {
                    $rowPadre = pg_fetch_assoc($resultPadre);
                    $padreID = $rowPadre['id_genitore'];
                   
                    $queryAssociazione = "INSERT INTO Ha_Genitore (iscritto_numero_tessera, genitore_id_genitore) 
                                  VALUES ('$iscrittoID', '$madreID'), 
                                  ('$iscrittoID', '$padreID')";
                    $resultAssociazione = pg_query($conn, $queryAssociazione);

    

                 if($resultAssociazione) {
                    echo "Salvataggio avvenuto con successo";
                    echo '<br><a href="lista-iscritti.php">Torna alla lista di iscritti</a>';
                } else {
                    echo "Errore nell'inserimento nella tabella di associazione";
                    }
            } else {
             echo "Errore nell'inserimento del genitore padre";
            }
        } else {
echo "Errore nell'inserimento del genitore madre";
}
} else {
echo "Errore nell'inserimento dell'iscritto";
}
}
?>