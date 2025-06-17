<?php
session_start();
include 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conexao, $sql);
   
    if (mysqli_num_rows($resultado) > 0) {
        $erro = "O nome de usuário já está em uso!";
    } else {
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuario (usuario, email, senha) VALUES ('$usuario', '$email', '$senha_criptografada')";       
        if (mysqli_query($conexao, $sql_insert)) {
            header("Location: login.php?registrado=sucesso");
            exit();
        } else {
            $erro = "Erro ao registrar o usuário. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Loja de Eletrônicos</title>
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
        .cadastro-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .cadastro-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-register {
            background-color: mediumseagreen;
            border-color: mediumseagreen;
            color: white;
        }
        .btn-register:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro</h2>
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
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-register btn-block">Registrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Já tem uma conta? Faça login aqui.</a>
        </div>
    </div>
</body>
</html>