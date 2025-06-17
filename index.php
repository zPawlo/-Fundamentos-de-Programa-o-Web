<?php
session_start();
include 'conexao.php';
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Eletrônicos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Loja de Eletrônicos</a>
  <div class="ml-auto">
    <a href="carrinho.php" class="btn btn-outline-light mr-3">Carrinho</a>
    <a href="logout.php" class="btn btn-outline-light">Sair</a>
  </div>
</nav>
<div class="container mt-5">
    <div class="row">
        <?php while ($produto = mysqli_fetch_assoc($resultado)): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="<?php echo $produto['imagem']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                    <p class="card-text"><?php echo $produto['descricao']; ?></p>
                    <p class="card-text">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    <form action="adicionar_carrinho.php" method="post" class="d-flex align-items-center">
    <input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
    <div class="form-group mb-0">
        <label for="quantidade" class="sr-only">Quantidade</label>
        <input type="number" name="quantidade" class="form-control text-center" value="1" min="1" style="width: 50px; height: 38px;">
    </div>
    <button type="submit" class="btn btn-primary ml-2" style="height: 38px; width: 300px;">Adicionar ao carrinho</button>
</form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>