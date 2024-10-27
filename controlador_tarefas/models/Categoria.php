<?php
class Categoria {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->conectar();
    }

    // Listar categorias
    public function listarCategorias() {
        $query = 'SELECT * FROM categorias';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Adicionar categoria
    public function adicionarCategoria($nome) {
        $query = 'INSERT INTO categorias (nome) VALUES (:nome)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
    }

    // Editar categoria
    public function editarCategoria($id, $nome) {
        $query = 'UPDATE categorias SET nome = :nome WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Excluir categoria
    public function excluirCategoria($id) {
        $query = 'DELETE FROM categorias WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Buscar categoria por ID
    public function buscarCategoriaPorId($id) {
        $query = 'SELECT * FROM categorias WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
?>