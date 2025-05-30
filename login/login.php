<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <h1>Login</h1>
    <form action="verifica_login.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <a href="cadastro.php" class="botao">Não possui login? Clique aqui!</a>
</div>
</body>
</html>
