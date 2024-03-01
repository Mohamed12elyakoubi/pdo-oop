<?php
include_once('../db.php');

class Rekening
{
    protected $db;
    private $table = "bon";

    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }
    public function insertrekening($datum, $tijd, $tafel_id, $afdeling, $aantal, $omschrijving, $prijs, $Totaal, $BTW, $incBTW, $ExclBTW)
    {
        $this->db->run("INSERT INTO $this->table (datum, tijd, tafel_id, afdeling,aantal,omschrijving,prijs, Totaal, BTW , incBTW, ExclBTW ) VALUES 
        (?, ?, ?, ?, ?, ?, ? , ? , ? , ? , ? )", [$datum, $tijd, $tafel_id, $afdeling, $aantal, $omschrijving, $prijs, $Totaal, $BTW, $incBTW, $ExclBTW]);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>