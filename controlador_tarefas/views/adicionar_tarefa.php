<?php
require '../models/Conexao.php';
require '../models/Categoria.php';
require '../models/Responsavel.php';

$conexao = new Conexao();
$categoria = new Categoria($conexao);
$responsavel = new Responsavel($conexao);

// Listar categorias e responsáveis
$categorias = $categoria->listarCategorias();
$responsaveis = $responsavel->listarResponsaveis();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tarefa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center my-4">Adicionar Nova Tarefa</h1>
        <form method="POST" action="../controllers/tarefa.controller.php" class="bg-light p-4 rounded">
            <input type="hidden" name="acao" value="adicionar">
            
            <div class="form-group">
                <label for="nome">Nome da Tarefa:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Tarefa" required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoria:</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma Categoria</option>
                    <?php foreach ($categorias as $c) { ?>
                        <option value="<?= $c->id ?>"><?= htmlspecialchars($c->nome) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="responsavel_id">Responsável:</label>
                <select class="form-control" id="responsavel_id" name="responsavel_id" required>
                    <option value="">Selecione um Responsável</option>
                    <?php foreach ($responsaveis as $r) { ?>
                        <option value="<?= $r->id ?>"><?= htmlspecialchars($r->nome) ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success btn-block">Adicionar Tarefa</button>
        </form>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Voltar para a Página Principal</a>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
