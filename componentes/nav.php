<nav class="navbar navbar-dark align-items-start sidebar  toggled sidebar-dark accordion   p-0" style="background-color: #2B3E4F">
    <div class="container-fluid d-flex flex-column p-0 sticky-top">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
            <div class="sidebar-brand-icon"><img src="assets/img/Logo/logo-judo-93x94.png" height="50" width="50"></div>
            <div class="sidebar-brand-text mx-3"><span>Kazoku</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer"></i><span>Panel</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Mi Perfil</span></a></li>
            <?php
                if(isset($_SESSION['Rango'])){
                    if($_SESSION['Rango']<2 &&  $_SESSION['Confirmado']==1){
                        echo'
                         <li class="nav-item" role="presentation"><a class="nav-link" href="confirmaciones.php"><i class="fas fa-user-circle"></i><span>Confirmaciones</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="table.php"><i class="fas fa-table"></i><span>Alumnos</span></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="forgot-password.php"><i class="fas fa-key"></i><span>Reestablecer Contraseñas</span></a></li>';
                    }
                }

            ?>

            <li class="nav-item" role="presentation"><a class="nav-link" href="alta.php"><i class="far fa-user-circle"></i><span>Alta</span></a></li>
<!--            <li class="nav-item" role="presentation"><a class="nav-link" href="404.php"><i class="fas fa-exclamation"></i><span></span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="blank.php"><i class="fas fa-window-maximize"></i><span>Blank Page</span></a></li>-->
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>