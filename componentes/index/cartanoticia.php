<div class="col-md-6 col-xl-12 mb-4">
    <div class="card shadow border-left-primary py-2">
        <div class="card-body">
            <div class="row  no-gutters">
                <div class="col mr-2">
                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1" ><h1><?= $noticia->Titulo ?></h1></div>

                    <div class="text-dark font-weight-bold h5 mb-0"><span><?= $noticia->Autor ?></span></div>
                </div>
                <div class="col-md-12">
                    <p class="text-justify"><?=$noticia->Cuerpo ?></p>
                </div>
                <?php
                $originalDate = $noticia->Fecha;
                $newDate = date("d/m/Y", strtotime($originalDate));
                ?>
                <small class="text-right"><?= $newDate ?> - Noticia <?php if($noticia->Publica==1){echo "Pública";}else{echo "Privada";}?></small>
            </div>
        </div>
    </div>
    <form method="post" href="form/">
        <?php
        if(isset($_SESSION['Rango'])) {
            if ($_SESSION['Rango'] < 2) {
                echo '
                
                 <button class="btn btn-danger container-fluid" href="../../borrar.php?CodNot=' .$noticia->CodNot.'"  type="submit" >Borrar</button>';
            }
        }
        ?>

    </form>
</div>
