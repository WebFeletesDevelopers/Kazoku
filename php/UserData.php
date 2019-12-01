<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: ../../../index.php');
}
else {
    include 'php/conexion.php';
    $user_id = null;
    $sql1 = "select * from alumno where CodUsu = " . $_SESSION['CodUsu'];
    $query = $con->query($sql1);
    $alumno = null;
    if ($query->num_rows > 0) {
        while ($r = $query->fetch_object()) {
            $alumno = $r;
            break;
        }
    }
}
$sql2= "select * from direccion where CodDireccion = $alumno->CodDireccion";
$query = $con->query($sql2);
$direccion = null;
if(isset($query->num_rows)){
    if($query->num_rows>0){
        while ($r=$query->fetch_object()){
            $direccion=$r;
            break;
        }
    }
}
$sql2= "select * from clase where CodClase = $alumno->CodClase";
$query = $con->query($sql2);
$clase = null;
if(isset($query->num_rows)){
    if($query->num_rows>0){
        while ($r=$query->fetch_object()){
            $clase=$r;
            break;
        }
    }
}
$sql3= "select * from centro where CodCentro = $clase->CodCentro";
$query = $con->query($sql3);
$Centro = null;
if(isset($query->num_rows)){
    if($query->num_rows>0){
        while ($r=$query->fetch_object()){
            $Centro=$r;
            break;
        }
    }
}
switch ($alumno->CodCinturon){
    case 1:
        $cinturon = 'Blanco';
        break;
    case 2:
        $cinturon = 'Blanco-Amarillo';
        break;
    case 3:
        $cinturon = 'Amarillo-Naranja';
        break;
    case 4:
        $cinturon = 'Naranja-verde';
        break;
    case 5:
        $cinturon = 'Verde';
        break;
    case 6:
        $cinturon = 'Verde-Azul';
        break;
    case 7:
        $cinturon = 'Azul';
        break;
    case 8:
        $cinturon = 'Azul-Marrón';
        break;
    case 9:
        $cinturon = 'Marrón';
        break;
    case 10:
        $cinturon = 'Negro';
        break;
    default:
        $cinturon = 'Blanco';

}
@$Range = $_SESSION['Rango'];
switch ($Range){
    case 0:
        $Range = 'Administrador';
        break;
    case 1:
        $Range = 'Profesor';
        break;
    case 2:
        $Range = 'Alumno';
        break;
    case 3:
        $Range = 'Tutor';
        break;
    default:
        $Range = "N/A";
}


$date = DateTime::createFromFormat('Y-m-d', $alumno->FechaNacimiento)->getTimestamp();
$newDate = date("d/m/Y", $date);
$yearN = date("Y",$date);
$edad = date("Y") - $yearN;
?>
<!--<script type="text/javascript">
    $(document).ready(function(){

        $("#but_submit").click(function(){
            var Nombre = $("#Nombre").val().trim();
            var Apellido1 = $("#Apellido1").val().trim();
            var FechaNacimiento = $("#FechaNacimiento").val().trim();
            var CodPostal = $("#CodPostal").val().trim();
            //var CodDireccion = $alumno->CodDireccion;
            if( Nombre != "" && Apellido1 != "" && FechaNacimiento != ""  && CodPostal !="" && CodDireccion !==""){
                $.ajax({
                    url:'./php/actualizarUsuario.php',
                    type:'post',
                    data:{Nombre:Nombre,Apellido1:Apellido1,FechaNacimiento:FechaNacimiento,CodPostal:CodPostal,CodDireccion:CodDireccion},
                    success:function(response){
                        var msg = "";
                        if(response ==1){
                            msg = "Actualizado con �xito, por favor, inicie sesi�n de nuevo.";

/*                            //session_destroy();
                            //session_unset();
                            //http_redirect('../../index.php');


                        }else{
                            msg = "Algo ha fallado";
                        }
                        $("#message").html(msg);
                    }
                });
            }
        });

    });
</script>-->

<div class="container-fluid p-2" >
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="/assets/img/profile/<?php if(file_exists("assets/img/profile/".$alumno->DNI.'.png')){echo "$r[DNI]";}else{echo "generic";}  ?>.png" alt="" width="90" height="90">
        <h2>
            <?php
            echo $alumno->Nombre." ".$alumno->Apellido1;
            if(isset($alumno->Apellido2)){
                echo " ".$alumno->Apellido2;
            }
            ?>
        </h2>
        <small><?= $Range ?> </small>
        <p class="lead"> </p>
    </div>

    <div class="row">
        <div class="col-md-3 order-md-2 mb-4 p-1">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tu Centro</span>
                <span class="badge badge-secondary badge-pill"><?= $Centro->Nombre ?></span>
            </h4>
            <ul class="list-group mb-3 p-1">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                            <h6 class="my-0">Próxima Clase</h6>
                        <small class="text-muted">MAÑANA, <?= $clase->Horario ?></small>
                    </div>
                    <span class="text-muted"><?= $clase->Nombre ?></span>
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

            <!--<form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>-->
        </div>
        <div class="col-md-4 order-md-1">
        </div>
        <div class="col-md-4 order-md-1 ">
            <h4 class="mb-3 text-primary">Mis datos</h4>
            <form class="needs-validation" novalidate >
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label for="firstName">Nombre</label>
                        <input type="text" class="form-control" id="firstName" name="Nombre" placeholder="" value="<?= $alumno->Nombre ?>" required>

                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="lastName">Primer Apellido </label>
                        <input type="text" class="form-control" id="lastName" placeholder="" name="Apellido1" value="<?= $alumno->Apellido1 ?>" required>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="firstName" name="FechaNacimiento" placeholder="<?= $newDate ?>" value="<?= $alumno->FechaNacimiento ?>" required>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Clase</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" name="CodClase" disabled readonly  value="<?= $clase->Nombre ?>" required>

                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Tu nombre de usuario</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" placeholder="Username" disabled readonly name="Username" value="<?= $_SESSION['name'] ?>" required>

                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Tu correo electrónico <span class="text-muted"></span></label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" name="Email"
                           disabled readonly  value="<?php if(isset($_SESSION['Email'])){ echo $_SESSION['Email']; } ?>">

                </div>

                <div class="mb-3">

                </div>
                <div class="row mb-3">
                    <div class="col-md-9 mb-3">
                        <label for="address">Tu dirección</label>
                        <input type="text" class="form-control" id="address" name="Direccion" placeholder="1234 Main St" value="<?php if(isset($direccion->Direccion)){echo $direccion->Direccion;}else{echo "N/A";}; ?>"  required>

                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Código postal</label>
                        <input type="text" class="form-control" id="zip" placeholder="" name="CodPostal" value="<?php if(isset($direccion->CodigoPostal)){echo $direccion->CodigoPostal;}else{echo "N/A";}; ?>" required>

                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Enfermedades</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" placeholder="Username" disabled readonly name="Username" value="<?php if(isset($alumno->Enfermedad)){echo $alumno->Enfermedad;}else{echo "N/A";}; ?>" required>

                    </div>
                </div>

 <!--               <h4 class="mb-3">Método de pago</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="paypal">PayPal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required>
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div>-->
<!--                <hr class="mb-4">
                <button id="but_submit" class="btn btn-primary btn-lg btn-block mb-4" type="submit">Actualizar datos</button>-->
            </form>
        </div>
    </div>