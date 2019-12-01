
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Taskapi</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body{
            background-color: black;
            color: gray;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Taskapi</h3>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">API de acceso a datos</h1><small>En desarrollo</small>
        <p class="lead">Probablemente si has llegado aqui es porque estás haciendo un rico test a mi API, has llegado por casualidad o quieres documentación de la api.</p>
        <div class="text-center container-fluid" align="center">
            <h4>Acciones disponibles</h4>
                <table class="text-center container-fluid">
                    <thead>
                    <tr>
                        <th class="w-25">
                            Nombre
                        </th>
                        <th class="w-25">
                            accion
                        </th>
                        <th class="w-25">
                            parámetros
                        </th>
                        <th class="w-25">
                            resultado
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                Listar
                            </th>
                            <td>
                                0
                            </td>
                            <td>
                                ninguno
                            </td>
                            <td>
                                todas las tareas
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Insertar
                            </th>
                            <td>
                                1
                            </td>
                            <td>
                                Name,Progress,Comment
                            </td>
                            <td>
                                Confirmación de la operación
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Borrar
                            </th>
                            <td>
                                2
                            </td>
                            <td>
                                TaskCode
                            </td>
                            <td>
                                Confirmación de la operación
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Editar
                            </th>
                            <td>
                                3
                            </td>
                            <td>
                                TaskCode,old,new
                            </td>
                            <td>
                                Confirmación de la operación
                            </td>
                        </tr>
                    </tbody>
                </table>

        </div>
        <p class="lead mt-5">
            <a href="http://nukazoku.albertogomp.es" target="_blank" class="btn btn-lg btn-primary">La APP para lo que fue diseñado</a>
        </p>
    </main>

    <footer class="mastfoot mt-auto text-center" style="position: absolute; bottom: 0; align-self: center">
        <div class="inner text-center">
            <p class="text-center">Alberto Gómez &copy; 2019.</p>
        </div>
    </footer>
</div>
</body>
</html>
