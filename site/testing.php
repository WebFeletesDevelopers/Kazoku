<?php
// Datos de prueba para la sección de noticias del footer.
$ANDummyRaw = array(
    array(
        'Cod' => 1,
        'color' => "badge-orange",
        'Titulo' => "Lorem 123",
        'Cuerpo' => "Lorem Ipsun admin arbat sien nama te",
        'Fecha' => "01/02/2020"),
    array(
        'Cod' => 1,
        'color' => "badge-orange",
        'Titulo' => "Lorem alop",
        'Cuerpo' => "Lorem Ipsun admin arbat sien nama te",
        'Fecha' => "01/02/2020"),
    array(
        'Cod' => 1,
        'color' => "badge-red",
        'Titulo' => "Lorem yemen",
        'Cuerpo' => "Lorem Ipsun admin arbat sien nama te",
        'Fecha' => "01/02/2020"),
    array(
        'Cod' => 2,
        'color' => "badge-blue",
        'Titulo' => "Lorem asin",
        'Cuerpo' => "Lorem Ipsun admin arbat sien nama te",
        'Fecha' => "01/02/2020")
    );
$ArrayNoticiasFooter = json_encode($ANDummyRaw, JSON_PRETTY_PRINT);
$ArrayNoticias = json_encode($ANDummyRaw, JSON_PRETTY_PRINT);

$ACDummyRaw = array(
    array(
        'Cod' => 1,
        'Nivel' => "European Cup",
        'Categoria' => "Senior",
        'Dia' => "10/11",
        'Mes' => "Enero",
        'Lugar' => "Pabellón Juan Gómez Juanito (Fuengirola)"),
    array(
        'Cod' => 1,
        'Nivel' => "European Cup",
        'Categoria' => "Senior",
        'Dia' => "13",
        'Mes' => "Septiembre",
        'Lugar' => "Pabellón Juan Gómez Juanito (Fuengirola)"),
    array(
        'Cod' => 1,
        'Nivel' => "European Cup",
        'Categoria' => "Senior",
        'Dia' => "12",
        'Mes' => "Enero",
        'Lugar' => "Pabellón Juan Gómez Juanito (Fuengirola)"
    ));
$ArrayCampeonatos = json_encode($ACDummyRaw, JSON_PRETTY_PRINT);
