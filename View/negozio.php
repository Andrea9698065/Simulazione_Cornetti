<?php
$Crud = new CCrud();
$data = $Crud->getAll(Table_Name);

$IntestazioneColonne = array(
        "id",
        "sapore",
        "prezzo",
        "Inserimento",
        "Azioni"
);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cornetti e Dolcetti - Negozio</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>NEGOZIO.PHP </h2>

<?php if(empty($data)) : ?>
    <strong>NON CI SONO CORNETTI</strong>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <?php foreach ($IntestazioneColonne as $key) : ?>
                <th><?= htmlspecialchars($key) ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($data as $row) : ?>
            <tr>
                <?php
                foreach ($row as $key => $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                ?>
                <td>
                    <a href="<?= GetUrl('vendi') ?>&id=<?= htmlspecialchars($row['id']) ?>">
                        <button class="btn-vendi">Vendi</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<br>
<a href="<?= GetUrl('aggiungi') ?>">
    <button>Aggiungi Cornetto</button>
</a>

</body>
</html>