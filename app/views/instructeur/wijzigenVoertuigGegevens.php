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

        <p><?= var_dump($data['formDetails']) ?></p>
        <p><?= var_dump($data['voerID']) ?></p>
        <p><?= var_dump($data['insID']) ?></p>

        <?= $data['formDetails'] ?>
    </main>
</body>

</html>