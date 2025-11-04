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
        $result = $this->ContactPersoon->GetAllContactPersonen();

        $data = [
            'title' => 'Overzicht Contactpersonen',
            'ContactPersonen' => $result
        ];

        $this->view('ContactPersoon/index', $data);
    }

    public function assign($contactpersoonId = null)
    {
        $error = '';
        $verkopers = $this->ContactPersoon->getAllVerkopers();

        if ($contactpersoonId) {
            $contactpersoon = $this->ContactPersoon->getContactPersoonById($contactpersoonId);
        } else {
            $contactpersoon = null;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['VerkoperId'])) {
                $verkoperId = $_POST['VerkoperId'];
                if ($contactpersoonId) {
                    $result = $this->ContactPersoon->updateVerkoper($contactpersoonId, $verkoperId);
                } else {
                    $result = $this->ContactPersoon->assignContactToVerkoper([
                        'VerkoperId' => $verkoperId,
                        'ContactpersoonId' => $_POST['ContactpersoonId']
                    ]);
                }

                if ($result) {
                    $_SESSION['success'] = 'Koppeling succesvol!';
                    header("Location: " . URLROOT . "/ContactPersoon/index");
                } else {
                    $error = 'Koppelen of aanpassen mislukt';
                }
            } else {
                $error = 'Selecteer een verkoper';
            }
        }

        $data = [
            'title' => $contactpersoonId ? 'Wijzig koppeling' : 'Koppel Contactpersoon aan Verkoper',
            'Verkopers' => $verkopers,
            'ContactPersoon' => $contactpersoon,
            'ContactPersonen' => $this->ContactPersoon->GetAllContactPersonen(),
            'error' => $error
        ];

        $this->view('ContactPersoon/assign', $data);
    }
    public function delete($id)
    {
        // Controleer of deze contactpersoon nog een koppeling heeft
        $hasKoppeling = $this->ContactPersoon->hasVerkoperKoppeling($id);

        if ($hasKoppeling) {
            $_SESSION['error'] = 'Kan niet verwijderen: contactpersoon is gekoppeld aan een verkoper.';
        } else {
            $deleted = $this->ContactPersoon->deleteContactPersoon($id);
            if ($deleted) {
                $_SESSION['success'] = 'Contactpersoon succesvol verwijderd.';
            } else {
                $_SESSION['error'] = 'Verwijderen mislukt.';
            }
        }

        header("Location: " . URLROOT . "/ContactPersoon/index");
    }
}
