-- Script otimizado para importação direta no phpMyAdmin da hospedagem
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- 1. Tabela de Usuários
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','usuario') NOT NULL DEFAULT 'usuario',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabela de Animais
CREATE TABLE IF NOT EXISTS `animais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `raca` varchar(80) DEFAULT NULL,
  `sexo` enum('Macho','Fêmea') NOT NULL,
  `idade` varchar(50) DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Cadastrado',
  `descricao` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabela de Ocorrências (SOS)
CREATE TABLE IF NOT EXISTS `ocorrencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `tipo` enum('Perdido','Encontrado') NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `data_ocorrencia` date NOT NULL,
  `hora_ocorrencia` time DEFAULT NULL,
  `telefone_contato` varchar(30) DEFAULT NULL,
  `status_verificacao` enum('Pendente','Aprovada','Rejeitada') NOT NULL DEFAULT 'Pendente',
  `verificada_por` int(11) DEFAULT NULL,
  `verificada_em` datetime DEFAULT NULL,
  `motivo_rejeicao` text DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_ocorrencia_usuario` (`usuario_id`),
  KEY `fk_ocorrencia_animal` (`animal_id`),
  KEY `fk_ocorrencia_verificador` (`verificada_por`),
  CONSTRAINT `fk_ocorrencia_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ocorrencia_animal` FOREIGN KEY (`animal_id`) REFERENCES `animais` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ocorrencia_verificador` FOREIGN KEY (`verificada_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir Administrador Padrão (Login: admin@minhpatinha.com / Senha: admin123)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) 
VALUES (1, 'Administrador do Sistema', 'admin@minhpatinha.com', '$2y$10$4oOSq4x4nPWqDWvrOQabEeX43jPKAO3b38s1Y0Arp.tABepiVwETu', 'admin')
ON DUPLICATE KEY UPDATE `senha`='$2y$10$4oOSq4x4nPWqDWvrOQabEeX43jPKAO3b38s1Y0Arp.tABepiVwETu';

SET FOREIGN_KEY_CHECKS=1;
