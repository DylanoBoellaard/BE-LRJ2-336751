<?php

class Country extends BaseController
{
    private $countryModel;

    public function __construct()
    {
        $this->countryModel = $this->model('CountryModel');
    }

    public function index()
    {
        $countries = $this->countryModel->getCountries();

        //var_dump($countries);
        $rows = "";
        foreach ($countries as $result) {
            $rows .= "<tr>
                        <td>$result->Id</td>
                        <td>$result->Naam</td>
                    </tr>";
        }

        $data = [
            'title' => 'Country pagina test',
            'records' => 'info uit de database',
            'rows' => $rows
        ];

        $this->view('country/index', $data);
    }
}