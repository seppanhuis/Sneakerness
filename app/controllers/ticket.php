<?php

class Ticket extends BaseController
{
    private $ticketModel;
    private $bezoekerModel;
    private $evenementModel;
    private $prijsModel;

    public function __construct()
    {
        $this->ticketModel = $this->model('ticketModel');
        $this->bezoekerModel = $this->model('bezoekerModel');
        $this->evenementModel = $this->model('evenementModel');
        $this->prijsModel = $this->model('prijsModel');
    }

    // Overzicht tickets
    public function index()
    {
        $tickets = $this->ticketModel->getAllTicket();

        $data = [
            'title' => 'Overzicht tickets',
            'tickets' => $tickets
        ];

        $this->view('ticket/index', $data);
    }

    // Ticket verwijderen
    public function delete($id)
    {
        $this->ticketModel->delete($id);
        header('Refresh:2; url=' . URLROOT . '/ticket/index');
    }

    // Ticket aanmaken
    public function create()
    {
        $bezoekers = $this->bezoekerModel->getAll();
        $evenementen = $this->evenementModel->getAll();
        $prijzen = $this->prijsModel->getAll();

        $data = [
            'title' => 'Nieuw ticket kopen',
            'message' => 'none',
            'bezoekers' => $bezoekers,
            'evenementen' => $evenementen,
            'prijzen' => $prijzen
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->ticketModel->create($_POST);
            $data['message'] = 'flex';
            header('Refresh:2; url=' . URLROOT . '/ticket/index');
        }

        $this->view('ticket/create', $data);
    }

    // Ticket aanpassen
    public function update($id)
    {
        $ticket = $this->ticketModel->getById($id);
        $bezoekers = $this->bezoekerModel->getAll();
        $evenementen = $this->evenementModel->getAll();
        $prijzen = $this->prijsModel->getAll();

        $data = [
            'title' => 'Ticket aanpassen',
            'ticket' => $ticket,
            'bezoekers' => $bezoekers,
            'evenementen' => $evenementen,
            'prijzen' => $prijzen,
            'message' => 'none'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $_POST;
            $postData['id'] = $id;
            $this->ticketModel->updateTicket($postData);
            $data['message'] = 'flex';
            header('Refresh:2; url=' . URLROOT . '/ticket/index');
        }

        $this->view('ticket/update', $data);
    }

    // Bezoeker koopt ticket (pagina koop)
    public function koop()
    {
        $bezoekers = $this->bezoekerModel->getAll();
        $evenementen = $this->evenementModel->getAll();
        $prijzen = $this->prijsModel->getAll();

        $data = [
            'title' => 'Koop Ticket',
            'bezoekers' => $bezoekers,
            'evenementen' => $evenementen,
            'prijzen' => $prijzen,
            'message' => 'none'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->ticketModel->create($_POST);
            $data['message'] = 'flex';
        }

        $this->view('ticket/koop', $data);
    }
}
