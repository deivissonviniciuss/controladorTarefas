<?php
require '../models/Conexao.php';
require '../models/Categoria.php';

$conexao = new Conexao();
$categoria = new Categoria($conexao);

// Verifica se a ação é para excluir uma categoria
if (isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
    $id = $_POST['id'];

    try {
        $categoria->excluirCategoria($id);
        // Redirecionar para a página de gerenciamento de categorias
        header('Location: ../views/gerenciar_categorias.php?msg=Categoria excluída com sucesso');
        exit;
    } catch (Exception $e) {
        // Exibir uma mensagem de erro
        echo '<script>alert("' . addslashes($e->getMessage()) . '");</script>';
        // Redirecionar de volta para a página de gerenciamento de categorias
        header('Location: ../views/gerenciar_categorias.php');
        exit;
    }
}

// Verificar qual ação foi solicitada
$acao = isset($_POST['acao']) ? $_POST['acao'] : '';

switch ($acao) {
    case 'adicionar':
        // Adicionar nova categoria
        $nome = $_POST['nome'];
        $categoria->adicionarCategoria($nome);
        header("Location: ../views/index.php");
        break;

    case 'editar':
        // Editar categoria
        $id = $_POST['id'];
        $novo_nome = $_POST['novo_nome'];
        $categoria->editarCategoria($id, $novo_nome);
        header("Location: ../views/index.php");
        break;

    case 'excluir':
        // Excluir categoria
        $id = $_POST['id'];
        $categoria->excluirCategoria($id);
        header("Location: ../views/index.php");
        break;

    default:
        // Redirecionar se nenhuma ação for válida
        header("Location: ../views/index.php");
        break;
}
?>
