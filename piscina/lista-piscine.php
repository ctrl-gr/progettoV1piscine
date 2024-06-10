<!DOCTYPE html>
<html>
<head>
    <title>Lista Piscine</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
    <h1>Lista Piscine</h1>
    <a href="../gestione-piscine.php"><button>Homepage</button></a>
    <a href="insert-piscina.php"><button>Inserisci Piscina</button></a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Indirizzo</th>
                <th>Periodo Apertura</th>
                <th>Telefono</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once("../index.php");

            $query = "SELECT 
            P.nome_piscina, 
            P.indirizzo, 
            P.periodo_apertura, 
            STRING_AGG(T.telefono, ', ') AS numeri_telefono
        FROM 
            Piscina P
        LEFT JOIN 
            possiede PO ON P.nome_piscina = PO.piscina_nome_piscina
        LEFT JOIN 
            Telefono T ON PO.telefono_id_telefono = T.id_telefono
        GROUP BY 
            P.nome_piscina, P.indirizzo, P.periodo_apertura;
        
            ";
            $result = pg_query($conn, $query);

          
            while ($row = pg_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nome_piscina'] . "</td>";
                echo "<td>" . $row['indirizzo'] . "</td>";
                echo "<td>" . $row['periodo_apertura'] . "</td>";
                echo "<td>" . $row['numeri_telefono'] . "</td>";
                echo '<td><a href="insert-piscina.php?id=' . $row['nome_piscina'] . '">Modifica</a>
                <a href="elimina-piscina.php?id=' . $row['nome_piscina'] .'">Elimina</a>
                <a href="lista-vasche.php?id=' . $row['nome_piscina'] .'">Lista vasche</a>
                </td>';
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
