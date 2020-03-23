<form class="text-light p-5" role="form" method="post" action="php/agregar.php">
    <p class="h4 mb-4 text-center text-ligh" style="color:white">Formulario de Alta</p>
    <div class="form-group text-center">
    <input type="text" id="Nombre" class="form-control mb-4 text-center" placeholder="Nombre" required>
    <input type="text" id="Apellido1" class="form-control mb-4 text-center" placeholder="Primer Apellido" required>
    <input type="text" id="Apellido2" class="form-control mb-4 text-center" placeholder="Segundo Apellido">

    <input type="text" id="Telefono" class="form-control mb-4 text-center" placeholder="Teléfono (si lo tiene el alumno)">
    <input type="text" id="IdFanjyda" class="form-control mb-4 text-center" placeholder="ID Fanjyda (si se conoce)">
    <input type="text" id="DNI" class="form-control mb-4 text-center" placeholder="DNI/NIE/PASAPORTE">
    <input type="date" id="FechaNacimiento" class="form-control mb-4 text-center" placeholder="Fecha Nacimiento">

<!--    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4 text-center" placeholder="E-mail">
-->    </div>
    <button class="btn btn-info btn-block my-4" type="submit" disabled>Fuera de servicio</button>
</form>