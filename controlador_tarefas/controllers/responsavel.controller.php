<?php
require '../models/Conexao.php';
require '../models/Responsavel.php';

$conexao = new Conexao();
$responsavel = new Responsavel($conexao);

// Verifica se a ação é para excluir um responsável
if (isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
    $id = $_POST['id'];

    try {
        $responsavel->excluirResponsavel($id);
        // Redirecionar para a página de gerenciamento de responsáveis
        header('Location: ../views/gerenciar_responsaveis.php?msg=Responsável excluído com sucesso');
        exit;
    } catch (Exception $e) {
        // Exibir uma mensagem de erro
        echo '<script>alert("' . addslashes($e->getMessage()) . '");</script>';
        // Redirecionar de volta para a página de gerenciamento de responsáveis
        header('Location: ../views/gerenciar_responsaveis.php');
        exit;
    }
}


// Verificar qual ação foi solicitada
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch ($acao) {
    case 'adicionar':
        // Adicionar novo responsável
        $nome = $_POST['nome'];
        $responsavel->adicionarResponsavel($nome);
        header("Location: ../views/gerenciar_responsaveis.php");
        break;

    case 'editar':
        // Editar responsável
        $id = $_POST['id'];
        $novo_nome = $_POST['novo_nome'];
        $responsavel->editarResponsavel($id, $novo_nome);
        header("Location: ../views/gerenciar_responsaveis.php");
        break;

    case 'excluir':
        // Excluir responsável
        $id = $_POST['id'];
        $responsavel->excluirResponsavel($id);
        header("Location: ../views/gerenciar_responsaveis.php");
        break;

    default:
        // Redirecionar se nenhuma ação for válida
        header("Location: ../views/gerenciar_responsaveis.php");
        break;
}
?>

