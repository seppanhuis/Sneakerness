<?php

class StandsModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetAllStands() {
        $sql = 'SELECT 
                Id
                ,Naam 
                ,Locatie 
                ,Capaciteit 
                ,Prijs
                FROM Stand
                ORDER BY Id ASC
                LIMIT 10;
                FROM Stand as S
                ORDER BY S.Id ASC
                LIMIT 10;
                ';
    

                
                
                $this->db->query($sql);

                return $this->db->resultSet();
    }
}