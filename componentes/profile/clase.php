<?php
$hoy= date("w");

switch ($clase->Dias){
    case 10:
        $dia1 =  2;
        $dia2 = 4;
        break;
    case 21:
        $dia1 = 1;
        $dia2 = 3;
        $dia3 = 5;
        break;
    case 5:
        $dia1 = 1;
        $dia2 = 3;
        break;
    default:
        $dia1 = null;
}
if($dia1 !=null){
    switch ($hoy){
        case $dia1:
        case $dia2:
        case $dia3:
            $proxClase = "Hoy";
            break;
        case $dia1-1:
        case $dia2-1:
        case $dia3-1:
            $proxClase = "Mañana";
            break;
        case $dia1-2:
        case $dia2-2:
        case $dia3-2:
            $proxClase = "Pasado mañana";
            break;
        default:
            if($hoy ==7 AND $dia1==0){
            $proxClase = "Mañana";
            }
            else{
                $dif = (7-$hoy)+min($dia1,$dia2,$dia3);
                switch ($dif){
                    case 0:
                        $proxClase = 'Hoy';
                        break;
                    case 1:
                        $proxClase ='Mañana';
                        break;
                    case 2:
                        $proxClase = 'Pasado mañana';
                        break;
                    default:
                        $proxClase = 'En '.$dif. ' dias';
                }
            }
    }
}

?>
<ul class="list-group mb-3 p-1">
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">Próxima Clase</h6>

            <small class="text-muted"><?= $proxClase.", ".$clase->Horario ?></small>
        </div>
        <span class="text-muted" style=""><?= $clase->Nombre ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">Dirección</h6>
            <small class="text-muted">CP : <?=$Centro->CodPostal?></small>
        </div>
        <span class="text-muted"><?= $Centro->Direccion ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">Teléfono</h6>
            <small class="text-muted"></small>
        </div>
        <span class="text-muted"><?=$Centro->Telefono?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between bg-light">
        <div class="text-success">
            <h6 class="my-0">Profesor</h6>

        </div>
        <span class="text-success"><?=$clase->Profesor?></span>
    </li>
</ul>