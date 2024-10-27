-- criar_banco.sql

-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS controlador_tarefas;

-- Usa o banco de dados
USE controlador_tarefas;

-- Criar tabela de Responsáveis
CREATE TABLE IF NOT EXISTS responsaveis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Criar tabela de Categorias
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Criar tabela de Tarefas
CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria_id INT,
    responsavel_id INT,
    status ENUM('pendente', 'iniciada', 'pausada', 'finalizada') DEFAULT 'pendente',
    tempo_acumulado INT DEFAULT 0, -- Tempo acumulado em segundos
    inicio DATETIME,
    pausa DATETIME,
    finalizacao DATETIME,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE,
    FOREIGN KEY (responsavel_id) REFERENCES responsaveis(id) ON DELETE CASCADE 
);
