<?php

class StandsModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

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
}