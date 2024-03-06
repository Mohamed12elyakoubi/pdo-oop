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
    public function insertrekening($ReserveringID, $klant_id,  $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal,  $Prijs)
    {
        $this->db->run("INSERT INTO $this->table (ReserveringID,klant_id, tafel_id, product_id,omschrijving,datum,tijd, aantal, Prijs) VALUES 
        ( ?, ?, ? , ? , ? , ? , ? , ?, ? )", [$ReserveringID, $klant_id, $tafel_id, $product_id, $omschrijving, $datum, $tijd, $aantal,  $Prijs]);
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
}
