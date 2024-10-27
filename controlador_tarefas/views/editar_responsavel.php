<?php
require_once '../models/Responsavel.php';
require_once '../models/Conexao.php';

// Obter ID do responsável via GET
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    header('Location: index.php?erro=semid');
    exit();
}

// Conectar ao banco e buscar o responsável
$conexao = new Conexao();
$responsavel = new Responsavel($conexao);

// Se o formulário for enviado, processar a edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];

    $responsavel->editarResponsavel($id, $nome);

    // Redirecionar após editar
    header('Location: index.php?sucesso=editadoresp');
    exit();
}

// Buscar responsável específico
$responsavel_atual = $responsavel->buscarResponsavelPorId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Responsável</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h2>Editar Responsável</h2>

        <!-- Formulário para edição -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Responsável</label>
                <input type="text" name="nome" id="nome" class="form-control" value="<?= $responsavel_atual->nome ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
