<?php
include_once('../db.php');
class Product
{
    protected $db;
    private $table = "product";
    private $primaryKey = "productid";


    public function __construct()
    {
        global $mydb;
        $this->db = $mydb;
    }
    public function insertproduct($product, $omschrijving, $prijs)
    {
        $this->db->run("INSERT INTO $this->table (product,omschrijving, prijs) VALUES (?, ?,? )", [$product, $omschrijving, $prijs]);
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->db->run($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deleteproduct($productid)
    {
        $this->db->delete($this->table, $this->primaryKey, $productid);
    }
    public function updateproduct($productid, $product, $omschrijving, $prijs)
    {
        $setValues = "product = ?, omschrijving = ?, prijs = ?";
        $sql = "UPDATE $this->table SET $setValues WHERE $this->primaryKey = ?";
        $this->db->run($sql, [$product, $omschrijving, $prijs, $productid]);
    }
    public function getproductbyid($productid)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = ?";
        $stmt = $this->db->run($sql, [$productid]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
