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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            var_dump($_POST);
            $result = $this->ContactPersoon->CreateContactPersoon($_POST);
            if ($result) {
                header("Location:". URLROOT. "/ContactPersoon/index");
            }
        }

        $data = [
            'title' => 'Nieuwe Zanger',
            'Naam' => '',
            'Nettowaarde' => '',
            'Genre' => '',
            'Land' => '',
            'Mobiel' => '',
            'Leeftijd' => ''
        ];

        $this->view('ContactPersoon/create', $data);
    }
}