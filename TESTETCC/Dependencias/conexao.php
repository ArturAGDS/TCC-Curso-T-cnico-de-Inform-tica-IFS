<?php
// Modificar com as informações de seu banco de dados
define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', '1234');
define('DB', 'testelogin');

$conn = mysqli_connect(SERVER, USER, PASSWORD, DB) or die('It was not possible to connect');
mysqli_set_charset($conn, "utf8mb4");
//mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);




//   SCRIPT BD
// -- phpMyAdmin SQL Dump
// -- version 5.1.1
// -- https://www.phpmyadmin.net/
// --
// -- Host: 127.0.0.1:3306
// -- Tempo de geração: 07-Fev-2022 às 23:58
// -- Versão do servidor: 5.7.36
// -- versão do PHP: 7.4.26

// SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
// START TRANSACTION;
// SET time_zone = "+00:00";


// /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
// /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
// /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
// /*!40101 SET NAMES utf8mb4 */;

// --
// -- Banco de dados: `testelogin`
// --

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `cliente`
// --

// DROP TABLE IF EXISTS `cliente`;
// CREATE TABLE IF NOT EXISTS `cliente` (
//   `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
//   `usuario_id_usuario` int(11) NOT NULL,
//   `nome_cliente` varchar(255) DEFAULT NULL,
//   `nome_empresa` varchar(255) DEFAULT NULL,
//   `end_cliente` text NOT NULL,
//   `cidade_cliente` varchar(255) NOT NULL,
//   `bairro_cliente` varchar(255) NOT NULL,
//   `cnpj_cliente` varchar(20) DEFAULT NULL,
//   `cpf_cliente` varchar(20) DEFAULT NULL,
//   `insc_estadual` varchar(20) DEFAULT NULL,
//   `tel_cliente` varchar(20) NOT NULL,
//   `email_cliente` varchar(255) DEFAULT NULL,
//   `ativo` tinyint(1) NOT NULL,
//   PRIMARY KEY (`id_cliente`),
//   KEY `cliente_fk0` (`usuario_id_usuario`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `despesas`
// --

// DROP TABLE IF EXISTS `despesas`;
// CREATE TABLE IF NOT EXISTS `despesas` (
//   `id_despesa` int(11) NOT NULL AUTO_INCREMENT,
//   `usuario_id_usuario` int(11) NOT NULL,
//   `nome_conta` varchar(255) NOT NULL,
//   `data_conta` datetime NOT NULL,
//   `descricao_conta` text NOT NULL,
//   `valor_conta` float NOT NULL,
//   `tipo_pagamento` enum('Dep_Bancario','Pix','Dinheiro','Prazo','Cheque') NOT NULL,
//   PRIMARY KEY (`id_despesa`),
//   KEY `despesas_fk0` (`usuario_id_usuario`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `itemvenda`
// --

// DROP TABLE IF EXISTS `itemvenda`;
// CREATE TABLE IF NOT EXISTS `itemvenda` (
//   `id_itemvenda` int(11) NOT NULL AUTO_INCREMENT,
//   `venda_id_venda` int(11) NOT NULL,
//   `produto_id_produto` int(11) NOT NULL,
//   `qtd_produto` int(6) NOT NULL,
//   `produto_nome_produto` varchar(255) NOT NULL,
//   PRIMARY KEY (`id_itemvenda`),
//   KEY `itemVenda_fk0` (`venda_id_venda`),
//   KEY `itemVenda_fk1` (`produto_id_produto`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `produto`
// --

// DROP TABLE IF EXISTS `produto`;
// CREATE TABLE IF NOT EXISTS `produto` (
//   `id_produto` int(11) NOT NULL AUTO_INCREMENT,
//   `usuario_id_usuario` int(11) NOT NULL,
//   `nome_produto` varchar(40) NOT NULL,
//   `descricao_produto` text NOT NULL,
//   `comercializavel` tinyint(1) NOT NULL,
//   `qtd_estoque` int(6) DEFAULT NULL,
//   `peso_produto` float DEFAULT NULL,
//   `valor_unidade` float DEFAULT NULL,
//   `ativo` tinyint(1) NOT NULL,
//   PRIMARY KEY (`id_produto`),
//   KEY `produto_fk0` (`usuario_id_usuario`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `usuario`
// --

// DROP TABLE IF EXISTS `usuario`;
// CREATE TABLE IF NOT EXISTS `usuario` (
//   `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
//   `login` varchar(20) NOT NULL,
//   `senha` varchar(255) NOT NULL,
//   `nome_usuario` varchar(255) NOT NULL,
//   PRIMARY KEY (`id_usuario`),
//   UNIQUE KEY `login` (`login`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

// -- --------------------------------------------------------

// --
// -- Estrutura da tabela `venda`
// --

// DROP TABLE IF EXISTS `venda`;
// CREATE TABLE IF NOT EXISTS `venda` (
//   `id_venda` int(11) NOT NULL AUTO_INCREMENT,
//   `usuario_id_usuario` int(11) NOT NULL,
//   `cliente_id_cliente` int(11) NOT NULL,
//   `numero_nota` varchar(10) DEFAULT NULL,
//   `valor_venda` float NOT NULL,
//   `peso_venda` float DEFAULT NULL,
//   `cliente_end_cliente` text NOT NULL,
//   `data_pedido` date NOT NULL,
//   `data_entrega` date DEFAULT NULL,
//   `status` enum('Em_aberto','Entregue','Concluida') NOT NULL,
//   `tipo_pagamento` enum('Dep_Bancario','Pix','Dinheiro','Prazo','Cheque') NOT NULL,
//   `data_hora` datetime DEFAULT NULL,
//   PRIMARY KEY (`id_venda`),
//   KEY `venda_fk0` (`usuario_id_usuario`),
//   KEY `venda_fk1` (`cliente_id_cliente`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
// COMMIT;

// /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
// /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
// /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
