<?php

class prijsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Prijs ORDER BY Datum ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
