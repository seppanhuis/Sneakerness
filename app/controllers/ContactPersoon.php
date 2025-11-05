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
        $contactpersonen = $this->ContactPersoon->GetAllContactPersonen();

        $data = [
            'title' => 'Overzicht Contactpersonen',
            'ContactPersonen' => $contactpersonen,
            'success' => $_SESSION['success'] ?? '',
            'error' => $_SESSION['error'] ?? ''
        ];

        unset($_SESSION['success'], $_SESSION['error']);

        $this->view('ContactPersoon/index', $data);
    }

    public function assign($contactpersoonId = null)
    {
        $verkopers = $this->ContactPersoon->getAllVerkopers();
        $contactpersoon = $contactpersoonId ? $this->ContactPersoon->getContactPersoonById($contactpersoonId) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $verkoperId = $_POST['VerkoperId'] ?? null;

            if ($verkoperId === 'none') {
                // Loskoppelen
                if ($contactpersoonId) {
                    $this->ContactPersoon->removeVerkoperKoppeling($contactpersoonId);
                }
            } else {
                // Controleer of contactpersoon al gekoppeld is
                if ($this->ContactPersoon->hasVerkoperKoppeling($contactpersoonId)) {
                    $this->ContactPersoon->updateVerkoper($contactpersoonId, $verkoperId);
                } else {
                    $this->ContactPersoon->assignContactToVerkoper([
                        'VerkoperId' => $verkoperId,
                        'ContactpersoonId' => $contactpersoonId
                    ]);
                }
            }

            header("Location: " . URLROOT . "/ContactPersoon/index");
        }

        $data = [
            'title' => $contactpersoonId ? 'Wijzig koppeling' : 'Koppel Contactpersoon aan Verkoper',
            'Verkopers' => $verkopers,
            'ContactPersoon' => $contactpersoon
        ];

        $this->view('ContactPersoon/assign', $data);
    }


    public function update($contactpersoonId = null)
    {
        // Als geen ID is meegegeven, terug naar index
        if (!$contactpersoonId) {
            header("Location: " . URLROOT . "/ContactPersoon/index");
        }

        // Haal contactpersoon op
        $contactpersoon = $this->ContactPersoon->getContactPersoonById($contactpersoonId);
        if (!$contactpersoon) {
            $_SESSION['error'] = 'Contactpersoon niet gevonden.';
            header("Location: " . URLROOT . "/ContactPersoon/index");
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Naam' => trim($_POST['Naam'] ?? ''),
                'Telefoonnummer' => trim($_POST['Telefoonnummer'] ?? ''),
                'Emailadres' => trim($_POST['Emailadres'] ?? ''),
                'Opmerking' => trim($_POST['Opmerking'] ?? ''),
            ];

            // Validatie
            if (empty($data['Naam']) || empty($data['Telefoonnummer']) || empty($data['Emailadres'])) {
                $error = 'Naam, telefoonnummer en emailadres zijn verplicht!';
            } else {
                try {
                    $result = $this->ContactPersoon->updateContactPersoon($contactpersoonId, $data);
                    if ($result) {
                        $_SESSION['success'] = 'Contactpersoon succesvol bijgewerkt!';
                        header("Location: " . URLROOT . "/ContactPersoon/index");
                    } else {
                        $error = 'Bijwerken mislukt. Controleer de gegevens.';
                    }
                } catch (Exception $e) {
                    $error = 'Er is een fout opgetreden: ' . $e->getMessage();
                }
            }
        }

        $data = [
            'title' => 'Contactpersoon bijwerken',
            'ContactPersoon' => $contactpersoon,
            'error' => $error
        ];

        $this->view('ContactPersoon/update', $data);
    }
    public function delete($contactpersoonId)
    {
        if (!$contactpersoonId) {
            $_SESSION['error'] = 'Geen contactpersoon geselecteerd.';
            header("Location: " . URLROOT . "/ContactPersoon/index");
            
        }

        // Controleer of deze contactpersoon nog gekoppeld is aan een verkoper
        if ($this->ContactPersoon->hasVerkoperKoppeling($contactpersoonId)) {
            $_SESSION['error'] = 'Kan niet verwijderen: contactpersoon is gekoppeld aan een verkoper.';
        } else {
            $deleted = $this->ContactPersoon->deleteContactPersoon($contactpersoonId);
            $_SESSION['success'] = $deleted ? 'Contactpersoon succesvol verwijderd.' : 'Verwijderen mislukt.';
        }

        header("Location: " . URLROOT . "/ContactPersoon/index");
        
    }
}
