<?php

class ticket extends BaseController
{
    // ✅ Voeg deze regel toe en kies de juiste zichtbaarheid
    private $ticketModel;   // of: protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = $this->model('ticketModel');
    }

    public function index()
    {
        $result = $this->ticketModel->getAllticket();

        $data = [
            'title'  => 'Overzicht ticket',
            'ticket' => $result
        ];

        $this->view('ticket/index', $data);
    }
}
