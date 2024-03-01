<?php

include_once('../db.php');

class Reservering
{
    protected $db;
    private $table = "reservering";
    private $primaryKey = "ReserveringID";

    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }
    public function insertreservering($Tafel, $klantId, $startreservering, $eindereservering)
    {
        $this->db->run("INSERT INTO $this->table (`Tafel`, `klantId`, `start-reservering`, `einde-reservering`) VALUES (?, ?, ?, ?)", [$Tafel, $klantId, $startreservering, $eindereservering]);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deletereservering($ReserveringID)
    {
        $this->db->delete($this->table, $this->primaryKey, $ReserveringID);
    }
    public function updatereservering($ReserveringID, $Tafel, $klantId, $startreservering, $eindereservering)
    {
        $setValues = "Tafel = ?, klantId = ?, start-reservering,  = ?, start-reservering = ?";
        $sql = "UPDATE $this->table SET $setValues WHERE $this->primaryKey = ?";
        $this->db->run($sql, [$Tafel, $klantId, $startreservering, $eindereservering , $ReserveringID]);
    }
    public function get_reservering_by_id($ReserveringID)
    {
        $sql = "SELECT r.*, k.klantnaam, k.email, k.telefoonnummer, t.tafel FROM $this->table r 
                JOIN klanten k ON r.klantId = k.klantId
                JOIN restaurant t ON r.Tafel = t.TafelId
                WHERE r.$this->primaryKey = ?";
        $stmt = $this->db->run($sql, [$ReserveringID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>
