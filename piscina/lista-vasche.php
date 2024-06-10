<!DOCTYPE html>
<html>
<head>
    <title>Lista Vasche</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
    <h1>Lista Vasche</h1>
    <a href="../gestione-piscine.php"><button>Homepage</button></a>
    <a href="lista-piscine.php"><button>Lista Piscine</button></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Piscina</th>
                <th>Vasche</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("../index.php");

            $query = "SELECT nome_piscina, tipo FROM Piscina JOIN contiene ON contiene.piscina_nome_piscina = piscina.nome_piscina
            JOIN Vasca ON contiene.vasca_id_vasca = vasca.id_vasca";
            $result = pg_query($conn, $query);

          
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nome_piscina'] . "</td>";
                echo "<td>" . $row['tipo'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
