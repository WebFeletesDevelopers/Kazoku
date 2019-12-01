<?php

include "conexion.php";

$user_id=null;
$sql1= "select * from alumno where Nombre like '%$_GET[s]%' or Apellido1 like '%$_GET[s]%' or Apellido2 like '%$_GET[s]%' or Sexo like '%$_GET[s]%' or FechaNacimiento like '%$_GET[s]%' or DNI like '%$_GET[s]%' or IdFanjyda like '%$_GET[s]%' or CodAlumno like '%$_GET[s]%'";
$query = $con->query($sql1);
function asignarCinturon($CodCinturon){
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
            $response = 'Blanco';

    }
    return $response;
}

?>

<?php if($query->num_rows>0):?>
    <table class="table table-hover table-dark m-3">
<thead>
<th></th>
    <th name="s" >Foto</th>
	<th>Nombre</th>
	<th>Primer Apellido</th>
	<th>Segundo Apellido</th>
	<th>Sexo</th>
	<th>ID Federacion</th>
    <th>DNI</th>
    <th>Fecha Nacimiento</th>


</thead>
<?php while ($r=$query->fetch_array()):?>
<tr>
    <td style="width:150px;" class="inline-block container-fluid text-center align-middle">
        <a href="/info.php?CodAlumno=<?=$r["CodAlumno"]?>" id="#del-<?= $r["CodAlumno"];?>" class="container-fluid btn btn-sm btn-danger inline-block m-1">Info</a>
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
    <td class="align-middle text-center"><img src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$r['DNI'].'.png')){echo "$r[DNI]";}else{echo "generic";}  ?>.png" width="50" height="50"></td>
    <td><?= $r["Nombre"]; ?></td>
	<td><?= $r["Apellido1"]; ?></td>
	<td><?= $r["Apellido2"]; ?></td>
	<td><?= $r["Sexo"]; ?></td>
	<td><?= $r["IdFanjyda"]; ?></td>
    <td><?= $r["DNI"]; ?></td>
    <td><?= $r["FechaNacimiento"]; ?></td>


</tr>
<?php endwhile;?>
</table>
<?php else:?>
	<p class="alert alert-warning">No hay resultados</p>
<?php endif;?>
