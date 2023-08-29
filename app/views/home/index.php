<?php require_once 'C:\Users\Gebruiker\Documents\School Utrecht\Backend\Leerjaar 1\Periode 3\MVC-Framework\app\views\includes\header.php'; ?>

    <h3><?= $data['title']; ?></h3>
    <a href="<?= URLROOT; ?>/country/index"> Ga naar de landenpagina</a>

    <table border="1">
        <thead>
            <th>Id</th>
            <th>Naam</th>
            <tbody>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['naam'] ?></td>
                </tr>
            </tbody>
        </thead>
    </table>

<?php require_once 'C:\Users\Gebruiker\Documents\School Utrecht\Backend\Leerjaar 1\Periode 3\MVC-Framework\app\views\includes\footer.php'; ?>