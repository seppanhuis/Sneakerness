<?php

class TicketModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Alle tickets ophalen
    public function getAllTicket()
    {
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
    }

    // Ticket ophalen op ID
    public function getById($id)
    {
        $this->db->query("SELECT * FROM Ticket WHERE Id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Ticket aanmaken
    public function create($data)
    {
        $sql = "INSERT INTO Ticket (BezoekerId, EvenementId, PrijsId, AantalTickets, Datum)
                VALUES (:BezoekerId, :EvenementId, :PrijsId, :AantalTickets, :Datum)";
        $this->db->query($sql);
        $this->db->bind(':BezoekerId', $data['BezoekerId']);
        $this->db->bind(':EvenementId', $data['EvenementId']);
        $this->db->bind(':PrijsId', $data['PrijsId']);
        $this->db->bind(':AantalTickets', $data['AantalTickets']);
        $this->db->bind(':Datum', $data['Datum']);
        return $this->db->execute();
    }

    // Ticket verwijderen
    public function delete($id)
    {
        $this->db->query("DELETE FROM Ticket WHERE Id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Ticket aanpassen
    public function updateTicket($data)
    {
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
    }
}
    