<?php

class Zanger extends BaseController
{
    private $Zanger;

    public function __construct()
    {
        $this->Zanger = $this->model('ZangersModel');
    }


    public function index()
    {
        $result = $this->Zanger->GetAllZangers();
        
        $data = [
            'title' => 'Overzicht Zanger',
            'Zanger' => $result
        ];

        $this->view('Zangers/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            var_dump($_POST);
            $result = $this->Zanger->createZanger($_POST);
            if ($result) {
                header("Location:". URLROOT. "/Zanger/index");
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

        $this->view('Zangers/create', $data);
    }

 
    public function edit($Id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->Zanger->updateZanger($Id, $_POST);
            if ($result) {
                header("Location:". URLROOT. "/Zanger/index");
                exit;
            }
        }

        $result = $this->Zanger->getZangerById($Id);

        $data = [
            'title' => 'Wijzigen Zanger',
            'Id' => $result->Id,
            'Naam' => $result->Naam,
            'Nettowaarde' => $result->Nettowaarde,
            'Genre' => $result->Genre,
            'Land' => $result->Land,
            'Mobiel' => $result->Mobiel,
            'Leeftijd' => $result->Leeftijd
        ];

        $this->view('Zangers/edit', $data);
    }

    public function delete($Id)
    {
        $result = $this->Zanger->deleteZanger($Id);

        header("Location:". URLROOT. "/Zanger/index");


        
    }
}