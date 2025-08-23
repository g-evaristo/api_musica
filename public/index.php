<?php
require_once '../app/controller/musicaController.php';
require_once '../app/controller/artistaController.php';

$database = new DataBase();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/',$uri);

$musicaController = new MusicaController($db);
$artistaController = new ArtistaController($db);

//ROTA: localhost/api_musica/musica
if($uri[2] == "musica"){
    if($method == "POST"){
        $musicaController->createMusica();
    }
    else if($method == "GET"){
        $musicaController->getTodasMusicasCantores();
    }
}

//ROTA: localhost/api_musica/artista
if($uri[2] == "artista"){
    if($method == "POST"){
        $artistaController->createArtista();
    }
    else if($method == "GET"){
        $artistaController->getArtistas();
    }
}
?>