<?php 
require '../models/Conexao.php';
require '../models/Categoria.php';

$conexao = new Conexao();
$categoria = new Categoria($conexao);

// Listar categorias
$categorias = $categoria->listarCategorias();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    
    <!-- Incluindo o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Gerenciar Categorias</h1>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $c) { ?>
                <tr>
                    <td><?= htmlspecialchars($c->nome) ?></td>
                    <td>
                        <form method="POST" action="../controllers/categoria.controller.php" style="display:inline;">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="id" value="<?= $c->id ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                        <a href="editar_categoria.php?id=<?= $c->id ?>" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <h4>Adicionar nova categoria</h4>
            <form method="POST" action="../controllers/categoria.controller.php" class="form-inline justify-content-center">
                <input type="hidden" name="acao" value="adicionar">
                <input type="text" name="nome" class="form-control mr-2" placeholder="Nome da Categoria" required>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </form>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Voltar para a Página Principal</a>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
