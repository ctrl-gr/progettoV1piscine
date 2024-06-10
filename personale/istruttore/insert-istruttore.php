<!DOCTYPE html>
<html>

<head>
    <title>Inserimento/Modifica Istruttore</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="header">
        <h1>Inserimento/Modifica Istruttore</h1>
        <a href="../lista-personale.php"><button>Lista Personale</button></a>
    </div>

    <?php
    require_once("../../index.php");

    $isModifica = false;
    $buttonLabel = $isModifica ? 'Aggiorna' : 'Salva';

    $id_istruttore = isset($_POST['id_personale']) ? $_POST['id_personale'] : '';


    if ($id_istruttore) {

        $isModifica = true;
        $buttonLabel = 'Aggiorna';


            $query = "SELECT * FROM Istruttore WHERE id_istruttore = " . pg_escape_string($id_istruttore);
            $result = pg_query($conn, $query);

            if (pg_num_rows($result) > 0) {
                $istruttore = pg_fetch_assoc($result);

            } else {
                echo "Istruttore non trovato";
                exit;
            }
        } else {
            $istruttore = [
                'cognome' => '',
                'nome' => '',
                'nome_piscina' => ''
            ];
        }

    ?>

    <form action="salva_istruttore.php" method="POST" class="form-style">
       
        <?php if ($isModifica): ?>
                <input type="hidden" name="id_istruttore" value="<?php echo $id_istruttore; ?>">
        <?php endif; ?>
            <div class="form-row">
                <label for="cognome">Cognome:</label>
                <input type="text" id="cognome" name="cognome" value="<?php echo $istruttore['cognome']; ?>" required>
            </div>

            <div class="form-row">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?php echo $istruttore['nome']; ?>" required>
            </div>

            <div class="form-row">
                <label for="piscina">Piscina</label>
                <input type="text" id="piscina" name="nome_piscina" value="<?php echo $istruttore['nome_piscina']; ?>" required>
            </div>

        <input type="submit" value="<?php echo $buttonLabel; ?>">
    </form>
</body>

</html>