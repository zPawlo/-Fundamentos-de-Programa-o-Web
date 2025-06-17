<?php
session_start();
if (isset($_POST['id_produto']) && isset($_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    $_SESSION['carrinho'][$id_produto] = [
        'quantidade' => $quantidade
    ];
}
header("Location: carrinho.php");
exit();
?>