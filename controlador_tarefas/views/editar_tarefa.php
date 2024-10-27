<?php
require_once '../models/Tarefa.php';
require_once '../models/Conexao.php';

// Obter ID da tarefa via GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('Location: index.php?erro=semid');
    exit();
}

// Conectar ao banco e buscar a tarefa
$conexao = new Conexao();
$tarefa = new Tarefa($conexao);

// Se o formulário for enviado, processar a edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $categoria_id = $_POST['categoria_id'];
    $responsavel_id = $_POST['responsavel_id'];
    $status = $_POST['status'];

    $tarefa->editarTarefa($id, $nome, $categoria_id, $responsavel_id, $status);

    // Redirecionar após editar
    header('Location: index.php?sucesso=editado');
    exit();
}

// Buscar tarefa específica
$tarefa_atual = $tarefa->buscarTarefaPorId($id);

// Obter lista de categorias e responsáveis (se necessário)
$categorias = $tarefa->listarCategorias();
$responsaveis = $tarefa->listarResponsaveis();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h2>Editar Tarefa</h2>

        <!-- Formulário para edição -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome da Tarefa</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $tarefa_atual->nome ?>" required>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria->id ?>" <?= ($categoria->id == $tarefa_atual->categoria_id) ? 'selected' : '' ?>>
                            <?= $categoria->nome ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="responsavel_id">Responsável</label>
                <select name="responsavel_id" id="responsavel_id" class="form-control" required>
                    <?php foreach ($responsaveis as $responsavel): ?>
                        <option value="<?= $responsavel->id ?>" <?= ($responsavel->id == $tarefa_atual->responsavel_id) ? 'selected' : '' ?>>
                            <?= $responsavel->nome ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
