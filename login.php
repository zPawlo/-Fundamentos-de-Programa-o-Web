<?php
session_start();
include 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario'] = $dados['usuario'];
            header("Location: index.php");
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Loja de Eletrônicos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://cdn.pixabay.com/photo/2017/08/10/03/47/computer-2617622_1280.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-login {
            background-color: royalblue;
            border-color: royalblue;
            color: white;
        }
        .btn-register {
            background-color: mediumseagreen;
            border-color: mediumseagreen;
            color: white;
        }
        .btn-login:hover, .btn-register:hover {
            opacity: 0.9;
        }
        .btn-block {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-login btn-block">Entrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="cadastro.php" class="btn btn-register btn-block">Registre-se aqui</a>
        </div>
    </div>
</body>
</html>