<?php
//$limit = 5;
//$sql1= "select * from `noticias` order by 1 desc LIMIT 5";
//$query = $con->query($sql1);

include_once 'PDO/database.php';
if(!isset($bd)){
    $bd = crear();
}
$sentencia = $bd->query("SELECT * FROM noticias order by 1 desc LIMIT 5;");
$noticias = $sentencia->fetchAll(PDO::FETCH_OBJ);

?>
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Noticias</h3>
    <?php
    if(isset($_SESSION['Rango'])){
    if($_SESSION['Rango']<2){
        echo '<a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="../../escribir.php">
                <i class="fas fa-pen fa-sm text-white-50"></i>&nbsp;Añadir Noticia
                </a>';}
    } ?>
</div>
<div class="row">
    <?php if(count($noticias)>0):
        foreach ($noticias as $noticia){

            //$sql= "select `username` from `users` where CodUsu =".$r['CodAutor']." ";
            //$query2 = $con->query($sql);
            //$u=$query2->fetch_array();
        if(isset($_SESSION['Confirmado'])){
                include 'cartanoticia.php';
        }
        else if($noticia->Publica==1) {
            include 'cartanoticia.php';
        }
        }
        else:?>
        <p class="alert alert-warning">No hay resultados</p>
    <?php endif;?>

</div>