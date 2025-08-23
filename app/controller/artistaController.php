<?php
require_once '../app/model/artista_model.php';
require_once '../app/view/artistaView.php';

class ArtistaController{
    private $modelArtista;
    private $view;

    public function __construct($db){
        $this->modelArtista = new Artista($db);
        $this->view = new ArtistaView();
    }

    //Criar um artista
    public function createArtista(){
        $data = json_decode(file_get_contents("php://input"),true);
        if( isset($data['nome']) &&
            isset($data['data']) &&
            isset($data['foto']) &&
            isset($data['biografia'])
        ){
            $this->modelArtista->createArtista( $data['nome'],
                                                $data['data'],
                                                $data['foto'],
                                                $data['biografia']);
            $this->view->sendResponse(['message' => 'Artista cadastrado! 🎤'],201);
        }
        else{
            $this->view->sendResponse(['message' => 'Dados inválido! 😒'],400);
        }
    }

    public function getArtistas(){
        $artistas = $this->modelArtista->getArtistas();
        $this->view->sendResponse($artistas);
    }
}
?>