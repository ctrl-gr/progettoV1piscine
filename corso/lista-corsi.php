<!DOCTYPE html>
<html>
<head>
    <title>Lista Corsi</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
    <h1>Lista Corsi</h1>
    <a href="../gestione-piscine.php"><button>Homepage</button></a>
    <a href="insert-corso.php"><button>Inserisci Corso</button></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Piscina</th>
                <th>Costo</th>
                <th>Numero minimo partecipanti</th>
                <th>Numero massimo partecipanti</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("../index.php");

            $query = "SELECT Tipo, Costo, partecipanti_min, partecipanti_max, piscina_nome_piscina, id_corso FROM Corso JOIN PROPONE ON propone.corso_id_corso = corso.id_corso";
            $result = pg_query($conn, $query);

          
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "<td>" . $row['piscina_nome_piscina'] . "</td>";
                echo "<td>" . $row['costo'] . "</td>";
                echo "<td>" . $row['partecipanti_min'] . "</td>";
                echo "<td>" . $row['partecipanti_max'] . "</td>";
                echo '<td>
                <form action="insert-corso.php" method="POST">
                <input type="hidden" name="id_corso" value="' . $row['id_corso'] . '">
                <input type="submit" value="Modifica">
            </form>
            <form action="elimina-corso.php" method="POST">
                <input type="hidden" name="id_corso" value="' . $row['id_corso'] . '">
                <input type="submit" value="Elimina">
            </form>
                </td>';
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>