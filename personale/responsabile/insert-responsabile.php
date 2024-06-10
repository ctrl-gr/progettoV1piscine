<!DOCTYPE html>
<html>

<head>
    <title>Inserimento/Modifica Responsabile</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="header">
        <h1>Inserimento/Modifica Responsabile</h1>
        <a href="../lista-personale.php"><button>Lista Personale</button></a>
    </div>

    <?php
    require_once("../../index.php");

    $isModifica = false;
    $buttonLabel = $isModifica ? 'Aggiorna' : 'Salva';

    $id_responsabile = isset($_POST['id_personale']) ? $_POST['id_personale'] : '';


    if ($id_responsabile) {

        $isModifica = true;
        $buttonLabel = 'Aggiorna';


            $query = "SELECT * FROM Responsabile WHERE id_responsabile = " . pg_escape_string($id_responsabile);
            $result = pg_query($conn, $query);

            if (pg_num_rows($result) > 0) {
                $responsabile = pg_fetch_assoc($result);

            } else {
                echo "Responsabile non trovato";
                exit;
            }
        } else {
            $responsabile = [
                'cognome' => '',
                'nome' => '',
                'nome_piscina' => ''
            ];
        }

    ?>

    <form action="salva_responsabile.php" method="POST" class="form-style">
       
        <?php if ($isModifica): ?>
                <input type="hidden" name="id_responsabile" value="<?php echo $id_responsabile; ?>">
        <?php endif; ?>
            <div class="form-row">
                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" name="cognome" value="<?php echo $responsabile['cognome']; ?>" required>
            </div>

            <div class="form-row">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?php echo $responsabile['nome']; ?>" required>
            </div>

            <div class="form-row">
                <label for="piscina">Piscina</label>
                <input type="text" id="piscina" name="nome_piscina" value="<?php echo $responsabile['nome_piscina']; ?>" required>
            </div>

        <input type="submit" value="<?php echo $buttonLabel; ?>">
    </form>
</body>

</html>