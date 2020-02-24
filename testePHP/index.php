<?php
require_once('config.php');
$bd = new Banco();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="uft-8">
    <script src="ATENÇÃO: aqui é colocado o link da sua conta no 'https://fontawesome.com/'" crossorigin="anonymous"></script> <!-- usado para colocar ícones -->
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="./bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="./jquery-3.4.1.min.js"></script>

    <title>Cadastro de aluno</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <?php
                $pagina = "home";
                if (!empty($_GET["pagina"])) {
                    $pagina = $_GET["pagina"];
                }
                if (file_exists("$pagina.php")) {
                    include("$pagina.php");
                } else {
                ?>
                    <i class="fa fa-times"></i> Página não encontrada.
                <?php
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>