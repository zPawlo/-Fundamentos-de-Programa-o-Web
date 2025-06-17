<?php
include 'conexao.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$id = $_GET['id'];
$sql = "DELETE FROM produtos WHERE id = $id";
if (mysqli_query($conexao, $sql)) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir produto: " . mysqli_error($conexao);
}
?>