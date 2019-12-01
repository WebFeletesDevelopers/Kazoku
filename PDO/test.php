<?php
    include "insert.php";
    require "cinturon.php";
    $crud = new CRUD();
    $cinturon = new cinturon();
    $cinturon->setCinturon("Morado");
    $cinturon->setCodCinturon(99);
    echo $cinturon->toString();
    echo '<br>';
    $res =  $crud->insert($cinturon);
    echo $res;