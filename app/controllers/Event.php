<?php
class Event extends BaseController
{
    private $eventModel;

    public function __construct()
    {
        $this->eventModel = $this->model('EvenementModel');
        session_start();
    }

    public function index()
    {
        $events = $this->eventModel->getAllEvents();

        if ($events) {
            $data = [
                'title' => 'Evenementen Overzicht',
                'events' => $events,
                'message' => isset($_SESSION['message']) ? $_SESSION['message'] : '',
                'message_type' => isset($_SESSION['message_type']) ? $_SESSION['message_type'] : ''
            ];

            // Sessie melding resetten na tonen
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);

            $this->view('event/index', $data);
        } else {
            $this->view('event/error', [
                'message' => 'Events zijn momenteel niet beschikbaar, excuses voor het ongemak.'
            ]);
        }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'date' => trim($_POST['date']),
                'time' => trim($_POST['time']),
                'location' => trim($_POST['location'])
            ];

            // Validatie: lege velden
            if (empty($data['title']) || empty($data['date']) || empty($data['time']) || empty($data['location'])) {
                $_SESSION['message'] = 'Controleer de ingevoerde gegevens.';
                $_SESSION['message_type'] = 'danger';
                header("Location: " . URLROOT . "/Event/index");
                exit;
            }

            // Dubbele events
            if ($this->eventModel->eventExists($data['title'], $data['date'], $data['location'])) {
                $_SESSION['message'] = 'Dit event bestaat al.';
                $_SESSION['message_type'] = 'warning';
                header("Location: " . URLROOT . "/Event/index");
                exit;
            }

            // Succesvol toevoegen
            if ($this->eventModel->addEvent($data)) {
                $_SESSION['message'] = 'Succesvol toegevoegd!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Er ging iets mis bij het toevoegen.';
                $_SESSION['message_type'] = 'danger';
            }

            header("Location: " . URLROOT . "/Event/index");
            exit;
        } else {
            $data = [
                'title' => '',
                'date' => '',
                'time' => '',
                'location' => ''
            ];
            $this->view('event/add', $data);
        }
    }

    public function edit($id)
    {
        $event = $this->eventModel->getEventById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'date' => trim($_POST['date']),
                'time' => trim($_POST['time']),
                'location' => trim($_POST['location'])
            ];

            // Ongeldige tijden
            $ongeldigeTijden = [
                '00:00', '00:30', '01:00', '02:00', '03:00',
                '04:00', '05:00', '06:00', '23:00', '23:30'
            ];

            if (in_array($data['time'], $ongeldigeTijden) || $data['time'] < '08:00' || $data['time'] > '22:00') {
                $_SESSION['message'] = 'Deze tijd is niet geldig (evenementen mogen enkel tussen 08:00 en 22:00 plaatsvinden).';
                $_SESSION['message_type'] = 'warning';
                header("Location: " . URLROOT . "/Event/index");
                exit;
            }

            // Updaten
            if ($this->eventModel->updateEvent($data)) {
                $_SESSION['message'] = 'Event succesvol gewijzigd!';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Er is iets misgegaan bij het opslaan.';
                $_SESSION['message_type'] = 'danger';
            }

            header("Location: " . URLROOT . "/Event/index");
            exit;
        } else {
            $data = [
                'event' => $event
            ];
            $this->view('event/edit', $data);
        }
    }

    public function delete($id)
{
    // Controleer of het event bestaat
    $event = $this->eventModel->getEventById($id);

    if (!$event) {
        $_SESSION['message'] = 'Event niet gevonden.';
        $_SESSION['message_type'] = 'danger';
        header("Location: " . URLROOT . "/Event/index");
        exit;
    }

    // Controleer of de gebruiker bevestigt
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->eventModel->deleteEvent($id)) {
            $_SESSION['message'] = 'Event succesvol verwijderd!';
            $_SESSION['message_type'] = 'success';
            header("Refresh:3; url=" . URLROOT . "/Event/index");
            exit;
        } else {
            $_SESSION['message'] = 'Verwijderen mislukt.';
            $_SESSION['message_type'] = 'danger';
            header("Location: " . URLROOT . "/Event/index");
            exit;
        }
    } else {
        // Als er direct via GET op delete geklikt is (zonder POST), toon een melding
        $_SESSION['message'] = 'Verwijderen mislukt. Ongeldige actie.';
        $_SESSION['message_type'] = 'warning';
        header("Location: " . URLROOT . "/Event/index");
        exit;
    }
}

}
