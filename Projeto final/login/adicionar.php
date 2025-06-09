<?php
require 'conexao.php';

$id = $_POST['id'];
$nome = $_POST['produto'];
$descricao = $_POST['descricao'];
$categoria_id = $_POST['categoria_id'];
$preco = $_POST['preco'];
$estoque = $_POST['em_estoque'];

if (!empty($id)) {
    $sql = "UPDATE produtos SET produto = ?, descricao = ?, categoria_id = ?, preco = ?, em_estoque = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $categoria_id, $preco, $estoque, $id]);
} else {
    $sql = "INSERT INTO produtos (produto, descricao, categoria_id, preco, em_estoque) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $categoria_id, $preco, $estoque]);
}

header("Location: index.php");
exit();
