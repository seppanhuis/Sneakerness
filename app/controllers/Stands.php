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

    public function delete($Id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location:" . URLROOT . "/Stands/index");
        }

        $result = $this->Stands->deleteStand($Id);
        $allStands = $this->Stands->GetAllStands();

        $data = [
            'title' => 'Overzicht Stands',
            'Stand' => $allStands,
            'message' => $result['message'],
            'error' => !$result['status']
        ];

        $this->view('Stands/index', $data);
    }
}
