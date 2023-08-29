<?php

class Instructeur extends BaseController
{
    private $instructeurModel;

    public function __construct()
    {
        $this->instructeurModel = $this->model('InstructeurModel');
    }

    public function index()
    {
        $result = $this->instructeurModel->getInstructeurs();

        $rows = "";
        foreach ($result as $instructeur) {
            $rows .= "<tr>
                        <td>$instructeur->Voornaam</td>
                        <td>$instructeur->Tussenvoegsel</td>
                        <td>$instructeur->Achternaam</td>
                        <td>$instructeur->Mobiel</td>
                        <td>$instructeur->DatumInDienst</td>
                        <td>$instructeur->AantalSterren</td>
                        <td><a href='../instructeur/gebruikteVoertuigen/" . $instructeur->Id . "'><img src='../../public/img/Car-logo-transparent.png' alt='car'></a></td>
                    </tr>";
        }

        $data = [
            'title' => 'Instructeurs in dienst',
            'tableRows' => $rows
        ];

        $this->view('instructeur/index', $data);
    }

    public function gebruikteVoertuigen($Id)
    {
        $instructeur = $this->instructeurModel->getInstructeurById($Id);

        $instructeurLink = "<a href='../beschikbareVoertuigen/" . $Id . "'>Toevoegen voertuig</a>";

        $result = $this->instructeurModel->getToegewezenVoertuigen($Id);

        if (empty($result)) {
            $tableRows = "<tr><td colspan='6'>Geen Toegewezen Voertuigen</td></tr>";
            header('Refresh:3; url=/instructeur/index.php');
        } else {
            //var_dump($result);

            $tableRows = "";
            foreach ($result as $voertuig) {
                $tableRows .= "<tr>
                        <td>$voertuig->TypeVoertuig</td>
                        <td>$voertuig->Type</td>
                        <td>$voertuig->Kenteken</td>
                        <td>$voertuig->Bouwjaar</td>
                        <td>$voertuig->Brandstof</td>
                        <td>$voertuig->Rijbewijscategorie</td>
                    </tr>";
            }
        }

        $data = [
            'title' => 'Door instructeur gebruikte voertuigen',
            'tableRows' => $tableRows,
            'instructeur' => $instructeur,
            'instructeurLink' => $instructeurLink
        ];

        $this->view('instructeur/gebruikteVoertuigen', $data);
    }

    public function beschikbareVoertuigen($Id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $voertuigId = intval($_POST['voertuigId']); // Convert to int
            $this->instructeurModel->insertVoertuigInstructeur($Id, $voertuigId); // Run insert function with instructeurId & voertuigId as parameters
            //var_dump($voertuigId);
            echo "Voertuig succesvol toegevoegd";

            // Redirect to gebruikteVoertuigen page
            header('Refresh:3; url=/instructeur/gebruikteVoertuigen/' . $Id);
        } else { // Shows available vehicles
            $instructeur = $this->instructeurModel->getInstructeurById($Id);
            $result = $this->instructeurModel->getBeschikbareVoertuigen();

            if ($result == NULL) {
                echo "Error: Geen beschikbare voertuigen om toe te voegen!";
                header('Refresh:3; url=/instructeur/gebruikteVoertuigen/' . $Id);
            } else {
                $tableRows = "";
                foreach ($result as $beschikbareVoertuigen) {
                    $tableRows .= "<tr>
                        <td>$beschikbareVoertuigen->TypeVoertuig</td>
                        <td>$beschikbareVoertuigen->Type</td>
                        <td>$beschikbareVoertuigen->Kenteken</td>
                        <td>$beschikbareVoertuigen->Bouwjaar</td>
                        <td>$beschikbareVoertuigen->Brandstof</td>
                        <td>$beschikbareVoertuigen->Rijbewijscategorie</td>
                        <td>
                            <form method='post' action=''>
                                <input type='hidden' name='voertuigId' value='$beschikbareVoertuigen->Id'>
                                <button type='submit'>
                                    <img src='../../public/img/Plus-button.png' alt='plus-button'>
                                </button>
                            </form>
                        </td>
                    </tr>";
                }

                $data = [
                    'title' => 'Alle beschikbare voertuigen',
                    'instructeur' => $instructeur,
                    'tableRows' => $tableRows
                ];

                $this->view('instructeur/beschikbareVoertuigen', $data);
            }
        }
    }
}
