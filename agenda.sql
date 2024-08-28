CREATE DATABASE  IF NOT EXISTS `SuporteTech`;
USE `SuporteTech`;

CREATE TABLE `Peca` (
  `idPeca` int NOT NULL auto_increment,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `qtdDisponivel` int NOT NULL,
  PRIMARY KEY (`idPeca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `Peca` WRITE;

UNLOCK TABLES;

