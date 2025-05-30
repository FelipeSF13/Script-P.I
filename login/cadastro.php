<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="Formulario.css">
</head>
<body>
<div class="box">
    <form action="registrar.php" method="POST">
        <fieldset>
            <legend><b>Fórmulário de Clientes</b></legend>
            <br>
            <div class="inputBox">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <label for="nome" class="labelInput">Nome completo</label>
            </div>
            <br><br>
            <div class="inputBox">
                <input type="text" name="usuario" id="usuario" class="inputUser" required>
                <label for="usuario" class="labelInput">Usuário</label>
            </div>
            <br><br>
            <div class="inputBox">
                <input type="password" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelInput">Senha</label>
            </div>
            <br><br>
            <div class="inputBox">
                <input type="text" name="email" id="email" class="inputUser" required>
                <label for="email" class="labelInput">Email</label>
            </div>
            <br><br>
            <div class="inputBox">
                <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                <label for="telefone" class="labelInput">Telefone</label>
            </div>
            <p>Sexo:</p>
            <input type="radio" id="feminino" name="sexo" value="feminino" required>
            <label for="feminino">Feminino</label><br>
            <input type="radio" id="masculino" name="sexo" value="masculino" required>
            <label for="masculino">Masculino</label><br>
            <input type="radio" id="outro" name="sexo" value="outro" required>
            <label for="outro">Outro</label><br><br>
            <label for="data_nascimento"><b>Data de Nascimento:</b></label>
            <input type="date" name="data_nascimento" id="data_nascimento" required><br><br><br>
            <div class="inputBox">
                <input type="text" name="cidade" id="cidade" class="inputUser" required>
                <label for="cidade" class="labelInput">Cidade</label><br><br>
            </div>
            <input type="submit" value="Cadastrar" id="submit">
        </fieldset>
    </form>
</div>
</body>
</html>
