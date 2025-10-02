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

    public function CreateContactPersoon($data) {
        $sql = "INSERT INTO Contactpersoon (Naam, Telefoonnummer, Emailadres) 
            VALUES (:naam, :telefoonnummer, :emailadres);";

        $this->db->query($sql);
        $this->db->bind(':naam', $data['Naam'], PDO::PARAM_STR);
        $this->db->bind(':telefoonnummer', $data['Telefoonnummer'], PDO::PARAM_STR);
        $this->db->bind(':emailadres', $data['Emailadres'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}