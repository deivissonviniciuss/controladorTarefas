<?php
class Responsavel {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->conectar();
    }

    // Listar responsáveis
    public function listarResponsaveis() {
        $query = 'SELECT * FROM responsaveis';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Adicionar responsável
    public function adicionarResponsavel($nome) {
        $query = 'INSERT INTO responsaveis (nome) VALUES (:nome)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
    }

    // Editar responsável
    public function editarResponsavel($id, $nome) {
        $query = 'UPDATE responsaveis SET nome = :nome WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Excluir responsável
    public function excluirResponsavel($id) {
        $query = 'DELETE FROM responsaveis WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Buscar categoria por ID
    public function buscarResponsavelPorId($id) {
        $query = 'SELECT * FROM responsaveis WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}
?>