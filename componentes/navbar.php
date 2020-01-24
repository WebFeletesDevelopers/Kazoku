<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top sticky-top">
    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
        <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
            </div>
        </form>
        <ul class="nav navbar-nav flex-nowrap ml-auto">
            <?php include 'subcomponents/search.php'; ?>
            <?php include 'subcomponents/notificaciones.php'; ?>

            <div class="d-none d-sm-block topbar-divider"></div>
            <?php
            if(isset($_SESSION['name'])){
                include 'subcomponents/usermini.php';
            }
            else{
                include 'subcomponents/loginmini.php';

            }
            ?>

        </ul>
    </div>
</nav>