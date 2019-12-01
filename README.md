# kazoku
Repo del proyecto
<h2>POR MOTIVOS DE SEGURIDAD, LAS CONTRASEÑAS HAN SIDO RETIRADAS DE LA REPO, PARA PODER COMPROBAR FUNCIONALIDADES, HA DE PEDIRSE LA CONTRASEÑA </h2>
<h1>Esquema de la base de datos</h1>
<img src="esquema.jpg" style="text-align: center;">
<h1>Enlaces al proyecto</h1>
<ul>
    <li>
        Proyecto publicado: <a href="nukazoku.albertogomp.es" target="_blank">Web kazoku</a>
    </li>
     <li>
        API publicada: <a href="taskapi.albertogomp.es" target="_blank">Web Taskapi</a>
    </li>
</ul>
<h1>Listado de funcionalidades disponibles</h1>
<small>Actualmente se está realizando una conversión de MySQLi a PDO en las consultas, al lado de cada apartado se puede ver que acciones se relizan con PDO o con MySQL</small>
<h2>Página de Inicio</h2>
<ul>
    <li>
        Carrusel informativo
    </li>
    <li>
        Noticias de la web (PDO)<br>
        Consulta a la base de datos con PDO para obtención de noticias
        <ul>
            <li>
                Los usuarios no registrado solo podrán ver las noticias públicas
            </li>
            <li>
                Los usuarios registrados pueden ver las noticias públicas y privadas
            </li>
            <li>
                Los profesores y administrador pueden ver todas las noticias, publicar nuevas y podrán próximamente borrarlas.
            </li>
        </ul>
    </li>
            <li>
                Taskapi (PDO, API)
                <br>
                La API taskapi es una API propia capaz de crear una lista de tareas, poner el porcentaje en el que se está realizando.
                <ul>
                    <li>
                        Los usuarios pueden ver el progreso de las tareas.
                    </li>
                    <li>
                        los administradores podrán modificar valores, crear tareas y borrarlas.
                    </li>
                </ul>
            </li>
            <li>
                Chat con un profe
                <ul>
                    Script JS conectado a un BOT de telegram que reenvia los mensajes a mi cuenta y viceversa para usarlo de chat.
                </ul>
            </li>
</ul>
<h2>Cuentas de usuario</h2>
<ul>
            <li>
                Login y registro (PDO y MySQLi)<br>
                Mediante llamadas AJAX, los usuarios pueden crear sus cuentas y registrarse.
                <ul>
                    <li>
                        Las contraseñas son cifradas con un método de hashing en el backend
                    </li>
                    <li>
                        Al registrarse, el usuario recibe en su correo un enlace de confirmación de cuenta.
                    </li>
                    <li>
                        Al registrarse, el usuario necesita ser confirmado por un profesor para poder acceder a los diversos servicios.
                    </li>
                    <li>
                        Los usuarios logueados serán redireccionados si intentan acceder a esta página
                    </li>
                </ul>
            </li>
            <li>
                <a href="http://nukazoku.albertogomp.es/userdata.php">userdata.php (Sesiones)</a>
                <ul>
                    <li>
                        El usuario puede consultar sus datos de cuenta
                    </li>
                    <li>
                        El usuario podrá próximamente modificar sus datos.
                    </li>
                </ul>
                <a href="http://nukazoku.albertogomp.es/profile.php">profile.php (PDO)</a>
                <ul>
                    <li>
                        <ul>
                            Si el usuario no tiene cuenta de alumno asociada a su cuenta:
                            <li>
                                Si es padre:
                                <ul>
                                    <li>
                                        Puede buscar la cuenta de alumno de su hij@.
                                    </li>
                                    <li>
                                        Si no encuentra cuenta, podrá próximamente darle de alta y asociarla a si mismo como su hij@
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Si es alumno
                                <ul>
                                    <li>
                                        Puede buscar en función de nombre y apellidos cuentas de alumnos existentes y enlazarla con su cuenta de alumno
                                    </li>
                                    <li>
                                        Si no encuentra cuenta asociada, podrá próximamente crear una nueva.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                El profesor puede crear cuentas de alumnos sin que se asocien a si mismos.
                            </li>
                        </ul>
                    </li>
                    <li>
                        El usuario puede consultar sus datos de cuenta y su relación (si es alumno) con sus datos de alumno
                        <ul>
                            <li>
                                EL usuario puede ver su foto de perfil si se encuentra en el servidor, sino, encontrará una genérica.
                            </li>
                            <li>
                                El usuario podrá próximamente ver bajo su foto el cinturón que tiene en ese momento, mientras, solo aparece un cinturón blanco o negro.
                            </li>
                            <li>
                                El usuario puede ver sus datos de usuario (nickname, correo electrónico, nombre y apellidos)
                            </li>
                        </ul>
                    </li>
                    <li>
                        El usuario puede ver sus datos de dirección.
                    </li>
                    <li>
                        El usuario puede cual es su próxima clase
                    </li>
                    <li>
                        El usuario puede ver información de su profesor
                        <ul>
                            <li>
                                El usuario puede ver el nombre del profesor
                            </li>
                            <li>
                                El usuario puede ver el teléfono del profesor
                            </li>

                        </ul>
                    </li>
                    <li>
                        El usuario puede ver información de su clase:
                        <ul>
                            <li>
                                Nombre del centro
                            </li>
                            <li>
                                Dirección
                            </li>
                            <li>
                                Nombre de su grupo
                            </li>
                        </ul>
                    </li>
                    <li>
                        El usuario podrá próximamente modificar sus datos.
                    </li>
                </ul>
            </li>
            <li>
                Los usuarios no verificados o no logueados serán redireccionados si intentan acceder a esta página
            </li>
        </ul>
<h2>Gestión de cuentas</h2>
<h3><a href="http://nukazoku.albertogomp.es/confirmaciones.php" target="_blank">confirmaciones.php (PDO)</a></h3>
<ul>
    <li>
        El administrador o profesores pueden comprobar las cuentas que se han dado de alta.
        <ul>
            <li>
                Aceptar la solicitud si los datos concuerdan
            </li>
            <li>
                Rechazar la solicitud (que borrará la cuenta de usuario)
            </li>
        </ul>
    </li>
    <li>
        Cualquier otro tipo de usuario será redirigido si intenta entrar en esta página
    </li>
</ul>
<h2>Gestión de alumnado</h2>
<h3><a href="http://nukazoku.albertogomp.es/table.php" target="_blank">table.php (PDO)</a></h3>
<ul>
    El profesor o administradores pueden ver todos los alumnos dados de alta junto con sus datos personales
    <li>
        Buscador de alumnos: Se pueden buscar alumnos en función de cualquier campo (nombre, apellidos, DNI, IdFanjyda, Fecha de nacimiento, Sexo...)
    </li>
    <li>
        Los profesores o administradores pueden darle al botón "info" que redirecciona a profile.php donde se pueden ver en detalles los datos del alumn@
    </li>
    <li>
        Los profesores podrán próximamente crear entradas de usuarios o borrarlos.
    </li>
    <li>
        Cualquier otro usuario que intente entrar en esta página será redireccionado.
    </li>
</ul>
Posteriormente se añadiran las siguientes funcionalidades:
<ul>
    <li>
        Gestión de asistencias.
    </li>
    <li>
        Servicio de mensajería
    </li>
    <li>
        Servicio de notificaciones
    </li>
    <li>
        Gestion de formularios federativos.
    </li>
    <lI>
        Gestión de pago de mensualidades>
    </lI>
    <li>
        Tienda online
    </li>
    <li>
        Galeria (actualmente existe, pero presenta fallos)
    </li>
    <li>
        Gestión de cinturones
    </li>



</ul>
</body>