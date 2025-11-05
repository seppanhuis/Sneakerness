<?php

/*
  Model voor Ticket-gerelateerde database-operaties.
  - Verzorgt ophalen, aanmaken, verwijderen en bijwerken van tickets.
  - Maakt gebruik van de Database wrapper (PDO) die in app/libraries/Database.php zit.
*/
class TicketModel
{
    private $db;

    public function __construct()
    {
        try {
            // Maak een database connectie aan via de Database-class
            $this->db = new Database();
        } catch (\Exception $e) {
            // Log eventuele fouten en zet $db op null zodat controller dit kan opvangen
            error_log('TicketModel::__construct error: ' . $e->getMessage());
            $this->db = null;
        }
    }

    // Alle tickets ophalen
    public function getAllTicket()
    {
        if (!$this->db) {
            return false; // Geen database verbinding
        }

        try {
            // Samenstellen van query met joins om gerelateerde gegevens te tonen
            $sql = 'SELECT TIK.Id,
                           B.Naam AS BezoekerNaam,
                           E.Naam AS EvenementNaam,
                           P.Tijdslot,
                           P.Tarief,
                           TIK.AantalTickets,
                           TIK.Datum
                    FROM Ticket TIK
                    INNER JOIN Bezoeker B ON TIK.BezoekerId = B.Id
                    INNER JOIN Evenement E ON TIK.EvenementId = E.Id
                    INNER JOIN Prijs P ON TIK.PrijsId = P.Id
                    ORDER BY TIK.Datum ASC';
            $this->db->query($sql);
            return $this->db->resultSet();
        } catch (\Exception $e) {
            error_log('TicketModel::getAllTicket error: ' . $e->getMessage());
            return false;
        }
    }

    // Ticket ophalen op ID
    public function getById($id)
    {
        if (!$this->db) {
            return false;
        }

        try {
            $this->db->query("SELECT * FROM Ticket WHERE Id = :id");
            $this->db->bind(':id', $id);
            return $this->db->single();
        } catch (\Exception $e) {
            error_log('TicketModel::getById error: ' . $e->getMessage());
            return false;
        }
    }

    // Ticket aanmaken
    public function create($data)
    {
        if (!$this->db) {
            return false;
        }

        try {
            $sql = "INSERT INTO Ticket (BezoekerId, EvenementId, PrijsId, AantalTickets, Datum)
                    VALUES (:BezoekerId, :EvenementId, :PrijsId, :AantalTickets, :Datum)";
            $this->db->query($sql);
            $this->db->bind(':BezoekerId', $data['BezoekerId']);
            $this->db->bind(':EvenementId', $data['EvenementId']);
            $this->db->bind(':PrijsId', $data['PrijsId']);
            $this->db->bind(':AantalTickets', $data['AantalTickets']);
            $this->db->bind(':Datum', $data['Datum']);
            return $this->db->execute();
        } catch (\Exception $e) {
            error_log('TicketModel::create error: ' . $e->getMessage());
            return false;
        }
    }

    // Ticket verwijderen
    public function delete($id)
    {
        if (!$this->db) {
            return false;
        }

        try {
            $this->db->query("DELETE FROM Ticket WHERE Id = :id");
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (\Exception $e) {
            error_log('TicketModel::delete error: ' . $e->getMessage());
            return false;
        }
    }

    // Ticket aanpassen
    public function updateTicket($data)
    {
        if (!$this->db) {
            return false;
        }

        try {
            $sql = "UPDATE Ticket 
                    SET BezoekerId = :bezoekerId, 
                        EvenementId = :evenementId, 
                        PrijsId = :prijsId, 
                        AantalTickets = :aantalTickets,
                        Datum = :datum
                    WHERE Id = :id";
            $this->db->query($sql);
            $this->db->bind(':bezoekerId', $data['BezoekerId']);
            $this->db->bind(':evenementId', $data['EvenementId']);
            $this->db->bind(':prijsId', $data['PrijsId']);
            $this->db->bind(':aantalTickets', $data['AantalTickets']);
            $this->db->bind(':datum', $data['Datum']);
            $this->db->bind(':id', $data['id']);
            return $this->db->execute();
        } catch (\Exception $e) {
            error_log('TicketModel::updateTicket error: ' . $e->getMessage());
            return false;
        }
    }

    // Controleer of er tickets bestaan voor een gegeven evenement
    // Retourneert true wanneer minimaal één ticket bestaat, anders false
    public function hasTicketsForEvent($evenementId)
    {
        if (!$this->db) {
            return false;
        }

        try {
            $this->db->query("SELECT COUNT(*) AS cnt FROM Ticket WHERE EvenementId = :id");
            $this->db->bind(':id', $evenementId);
            $row = $this->db->single();
            return ($row && isset($row->cnt) && $row->cnt > 0);
        } catch (\Exception $e) {
            error_log('TicketModel::hasTicketsForEvent error: ' . $e->getMessage());
            return false;
        }
    }
}