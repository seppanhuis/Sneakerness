<?php

class Eventmodel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function gitallevents()
    {
        
        $sql = 'SELECT   
                        ,TIK.Naam
                        ,TIK.Datum
                        ,TIK.Locatie
                        ,TIK.AantalTicketsPerTijdslot
                        ,TIK.BeschikbareStands
                        ,TIK.Opmerking 


                    

                FROM Evenement as TIK ';
        $sql .= ' ORDER BY TIK.Datum ASC';
        $this->db->query($sql);

        return $this->db->resultSet();
    }
}