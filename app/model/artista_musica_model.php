<?php
require_once '../config/db.php';

class ArtistaMusica{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createArtistaMusica($fk_artista_id,$fk_musica_id){
        $stmt = $this->db->prepare("INSERT INTO ARTISTA_MUSICA (FK_ARTISTA_ID,FK_MUSICA_ID)
                                    VALUES (:fk_artista_id,:fk_musica_id)");
        $stmt->bindValue(':fk_artista_id',$fk_artista_id);
        $stmt->bindValue(':fk_musica_id',$fk_musica_id);
        return $stmt->execute();
    }

    public function getArtistasMusicas(){
        $stmt = $this->db->query("SELECT    M.TITULO,
                                            A.NOME
                                    FROM    MUSICA M
                                    JOIN    ARTISTA_MUSICA AM ON (M.ID = AM.FK_MUSICA_ID)
                                    JOIN    ARTISTA A ON (A.ID = AM.FK_ARTISTA_ID)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>