<?php

class StandsModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    // haalt alles van stands op een een paar van de verkopers
    public function GetAllStands()
    {
        $sql = 'SELECT
                s.Id AS StandId,
                s.StandType AS StandStandType,
                s.Prijs,
                s.VerhuurdStatus,
                s.IsActief,
                s.Opmerking,
                s.DatumAangemaakt,
                s.DatumGewijzigd,
                v.Id AS VerkoperId,
                v.Naam,
                v.SpecialeStatus,
                v.VerkooptSoort,
                v.StandType AS VerkoperStandType,
                v.Dagen
            FROM
                Stand s
            LEFT JOIN
                Verkoper v ON v.Id = s.VerkoperId
            ORDER BY
                s.Id ASC;';

        $this->db->query($sql);
        return $this->db->resultSet();
    }


    public function CreateStand($data)
    {
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
