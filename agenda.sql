/* 
UFLA        Universidade Federal de Lavras
DCC         Departamento de Ciência da Computação
Disciplina  GCC214 - Introdução a Sistemas de Banco de Dados
Professor   Denilson Alves Pereira

Trabalho de Introdução a Sistemas de Banco de Dados
Integrantes Aron
			Gabriel Jardim de Souza
            Kauê de Oliveira
            Paulo Henrique dos Anjos Silveira
            Thiago Ferreira
*/
-- CHECKPOINT A)
-- -----------------------------------------------------
-- Schema SuporteTech
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS SuporteTech DEFAULT CHARACTER SET utf8mb4;
USE SuporteTech;
-- -----------------------------------------------------
-- Table `SuporteTech`.`Pessoa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Pessoa` (
  `id_pessoa`   INT         NOT NULL AUTO_INCREMENT,
  `nome`        VARCHAR(50) NOT NULL,
  `CEP`         CHAR(8)     NOT NULL,
  `número`      INT(4)      NOT NULL,
  `logradouro`  VARCHAR(50) NOT NULL,
  `complemento` VARCHAR(30) NOT NULL,
  `cidade`      VARCHAR(30) NOT NULL,
  `bairro`      VARCHAR(30) NOT NULL,
  `estado`      CHAR(2)     NOT NULL,
  `ehCliente`   CHAR(1)     NOT NULL,
  PRIMARY KEY (`id_pessoa`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SuporteTech`.`telefone`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`telefone` (
  `id_pessoa` INT      NOT NULL,
  `telefone`  CHAR(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`, `telefone`),
  INDEX `fk_telefone_Pessoa1_idx` (`id_pessoa` ASC) ,
  CONSTRAINT `fk_telefone_Pessoa1` FOREIGN KEY (`id_pessoa`)
    REFERENCES `SuporteTech`.`Pessoa` (`id_pessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SuporteTech`.`Física`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Física` (
  `id_pessoa` INT      NOT NULL,
  `cpf`       CHAR(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  INDEX `fk_Física_Pessoa1_idx` (`id_pessoa` ASC) ,
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC) ,
  CONSTRAINT `fk_Física_Pessoa1` FOREIGN KEY (`id_pessoa`)
    REFERENCES `SuporteTech`.`Pessoa` (`id_pessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SuporteTech`.`Jurídica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Jurídica` (
  `id_pessoa` INT      NOT NULL,
  `cnpj`      CHAR(14) NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  INDEX `fk_Jurídica_Pessoa1_idx` (`id_pessoa` ASC) ,
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) ,
  CONSTRAINT `fk_Jurídica_Pessoa1` FOREIGN KEY (`id_pessoa`)
    REFERENCES `SuporteTech`.`Pessoa` (`id_pessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `SuporteTech`.`Funcionário`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Funcionário` (
  `id_pessoa`       INT           NOT NULL,
  `codFunc`         INT(8)        NOT NULL,
  `e-mail`          VARCHAR(30)   NOT NULL,
  `dataContratação` DATE          NOT NULL,
  `salário`         DECIMAL(10,2) NOT NULL,
  `TipoFunc`        VARCHAR(3)    NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  INDEX `fk_Funcionário_Física1_idx` (`id_pessoa` ASC) ,
  UNIQUE INDEX `codFunc_UNIQUE` (`codFunc` ASC) ,
  CONSTRAINT `fk_Funcionário_Física1` FOREIGN KEY (`id_pessoa`)
    REFERENCES `SuporteTech`.`Física` (`id_pessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SuporteTech`.`Atendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Atendimento` (
  `codAtendimento`       INT(8)       NOT NULL,
  `descrição`            VARCHAR(255) NOT NULL,
  `valor`                REAL(8,2)    NOT NULL,
  `dataAtendimento`      DATE         NOT NULL,
  `statusAtendimento`    VARCHAR(13)  NULL DEFAULT 'Não Concluído',
  `dataTérmino`          DATE         NULL,
  `garantia`             DATE         NULL,
  `id_pessoa_cliente`    INT          NOT NULL,
  `id_pessoa_secretaria` INT          NOT NULL,
  `id_pessoa_supervisor` INT          NOT NULL,
  PRIMARY KEY (`codAtendimento`),
  INDEX `fk_Atendimento_Pessoa1_idx` (`id_pessoa_cliente` ASC) ,
  INDEX `fk_Atendimento_Funcionário1_idx` (`id_pessoa_secretaria` ASC) ,
  INDEX `fk_Atendimento_Funcionário2_idx` (`id_pessoa_supervisor` ASC) ,
  CONSTRAINT `fk_Atendimento_Pessoa1` FOREIGN KEY (`id_pessoa_cliente`)
    REFERENCES `SuporteTech`.`Pessoa` (`id_pessoa`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_Atendimento_Funcionário1` FOREIGN KEY (`id_pessoa_secretaria`)
    REFERENCES `SuporteTech`.`Funcionário` (`id_pessoa`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_Atendimento_Funcionário2` FOREIGN KEY (`id_pessoa_supervisor`)
    REFERENCES `SuporteTech`.`Funcionário` (`id_pessoa`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SuporteTech`.`Peça`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`Peça` (
  `idPeça`        INT(8)       NOT NULL,
  `nome`          VARCHAR(100) NOT NULL,
  `tipo`          VARCHAR(50)  NOT NULL,
  `qtdDisponivel` INT(4)       NOT NULL,
  PRIMARY KEY (`idPeça`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SuporteTech`.`equipamentoCliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`equipamentoCliente` (
  `codEquip`   INT(8)       NOT NULL,
  `descrição`  VARCHAR(255) NOT NULL,
  `dataCompra` DATE         NOT NULL,
  `tipo`       VARCHAR(50)  NOT NULL,
  `id_pessoa`  INT          NOT NULL,
  PRIMARY KEY (`codEquip`),
  INDEX `fk_equipamentoCliente_Pessoa1_idx` (`id_pessoa` ASC) ,
  CONSTRAINT `fk_equipamentoCliente_Pessoa1` FOREIGN KEY (`id_pessoa`)
    REFERENCES `SuporteTech`.`Pessoa` (`id_pessoa`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SuporteTech`.`utiliza`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SuporteTech`.`utiliza` (
  `codEquip`          INT(8) NOT NULL,
  `codAtendimento`    INT(8) NOT NULL,
  `idPeça`            INT(8) NOT NULL,
  `id_pessoa_tecnico` INT NOT NULL,
  PRIMARY KEY (`codEquip`, `codAtendimento`, `idPeça`, `id_pessoa_tecnico`),
  INDEX `fk_equipamentoCliente_has_Atendimento_Atendimento1_idx` (`codAtendimento` ASC) ,
  INDEX `fk_equipamentoCliente_has_Atendimento_equipamentoCliente1_idx` (`codEquip` ASC) ,
  INDEX `fk_utiliza_Peça1_idx` (`idPeça` ASC) ,
  INDEX `fk_utiliza_Funcionário1_idx` (`id_pessoa_tecnico` ASC) ,
  CONSTRAINT `fk_equipamentoCliente_has_Atendimento_equipamentoCliente1` FOREIGN KEY (`codEquip`)
    REFERENCES `SuporteTech`.`equipamentoCliente` (`codEquip`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_equipamentoCliente_has_Atendimento_Atendimento1` FOREIGN KEY (`codAtendimento`)
    REFERENCES `SuporteTech`.`Atendimento` (`codAtendimento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_utiliza_Peça1` FOREIGN KEY (`idPeça`)
    REFERENCES `SuporteTech`.`Peça` (`idPeça`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_utiliza_Funcionário1` FOREIGN KEY (`id_pessoa_tecnico`)
    REFERENCES `SuporteTech`.`Funcionário` (`id_pessoa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;
