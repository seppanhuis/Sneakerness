<?php
class EvenementModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Haal alle evenementen op uit de Nederlandse tabel `Evenement`.
    // De view verwacht objecten met properties: id, title, date, time, location.
    public function getAllEvents()
    {
        // Retuneer zowel de Nederlandse kolomnamen (Id, Naam, Datum, Locatie)
        // als aliassen die sommige views/controllers verwachten (id, title, date, location).
        $this->db->query(
            "SELECT 
                 Id, Id AS id,
                 Naam, Naam AS title,
                 Datum, Datum AS date,
                 '' AS time,
                 Locatie, Locatie AS location
             FROM Evenement
             ORDER BY Datum DESC"
        );
        return $this->db->resultSet();
    }

    // Voeg een nieuw evenement toe aan de Nederlandse tabel `Evenement`.
    // We vullen alleen Naam, Datum en Locatie; overige velden hebben defaults.
    public function addEvent($data)
    {
        try {
            $this->db->query("INSERT INTO Evenement (Naam, Datum, Locatie) VALUES (:title, :date, :location)");
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':location', $data['location']);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log('EvenementModel::addEvent error: ' . $e->getMessage());
            return false;
        }
    }

    // Haal één evenement op en map kolomnamen naar de properties die de view verwacht
    public function getEventById($id)
    {
        // Select met dubbele kolomnamen zodat zowel oude als nieuwe views werken
        $this->db->query(
            "SELECT 
                 Id, Id AS id,
                 Naam, Naam AS title,
                 Datum, Datum AS date,
                 '' AS time,
                 Locatie, Locatie AS location
             FROM Evenement
             WHERE Id = :id
             LIMIT 1"
        );
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    // Werk een evenement bij (Naam/Datum/Locatie)
    public function updateEvent($data)
    {
        try {
            $this->db->query("UPDATE Evenement SET Naam = :title, Datum = :date, Locatie = :location WHERE Id = :id");
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':date', $data['date']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':id', $data['id'], PDO::PARAM_INT);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log('EvenementModel::updateEvent error: ' . $e->getMessage());
            return false;
        }
    }

    // Controleer of een event met dezelfde Naam, Datum en Locatie al bestaat
    public function eventExists($title, $date, $location)
    {
        $this->db->query('SELECT Id FROM Evenement WHERE Naam = :title AND Datum = :date AND Locatie = :location');
        $this->db->bind(':title', $title);
        $this->db->bind(':date', $date);
        $this->db->bind(':location', $location);

        $row = $this->db->single();

        return $row ? true : false;
    }

    // Verwijder een evenement op Id
    public function deleteEvent($id)
    {
        $this->db->query('DELETE FROM Evenement WHERE Id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    // Backwards-compatibility wrapper: sommige controllers (bijv. Ticket) roepen ->getAll() aan.
    // Retourneer dezelfde data als getAllEvents().
    public function getAll()
    {
        return $this->getAllEvents();
    }

}





