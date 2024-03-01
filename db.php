<?php
class db
{
    private $dbh;
    protected $stmt;
    public function __construct($db, $host = "localhost:3306", $user = "root", $pass = "")
    {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function run($sql, $args = NULL)
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
    public function delete($table, $column, $value)
    {
    $sql = "DELETE FROM $table WHERE $column = ?";
    $this->run($sql, [$value]);
    }
}

$mydb = new db("cascade");

