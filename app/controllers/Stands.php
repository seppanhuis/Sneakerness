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
}