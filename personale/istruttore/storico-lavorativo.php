<!DOCTYPE html>
<html>

<head>
    <title>Storico lavorativo istruttori</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="header">
        <h1>Storico lavorativo istruttori</h1>
        <a href="../../gestione-piscine.php"><button>Homepage</button></a>
        <a href="./lista-personale.php"><button>Lista personale</button></a>
    </div>

    <?php
    require_once("../../index.php");


    $query = "SELECT
    Istruttore.id_istruttore,
    Istruttore.nome AS nome,
    Istruttore.cognome AS cognome,
    Piscina.nome_piscina AS nome_piscina,
    Registro_lavorativo.data_assunzione AS data_assunzione,
    Registro_lavorativo.tipo_contratto AS tipo_contratto,
    Registro_lavorativo.data_termine AS data_termine
FROM
    Istruttore
JOIN
    Ha_storico ON Istruttore.id_istruttore = Ha_storico.istruttore_id_istruttore
    JOIN Registro_lavorativo ON Ha_storico.registro_lavorativo_id_registrazione = Registro_lavorativo.ID_registrazione
JOIN
    Piscina ON Ha_storico.piscina_nome_piscina = Piscina.nome_piscina";

    $result = pg_query($conn, $query);

    if (pg_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Data assunzione</th>
        <th>Tipo contratto</th>
        <th>Data fine contratto</th>
        </tr>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['cognome'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['data_assunzione'] . "</td>";
            echo "<td>" . $row['tipo_contratto'] . "</td>";
            echo "<td>" . $row['data_termine'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nessun dato trovato.";
    }
    ?>
</body>

</html>