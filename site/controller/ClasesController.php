<?php
session_start();


if (isProfe() || isAdmin()) {
    $listadoClases = getClases();
    foreach ($listadoClases as $clase) {
        if (isDiaClase($clase->Dias)) {
            if (isClaseAhora($clase->Horario)) {
                $claseActual = $clase;
                $_SESSION['IdClaseActualListado'] = $clase->CodClase;
                $listadoAlumnos = getAlumnosEnClase($clase->CodClase);
            }
        }

    }
} else {
    header('Location: ../../../login.php');
}



/**
 * Funcion para obtener todas las clases disponibles
 * @return array las clases obtenidas
 */
function getClases()
{
    $bd = crear();
    $sentencia1 = $bd->query("SELECT * FROM clase");
    return $sentencia1->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Funcion para obtener todos los centros disponibles
 * @return array los centros obtenidos
 */
function getCentros()
{
    $bd = crear();
    $sentencia1 = $bd->query("SELECT * FROM centro");
    return $sentencia1->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Busca los alumnos en una clase concreta meediante el codigo de la clase
 * @param $CodClase el código de la clase en la que buscar
 * @return array Listado de alumnos
 */
function getAlumnosEnClase($CodClase)
{
    $bd = crear();
    $sentencia = $bd->query("SELECT * FROM alumno WHERE CodClase = $CodClase;");
    $res = $sentencia->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/** Funcion para obtener si hoy hay clase, partiendo de un valor decimal de días de la base de datos, similar a conversión decimal - binario, con los siguientes valores
 * Lunes      -  1
 * Martes     -  2
 * Miércoles  -  4
 * Jueves     -  8
 * Viernes    - 16
 *
 * Por ejemplo, si hay clase lunes y miércoles, en la BD encontraremos 5 (1 + 4)
 *              si hay clase martes y jueves, en la BD encontraremos  10 (2 + 8)
 *
 * @param $totalDias int el resultado de cuantas clases hay a la semana de un determinado grupo
 * @return bool TRUE: Hay clase hoy / FALSE: No hay clase hoy
 */
function isDiaClase($totalDias)
{
    $hayclase = false;
    /**
     * Primero obtenemos los días en sistema decimal
     * Segundo, se convierte a binario (ya que el sistema está basado en ello)
     * Tercero se introduce en un array forzando que tenga 5 posiciones
     */
    $dias = str_split(sprintf("%05d", decbin($totalDias)));
    for ($i = 0; $i < 5; $i++) {
        /** recorremos el array, si encontramos que si el iterador vale 1 (hay clase) y además el día coincide con el día de la semana actual (hoy) */
        if ($dias[$i] == 1 && $i == ((int)date('w') - 1)) {
            $hayclase = true;
        }
    }
    return $hayclase;
}

/** Comprueba si la hora actual está dentro del rango pasado por parámetro
 * @param $horasEnString string Campo hora de la Base de datos
 * @return bool TRUE: Está en horario / FALSE: No está en horario
 */
function isClaseAhora($horasEnString)
{
    $isClase = false;
    if (!is_null($horasEnString)) { //TODO: ver si es necesaria esta comprobación
        $isClase = false;
        $horario = explode("-", $horasEnString);

        $horaCompletaInicio = explode(":", $horario[0]);
        $horaCompletaFinal = explode(":", $horario[1]);

        $horaActual = (int)date("H") + 1;
        $minutoActual = (int)date("i");
        $actual = ($horaActual * 60) + $minutoActual;

        $horaInicio = (int)$horaCompletaInicio[0];
        $minutoInicio = (int)$horaCompletaInicio[1];
        $inicio = ($horaInicio * 60) + $minutoInicio;

        $horaFinal = (int)$horaCompletaFinal[0];
        $minutoFinal = (int)$horaCompletaFinal[1];
        $final = ($horaFinal * 60) + $minutoFinal;

        if (($inicio <= $actual) && ($final >= $actual)) {
            $isClase = true;
        }

    }
    return $isClase;
}

?>