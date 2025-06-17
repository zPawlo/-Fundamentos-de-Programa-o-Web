<?php
session_start();
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header('Location: index.php');
    exit();
}
unset($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrigado pela Compra</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="jumbotron text-center mt-5">
            <h1 class="display-4">Obrigado pela compra!</h1>
            <p class="lead">Sua compra foi realizada com sucesso. Um email de confirmação será enviado para você em breve.</p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="index.php" role="button">Voltar à Página Inicial</a>
            </p>
        </div>
    </div>
</body>
</html>