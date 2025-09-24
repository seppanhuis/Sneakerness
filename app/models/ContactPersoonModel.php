<?php

class ContactPersoonModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    // haalt alle gegevens op van Contact personen
    public function GetAllContactPersonen() {
        $sql = 'SELECT 
                Id
                ,Naam 
                ,Telefoonnummer 
                ,Emailadres 


                FROM Contactpersoon as CP
                ORDER BY CP.Id ASC
                LIMIT 10;
                ';
    

                
                
                $this->db->query($sql);

                return $this->db->resultSet();
    }
}