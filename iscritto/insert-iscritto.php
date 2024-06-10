<!DOCTYPE html>
<html>
<head>
    <title>Inserimento/Modifica Iscritto</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="header">
        <h1>Inserimento/Modifica Iscritto</h1>
        <a href="lista-iscritti.php"><button>Lista Iscritti</button></a>
    </div>

    <?php
    require_once("../index.php");

    $isModifica = false;
    $buttonLabel = $isModifica ? 'Aggiorna' : 'Salva';
    

    if (isset($_POST['numero_tessera'])) {
        $isModifica = true;
        $buttonLabel = 'Aggiorna';
        $numero_tessera = $_POST['numero_tessera'];

        $query = "SELECT * FROM Iscritto WHERE numero_tessera = " . pg_escape_string($numero_tessera);
        $result = pg_query($conn, $query);

        if (pg_num_rows($result) > 0) {
            $iscritto = pg_fetch_assoc($result);
        } else {
            echo "Iscritto non trovato";
            exit;
        }
    } else {
        $iscritto = [
            'numero_tessera' => '',
            'cognome' => '',
            'nome' => '',
            'madre' => '',
            'padre' => ''
        ];
    }
    ?>

    <form action="salva_iscritto.php" method="POST" class="form-style">
    <?php if ($isModifica): ?>
        <input type="hidden" name=numero_tessera value="<?php echo $iscritto['numero_tessera']; ?>">
    <?php endif; ?>
       
        <div class="form-row">
            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" value="<?php echo $iscritto['cognome']; ?>" required>
        </div>

        <div class="form-row">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo $iscritto['nome']; ?>" required>
        </div>

        <?php if (!$isModifica): ?>
        <div class="form-row">
            <label for="cognomeMadre">Cognome Madre</label>
            <input type="text" id="cognomeMadre" name="cognomeMadre" value="<?php echo $iscritto['madre']; ?>" required>
        </div>
       

        <div class="form-row">
            <label for="nomeMadre">Nome Madre</label>
            <input type="text" id="nomeMadre" name="nomeMadre" value="<?php echo $iscritto['padre']; ?>" required>
        </div>
        
        <div class="form-row">
            <label for="cognomePadre">Cognome Padre</label>
            <input type="text" id="cognomePadre" name="cognomePadre" value="<?php echo $iscritto['madre']; ?>" required>
        </div>

        <div class="form-row">
            <label for="nomePadre">Nome Padre</label>
            <input type="text" id="nomePadre" name="nomePadre" value="<?php echo $iscritto['padre']; ?>" required>
        </div>
        <?php endif; ?>
        
        <input type="submit" value="<?php echo $buttonLabel; ?>">
    </form>
</body>
</html>

