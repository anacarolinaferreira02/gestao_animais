-- Script de Criação das Tabelas - Sistema Minha Patinha
-- Obs: Selecione o seu banco de dados no phpMyAdmin antes de importar

-- 1. Tabela de Usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabela de Animais
CREATE TABLE IF NOT EXISTS animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(80) DEFAULT NULL,
    sexo ENUM('Macho', 'Fêmea') NOT NULL,
    idade VARCHAR(50) DEFAULT NULL,
    cor VARCHAR(50) DEFAULT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Cadastrado',
    descricao TEXT DEFAULT NULL,
    foto VARCHAR(255) DEFAULT NULL
);

-- 3. Tabela de Ocorrências (SOS)
CREATE TABLE IF NOT EXISTS ocorrencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    animal_id INT DEFAULT NULL,
    tipo ENUM('Perdido', 'Encontrado') NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    data_ocorrencia DATE NOT NULL,
    hora_ocorrencia TIME DEFAULT NULL,
    telefone_contato VARCHAR(30) DEFAULT NULL,
    status_verificacao ENUM('Pendente', 'Aprovada', 'Rejeitada') NOT NULL DEFAULT 'Pendente',
    verificada_por INT DEFAULT NULL,
    verificada_em DATETIME DEFAULT NULL,
    motivo_rejeicao TEXT DEFAULT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ocorrencia_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    CONSTRAINT fk_ocorrencia_animal FOREIGN KEY (animal_id) REFERENCES animais(id) ON DELETE SET NULL,
    CONSTRAINT fk_ocorrencia_verificador FOREIGN KEY (verificada_por) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Usuário Administrador de Teste Inicial (Senha: admin123)
-- Hash bcrypt gerado com password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO usuarios (id, nome, email, senha, tipo) 
VALUES (1, 'Administrador do Sistema', 'admin@minhpatinha.com', '$2y$10$4oOSq4x4nPWqDWvrOQabEeX43jPKAO3b38s1Y0Arp.tABepiVwETu', 'admin')
ON DUPLICATE KEY UPDATE senha='$2y$10$4oOSq4x4nPWqDWvrOQabEeX43jPKAO3b38s1Y0Arp.tABepiVwETu';
