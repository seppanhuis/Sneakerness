<?php

class bezoekerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Bezoeker ORDER BY Naam ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
