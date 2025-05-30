<?php
session_start();
include('conexao.php');

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$user = $stmt->fetch();

if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
} else {
    echo "Login inválido! <a href='login.php'>Tente novamente</a>";
}
?>
