<?php

class StandsModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    // haalt alles van stands op een een paar van de verkopers
    public function GetAllStands() {
        $sql = 'SELECT
                v.Naam
                ,v.SpecialeStatus
                ,v.Naam
                ,v.VerkooptSoort
                ,v.StandType AS VerkoperStandType
                ,v.Dagen
                ,s.StandType AS StandStandType
                ,s.Prijs
                ,s.VerhuurdStatus
                FROM
                    Verkoper v
                JOIN
                    Stand s ON v.Id = s.VerkoperId;

                ';
                
                $this->db->query($sql);

                return $this->db->resultSet();
    }

    public function CreateStand($data) {
        $sql = "INSERT INTO Stand (VerkoperId, StandType, Prijs, VerhuurdStatus) 
            VALUES (:verkoperId, :standType, :prijs, :verhuurdStatus);";

        $this->db->query($sql);
        $this->db->bind(':verkoperId', $data['VerkoperId'], PDO::PARAM_INT);
        $this->db->bind(':standType', $data['StandType'], PDO::PARAM_STR);
        $this->db->bind(':prijs', $data['Prijs'], PDO::PARAM_STR);
        $this->db->bind(':verhuurdStatus', $data['VerhuurdStatus'], PDO::PARAM_STR);
        try {
            return $this->db->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                return 'duplicate_stand';
            }
            return false;
        }
    }
}

