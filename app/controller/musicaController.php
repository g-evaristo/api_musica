<?php
require_once '../app/model/musica_model.php';
require_once '../app/model/artista_model.php';
require_once '../app/model/artista_musica_model.php';
require_once '../app/view/musicaView.php';

class MusicaController{
    private $modelMusica;
    private $modelArtista;
    private $modelMusicaArtista;
    private $view;

    public function __construct($db){
        $this->modelMusica = new Musica($db);
        $this->modelArtista = new Artista($db);
        $this->modelMusicaArtista = new ArtistaMusica($db);
        $this->view = new MusicaView();
    }

    //Criar uma música
    public function createMusica(){
        $data = json_decode(file_get_contents("php://input"),true);
        if( isset($data['titulo']) &&
            isset($data['duracao']) &&
            isset($data['capa']) &&
            isset($data['nome'])
        ){
            $this->modelMusica->createMusica(   $data['titulo'],
                                                $data['duracao'],
                                                $data['capa']);
            $fk_artista = $this->modelArtista->getArtistaPeloNome($data['nome']);
            $fk_musica = $this->modelMusica->getMusicaPeloTitulo($data['titulo']);
            $this->modelMusicaArtista->createArtistaMusica($fk_artista['id'],$fk_musica['id']);
            $this->view->sendResponse(['message' => 'Música cadastrada! 🎵'],201);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados inválido! 😒'],400);
        }
    }

    public function getTodasMusicasCantores(){
        $musicas = $this->modelMusicaArtista->getArtistasMusicas();
        $this->view->sendResponse($musicas);
    }
}
?>