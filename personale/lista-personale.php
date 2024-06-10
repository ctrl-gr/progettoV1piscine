<!DOCTYPE html>
<html>

<head>
    <title>Lista Personale</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h1>Lista Personale</h1>
        <a href="../gestione-piscine.php"><button>Homepage</button></a>
        <a href="./istruttore/storico-lavorativo.php"><button>Storico lavorativo istruttori</button></a>
        <a href="./istruttore/insert-istruttore.php"><button>Inserimento Istruttore</button></a>
        <a href="./responsabile/insert-responsabile.php"><button>Inserimento Responsabile</button></a>
    </div>

    <?php
    require_once("../index.php");


    $queryResponsabile = "SELECT
    Istruttore.id_istruttore,
    Istruttore.nome AS nome,
    Istruttore.cognome AS cognome,
    'Istruttore' AS ruolo,
    Piscina.nome_piscina AS nome_piscina
FROM
    Istruttore
JOIN
    Ha_storico ON Istruttore.id_istruttore = Ha_storico.istruttore_id_istruttore
JOIN
    Piscina ON Ha_storico.piscina_nome_piscina = Piscina.nome_piscina
UNION
SELECT
Responsabile.id_responsabile,
    Responsabile.nome AS nome,
    Responsabile.cognome AS cognome,
    'Responsabile' AS ruolo,
    Piscina.nome_piscina AS nome_piscina
FROM
    Responsabile
JOIN
    Dirige ON Responsabile.id_responsabile = Dirige.responsabile_id_responsabile
JOIN
    Piscina ON Dirige.piscina_nome_piscina = Piscina.nome_piscina";
    $result = pg_query($conn, $queryResponsabile);

    if (pg_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Ruolo</th>
        <th>Piscina</th>
        <th>Azioni</th>
        </tr>";

        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['cognome'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['ruolo'] . "</td>";
            echo "<td>" . $row['nome_piscina'] . "</td>";
            echo '<td>
            <form action="' . ($row['ruolo'] === 'Responsabile' ? 'responsabile/insert-responsabile.php' : 'istruttore/insert-istruttore.php') . '" method="POST">

                <input type="hidden" name="id_personale" value="' . ($row['id_responsabile'] ?? $row['id_istruttore']) . '">
                <input type="hidden" name="ruolo" value="' . $row['ruolo'] . '">
                <input type="hidden" name="piscina" value="' . $row['nome_piscina'] . '">
                <input type="submit" value="Modifica">
            </form>
            <form action="' . ($row['ruolo'] === 'Responsabile' ? 'responsabile/elimina-responsabile.php' : 'istruttore/elimina-istruttore.php') . '" method="POST">
                <input type="hidden" name="id_personale" value="' . ($row['id_responsabile'] ?? $row['id_istruttore']) . '">
                <input type="submit" value="Elimina">
            </form>
        </td>';
    
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nessun dato trovato.";
    }
    ?>
</body>

</html>