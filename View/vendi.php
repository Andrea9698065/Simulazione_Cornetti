<?php
$Crud = new CCrud();

$id = $_GET["id"] ?? null;
$messaggio = "";
if (empty($id)) {
    $messaggio = "ID non valido";
} else {

    $cornetto = $Crud->GetById($id, Table_Name);

    if ($cornetto == null) {
        $messaggio = "Il cornetto non esiste";
    } else {

        if ($Crud->Delete($id, Table_Name)) {
            $messaggio = "Venduto con Successo";
        } else {
            $messaggio = " Qualcosa è andato storto";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo $messaggio;
    ?>




    <a href="<?= GetUrl('negozio') ?>">
        <button>Negozio</button>
    </a>
</body>
</html>
