<?php
include_once('../db.php');
class Klant
{
    protected $db;
    private $table = "klanten";
    private $primaryKey = "klantId";


    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }                                                                                                                                                                                                                                   
    public function insertKlant($klantnaam, $email, $telefoonnummer)
    {
        $this->db->run("INSERT INTO $this->table (Klantnaam, email, telefoonnummer) VALUES (?, ?, ?)", [$klantnaam, $email, $telefoonnummer]);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deleteklant($klantId)
    {
        $this->db->delete($this->table, $this->primaryKey, $klantId);
    }
    public function updateKlant($klantId, $klantnaam, $email, $telefoonnummer)
    {
        $setValues = "Klantnaam = ?, email = ?, telefoonnummer = ?";
        $sql = "UPDATE $this->table SET $setValues WHERE $this->primaryKey = ?";
        $this->db->run($sql, [$klantnaam, $email, $telefoonnummer, $klantId]);
    }

    public function getKlantById($klantId)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $stmt = $this->db->run($sql, [$klantId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
