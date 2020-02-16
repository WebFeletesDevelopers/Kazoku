<?php session_start()
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="es">
<?php include 'site/template/head.php' ?>
  <body>
    <!-- Preloader -->
    <?php include 'site/template/preloader.php' ?>
    <!-- pagina-->
    <div class="page">
      <!-- Encabezado-->
    <?php include 'site/template/header.php' ?>
        <div class="container bg-dark ">
        <div
        >
            <div class=" px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-4">Perfil de <?=$_SESSION['Nombre'] ?></h1>
                <img src="/assets/img/profile/generic.png" width="256" height="256">

            </div>
            <div class="card-deck mb-3 text-center">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header kaz-azul">
                        <h4 class="my-0 font-weight-normal " style="color: white">Tu Clase</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>10 users included</li>
                            <li>2 GB of storage</li>
                            <li>Email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-success">Ir a la clase</button>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header kaz-terciario ">
                        <h4 class="my-0 font-weight-normal " style="color: white">Tus Datos</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Nombre</label>
                                    <input type="text" class="form-control" id="txt-nombre">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">Primer Apellido</label>
                                    <input type="text" class="form-control" id="txt-apellido1">
                                    <label for="inputPassword4">Segundo Apellido</label>
                                    <input type="text" class="form-control" id="text-apellido2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Teléfono</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2"></label>
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Zip</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                        <button type="button" class="btn btn-lg btn-block kaz-azul text-light">Actualizar datos</button>
                    </div>
                </div>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header kaz-azul">
                        <h4 class="my-0 font-weight-normal" style="color: white">No se que poner</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-success">Soy un felete</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

      <!-- Page Footer-->
      <?php 
        include 'site/template/footer.php'; 
        include 'site/template/videomodal.php';
        include 'site/template/scripts.php'
     ?>
  </body>
</html>