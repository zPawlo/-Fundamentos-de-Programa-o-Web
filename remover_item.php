<?php
session_start();
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];
    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $index => $item) {
            if ($item['id'] == $produto_id) {
                unset($_SESSION['carrinho'][$index]);
                break;
            }
        }
    }
}
header('Location: carrinho.php');
exit();