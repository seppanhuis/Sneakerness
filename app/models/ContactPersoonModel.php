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
        try {
            $sql = "SELECT 
                        CP.Id, 
                        CP.Naam, 
                        CP.Telefoonnummer, 
                        CP.Emailadres,
                        CP.Opmerking,
                        V.Id AS VerkoperId,
                        V.Naam AS VerkoperNaam,
                        (
                            SELECT COUNT(*) 
                            FROM ContactPerVerkoper c 
                            WHERE c.ContactpersoonId = CP.Id
                        ) AS Koppelingen
                    FROM Contactpersoon CP
                    LEFT JOIN ContactPerVerkoper CPV ON CP.Id = CPV.ContactpersoonId
                    LEFT JOIN Verkoper V ON CPV.VerkoperId = V.Id
                    ORDER BY CP.Id ASC";
            $this->db->query($sql);
            return $this->db->resultSet();
        } catch (PDOException $e) {
            // Log error eventueel in een file, maar geef niets aan de gebruiker
            error_log($e->getMessage());
            return [];
        }
    }

    public function getContactPersoonById($id)
    {
        $sql = "SELECT CP.Id, CP.Naam, CP.Telefoonnummer, CP.Emailadres, CP.Opmerking,
                   V.Id AS VerkoperId, V.Naam AS VerkoperNaam
            FROM Contactpersoon CP
            LEFT JOIN ContactPerVerkoper CPV ON CP.Id = CPV.ContactpersoonId
            LEFT JOIN Verkoper V ON CPV.VerkoperId = V.Id
            WHERE CP.Id = :id
            LIMIT 1";
        $this->db->query($sql);
        $this->db->bind(':id', $id, PDO::PARAM_INT);

        try {
            $result = $this->db->single();
            // Voeg fallback toe zodat properties altijd bestaan
            if (!$result) {
                return (object)[
                    'Id' => $id,
                    'Naam' => '',
                    'Telefoonnummer' => '',
                    'Emailadres' => '',
                    'Opmerking' => '',
                    'VerkoperId' => null,
                    'VerkoperNaam' => null
                ];
            }
            if (!isset($result->VerkoperId)) $result->VerkoperId = null;
            if (!isset($result->VerkoperNaam)) $result->VerkoperNaam = null;

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }


    public function getAllVerkopers()
    {
        try {
            $sql = "SELECT Id, Naam FROM Verkoper WHERE IsActief = 1 ORDER BY Naam ASC";
            $this->db->query($sql);
            return $this->db->resultSet();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function assignContactToVerkoper($data)
    {
        try {
            $sql = "INSERT INTO ContactPerVerkoper (VerkoperId, ContactpersoonId) 
                    VALUES (:verkoperId, :contactpersoonId)";
            $this->db->query($sql);
            $this->db->bind(':verkoperId', $data['VerkoperId'], PDO::PARAM_INT);
            $this->db->bind(':contactpersoonId', $data['ContactpersoonId'], PDO::PARAM_INT);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false; // gebruiker ziet alleen een generieke foutmelding
        }
    }

    public function updateVerkoper($contactpersoonId, $verkoperId)
    {
        try {
            $sql = "UPDATE ContactPerVerkoper
                    SET VerkoperId = :verkoperId
                    WHERE ContactpersoonId = :contactpersoonId";
            $this->db->query($sql);
            $this->db->bind(':verkoperId', $verkoperId, PDO::PARAM_INT);
            $this->db->bind(':contactpersoonId', $contactpersoonId, PDO::PARAM_INT);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function removeVerkoperKoppeling($contactpersoonId)
    {
        try {
            $sql = "DELETE FROM ContactPerVerkoper WHERE ContactpersoonId = :id";
            $this->db->query($sql);
            $this->db->bind(':id', $contactpersoonId, PDO::PARAM_INT);
            return $this->db->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteContactPersoon($contactpersoonId)
    {
        try {
            $sql = "DELETE FROM Contactpersoon WHERE Id = :id";
            $this->db->query($sql);
            $this->db->bind(':id', $contactpersoonId, PDO::PARAM_INT);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function hasVerkoperKoppeling($contactpersoonId)
    {
        $sql = "SELECT COUNT(*) AS koppelingen FROM ContactPerVerkoper WHERE ContactpersoonId = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $contactpersoonId, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result->koppelingen > 0;
    }
}
