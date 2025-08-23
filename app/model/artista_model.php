<?php
require_once '../config/db.php';

class Artista{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createArtista($nome,$data,$foto,$biografia){
        $stmt = $this->db->prepare("INSERT INTO ARTISTA (NOME,DATA,FOTO,BIOGRAFIA)
                                    VALUES (:nome,:data,:foto,:biografia)");
        $stmt->bindValue(':nome',$nome);
        $stmt->bindValue(':data',$data);
        $stmt->bindValue(':foto',$foto);
        $stmt->bindValue(':biografia',$biografia);
        return $stmt->execute();
    }

    public function getArtistas(){
        $stmt = $this->db->query("SELECT id, nome, data, foto, biografia
                                    FROM artista");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArtistaPeloNome($nome){
        $stmt = $this->db->prepare("SELECT id, nome, data, foto, biografia
                                    FROM artista
                                    WHERE nome LIKE :nome");
        $stmt->bindValue(":nome",$nome);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

}
?>