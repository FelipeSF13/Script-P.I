<?php
require 'conexao.php';
$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit();
?>
