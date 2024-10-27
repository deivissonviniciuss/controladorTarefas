<?php<?php  
// Incluindo os arquivos de conexão e modelos necessários
require '../models/Conexao.php'; 
require '../models/Tarefa.php';   
require '../models/Categoria.php';  
require '../models/Responsavel.php'; 

// Criação de instâncias das classes para uso posterior
$conexao = new Conexao(); 
$tarefa = new Tarefa($conexao); 
$categoria = new Categoria($conexao); 
$responsavel = new Responsavel($conexao); 

// Listar tarefas usando o método da classe Tarefa
$tarefas = $tarefa->listarTarefas(); // Chama o método para obter a lista de tarefas
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controlador de Tarefas</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"><!--Bootstrap CSS -->
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Lista de Tarefas</h1>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Tarefa</th>
                    <th>Categoria</th>
                    <th>Responsável</th>
                    <th>Status</th>
                    <th>Tempo Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tarefas as $t) { ?> <!-- Loop para listar cada tarefa -->
                <tr>
                    <td><?= htmlspecialchars($t->nome) ?></td> 
                    <td><?= htmlspecialchars($t->categoria) ?></td> 
                    <td><?= htmlspecialchars($t->responsavel) ?></td> 
                    <td><?= htmlspecialchars($t->status) ?></td> 
                    <td><?= htmlspecialchars($t->tempo_total) ?></td> 
                    <td> <!-- Coluna de ações -->
                        <form method="POST" action="../controllers/tarefa.controller.php" style="display:inline;"> <!-- Formulário para exclusão -->
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="id" value="<?= $t->id ?>"> <!-- ID da tarefa a ser excluída -->
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                        <a href="editar_tarefa.php?id=<?= $t->id ?>" class="btn btn-primary btn-sm">Editar</a> 
                        <?php if ($t->status === 'pendente') { ?>
                            <form method="POST" action="../controllers/tarefa.controller.php" style="display:inline;"> <!-- Formulário para iniciar a tarefa -->
                                <input type="hidden" name="acao" value="iniciar">
                                <input type="hidden" name="id" value="<?= $t->id ?>"> <!-- ID da tarefa a ser iniciada -->
                                <button type="submit" class="btn btn-success btn-sm">Iniciar</button>
                            </form>
                        <?php } elseif ($t->status === 'iniciada') { ?> 
                            <form method="POST" action="../controllers/tarefa.controller.php" style="display:inline;"> <!-- Formulário para pausar a tarefa -->
                                <input type="hidden" name="acao" value="pausar">
                                <input type="hidden" name="id" value="<?= $t->id ?>"> <!-- ID da tarefa a ser pausada -->
                                <button type="submit" class="btn btn-warning btn-sm">Pausar</button>
                            </form>
                            <form method="POST" action="../controllers/tarefa.controller.php" style="display:inline;"> <!-- Formulário para finalizar a tarefa -->
                                <input type="hidden" name="acao" value="finalizar">
                                <input type="hidden" name="id" value="<?= $t->id ?>"> <!-- ID da tarefa a ser finalizada -->
                                <button type="submit" class="btn btn-danger btn-sm">Finalizar</button>
                            </form>
                        <?php } elseif ($t->status === 'pausada') { ?> 
                            <form method="POST" action="../controllers/tarefa.controller.php" style="display:inline;"> <!-- Formulário para retomar a tarefa -->
                                <input type="hidden" name="acao" value="retomar">
                                <input type="hidden" name="id" value="<?= $t->id ?>"> <!-- ID da tarefa a ser retomada -->
                                <button type="submit" class="btn btn-success btn-sm">Retomar</button>
                            </form>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center"> <!-- Botões para adicionar nova tarefa e gerenciar categorias e responsáveis -->
            <a href="adicionar_tarefa.php" class="btn btn-primary">Adicionar Nova Tarefa</a>
            <a href="gerenciar_categorias.php" class="btn btn-secondary">Gerenciar Categorias</a>
            <a href="gerenciar_responsaveis.php" class="btn btn-secondary">Gerenciar Responsáveis</a>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
