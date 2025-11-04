<?php

class Stands extends BaseController
{
    private $Stands;

    public function __construct()
    {
        $this->Stands = $this->model('StandsModel');
    }

    public function index()
    {
        try {
            $result = $this->Stands->GetAllStands();
            $data = [
                'title' => 'Overzicht Stands',
                'Stand' => $result
            ];
            $this->view('Stands/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function update($standId)
    {
        $error = '';
        $stand = $this->Stands->GetStandById($standId);

        if (!$stand) {
            header("Location:" . URLROOT . "/Stands/index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $standType = $_POST['StandType'] ?? '';
            $prijs = $_POST['Prijs'] ?? '';

            if ($standType !== '' && $prijs !== '') {
                $prijsFloat = (float) str_replace(',', '.', $prijs);
                if ($prijsFloat < 0 || $prijsFloat > 99999999.99) {
                    $error = 'Prijs mag maximaal 99.999.999,99 zijn.';
                } else {
                    $data = [
                        'StandType' => trim($standType),
                        'Prijs' => $prijsFloat
                    ];

                    $result = $this->Stands->UpdateStandDetails($standId, $data);

                    if ($result) {
                        header("Location:" . URLROOT . "/Stands/index?message=Stand succesvol gewijzigd");
                        exit;
                    } else {
                        $error = 'Update mislukt.';
                    }
                }
            } else {
                $error = 'Vul alle velden in aub.';
            }
        }

        $data = [
            'title' => 'Stand Wijzigen',
            'StandType' => $stand->StandType,
            'Prijs' => $stand->Prijs,
            'error' => $error,
            'Id' => $standId
        ];

        $this->view('Stands/update', $data);
    }
}
