<?php
session_start();
include 'conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $sql = "SELECT * FROM produtos WHERE id = $produto_id";
    $resultado = mysqli_query($conexao, $sql);
    $produto = mysqli_fetch_assoc($resultado);
    if ($produto) {
        $item_carrinho = [
            'id' => $produto['id'],
            'nome' => $produto['nome'],
            'preco' => $produto['preco'],
            'quantidade' => $quantidade,
            'imagem' => $produto['imagem']
        ];
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
        $produto_existe = false;
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $produto_id) {
                $item['quantidade'] += $quantidade;
                break;
            }
        }
        if (!$produto_existe) {
            $_SESSION['carrinho'][] = $item_carrinho;
        }
        header('Location: index.php?adicionado=sucesso');
        exit();
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "Método de requisição inválido.";
}