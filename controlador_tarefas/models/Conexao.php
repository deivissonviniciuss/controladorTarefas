<?php
date_default_timezone_set('America/Sao_Paulo');

class Conexao {
    private $host = 'localhost';
    private $db = 'controlador_tarefas';
    private $user = 'root';
    private $pass = '';
    private $conn;

    public function conectar() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            return null;
        }
    }
}
?>

