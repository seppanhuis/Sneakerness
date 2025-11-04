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

    public function create()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $standType = $_POST['StandType'] ?? '';
            $prijs = $_POST['Prijs'] ?? '';

            if ($standType !== '' && $prijs !== '') {
                $prijsFloat = (float) str_replace(',', '.', $prijs);
                if ($prijsFloat < 0 || $prijsFloat > 99999999.99) {
                    $error = 'Prijs mag maximaal 99.999.999,99 zijn.';
                } else {
                    $data = [
                        'VerkoperId' => null,
                        'StandType' => trim($standType),
                        'Prijs' => $prijsFloat,
                        'VerhuurdStatus' => 0
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

        if (!is_numeric($standId)) {
            header("Location:" . URLROOT . "/Stands/index");
        }

        $stand = $this->Stands->GetStandById($standId);
        if (!$stand || $stand->VerhuurdStatus == 1) {
            header("Location:" . URLROOT . "/Stands/index");
        }

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
                } else {
                    $error = 'Verhuren mislukt.';
                }
            } else {
                $error = 'Kies een verkoper.';
            }
        }

        $verkopers = $this->Stands->GetAllVerkopers();

        $data = [
            'title' => 'Verhuur Stand',
            'stand' => $stand,
            'verkopers' => $verkopers,
            'error' => $error
        ];

        $this->view('Stands/verhuur', $data);
    }

    public function delete($Id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location:" . URLROOT . "/Stands/index");
        }

        // Delete via model
        $result = $this->Stands->deleteStand($Id);

        // Haal alle stands opnieuw op
        $allStands = $this->Stands->GetAllStands();

        // Verstuur direct naar index met message
        $data = [
            'title' => 'Overzicht Stands',
            'Stand' => $allStands,
            'message' => $result['message'],
            'error' => !$result['status']
        ];

        $this->view('Stands/index', $data);
    }

    public function update($Id)
    {
        $stand = $this->Stands->GetStandById($Id);

        if (!$stand) {
            $allStands = $this->Stands->GetAllStands();
            $data = [
                'title' => 'Overzicht Stands',
                'Stand' => $allStands,
                'message' => 'Deze stand bestaat niet.',
                'error' => true
            ];
            $this->view('Stands/index', $data);
            return;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $standType = $_POST['StandType'] ?? '';
            $prijs = $_POST['Prijs'] ?? '';

            if ($standType !== '' && $prijs !== '') {
                $prijsFloat = (float) str_replace(',', '.', $prijs);
                if ($prijsFloat < 0 || $prijsFloat > 99999999.99) {
                    $error = 'Prijs mag maximaal 99.999.999,99 zijn.';
                } else {
                    $dataUpdate = [
                        'StandType' => trim($standType),
                        'Prijs' => $prijsFloat
                    ];

                    $result = $this->Stands->UpdateStandDetails($Id, $dataUpdate);

                    $allStands = $this->Stands->GetAllStands();
                    $message = $result ? 'Stand succesvol bijgewerkt.' : 'Bijwerken mislukt.';
                    $data = [
                        'title' => 'Overzicht Stands',
                        'Stand' => $allStands,
                        'message' => $message,
                        'error' => !$result
                    ];
                    $this->view('Stands/index', $data);
                    return;
                }
            } else {
                $error = 'Vul alle velden in aub.';
            }
        }

        $data = [
            'title' => 'Wijzig Stand',
            'stand' => $stand,
            'error' => $error
        ];

        $this->view('Stands/update', $data);
    }
}
