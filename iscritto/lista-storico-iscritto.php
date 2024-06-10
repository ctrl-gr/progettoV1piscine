<!DOCTYPE html>
<html>

<head>
    <title>Lista Storico iscrizione corsi</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h1>Lista Storico iscrizione corsi</h1>
        <a href="../gestione-piscine.php"><button>Homepage</button></a>
    </div>


    <?php
    require_once("../index.php");

    $query = "SELECT Corso.Tipo, Edizione_corso.data_inizio, Edizione_corso.data_fine, Edizione_corso.giorni, Edizione_corso.orario, Iscritto.cognome, Iscritto.nome, Piscina.nome_piscina
    FROM Ha_iscritto
    JOIN Iscritto ON Ha_iscritto.iscritto_numero_tessera = Iscritto.numero_tessera
    JOIN Edizione_corso ON Ha_iscritto.Edizione_corso_ID_edizione = Edizione_corso.ID_edizione
    JOIN Ha_edizione ON Edizione_corso.ID_edizione = Ha_edizione.edizione_corso_ID_edizione
    JOIN Corso ON Ha_edizione.Corso_ID_corso = Corso.ID_corso
    JOIN Piscina ON Ha_iscritto.piscina_nome_piscina = Piscina.Nome_piscina";
    

    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Tipo Corso</th>
        <th>Piscina</th>
        <th>Data inizio</th>
        <th>Data fine</th>
        <th>Giorni</th>
        <th>Orario</th>
          </tr>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['cognome'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['tipo'] . "</td>";
            echo "<td>" . $row['nome_piscina'] . "</td>";
            echo "<td>" . $row['data_inizio'] . "</td>";
            echo "<td>" . $row['data_fine'] . "</td>";
            echo "<td>" . $row['giorni'] . "</td>";
            echo "<td>" . $row['orario'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nessun dato trovato.";
    }

    ?>

</body>

</html>