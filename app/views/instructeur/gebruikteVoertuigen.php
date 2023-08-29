<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gebruikte voertuigen</title>
    <link rel="stylesheet" href="../../../public/css/instructeurGlobal.css">
    <link rel="stylesheet" href="../../../public/css/instructeurVoertuigen.css">
</head>
<body>
    <main>
        <h3><?= $data['title'] ?></h3>

        <div class="instructeur">
            <p>
                <span>Naam: </span><?= $data['instructeur'][0]->Voornaam . " " . $data['instructeur'][0]->Tussenvoegsel . " " . $data['instructeur'][0]->Achternaam ?>
                <br><span>Datum in dienst: </span><?= $data['instructeur'][0]->DatumInDienst ?>
                <br><span>Aantal sterren: </span><?= $data['instructeur'][0]->AantalSterren ?>
            </p>
            <?= $data['instructeurLink'] ?>
            
            
        </div>
<a href=""></a>
        <div class="voertuigTable">
            <table>
                <thead>
                    <th>Type voertuig</th>
                    <th>Type</th>
                    <th>Kenteken</th>
                    <th>Bouwjaar</th>
                    <th>Brandstof</th>
                    <th>Rijbewijscategorie</th>
                </thead>
                <tbody>
                    <?= $data['tableRows']; ?>
                </tbody>
            </table>
        </div>

        <br>
        <a href="<?= URLROOT ?>/instructeur/index">Selecteer een andere instructeur</a><br>
        <a href="<?= URLROOT ?>/home/index">Terug naar homepage</a>
    </main>
</body>
</html>