<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['sexo'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];

    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, nome, email, telefone, sexo, data_nascimento, cidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$usuario, $senha, $nome, $email, $telefone, $sexo, $data_nascimento, $cidade]);

    header("Location: login.php");
    exit();
}
?>
