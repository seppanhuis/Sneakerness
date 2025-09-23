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
}