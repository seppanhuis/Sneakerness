<?php

class ticketModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTicket()
    {
        
        $sql = 'SELECT   TIK.Id
                        ,TIK.BezoekerId
                        ,TIK.EvenementId
                        ,TIK.PrijsId
                        ,TIK.AantalTickets
                        ,TIK.Datum   

                    

                FROM Ticket as TIK ';
        $sql .= ' ORDER BY TIK.Datum ASC';
        $this->db->query($sql);

        return $this->db->resultSet();
    }










}