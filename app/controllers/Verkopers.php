<?php

class Verkopers extends BaseController
{
    private $Verkoper;

    public function __construct()
    {
        $this->Verkoper = $this->model('VerkopersModel');
    }


    public function index()
    {
        $result = $this->Verkoper->GetAllVerkopers();
        
        $data = [
            'title' => 'Overzicht Verkopers',
            'Verkopers' => $result
        ];

        $this->view('Verkopers/index', $data);
    }
}