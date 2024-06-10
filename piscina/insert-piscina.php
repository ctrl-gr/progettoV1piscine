<!DOCTYPE html>
<html>
<head>
    <title>Inserimento/Modifica Piscina</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
        <h1>Inserimento/Modifica Piscina</h1>
        <a href="lista-piscine.php"><button>Lista Piscine</button></a>
    </div>

    <?php
    require_once("../index.php");

    $buttonLabel = 'Salva';
    $isModifica = false;

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $nome_piscina = $_GET['id'];
        $isModifica = true;
        $buttonLabel = $isModifica ? 'Aggiorna' : 'Salva';
        
        $query = "SELECT * FROM Piscina WHERE nome_piscina = '" . pg_escape_string($nome_piscina) . "'";
        $result = pg_query($conn, $query);

       
        if (pg_num_rows($result) > 0) {
            $piscina = pg_fetch_assoc($result);

           
            // Split del periodo apertura
            $periodo = explode("-", $piscina['periodo_apertura']);
            $piscina['periodoDa'] = trim($periodo[0]);
            $piscina['periodoA'] = trim($periodo[1]);

            // Split dei recapiti telefonici
            $recapiti = explode("-", $piscina['recapititelefonici']);
            $piscina['recapito1'] = trim($recapiti[0]);
            $piscina['recapito2'] = trim($recapiti[1]);
            $piscina['recapito3'] = trim($recapiti[2]);
        } else {
            echo "Piscina non trovata";
            exit;
        }
    } else {
        
        $piscina = [
            'nome_piscina' => '',
            'indirizzo' => '',
            'periodoDa' => '',
            'periodoA' => '',
            'recapito1' => '',
            'recapito2' => '',
            'recapito3' => ''
        ];
    }
    ?>

    <form action="salva_piscina.php" method="POST" class="form-style">
    <?php if ($isModifica): ?>
        <input type="hidden" name="isModifica" value="true">
    <?php endif; ?>
        <div class="form-row">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $piscina['nome_piscina']; ?>" required>
        </div>

        <div class="form-row">
            <label for="indirizzo">Indirizzo</label>
            <input type="text" id="indirizzo" name="indirizzo" value="<?php echo $piscina['indirizzo']; ?>" required>
        </div>

        <div class="form-row">
            <label for="periodoApertura">Periodo apertura:</label>
            <div class="form-column">
                <input type="text" id="periodoDa" name="periodoDa" value="<?php echo $piscina['periodoDa']; ?>" required placeholder="Da">
                <input type="text" id="periodoA" name="periodoA" value="<?php echo $piscina['periodoA']; ?>" required placeholder="A">
            </div>
        </div>

        <div class="form-row">
            <label for="recapitiTelefonici">Recapiti telefonici</label>
            <div class="form-column">
                <input type="text" id="recapito1" name="recapito1" value="<?php echo $piscina['recapito1']; ?>" required placeholder="Recapito 1">
                <input type="text" id="recapito2" name="recapito2" value="<?php echo $piscina['recapito2']; ?>" required placeholder="Recapito 2">
                <input type="text" id="recapito3" name="recapito3" value="<?php echo $piscina['recapito3']; ?>" required placeholder="Recapito 3">
            </div>
        </div>

        <input type="submit" value="<?php echo $buttonLabel; ?>">
    </form>
</body>
</html>
