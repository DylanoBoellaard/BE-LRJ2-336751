<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/instructeurWijzigen.css">
</head>

<body>
    <main>
        <h3><?= $data['title'] ?></h3>

        <?= var_dump($data['instructeurOptions']) ?>
        <?= var_dump($data['instructorID']) ?>

        <?= $data['formDetails'] ?>
        <a href="<?= URLROOT ?>/instructeur/index">Selecteer een andere instructeur</a>
        <a href="<?= URLROOT ?>/home/index">Terug naar homepage</a>
    </main>
</body>

</html>