<?php
session_start();
$carrinho = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Loja de Eletrônicos</a>
  <div class="ml-auto">
    <a href="index.php" class="btn btn-outline-light mr-3">Continuar comprando</a>
    <a href="logout.php" class="btn btn-outline-light">Sair</a>
  </div>
</nav>
<div class="container mt-5">
    <h2>Carrinho de Compras</h2>
    <?php if (count($carrinho) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrinho as $item): 
                    $subtotal = $item['preco'] * $item['quantidade'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>" style="width: 50px; height: 50px;">
                            <?php echo $item['nome']; ?>
                        </td>
                        <td><?php echo $item['quantidade']; ?></td>
                        <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                        <td>
                            <a href="remover_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h4>
        <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
        <a href="index.php" class="btn btn-primary">Voltar às Compras</a>
    <?php endif; ?>
</div>
</body>
</html>