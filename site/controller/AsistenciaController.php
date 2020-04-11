<?php

include_once '../../PDO/falta.php';
include_once '../../PDO/database.php';
/*
$_POST['listaFalta']=[1,2,3,4,5];
$_POST['CodClase']=1;
$_POST['Fecha']="1/2/2020";
*/

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $absence = new falta();
    $newDate = '2020-03-30';
    $judokasArray = $_POST['listaFalta'];
    $absence->CodClase = $_POST['CodClase'];
    $absence->CodFalta = 0;
    $absence->Fecha = $newDate;
    foreach($judokasArray as $CodAlumno) {
        $absence->CodAlumno = $CodAlumno;
        $dbConnection = create();
        insert($absence, $dbConnection);
        //TODO: Generate response
        return 1;
    }
}

/**
 * Gets all the absences of a student
 * @param $CodAlumno int the student's ID
 * @return array The list of the absences
 */
function getAbsences($CodAlumno)
{
    $bd = create();
    $sentence = $bd->query("SELECT * FROM falta WHERE CodAlumno = $CodAlumno;");
    $absences = $sentence->fetchAll(PDO::FETCH_OBJ);
    foreach ($absences as $absence){
        $classCodes[] = $absence->getCodClase;
        $
    }

}

