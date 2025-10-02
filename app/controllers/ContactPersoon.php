<?php

class ContactPersoon extends BaseController
{
    private $ContactPersoon;

    public function __construct()
    {
        $this->ContactPersoon = $this->model('ContactPersoonModel');
    }

    // stuur alle data van de contact personen naar ContactPersoon/index met de data ContactPersonen
    public function index()
    {
        try {
        $result = $this->ContactPersoon->GetAllContactPersonen();
        
        $data = [
            'title' => 'Overzicht Contactpersonen',
            'ContactPersonen' => $result
        ];

        $this->view('ContactPersoon/index', $data);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

        public function create()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Alleen verwerken als alle velden bestaan én niet leeg zijn
            if (
                isset($_POST['Naam'], $_POST['Telefoonnummer'], $_POST['Emailadres']) &&
                trim($_POST['Naam']) !== '' &&
                trim($_POST['Telefoonnummer']) !== '' &&
                trim($_POST['Emailadres']) !== ''
            ) {
                $data = [
                    'Naam' => trim($_POST['Naam']),
                    'Telefoonnummer' => trim($_POST['Telefoonnummer']),
                    'Emailadres' => trim($_POST['Emailadres'])
                ];
                $result = $this->ContactPersoon->CreateContactPersoon($data);
                if ($result) {
                    header("Location:". URLROOT. "/ContactPersoon/index");
                    exit;
                } else {
                    $error = 'Opslaan mislukt.';
                }
            } else {
                $error = 'Vul alle velden in aub.';
            }
        }

        $data = [
            'title' => 'Nieuwe Zanger',
            'Naam' => $_POST['Naam'] ?? '',
            'Telefoonnummer' => $_POST['Telefoonnummer'] ?? '',
            'Emailadres' => $_POST['Emailadres'] ?? '',
            'error' => $error
        ];

        $this->view('ContactPersoon/create', $data);
    }
}