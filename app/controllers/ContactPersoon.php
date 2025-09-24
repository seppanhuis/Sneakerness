<?php

class ContactPersoon extends BaseController
{
    private $ContactPersoon;

    public function __construct()
    {
        $this->ContactPersoon = $this->model('ContactPersoonModel');
    }


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
}