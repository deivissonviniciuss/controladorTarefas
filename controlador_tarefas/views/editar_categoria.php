<?php
require_once '../models/Categoria.php';
require_once '../models/Conexao.php';

// Obter ID da categoria via GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('Location: index.php?erro=semid');
    exit();
}

// Conectar ao banco e buscar a categoria
$conexao = new Conexao();
$categoria = new Categoria($conexao);

// Se o formulário for enviado, processar a edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];

    $categoria->editarCategoria($id, $nome);

    // Redirecionar após editar
    header('Location: index.php?sucesso=editadocat');
    exit();
}

// Buscar categoria específica
$categoria_atual = $categoria->buscarCategoriaPorId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h2>Editar Categoria</h2>

        <!-- Formulário para edição -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $categoria_atual->nome ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
