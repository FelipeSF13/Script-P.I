<?php
require 'conexao.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll();
$produtos = $pdo->query("SELECT p.*, c.nome AS categoria_nome 
                         FROM produtos p 
                         LEFT JOIN categorias c ON p.categoria_id = c.id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Produtos</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function editarProduto(id, nome, descricao, categoria_id, preco, estoque) {
            document.getElementById('id').value = id;
            document.querySelector('input[name="produto"]').value = nome;
            document.querySelector('textarea[name="descricao"]').value = descricao;
            document.querySelector('select[name="categoria_id"]').value = categoria_id;
            document.querySelector('input[name="preco"]').value = preco;
            document.querySelector('input[name="em_estoque"]').value = estoque;

            document.querySelector('.btn-add').style.display = 'none';
            document.querySelector('.btn-update').style.display = 'inline-block';
            document.querySelector('.cancelar-edicao').style.display = 'inline-block';
        }

        function cancelarEdicao() {
            document.getElementById('id').value = '';
            document.querySelector('form').reset();
            document.querySelector('.btn-add').style.display = 'inline-block';
            document.querySelector('.btn-update').style.display = 'none';
            document.querySelector('.cancelar-edicao').style.display = 'none';
        }
    </script>
</head>
<body>
    <div class="container">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Joalheria</h2>
            <nav>
                <ul>
                    <li class="active">Produtos</a></li>
                </ul>
            </nav>
            <ul class="bottom-links">
                <li><?= $_SESSION['usuario'] ?></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </div>

        <!-- Conteúdo principal -->
        <div class="main">
            <!-- Topo -->
            <div class="topbar">
                <div>
                    <span>Painel &gt; Produtos</span>
                    <h1>Todos os Produtos</h1>
                </div>
                <input type="text" placeholder="Pesquisar...">
            </div>

<!-- Container flexível para formulário de produto e categorias lado a lado -->
<div class="form-wrapper">
    <!-- Formulário de produtos -->
    <form action="adicionar.php" method="POST" class="form">
        <input type="hidden" name="id" id="id">
        <input type="text" name="produto" placeholder="Nome do Produto" required>
        <textarea name="descricao" placeholder="Descrição"></textarea>
        <select name="categoria_id" required>
            <option value="">Selecione uma Categoria</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="preco" placeholder="Preço" step="0.01" required>
        <input type="number" name="em_estoque" placeholder="Estoque" required>

        <div>
            <button type="submit" class="btn btn-add">Adicionar Produto</button>
            <button type="submit" class="btn btn-update" name="editar" style="display: none;">Atualizar Produto</button>
            <button type="button" class="btn cancelar-edicao" onclick="cancelarEdicao()" style="display: none;">Cancelar</button>
        </div>
    </form>

    <!-- Seção de Gerenciar Categorias -->
    <div class="categorias-box">
        <h2>Categorias</h2>

        <!-- Formulário para adicionar -->
        <form action="adicionar_categoria.php" method="POST" style="margin-bottom: 10px;">
            <input type="text" name="nome_categoria" placeholder="Nova Categoria" required>
            <button type="submit" class="btn">Adicionar Categoria</button>
        </form>

        <!-- Lista de categorias existentes com botão de remover -->
        <ul>
            <?php foreach ($categorias as $cat): ?>
                <li style="margin-bottom: 5px;">
                    <?= htmlspecialchars($cat['nome']) ?>
                    <form action="remover_categoria.php" method="POST" style="display:inline;" onsubmit="return confirm('Remover categoria \"<?= $cat['nome'] ?>\"?');">
                        <input type="hidden" name="id_categoria" value="<?= $cat['id'] ?>">
                        <button type="submit" class="btn-remover" style="font-size: 12px;">Remover</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


            <!-- Tabela de Produtos -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= $produto['id'] ?></td>
                            <td><?= $produto['produto'] ?></td>
                            <td><?= $produto['categoria_nome'] ?></td>
                            <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                            <td><?= $produto['em_estoque'] ?></td>
                            <td>
                                <form action="remover.php" method="POST" onsubmit="return confirm('Deseja remover?')">
                                    <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                                    <button class="btn-remover">Remover</button>
                                </form>
                                <button type="button"
                                    onclick="editarProduto(
                                        '<?= $produto['id'] ?>',
                                        '<?= htmlspecialchars($produto['produto'], ENT_QUOTES) ?>',
                                        '<?= htmlspecialchars($produto['descricao'], ENT_QUOTES) ?>',
                                        '<?= $produto['categoria_id'] ?>',
                                        '<?= $produto['preco'] ?>',
                                        '<?= $produto['em_estoque'] ?>'
                                    )"
                                    class="btn-editar">Editar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
