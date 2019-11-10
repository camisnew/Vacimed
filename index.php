<?php
define('SITE_ROOT', dirname(dirname(__FILE__)));
error_reporting(E_ALL);
ini_set('display_errors', true);
spl_autoload_register(function ($class) {
    if (file_exists("controller/$class.php")) {
        require_once "controller/$class.php";
        return true;
    }
});
?>
<!DOCTYPE html>
<html lang='pt-br'>
<header>
    <meta charset="utf-8">
    <title>Tem remédio</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <!-- Theme CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/imageLink.js"></script>
</header>

<body>

    <?php
    if ($_GET) {
        $controller = isset($_GET['controller']) ? ((class_exists($_GET['controller'])) ? new $_GET['controller'] : NULL) : null;
        $method     = isset($_GET['method']) ? $_GET['method'] : null;
        if ($controller && $method) {
            if (method_exists($controller, $method)) {
                $parameters = $_GET;
                unset($parameters['controller']);
                unset($parameters['method']);
                call_user_func(array($controller, $method), $parameters);
            } else {
                echo "Método não encontrado!";
            }
        } else {
            echo "Controller não encontrado!";
        }
    } else {
        ?>
        <?php include 'header.php';?>

        <section class="font-roboto">
            <h3 class="text-center bold" id="oquedeseja">
                <p>O QUE DESEJA BUSCAR?</p>
            </h3>
            <p class="text-center">
                Selecione o icone abaixo referente ao que deseja pesquisar.
            </p>
            <div class="caption-image container2 flex-end ">
                <div class="item">
                    <img src="img/icone-medicamento.png" alt="Medicamento" width="300" height="300" class="img-fluid center-flex" onclick="medicamentoLink(this)">
                    <div class="caption bold">Medicamentos</div>
                </div>
                <div class="item">
                    <img src="img/icone-farmacias.png" alt="Farmacia" width="300" height="300" class="img-fluid center-flex" onclick="farmaciaLink(this)">
                    <div class="caption bold">Farmácias</div>
                </div>
            </div>
        </section>

        <?php include 'footer.php';?>

        <?php
            /*
            echo '<div class="container"><h1>Tem Remédio</h1><hr>';
            echo 'Bem-vindo ao aplicativo da Tem Remédio! <br /><br />';
            echo '<a href="?controller=ProdutosController&method=list" class="btn btn-success">Vamos Começar!</a></div>';
            */ ?>
    <?php
    }
    ?>
</body>

</html>