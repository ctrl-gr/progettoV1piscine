<!DOCTYPE html>
<html>
<head>
    <title>Lista Iscritti</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
    <h1>Lista Iscritti</h1>
    <a href="../gestione-piscine.php"><button>Homepage</button></a>
    <a href="insert-iscritto.php"><button>Inserisci Iscritto</button></a>
    <a href="lista-storico-iscritto.php"><button>Storico iscritti</button></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Cognome</th>
                <th>Nome</th>
                <th>Madre</th>
                <th>Padre</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("../index.php");

            $query = "SELECT 
            I.Cognome AS Cognome_Iscritto, 
            I.Nome AS Nome_Iscritto, 
            I.numero_tessera,
            G1.Cognome AS Cognome_Padre,
            G1.Nome AS Nome_Padre, 
            G2.Cognome AS Cognome_Madre,
            G2.Nome AS Nome_Madre
        FROM 
            Iscritto I
        LEFT JOIN 
            (
                SELECT 
                    HG1.iscritto_numero_tessera,
                    G1.Cognome,
                    G1.Nome
                FROM 
                    ha_genitore HG1
                JOIN 
                    Genitore G1 ON HG1.Genitore_ID_genitore = G1.ID_genitore
                ORDER BY 
                    G1.Cognome, G1.Nome
            ) AS G1 ON I.numero_tessera = G1.iscritto_numero_tessera
        LEFT JOIN 
            (
                SELECT 
                    HG2.iscritto_numero_tessera,
                    G2.Cognome,
                    G2.Nome
                FROM 
                    ha_genitore HG2
                JOIN 
                    Genitore G2 ON HG2.Genitore_ID_genitore = G2.ID_genitore
                ORDER BY 
                    G2.Cognome, G2.Nome
            ) AS G2 ON I.numero_tessera = G2.iscritto_numero_tessera
        WHERE 
            G1.Cognome < G2.Cognome OR G2.Cognome IS NULL
        ORDER BY 
            Cognome_Iscritto, Nome_Iscritto;
        
        ";

            
            $result = pg_query($conn, $query);

          
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['cognome_iscritto'] . "</td>";
                echo "<td>" . $row['nome_iscritto'] . "</td>";
                echo "<td>" . $row['cognome_padre'] . " " . $row['nome_padre'] . "</td>";
                echo "<td>" . $row['cognome_madre'] . " " . $row['nome_madre'] . "</td>";
                echo '<td>
                <form action="insert-iscritto.php" method="POST">
                <input type="hidden" name="numero_tessera" value="' . $row['numero_tessera'] . '">
                <input type="submit" value="Modifica">
            </form>
            <form action="elimina-iscritto.php" method="POST">
                <input type="hidden" name="numero_tessera" value="' . $row['numero_tessera'] . '">
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