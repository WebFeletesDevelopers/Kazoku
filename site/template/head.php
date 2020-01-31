
<head>
    <!-- Titulo y metadata-->
    <?php
    include 'site/controller/SessionController.php';
    if(!isset($_SESSION['Lang'])){
        $_SESSION['Lang'] = "ES";
    }
    switch($_SESSION['Lang']){
        case "ES":
            include 'site/template/lang-es.php';
        break;
    }
    ?>
    <title><?= ucfirst(substr(basename($_SERVER['PHP_SELF']),0,-4  ));  ?></title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="<?=$Rutas->Favicon?>" type="image/x-icon">
    <!-- Hojas de estilo -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600%7CRoboto:400,900">
    <link rel="stylesheet" href="<?=$Rutas->Bootstrap?>">
    <link rel="stylesheet" href="<?=$Rutas->Fonts?>">
    <link rel="stylesheet" href="<?=$Rutas->CSS?>">
    <link rel="stylesheet" href="<?=$Rutas->CSSKazoku?>">
</head>