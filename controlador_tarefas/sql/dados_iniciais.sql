-- dados_iniciais.sql

-- Usar o banco de dados
USE controlador_tarefas;

-- Inserir Categorias
INSERT INTO categorias (nome) VALUES 
('Esportes'),
('Marketing'),
('Limpeza');

-- Inserir Responsáveis
INSERT INTO responsaveis (nome) VALUES 
('Alice Santos'),
('Eduardo Romão'),
('Carlos França');

-- Inserir Tarefas
INSERT INTO tarefas (nome, categoria_id, responsavel_id) VALUES 
('Correr na esteira', 1, 1),
('Lançar campanha no instagram', 2, 2),
('Lavar as louças', 3, 3);
