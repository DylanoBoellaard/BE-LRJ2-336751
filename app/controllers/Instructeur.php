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

        $instructorCount = $this->instructeurModel->countInstructeurs();

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
            'tableRows' => $rows,
            'instructorCount' => $instructorCount
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
                        <td><a href='../wijzigenVoertuigGegevens/" . $voertuig->Id . "/" . $Id . "'><img src='../../public/img/Edit-icon.png' alt='edit'></a></td>
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
                        <td><a href='../wijzigenVoertuigGegevens/" . intval($beschikbareVoertuigen->Id) . "/" . intval($Id) . "'><img src='../../public/img/Edit-icon.png' alt='edit'></a></td>
                    </tr>";
                }

                $data = [
                    'title' => 'Alle beschikbare voertuigen',
                    'instructeur' => $instructeur,
                    'tableRows' => $tableRows,
                    'voertuigId' => $beschikbareVoertuigen->Id,
                    'instructeurId' => $Id
                ];

                $this->view('instructeur/beschikbareVoertuigen', $data);
            }
        }
    }

    public function wijzigenVoertuigGegevens($vId, $iId)
    {
        // Check if wijzigen button has been pressed for updating after user has filled in the form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Bind form values to variables
            $type = $_POST['type'];
            $bouwjaar = $_POST['bouwjaar'];
            $brandstof = $_POST['brandstof'];
            $kenteken = $_POST['kenteken'];

            $selectedInstructorId = intval($_POST['instructeur']);
            $selectedTypeVoertuigId = intval($_POST['typeVoertuig']);
            //var_dump($selectedInstructorId);      FOR TESTING
            //var_dump($selectedTypeVoertuigId);    FOR TESTING

            // Send the variables to the database to be updated
            $result = $this->instructeurModel->updateVoertuigGegevens($vId, $selectedInstructorId, $selectedTypeVoertuigId, $type, $bouwjaar, $brandstof, $kenteken);

            // Send user to different page.
            if ($result) {
                // Update succesful
                echo "Succesvol geupdate";
                header('Refresh:3; url=/instructeur/gebruikteVoertuigen.php');
            } else {
                // update unsuccesful
                echo "Error, data couldn't be updated";
                header('Refresh:3; url=/instructeur/gebruikteVoertuigen.php');
            }
        } else { // When user first loads the page to display the form itself (wijzigen form button has not been pressed yet)
            $result = $this->instructeurModel->wijzigenVoertuigGegevens($vId, $iId);    // Get all required form data
            $instructors = $this->instructeurModel->getInstructeurs();                  // Get all instructeurs
            $typesOfVoertuigen = $this->instructeurModel->getAllTypesOfVoertuigen();    // Get all typeVoertuigen

            if (empty($result)) {
                $formDetails = "<tr><td colspan='6'>Geen Voertuigen gevonden</td></tr>";
                //header('Refresh:3; url=/instructeur/index.php');
            } else {
                //var_dump($result);

                // Variables to display all instructeurs
                $instructeurOptions = "";
                $instructor = 0;

                // Foreach loop to display all of the instructors in dropdown option
                foreach ($instructors as $instructor) {
                    $selected = ($instructor->Id == $iId) ? 'selected' : ''; // Check if the instructor is selected
                    $instructeurOptions .= "<option value='{$instructor->Id}' $selected>{$instructor->Voornaam} {$instructor->Tussenvoegsel} {$instructor->Achternaam}</option>";
                }

                // Fill in $formDetails variable with HTML tags and filled PHP variables
                $formDetails = "";
                foreach ($result as $info) {
                    if (empty($info->Tussenvoegsel)) {
                        $info->Tussenvoegsel = ' ';
                    }
                
                    // Variable to display all typeVoertuig values
                    $typeVoertuigOptions = "";

                    // Foreach loop to display all of the typeVoertuig values in dropdown option
                    foreach ($typesOfVoertuigen as $typeVoertuigItem) {
                        $selected = ($typeVoertuigItem->TypeVoertuig == $info->TypeVoertuig) ? 'selected' : ''; // Check if the type voertuig is selected
                        $typeVoertuigOptions .= "<option value='{$typeVoertuigItem->Id}' $selected>{$typeVoertuigItem->TypeVoertuig}</option>";
                    }

                    // Variables to auto-select form option with corresponding value
                    $checkedBenzine = '';
                    $checkedElektrisch = '';
                    $checkedDiesel = '';

                    if ($info->Brandstof == 'benzine') {
                        $checkedBenzine = 'checked';
                    } else if ($info->Brandstof == 'elektrisch') {
                        $checkedElektrisch = 'checked';
                    } else if ($info->Brandstof == 'diesel') {
                        $checkedDiesel = 'checked';
                    }

                    // Form variable gets filled
                $formDetails .= "<form action='' method='post'>
                <fieldset>
                <label for='instructeur'>Instructeur:</label>
                    <select name='instructeur' id='instructeur'>
                        $instructeurOptions
                    </select>
                <label for='typeVoertuig'>Type Voertuig:</label>
                    <select name='typeVoertuig' id='typeVoertuig'>
                        $typeVoertuigOptions
                    </select>
                <label for='type'>Type:</label>
                    <input type='text' name='type' id='type' value='$info->Type'>
                <label for='bouwjaar'>Bouwjaar:</label>
                    <input type='date' name='bouwjaar' id='bouwjaar' value='$info->Bouwjaar' readonly>
                <div id='wijzigenBrandstof'>
                    <label for='diesel'>
                        <input type='radio' name='brandstof' id='diesel' value='diesel' $checkedDiesel>
                        Diesel</label>
                    <label for='benzine'>
                        <input type='radio' name='brandstof' id='benzine' value='benzine' $checkedBenzine>
                        Benzine</label>
                    <label for='elektrisch'>
                        <input type='radio' name='brandstof' id='elektrisch' value='elektrisch' $checkedElektrisch>
                        Elektrisch</label>
                </div>
                <label for='kenteken'>Kenteken:</label>
                    <input type='text' name='kenteken' id='kenteken' value='$info->Kenteken'>
                <button type='submit'>Wijzig</button>
                </fieldset>
            </form>";
                }
            }

            $data = [
                'title' => 'Wijzigen voertuiggegevens',         // Title to display in HTML file
                'formDetails' => $formDetails,                  // To display form in HTML file
                'voerID' => $vId,                               // FOR TESTING
                'insID' => $iId,                                // FOR TESTING
                'instructeurOptions' => $instructeurOptions,    // FOR TESTING
                'instructorID' => $instructor->Id               // FOR TESTING
            ];

            $this->view('instructeur/wijzigenVoertuigGegevens', $data);
        }
    }
}
