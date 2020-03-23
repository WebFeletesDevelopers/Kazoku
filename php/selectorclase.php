<?php

include 'conexion.php';
$CodCentro = 0;
if(isset($_SESSION["centro"])){
    if($_SESSION["centro"]=="Cole"){
        $CodCentro = 2;
    }
    if($_POST["centro"]=="Fuengirola"){
        $CodCentro = 1;

    }
}
$user_id=null;
$sql1= "select * from clase where CodCentro = $CodCentro";
$query = $con->query($sql1);
?>
<h2 class="text-center"> Grupos de
    <?= $_SESSION['centro']?>
    </h2>

<?php if($query->num_rows>0):?>

    <table class="table table-hover table-dark m-3 text-center">
        <thead>
        <th>Horario</th>
        <th>Edad Mínima</th>
        <th>Edad Máxima</th>
        <th>Nombre</th>

        </thead>
        <?php while ($r=$query->fetch_array()):?>
            <tr>
                <td><?= $r['Horario']; ?></td>
                <td><?= $r['EdadMin']; ?></td>
                <td><?= $r['EdadMax']; ?></td>
                <td><?= $r['Nombre']; ?></td>
<?php endwhile;?>

<?php endif;?>