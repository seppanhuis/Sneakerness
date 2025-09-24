<?php

// ticketModel class handles all ticket-related database operations
class ticketModel
{
    // Database connection instance
    private $db;

    // Constructor initializes the Database object
    public function __construct()
    {
        $this->db = new Database();
    }

    // Retrieves all tickets from the database, ordered by date (ascending)
    public function getAllTicket()
    {
        // SQL query to select relevant ticket fields
        $sql = 'SELECT   TIK.Id
                        ,TIK.BezoekerId
                        ,TIK.EvenementId
                        ,TIK.PrijsId
                        ,TIK.AantalTickets
                        ,TIK.Datum   
                FROM Ticket as TIK ';
        // Orders the results by the ticket date
        $sql .= ' ORDER BY TIK.Datum ASC';

        // Prepare and execute the query
        $this->db->query($sql);

        // Return all results as an array
        return $this->db->resultSet();
    }
    // Additional ticket-related methods can be added below
}
