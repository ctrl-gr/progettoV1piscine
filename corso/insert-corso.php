<!DOCTYPE html>
<html>
<head>
    <title>Inserimento/Modifica Corso</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
        <h1>Inserimento/Modifica Corso</h1>
        <a href="lista-corsi.php"><button>Lista Corsi</button></a>
    </div>

    <?php
    require_once("../index.php");

    $isModifica = false;
    $buttonLabel = $isModifica ? 'Aggiorna' : 'Salva';
    

    if (isset($_POST['id_corso'])) {
        $isModifica = true;
        $buttonLabel = 'Aggiorna';
        $id_corso = $_POST['id_corso'];

        $query = "SELECT * FROM Corso WHERE id_corso = " . pg_escape_string($id_corso);
        $result = pg_query($conn, $query);

        if (pg_num_rows($result) > 0) {
            $corso = pg_fetch_assoc($result);
        } else {
            echo "Corso non trovato";
            exit;
        }
    } else {
        $corso = [
            'tipo' => '',
            'costo' => '',
            'partecipanti_min' => '',
            'partecipanti_max' => ''
        ];
    }
    ?>

    <form action="salva_corso.php" method="POST" class="form-style">
    <?php if ($isModifica): ?>
        <input type="hidden" name=id_corso value="<?php echo $corso['id_corso']; ?>">
    <?php endif; ?>
        <div class="form-row">
            <label for="nome">Tipo corso:</label>
            <input type="text" id="tipo" name="tipo" value="<?php echo $corso['tipo']; ?>" required>
        </div>

        <div class="form-row">
            <label for="costo">Costo</label>
            <input type="number" id="costo" name="costo" value="<?php echo $corso['costo']; ?>" required>
        </div>

        <div class="form-row">
            <label for="partecipantiMin">Numero minimo partecipanti</label>
            <input type="number" id="partecipantiMin" name="partecipantiMin" value="<?php echo $corso['partecipanti_min']; ?>" required>
        </div>

        <div class="form-row">
            <label for="partecipantiMax">Numero massimo partecipanti</label>
            <input type="number" id="partecipantiMax" name="partecipantiMax" value="<?php echo $corso['partecipanti_max']; ?>" required>
        </div>
        
        <input type="submit" value="<?php echo $buttonLabel; ?>">
    </form>
</body>
</html>
