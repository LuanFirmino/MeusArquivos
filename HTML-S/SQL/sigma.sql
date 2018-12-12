-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.29-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela sigma.anamnese
CREATE TABLE IF NOT EXISTS `anamnese` (
  `cpanamnese` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria de Anamnese',
  `cepaciente` int(11) unsigned NOT NULL COMMENT 'Chave Estrangeira da Tabela Paciente',
  `historia` varchar(250) COLLATE utf8_bin NOT NULL,
  `familia` varchar(250) COLLATE utf8_bin NOT NULL,
  `medicamentos` varchar(250) COLLATE utf8_bin NOT NULL,
  `dataanamnese` date NOT NULL,
  PRIMARY KEY (`cpanamnese`),
  KEY `cepaciente` (`cepaciente`),
  CONSTRAINT `ceanamnesepaciente` FOREIGN KEY (`cepaciente`) REFERENCES `pacientes` (`cppaciente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.anamnese: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anamnese` DISABLE KEYS */;
/*!40000 ALTER TABLE `anamnese` ENABLE KEYS */;

-- Copiando estrutura para tabela sigma.atendimentos
CREATE TABLE IF NOT EXISTS `atendimentos` (
  `cpatendimento` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria atendimentos',
  `ceinstituicao` smallint(6) unsigned NOT NULL COMMENT 'Chave Estrangeira da tabela Instituicao',
  `cemedico` int(11) unsigned NOT NULL COMMENT 'Chave Estrangeira da tabela Medico',
  `cepaciente` int(11) unsigned NOT NULL COMMENT 'Chave Estrangeira da tabela Pacientes',
  `diagnostico` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `tratamento` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `dataatend` date NOT NULL,
  PRIMARY KEY (`cpatendimento`),
  KEY `ceinsituicao` (`ceinstituicao`),
  KEY `cemedico` (`cemedico`),
  KEY `cepaciente` (`cepaciente`),
  CONSTRAINT `ceatendimentoinstituicao` FOREIGN KEY (`ceinstituicao`) REFERENCES `instituicoes` (`cpinstituicao`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ceatendimentomedico` FOREIGN KEY (`cemedico`) REFERENCES `medicos` (`cpmedico`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ceatendimentopaciente` FOREIGN KEY (`cepaciente`) REFERENCES `pacientes` (`cppaciente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.atendimentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `atendimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimentos` ENABLE KEYS */;

-- Copiando estrutura para tabela sigma.instituicoes
CREATE TABLE IF NOT EXISTS `instituicoes` (
  `cpinstituicao` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria da Instituição',
  `nomeinstitu` varchar(100) COLLATE utf8_bin NOT NULL,
  `foneinstitu` char(15) COLLATE utf8_bin NOT NULL,
  `enderinstitu` varchar(100) COLLATE utf8_bin NOT NULL,
  `siteinstitu` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`cpinstituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.instituicoes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `instituicoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `instituicoes` ENABLE KEYS */;

-- Copiando estrutura para tabela sigma.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `cpmedico` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave Primaria da tabela Médico',
  `nomemedico` varchar(100) COLLATE utf8_bin NOT NULL,
  `crmmedico` char(15) COLLATE utf8_bin NOT NULL COMMENT 'Unica',
  `especmedico` varchar(80) COLLATE utf8_bin NOT NULL,
  `cpfmedico` char(15) COLLATE utf8_bin NOT NULL COMMENT 'Unica',
  `sexomedico` char(10) COLLATE utf8_bin NOT NULL,
  `fonemedico` char(15) COLLATE utf8_bin NOT NULL,
  `emailmedico` varchar(90) COLLATE utf8_bin NOT NULL,
  `nascmedico` date NOT NULL,
  `senhamed` varchar(8) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cpmedico`),
  UNIQUE KEY `crmmedico` (`crmmedico`),
  UNIQUE KEY `cpfmedico` (`cpfmedico`),
  UNIQUE KEY `emailmedico` (`emailmedico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.medicos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;

-- Copiando estrutura para tabela sigma.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `cppaciente` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomepaciente` varchar(100) COLLATE utf8_bin NOT NULL,
  `sexopaciente` char(10) COLLATE utf8_bin NOT NULL,
  `cpfpaciente` char(15) COLLATE utf8_bin NOT NULL COMMENT 'Unica',
  `enderpaciente` varchar(100) COLLATE utf8_bin NOT NULL,
  `emailpaciente` varchar(100) COLLATE utf8_bin NOT NULL,
  `fonepaciente` char(50) COLLATE utf8_bin NOT NULL,
  `nascpaciente` date NOT NULL,
  `senhapac` int(11) DEFAULT NULL,
  PRIMARY KEY (`cppaciente`),
  UNIQUE KEY `cpfpaciente` (`cpfpaciente`),
  UNIQUE KEY `emailpaciente` (`emailpaciente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.pacientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;

-- Copiando estrutura para tabela sigma.procedimentos
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `cpprocedimento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ceatendimento` int(11) unsigned NOT NULL,
  `descprocedimento` varchar(250) COLLATE utf8_bin NOT NULL,
  `tipoprocedimento` char(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cpprocedimento`),
  KEY `ceatendimento` (`ceatendimento`),
  CONSTRAINT `FK_procedimentos_atendimentos` FOREIGN KEY (`ceatendimento`) REFERENCES `atendimentos` (`cpatendimento`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Copiando dados para a tabela sigma.procedimentos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `procedimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `procedimentos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
