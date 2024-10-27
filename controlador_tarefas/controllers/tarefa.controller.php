<?php
require '../models/Conexao.php';
require '../models/Tarefa.php';
require '../models/Categoria.php';
require '../models/Responsavel.php';

$conexao = new Conexao();
$tarefa = new Tarefa($conexao);
$categoria = new Categoria($conexao);
$responsavel = new Responsavel($conexao);

// Verificar qual ação foi solicitada
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch ($acao) {
    case 'adicionar':
        // Adicionar nova tarefa, verificando se os dados estão presentes
        if (isset($_POST['nome'], $_POST['categoria_id'], $_POST['responsavel_id'])) {
            $nome = $_POST['nome'];
            $categoria_id = $_POST['categoria_id'];
            $responsavel_id = $_POST['responsavel_id'];
            $tarefa->adicionarTarefa($nome, $categoria_id, $responsavel_id);
        }
        header("Location: ../views/index.php");
        break;

    case 'editar':
        // Editar tarefa, verificando se os dados estão presentes
        if (isset($_POST['id'], $_POST['novo_nome'])) {
            $id = $_POST['id'];
            $novo_nome = $_POST['novo_nome'];
            $tarefa->editarTarefa($id, $novo_nome);
        }
        header("Location: ../views/index.php");
        break;

    case 'excluir':
        // Excluir tarefa, verificando se o id foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $tarefa->excluirTarefa($id);
        }
        header("Location: ../views/index.php");
        break;

    case 'iniciar':
        // Iniciar tarefa, verificando se o id foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $tarefa->iniciarTarefa($id);
        }
        header("Location: ../views/index.php");
        break;

    case 'pausar':
        // Pausar tarefa, verificando se o id foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $tarefa->pausarTarefa($id);
        }
        header("Location: ../views/index.php");
        break;

    case 'retomar':
        // Retomar tarefa, verificando se o id foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $tarefa->retomarTarefa($id);
        }
        header("Location: ../views/index.php");
        break;

    case 'finalizar':
        // Finalizar tarefa, verificando se o id foi enviado
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $tarefa->finalizarTarefa($id);
        }
        header("Location: ../views/index.php");
        break;

    default:
        // Redirecionar se nenhuma ação for válida
        header("Location: ../views/index.php");
        break;
}
?>
