<?php

class ContactPersoonModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function GetAllContactPersonen()
    {
        $sql = "SELECT CP.Id, CP.Naam, CP.Telefoonnummer, CP.Emailadres,
                   V.Naam AS VerkoperNaam, V.SpecialeStatus, V.VerkooptSoort, V.StandType, V.Dagen
            FROM Contactpersoon CP
            LEFT JOIN ContactPerVerkoper CPV ON CP.Id = CPV.ContactpersoonId
            LEFT JOIN Verkoper V ON CPV.VerkoperId = V.Id
            ORDER BY CP.Id ASC
            LIMIT 10;";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getContactPersoonById($id)
    {
        $sql = "SELECT CP.Id, CP.Naam, CP.Telefoonnummer, CP.Emailadres,
                       V.Id AS VerkoperId, V.Naam AS VerkoperNaam
                FROM Contactpersoon CP
                LEFT JOIN ContactPerVerkoper CPV ON CP.Id = CPV.ContactpersoonId
                LEFT JOIN Verkoper V ON CPV.VerkoperId = V.Id
                WHERE CP.Id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function CreateContactPersoon($data)
    {
        $sql = "INSERT INTO Contactpersoon (Naam, Telefoonnummer, Emailadres) 
                VALUES (:naam, :telefoonnummer, :emailadres)";
        $this->db->query($sql);
        $this->db->bind(':naam', $data['Naam'], PDO::PARAM_STR);
        $this->db->bind(':telefoonnummer', $data['Telefoonnummer'], PDO::PARAM_STR);
        $this->db->bind(':emailadres', $data['Emailadres'], PDO::PARAM_STR);
        try {
            return $this->db->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') return 'duplicate_email';
            return false;
        }
    }

    public function getAllVerkopers()
    {
        $sql = "SELECT Id, Naam FROM Verkoper WHERE IsActief = 1 ORDER BY Naam ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function assignContactToVerkoper($data)
    {
        $sql = "INSERT INTO ContactPerVerkoper (VerkoperId, ContactpersoonId) 
                VALUES (:verkoperId, :contactpersoonId)";
        $this->db->query($sql);
        $this->db->bind(':verkoperId', $data['VerkoperId'], PDO::PARAM_INT);
        $this->db->bind(':contactpersoonId', $data['ContactpersoonId'], PDO::PARAM_INT);
        try {
            return $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateVerkoper($contactpersoonId, $verkoperId)
    {
        $sql = "UPDATE ContactPerVerkoper
                SET VerkoperId = :verkoperId
                WHERE ContactpersoonId = :contactpersoonId";
        $this->db->query($sql);
        $this->db->bind(':verkoperId', $verkoperId, PDO::PARAM_INT);
        $this->db->bind(':contactpersoonId', $contactpersoonId, PDO::PARAM_INT);
        return $this->db->execute();
    }
}
