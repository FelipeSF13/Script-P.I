<?php
require 'conexao.php';

if (!empty($_POST['nome_categoria'])) {
    $nome = trim($_POST['nome_categoria']);
    $stmt = $pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
    $stmt->execute([$nome]);
}

header("Location: index.php");
exit();
