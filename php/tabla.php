<?php
include '../PDO/database.php';
$user_id=null;
$orden="Nombre";
/*if($_GET[s]!==null){
    $orden=$_GET[s];
}*/


function asignarCinturon($CodCinturon)
{
    switch ($CodCinturon) {
        case 1:
            $response = 'Blanco';
            break;
        case 2:
            $response = 'Blanco-Amarillo';
            break;
        case 3:
            $response = 'Amarillo-Naranja';
            break;
        case 4:
            $response = 'Naranja-verde';
            break;
        case 5:
            $response = 'Verde';
            break;
        case 6:
            $response = 'Verde-Azul';
            break;
        case 7:
            $response = 'Azul';
            break;
        case 8:
            $response = 'Azul-Marrón';
            break;
        case 9:
            $response = 'Marrón';
            break;
        case 10:
            $response = 'Negro';
            break;
        default:
            $response = 'Blanco ';

    }
    return $response;
}


$sql1= 'select * from alumno order by ?';
$bd = create();
$query = $bd->query($sql1);
$usuario = $query->fetchAll($orden);


?>

<?php if($query->num_rows>0):?>

<table class="container-fluid ">
<thead class="mt-4 pt-2">

    <th>Foto</th>
	<th>Nombre</th>
	<th>Apellido 1</th>
    <th>Apellido 2</th>
	<th>Sexo</th>
    <th>Cinturón</th>
	<th>ID FANJYDA</th>
	<th>DNI/NIE/PAS</th>
    <th>Fecha Nacimiento</th>
    <th></th>
</thead>
    <tbody class="text-center mx-0">
<?php
    foreach ($usuario as $usuarioDetalle){


    $originalDate = $usuarioDetalle->FechaNacimiento;
    $newDate = date("d-m-Y", strtotime($originalDate));
?>

<tr>



    <td class="align-middle text-center"><img src="/site/images/profile/<?php if(file_exists("site/images/profile/".$r['DNI'].'.png')){echo "$r[DNI]";}else{echo "generic";}  ?>.png" width="50" height="50"></td>
	<td class="align-middle text-center"><?= $r[""]; ?></td>
	<td class="align-middle text-center"><?= $r["Apellido1"]; ?></td>
	<td class="align-middle text-center"><?= $r["Apellido2"]; ?></td>

	<td class="align-middle text-center"><?php if($r["Sexo"]==1){echo "Masculino";}else{echo "Femenino";}?></td>
    <td class="align-middle text-center"><?php  if(isset($r["CodCinturon"])){ echo asignarCinturon($r["CodCinturon"]);} else{ echo "Blanco";}?></td>

	<td class="align-middle text-center"><?= $r["IdFanjyda"]; ?></td>
    <td class="align-middle text-center"><?= $r["DNI"]; ?></td>
    <td class="align-middle text-center"><?= $newDate; ?></td>
    <td>        <a href="/info.php?CodAlumno=<?=$r["CodAlumno"]?>" class="container-fluid btn btn-sm btn-primary inline-block m-1">Info</a>
        <script>
            $("#del-"+<?= $r["CodAlumno"];?>).click(function(e){
                e.preventDefault();
                p = confirm("Estas seguro?");
                if(p){
                    window.location="/Kazoku/php/eliminar.php?CodAlumno="+<?= $r["CodAlumno"];?>;
                }
            });
        </script>
    </td>
</tr>
<?php };?>
</tbody>
</table>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
