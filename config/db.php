<?php
class Database{
    private $host = 'localhost';
    private $dbname = 'bd_musica';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct(){
        try{
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $error){
            die("Erro na conexão com o banco de dados!".$error->getMessage());
        }
    }
    public function getConnection(){
        return $this->pdo;
    }
}
$db = new Database();
$conn = $db->getConnection();
?>