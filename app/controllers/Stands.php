<?php

class Stands extends BaseController
{
    private $Stands;

    public function __construct()
    {
        $this->Stands = $this->model('StandsModel');
    }

    //stuurt alle informatie van de stands naar de view als Stand naar Stand/index
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

    public function create()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $standType = $_POST['StandType'] ?? '';
            $prijs = $_POST['Prijs'] ?? '';

            // Controleer dat de velden niet leeg zijn
            if ($standType !== '' && $prijs !== '') {

                // Converteer prijs naar float en limiet check
                $prijsFloat = (float) str_replace(',', '.', $prijs);
                if ($prijsFloat < 0 || $prijsFloat > 99999999.99) {
                    $error = 'Prijs mag maximaal 99.999.999,99 zijn.';
                } else {
                    $data = [
                        'VerkoperId' => null,           // geen verkoper gekoppeld
                        'StandType' => trim($standType),
                        'Prijs' => $prijsFloat,
                        'VerhuurdStatus' => 0           // standaard Niet Verhuurd
                    ];

                    $result = $this->Stands->CreateStand($data);

                    if ($result === 'duplicate_stand') {
                        $error = 'Deze Stand bestaat al.';
                    } elseif ($result) {
                        header("Location:" . URLROOT . "/Stands/index");
                    } else {
                        $error = 'Opslaan mislukt.';
                    }
                }
            } else {
                $error = 'Vul alle velden in aub.';
            }
        }

        // Data terugsturen naar de view
        $data = [
            'title' => 'Nieuwe Stand',
            'StandType' => $_POST['StandType'] ?? '',
            'Prijs' => $_POST['Prijs'] ?? '',
            'error' => $error
        ];

        $this->view('Stands/create', $data);
    }

    public function verhuur($standId)
{
    $error = '';

    // Check geldig standId
    if (!is_numeric($standId)) {
        header("Location:" . URLROOT . "/Stands/index");
        return;
    }

    // Haal stand op
    $stand = $this->Stands->GetStandById($standId);
    if (!$stand || $stand->VerhuurdStatus == 1) {
        header("Location:" . URLROOT . "/Stands/index");
        return;
    }

    // Verwerk POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $verkoperId = $_POST['VerkoperId'] ?? '';

        if ($verkoperId !== '') {
            $data = [
                'VerhuurdStatus' => 1,
                'VerkoperId' => (int)$verkoperId
            ];

            $result = $this->Stands->UpdateStand($standId, $data);

            if ($result) {
                header("Location:" . URLROOT . "/Stands/index");
                return;
            } else {
                $error = 'Verhuren mislukt.';
            }
        } else {
            $error = 'Kies een verkoper.';
        }
    }

    // Haal alle verkopers op
    $verkopers = $this->Stands->GetAllVerkopers();

    $data = [
        'title' => 'Verhuur Stand',
        'stand' => $stand,
        'verkopers' => $verkopers,
        'error' => $error
    ];

    $this->view('Stands/verhuur', $data);
}

}
