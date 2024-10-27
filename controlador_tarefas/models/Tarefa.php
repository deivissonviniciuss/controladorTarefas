<?php
class Tarefa {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->conectar();
    }

    // Listar tarefas
    public function listarTarefas() {
        $query = 'SELECT t.id, t.nome, c.nome AS categoria, r.nome AS responsavel, t.status, 
                         SEC_TO_TIME(t.tempo_acumulado) AS tempo_total
                  FROM tarefas AS t INNER JOIN categorias AS c 
                  ON (t.categoria_id = c.id) INNER JOIN responsaveis AS r 
                  ON (t.responsavel_id = r.id)';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Adicionar tarefa
    public function adicionarTarefa($nome, $categoria_id, $responsavel_id) {
        $query = 'INSERT INTO tarefas (nome, categoria_id, responsavel_id, tempo_acumulado)
                  VALUES (:nome, :categoria_id, :responsavel_id, 0)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':categoria_id', $categoria_id);
        $stmt->bindValue(':responsavel_id', $responsavel_id);
        $stmt->execute();
    }

    // Iniciar tarefa
    public function iniciarTarefa($id) {
        $tempoInicio = date('Y-m-d H:i:s'); // Hora atual
        $sql = "UPDATE tarefas SET status = 'iniciada', inicio = '$tempoInicio', pausa = NULL WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$id]);
    }

    // Pausar tarefa
    public function pausarTarefa($id) {
        $query = 'SELECT inicio, tempo_acumulado FROM tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $tarefa = $stmt->fetch(PDO::FETCH_OBJ);

        // Calcular o tempo gasto desde o início até agora
        $tempo_gasto = time() - strtotime($tarefa->inicio); // Tempo desde o início

        // Somar o tempo gasto ao tempo acumulado
        $tempo_acumulado = $tarefa->tempo_acumulado + $tempo_gasto;

        // Atualizar o status da tarefa para "pausada" e registrar o tempo acumulado
        $query = 'UPDATE tarefas SET status = "pausada", pausa = NOW(), tempo_acumulado = :tempo_acumulado WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tempo_acumulado', $tempo_acumulado);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Retomar tarefa
    public function retomarTarefa($id) {
        // Atualizar o status da tarefa para "iniciada" e limpar a pausa
        $query = 'UPDATE tarefas SET status = "iniciada", inicio = NOW(), pausa = NULL WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Finalizar tarefa
    public function finalizarTarefa($id) {
        $query = 'SELECT inicio, tempo_acumulado, status FROM tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $tarefa = $stmt->fetch(PDO::FETCH_OBJ);

        // Calcular o tempo gasto desde o último início até agora
        $tempo_gasto = strtotime('now') - strtotime($tarefa->inicio);

        $tempo_acumulado = $tarefa->tempo_acumulado + $tempo_gasto;

        // Atualizar a tarefa para "finalizada" com o tempo total de execução
        $query = 'UPDATE tarefas SET status = "finalizada", finalizacao = NOW(), tempo_acumulado = :tempo_acumulado WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tempo_acumulado', $tempo_acumulado);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Excluir tarefa
    public function excluirTarefa($id) {
        $query = 'DELETE FROM tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Editar tarefa
    public function editarTarefa($id, $nome, $categoria_id, $responsavel_id, $status) {
        $query = 'UPDATE tarefas 
                  SET nome = :nome, categoria_id = :categoria_id, responsavel_id = :responsavel_id, status = :status 
                  WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':categoria_id', $categoria_id);
        $stmt->bindValue(':responsavel_id', $responsavel_id);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    //Buscar tarefa por ID
    public function buscarTarefaPorId($id) {
        $query = 'SELECT * FROM tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Listar categorias
    public function listarCategorias() {
        $query = 'SELECT * FROM categorias';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Listar responsáveis
    public function listarResponsaveis() {
        $query = 'SELECT * FROM responsaveis';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>

