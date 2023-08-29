<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/instructeurGlobal.css">
    <link rel="stylesheet" href="../../../public/css/instructeurHome.css">
</head>
<body>
    <main>
        <h3><?= $data['title'] ?></h3>

        <table>
            <thead>
                <th>Voornaam</th>
                <th>Tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Mobiel</th>
                <th>Datum in dienst</th>
                <th>Aantal sterren</th>
                <th>Voertuigen</th>
            </thead>
            <tbody>
                <?= $data['tableRows']; ?>
            </tbody>
        </table>

        <a href="<?= URLROOT ?>/home/index">Terug naar homepage</a>
    </main>
</body>
</html>