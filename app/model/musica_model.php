<?php
require_once '../config/db.php';

class Musica{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createMusica($titulo,$duracao,$capa){
        $stmt = $this->db->prepare("INSERT INTO MUSICA (TITULO,DURACAO,CAPA)
                                    VALUES (:titulo,:duracao,:capa)");
        $stmt->bindValue(':titulo',$titulo);
        $stmt->bindValue(':duracao',$duracao);
        $stmt->bindValue(':capa',$capa);
        return $stmt->execute();
    }

    public function getMusicas(){
        $stmt = $this->db->query("SELECT id, titulo, duracao, capa
                                    FROM musica");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMusicaPeloTitulo($titulo){
        $stmt = $this->db->prepare("SELECT id, titulo, duracao, capa FROM musica
                                    WHERE titulo = :titulo");
        $stmt->bindValue(':titulo', $titulo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>