<?php

$errori = [];
$TCorrente = date("Y-m-d");
$CCrud = new CCrud();

$Successo = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sapore = $_POST['sapore'] ?? '';
    $prezzo = $_POST['prezzo'] ?? '';
    $data = $_POST['data'] ?? '';

    if (empty($sapore)) {
        $errori[] = "Seleziona un sapore";
    }
    if ($prezzo <= 1) {
        $errori[] = "Il prezzo deve essere almeno 1 euro";
    }

    $dataLimite = date("Y-m-d", strtotime("-2 days"));
    if ($data < $dataLimite) {
        $errori[] = "La data non può essere più vecchia di 2 giorni";
    }


    if (empty($errori)) {
        if($CCrud->InsertCornetto(Table_Name,$sapore, $prezzo, $data)) {
          $Successo =  true;
        }
    }


}

$Sapore = array(
        "vuoto",
        "crema",
        "cioccolato",
        "fragola",
);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>INSERISCI NUOVO CORNETTO </h1>

    <form method="POST" action="">

        <label>Sapore:</label>
        <select name="sapore" required>
            <option value="">Seleziona sapore </option>
           <?php  foreach ($Sapore as $value):   ?>
               <option value="<?= htmlspecialchars($value) ?>">
                   <?= htmlspecialchars($value) ?>
               </option>
           <?php endforeach;?>
        </select><br><br>

        <label for="prezzo">Inserisci Prezzo</label>
        <input type = "number" name = "prezzo" id="prezzo" min="1" value=""><br><br>

        <label for="data">
            <input type="date" name = "data" id="data" value="<?php echo $TCorrente ?>"><br><br>


            <button type="submit" class="btn-submit">Conferma</button>
    </form>


    <a href="<?= GetUrl('negozio') ?>">
        <button type="button" class="btn-cancel">Torna al Negozio</button>
    </a><br><br>

    <?php
        if($Successo === true)
            echo $Messaggio = "Aggiunto Con successo cornetti : ";;
    ?>

    <?php
        foreach ($errori as $value) :
            echo $value;
    ?>
    <?php  endforeach;?>

</body>
</html>

