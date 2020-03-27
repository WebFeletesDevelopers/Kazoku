<li class="nav-item dropdown no-arrow" role="presentation">
    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small"><?= $_SESSION['name']?></span><img class="border rounded-circle img-profile" src="assets/img/profile/generic.png"></a>
        <div
            class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
            <a class="dropdown-item" role="presentation" href="/userdata.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Tus datos</a>
            <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Ajustes</a>
            <a class="dropdown-item" role="presentation" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;n/a</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" role="presentation" href="site/controller/LogoutController.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Salir</a></div>
    </div>
</li>