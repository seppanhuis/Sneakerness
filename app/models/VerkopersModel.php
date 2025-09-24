<?php

class VerkopersModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetAllVerkopers() {
        $sql = 'SELECT 
                 VK.Id
                ,VK.Naam
                ,VK.SpecialeStatus
                ,VK.VerkooptSoort
                ,VK.StandType
                ,VK.Dagen
                ,VK.Logo


                FROM verkoper as VK';
                
                $this->db->query($sql);

                return $this->db->resultSet();
    }
}