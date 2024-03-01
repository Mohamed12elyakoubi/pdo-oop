<?php 
include_once('../db.php');
class Restaurant
{
    protected $db;
    private $table = "restaurant";
    private $primaryKey = "TafelId"; 

    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }

    public function insertrestaurant($tafel, $stoelen, $terras)
    {
        $this->db->run("INSERT INTO $this->table (tafel, stoelen, terras) VALUES (?, ?, ?)", [$tafel, $stoelen, $terras]);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteTafel($tafelId)
    {
        $this->db->delete($this->table, $this->primaryKey, $tafelId);
    }
    public function updatetafel($tafelId, $tafel, $stoelen, $terras)
    {
        $setValues = "tafel = ?, stoelen = ?, terras = ?";
        $sql = "UPDATE $this->table SET $setValues WHERE $this->primaryKey = ?";
        $this->db->run($sql, [$tafel, $stoelen, $terras, $tafelId]);
    }

    public function gettafelById($tafelId)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $stmt = $this->db->run($sql, [$tafelId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>