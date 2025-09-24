<?php

// Controller voor ticket functionaliteit
class ticket extends BaseController
{
    // ✅ Model voor ticket data ophalen
    private $ticketModel;   // of: protected $ticketModel;

    // Constructor: initialiseert het ticketModel
    public function __construct()
    {
        // Laad het ticketModel via de model-methode van BaseController
        $this->ticketModel = $this->model('ticketModel');
    }

    // Index-methode: haalt alle tickets op en toont het overzicht
    public function index()
    {
        // Haal alle tickets op via het model
        $result = $this->ticketModel->getAllticket();

        // Data array voor de view
        $data = [
            'title'  => 'Overzicht ticket',
            'ticket' => $result
        ];

        // Laad de view en geef de data mee
        $this->view('ticket/index', $data);
    }
}
