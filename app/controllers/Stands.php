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
        // Alleen verwerken als alle velden bestaan én geen lege waarden zijn
        if (
            isset($_POST['StandType'], $_POST['Prijs'], $_POST['VerhuurdStatus']) &&
            trim($_POST['StandType']) !== '' &&
            trim($_POST['Prijs']) !== '' &&
            trim($_POST['VerhuurdStatus']) !== ''
        ) {
            $data = [
                'StandType' => trim($_POST['StandType']),
                'Prijs' => trim($_POST['Prijs']),
                'VerhuurdStatus' => trim($_POST['VerhuurdStatus'])
            ];
            $result = $this->Stands->CreateStand($data);
            if ($result === 'duplicate_stand') {
                $error = 'Deze Stand bestaat al';
            } elseif ($result) {
                header("Location:" . URLROOT . "/Stands/index");
                exit;
            } else {
                $error = 'Opslaan mislukt.';
            }
        } else {
            $error = 'Vul alle velden in aub.';
        }
    }

    $data = [
        'title' => 'Nieuwe Stand',
        'StandType' => $_POST['StandType'] ?? '',
        'Prijs' => $_POST['Prijs'] ?? '',
        'VerhuurdStatus' => $_POST['VerhuurdStatus'] ?? '',
        'error' => $error
    ];

    $this->view('Stands/create', $data);
}

}