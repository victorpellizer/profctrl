CREATE TABLE IF NOT EXISTS `profctrl`.`Pais` (
  `idPais` INT(11) NOT NULL AUTO_INCREMENT,
  `nomePais` VARCHAR(60) NULL DEFAULT NULL,
  `siglaPais` VARCHAR(10) NULL DEFAULT NULL,
  PRIMARY KEY (`idPais`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Estado` (
  `idEstado` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeEstado` VARCHAR(75) NULL DEFAULT NULL,
  `uf` VARCHAR(5) NULL DEFAULT NULL,
  `Pais_idPais` INT(11) NOT NULL,
  PRIMARY KEY (`idEstado`),
  INDEX `fk_Estado_Pais1_idx` (`Pais_idPais` ASC) VISIBLE,
  CONSTRAINT `fk_Estado_Pais1`
    FOREIGN KEY (`Pais_idPais`)
    REFERENCES `profctrl`.`Pais` (`idPais`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Cidade` (
  `idCidade` INT(32) NOT NULL AUTO_INCREMENT,
  `nomeCidade` VARCHAR(50) NOT NULL,
  `Estado_idEstado` INT NOT NULL,
  PRIMARY KEY (`idCidade`),
  INDEX `fk_Cidade_Estado1_idx` (`Estado_idEstado` ASC) VISIBLE,
  CONSTRAINT `fk_Cidade_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `profctrl`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Classe` (
  `idClasse` INT(3) NOT NULL,
  `classe` INT(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idClasse`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Funcao` (
  `idFuncao` INT(4) NOT NULL,
  `funcao` VARCHAR(40) NULL,
  PRIMARY KEY (`idFuncao`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Instituicao` (
  `idInstituicao` INT(32) NOT NULL AUTO_INCREMENT,
  `contatoInstituicao` VARCHAR(80) NULL,
  `nomeInstituicao` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idInstituicao`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Licenca` (
  `idLicenca` INT(32) NOT NULL,
  `tipoLicenca` VARCHAR(50) NOT NULL,
  `licencaRemunerada` VARCHAR(4) NULL,
  PRIMARY KEY (`idLicenca`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Nivel` (
  `idNivel` INT(3) NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(2) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`idNivel`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Titulo` (
  `idTitulo` INT(32) NOT NULL AUTO_INCREMENT,
  `caminho` VARCHAR(150) NULL,
  `tipoTitulo` VARCHAR(50) NOT NULL,
  `pontosDeFormacao` INT(3) NULL DEFAULT 0,
  PRIMARY KEY (`idTitulo`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Usuario` (
  `idUsuario` INT(4) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(32) NOT NULL,
  `senha` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Docente` (
  `idDocente` INT(32) NOT NULL AUTO_INCREMENT,
  `matricula` INT(32) NOT NULL,
  `nomeDocente` VARCHAR(100) NOT NULL,
  `cargo` VARCHAR(30) NULL,
  `status` VARCHAR(8) NULL,
  `pontosDeDesempenho` INT(3) NULL DEFAULT 0,
  `cargaHoraria` INT(3) NOT NULL,
  `tempoDeServico` INT(3) NOT NULL DEFAULT 0,
  `Cidade_idCidade` INT(32) NOT NULL,
  PRIMARY KEY (`idDocente`),
  INDEX `fk_Docente_Cidade_idx` (`Cidade_idCidade` ASC) VISIBLE,
  CONSTRAINT `fk_Docente_Cidade`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `profctrl`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Beneficio` (
  `idBeneficio` INT(10) NOT NULL,
  `dataInicioBeneficio` DATE NOT NULL,
  `tipoBeneficio` VARCHAR(4) NOT NULL,
  `valorBeneficio` VARCHAR(45) NOT NULL DEFAULT 0,
  `Usuario_idUsuario` INT(4) NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  PRIMARY KEY (`idBeneficio`),
  INDEX `fk_Remuneracao_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  INDEX `fk_Beneficio_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  CONSTRAINT `fk_Remuneracao_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Beneficio_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Classe_Docente` (
  `dataInicioClasse` DATE NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  `Classe_idClasse` INT(3) NOT NULL,
  `Usuario_idUsuario` INT(4) NOT NULL,
  INDEX `fk_Classe_Docente_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  INDEX `fk_Classe_Docente_Classe1_idx` (`Classe_idClasse` ASC) VISIBLE,
  INDEX `fk_Classe_Docente_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Classe_Docente_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Classe_Docente_Classe1`
    FOREIGN KEY (`Classe_idClasse`)
    REFERENCES `profctrl`.`Classe` (`idClasse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Classe_Docente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Funcao_Docente` (
  `dataInicioFuncao` DATE NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  `Funcao_idFuncao` INT(4) NOT NULL,
  `Usuario_idUsuario` INT(4) NOT NULL,
  INDEX `fk_Funcao_Docente_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  INDEX `fk_Funcao_Docente_Funcao1_idx` (`Funcao_idFuncao` ASC) VISIBLE,
  INDEX `fk_Funcao_Docente_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Funcao_Docente_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Funcao_Docente_Funcao1`
    FOREIGN KEY (`Funcao_idFuncao`)
    REFERENCES `profctrl`.`Funcao` (`idFuncao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Funcao_Docente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Licenca_Docente` (
  `dataInicioLicenca` DATE NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  `Licenca_idLicenca` INT(32) NOT NULL,
  `Usuario_idUsuario` INT(4) NOT NULL,
  INDEX `fk_Licenca_Docente_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  INDEX `fk_Licenca_Docente_Licenca1_idx` (`Licenca_idLicenca` ASC) VISIBLE,
  INDEX `fk_Licenca_Docente_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Licenca_Docente_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Licenca_Docente_Licenca1`
    FOREIGN KEY (`Licenca_idLicenca`)
    REFERENCES `profctrl`.`Licenca` (`idLicenca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Licenca_Docente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Nivel_Docente` (
  `dataInicioNivel` DATE NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  `Nivel_idNivel` INT(3) NOT NULL,
  `Usuario_idUsuario` INT(4) NOT NULL,
  INDEX `fk_Nivel_Docente_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  INDEX `fk_Nivel_Docente_Nivel1_idx` (`Nivel_idNivel` ASC) VISIBLE,
  INDEX `fk_Nivel_Docente_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Nivel_Docente_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nivel_Docente_Nivel1`
    FOREIGN KEY (`Nivel_idNivel`)
    REFERENCES `profctrl`.`Nivel` (`idNivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nivel_Docente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE TABLE IF NOT EXISTS `profctrl`.`Titulo_Docente` (
  `dataTitulo` DATE NOT NULL,
  `Titulo_idTitulo` INT(32) NOT NULL,
  `Docente_idDocente` INT(32) NOT NULL,
  `Usuario_idUsuario` INT(4) NOT NULL,
  INDEX `fk_Titulo_Docente_Titulo1_idx` (`Titulo_idTitulo` ASC) VISIBLE,
  INDEX `fk_Titulo_Docente_Docente1_idx` (`Docente_idDocente` ASC) VISIBLE,
  INDEX `fk_Titulo_Docente_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_Titulo_Docente_Titulo1`
    FOREIGN KEY (`Titulo_idTitulo`)
    REFERENCES `profctrl`.`Titulo` (`idTitulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Titulo_Docente_Docente1`
    FOREIGN KEY (`Docente_idDocente`)
    REFERENCES `profctrl`.`Docente` (`idDocente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Titulo_Docente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `profctrl`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB