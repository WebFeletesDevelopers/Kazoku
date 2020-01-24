<?php
class Sesion{

    private function __construct(){
    }
    private function __clone(){
        // TODO: Implement __clone() method.
    }
    public static function getInstance(){
        if(Sesion::$instancia === null){
            Sesion::$instancia = new Sesion();
        }
        return Sesion::$instancia;
    }
}