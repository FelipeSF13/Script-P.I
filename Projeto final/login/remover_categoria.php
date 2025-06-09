<?php
require 'conexao.php';

if (!empty($_POST['id_categoria'])) {
    $id = $_POST['id_categoria'];

    // Você pode checar se há produtos usando essa categoria antes de remover
    $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM produtos WHERE categoria_id = ?");
    $stmtCheck->execute([$id]);
    if ($stmtCheck->fetchColumn() == 0) {
        $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        // Não remove se ainda tem produtos associados (pode adaptar)
        echo "Categoria em uso, não pode ser removida.";
    }
}

header("Location: index.php");
exit();
