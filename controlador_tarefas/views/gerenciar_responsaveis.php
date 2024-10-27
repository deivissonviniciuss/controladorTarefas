<?php
require '../models/Conexao.php';
require '../models/Responsavel.php';

$conexao = new Conexao();
$responsavel = new Responsavel($conexao);

// Listar responsáveis
$responsaveis = $responsavel->listarResponsaveis();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Responsáveis</title>
    
    <!-- Incluindo o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Gerenciar Responsáveis</h1>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responsaveis as $r) { ?>
                <tr>
                    <td><?= htmlspecialchars($r->nome) ?></td>
                    <td>
                        <form method="POST" action="../controllers/responsavel.controller.php" style="display:inline;">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="id" value="<?= $r->id ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                        <a href="editar_responsavel.php?id=<?= $r->id ?>" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <h4>Adicionar novo responsável</h4>
            <form method="POST" action="../controllers/responsavel.controller.php" class="form-inline justify-content-center">
                <input type="hidden" name="acao" value="adicionar">
                <input type="text" name="nome" class="form-control mr-2" placeholder="Nome do Responsável" required>
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
