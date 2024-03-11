<?php
include_once('../db.php');

class Rekening
{
    protected $db;
    private $table = "bestelling";
    private $primaryKey = "bestelling_id";

    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }
    public function insertrekening($ReserveringID, $klant_id,  $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal,  $Prijs, $totaal_prijs)
    {
        $this->db->run("INSERT INTO $this->table (ReserveringID,klant_id, tafel_id, product_id,omschrijving,datum,tijd, aantal, Prijs , totaal_prijs) VALUES 
        ( ?, ?, ? , ? , ? , ? , ? , ?, ?, ?)", [$ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal,  $Prijs, $totaal_prijs]);
    }

    public function deletebestelling($bestelling_id)
    {
        $this->db->delete($this->table, $this->primaryKey, $bestelling_id);
    }
    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateRekening($bestelling_id, $ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal, $Prijs, $totaal_prijs)
    {
        $setValues = "ReserveringID = ?, klant_id = ?, tafel_id = ?, product_id = ?, omschrijving = ?, datum = ?, tijd = ?, aantal = ?, Prijs = ?, totaal_prijs = ?";
        $sql = "UPDATE $this->table SET $setValues WHERE bestelling_id = ?";
        $this->db->run($sql, [$ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal, $Prijs, $totaal_prijs, $bestelling_id]);
    }
    public function get_rekening_by_id($bestelling_id)
    {
        $sql = "SELECT * FROM $this->table WHERE bestelling_id = ?";
        $result = $this->db->run($sql, [$bestelling_id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
