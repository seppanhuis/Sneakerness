<?php
class EvenementModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllEvents()
    {
        $this->db->query("SELECT * FROM events ORDER BY date DESC");
        return $this->db->resultSet();
    }

    public function addEvent($data)
    {
        $this->db->query("INSERT INTO events (title, date, time, location) VALUES (:title, :date, :time, :location)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':location', $data['location']);
        return $this->db->execute();
    }

    public function getEventById($id)
    {
        $this->db->query("SELECT * FROM events WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    

    public function updateEvent($data)
    {
        $this->db->query("UPDATE events SET title = :title, date = :date, time = :time, location = :location WHERE id = :id");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':id', $data['id']);
        return $this->db->execute();
    }

    public function eventExists($title, $date, $location)
{
    $this->db->query('SELECT * FROM events WHERE title = :title AND date = :date AND location = :location');
    $this->db->bind(':title', $title);
    $this->db->bind(':date', $date);
    $this->db->bind(':location', $location);

    $row = $this->db->single();

    return $row ? true : false;
}

public function deleteEvent($id)
{
    $this->db->query('DELETE FROM events WHERE id = :id');
    $this->db->bind(':id', $id);

    return $this->db->execute();
}


}



