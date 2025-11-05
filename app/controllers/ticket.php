<?php

/*
  Controller voor Ticket-gerelateerde acties.
  Bevat methodes voor overzicht, aanmaken, verwijderen en aanpassen van tickets.
*/
class Ticket extends BaseController
{
    private $ticketModel;
    private $bezoekerModel;
    private $evenementModel;
    private $prijsModel;

    public function __construct()
    {
        // Maak instances van benodigde modellen via de BaseController helper
        $this->ticketModel = $this->model('ticketModel');
        $this->bezoekerModel = $this->model('bezoekerModel');
        $this->evenementModel = $this->model('evenementModel');
        $this->prijsModel = $this->model('prijsModel');
    }

    // Overzicht tickets: laadt alle tickets en stuurt naar de index view
    public function index()
    {
        $tickets = $this->ticketModel->getAllTicket();

        $data = [
            'title' => 'Overzicht tickets',
            'tickets' => $tickets
        ];

        $this->view('ticket/index', $data);
    }

    // Ticket verwijderen: roept model aan en redirect naar overzicht
    public function delete($id)
    {
        // Verwijder het ticket in de database
        $this->ticketModel->delete($id);
        // Redirect terug naar index. Hier wordt gebruikgemaakt van een Refresh in de originele code.
        header('Refresh:2; url=' . URLROOT . '/ticket/index');
    }

    // Ticket aanmaken: toont formulier en verwerkt POST
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
            // Verwerk formulierdata en maak ticket aan
            $this->ticketModel->create($_POST);
            $data['message'] = 'flex';
            // Redirect naar index na succesvolle creatie
            header('Refresh:2; url=' . URLROOT . '/ticket/index');
        }

        $this->view('ticket/create', $data);
    }

    // Ticket aanpassen: laad bestaande data, valideren en opslaan
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

            // Server-side validatie: zorg dat de geselecteerde datum overeenkomt met het evenement
            $selectedEventId = isset($postData['EvenementId']) ? $postData['EvenementId'] : null;
            $submittedDatum = isset($postData['Datum']) ? $postData['Datum'] : null;
            $eventDatum = null;

            foreach ($evenementen as $ev) {
                if ($ev->Id == $selectedEventId) {
                    $eventDatum = $ev->Datum;
                    break;
                }
            }

            $normalize = function($d) {
                if (!$d) return null;
                $ts = strtotime($d);
                if ($ts === false) return null;
                return date('Y-m-d', $ts);
            };

            $normSubmitted = $normalize($submittedDatum);
            $normEvent = $normalize($eventDatum);

            if ($normSubmitted === null || $normEvent === null || $normSubmitted !== $normEvent) {
                // Foutmelding naar view wanneer data niet overeenkomt
                $data['error'] = 'De geselecteerde datum komt niet overeen met de datum van het gekozen evenement.';
            } else {
                // Werk ticket bij en toon succesmelding
                $this->ticketModel->updateTicket($postData);
                $data['message'] = 'flex';
                header('Refresh:2; url=' . URLROOT . '/ticket/index');
            }
        }

        $this->view('ticket/update', $data);
    }

    // Pagina voor bezoekers om een ticket te kopen (koop)
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
            // Maak ticket aan vanuit het koopformulier
            $this->ticketModel->create($_POST);
            $data['message'] = 'flex';
        }

        $this->view('ticket/koop', $data);
    }

    
}
