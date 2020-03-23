<?php
include_once '../controller/NoticiasController.php';

/**
 * 0 - Busca noticias públicas
 * 1 - Busca noticias públicas y privadas
 * 2 - Envia una noticia
 * 3 - Borra una noticia
 */
switch ($_POST['Accion']){
    case 0:
    case 1:
        //buscarNoticias($_POST['Accion']);
        break;
    case 2:
        $noticia = new noticias();
        $noticia->setCodNot(0);
        $noticia->setCodAutor($_POST['Autor']);
        $noticia->setTitulo($_POST['Titulo']);
        $noticia->setCuerpo($_POST['Cuerpo']);
        $noticia->setFecha(date("Y-m-d"));
        $noticia->setPubllica($_POST['Publico']);
        //  $res =  enviarNoticia($noticia);
        if(enviarNoticia($noticia)) {
            echo 1;
        }
        else{
            echo 0;
        }

        break;
    case 3:
        //borrar noticia;

    default:
        throw new \Exception('Unexpected value');
        echo 0;
}
//header('X-PHP-Response-Code: 404', true, 404);
//http_response_code(1);
//header('X-PHP-Response-Code: 401', true, 401);
//return 1;