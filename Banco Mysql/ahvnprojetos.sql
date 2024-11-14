-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Out-2024 às 22:00
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ahvnprojetos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nome`, `chave`, `grupo`) VALUES
(1, 'Hóspedes', 'hospedes', 1),
(2, 'Funcionários', 'funcionarios', 1),
(3, 'Fornecedores', 'fornecedores', 1),
(4, 'Usuários', 'usuarios', 1),
(5, 'Tipo de Quarto', 'categorias_quartos', 2),
(6, 'Quartos', 'quartos', 2),
(7, 'Formas de PGTO', 'formas_pgto', 2),
(8, 'Grupos de Acesso', 'grupos', 2),
(9, 'Acessos', 'acessos', 2),
(10, 'Reservas', 'reservas', 3),
(11, 'Filtrar Reservas', 'filtrar_reservas', 3),
(12, 'Relatório de Quartos', 'rel_quartos', 3),
(13, 'Contas à Pagar', 'pagar', 4),
(14, 'Contas à Receber', 'receber', 4),
(15, 'Compras', 'compras', 4),
(16, 'Relatórios Financeiros', 'rel_financeiro', 4),
(17, 'Demonstrativo de Lucro', 'rel_lucro', 4),
(18, 'Categorias Produtos', 'categorias_produtos', 5),
(19, 'Produtos', 'produtos', 5),
(20, 'Entradas', 'entradas', 5),
(21, 'Saídas', 'saidas', 5),
(22, 'Estoque Baixo', 'estoque_baixo', 5),
(23, 'Categoria Serviços', 'categorias_servicos', 6),
(24, 'Serviços', 'servicos', 6),
(25, 'Venda de Produtos', 'vendas_produtos', 7),
(26, 'Venda de Serviços', 'vendas_servicos', 7),
(27, 'Lista de Vendas', 'lista_vendas', 7),
(28, 'Lista de Serviços', 'lista_servicos', 7),
(29, 'Home', 'home', 0),
(30, 'Configurações', 'configuracoes', 0),
(31, 'Dados do Site', 'dados_site', 8),
(32, 'Banner Site', 'banners_site', 8),
(33, 'Área de Lazer', 'especificacoes', 8),
(34, 'Galeria do Site', 'galeria_site', 8),
(35, 'Marketing Whatsapp', 'marketing', 0),
(36, 'Calendário Reservas', 'calendario', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `registro` varchar(35) DEFAULT NULL,
  `id_reg` int(11) DEFAULT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id`, `nome`, `descricao`, `arquivo`, `data_cad`, `registro`, `id_reg`, `usuario`) VALUES
(1, 'Teste pdf', NULL, '21-03-2023-17-54-29-09-11-2021-10-17-10-pdfteste.pdf', '2023-03-21', 'Conta à Pagar', 5, 1),
(3, 'teste', NULL, '21-03-2023-17-55-19-09-11-2021-12-04-29-pdfteste.zip', '2023-03-21', 'Fornecedores', 1, 1),
(4, 'aaaa', NULL, '21-03-2023-17-59-12-09-11-2021-10-17-10-pdfteste.pdf', '2023-03-21', 'Conta à Pagar', 9, 1),
(5, 'aaaa', NULL, '21-03-2023-17-59-12-09-11-2021-10-17-10-pdfteste.pdf', '2023-03-21', 'Fornecedores', 1, 1),
(7, 'afdsfsdafsdfa', NULL, '21-03-2023-18-04-04-09-11-2021-12-04-29-pdfteste.zip', '2023-03-21', 'Fornecedores', 1, 1),
(11, 'fdfdsf', NULL, '21-03-2023-18-47-03-09-11-2021-10-17-10-pdfteste.pdf', '2023-03-21', 'Hóspedes', 23, 1),
(12, 'fdfds', NULL, '21-03-2023-18-47-10-18-10-2021-14-50-06-caixa-som.rar', '2023-03-21', 'Conta à Receber', 1, 1),
(13, 'fdfds', NULL, '21-03-2023-18-47-10-18-10-2021-14-50-06-caixa-som.rar', '2023-03-21', 'Hóspedes', 2, 1),
(14, 'dgfdgdf', NULL, '21-03-2023-20-57-09-18-10-2021-15-02-46-conta3.jpg', '2023-03-21', 'Conta à Pagar', 5, 1),
(15, 'fsfd', NULL, '27-03-2023-16-51-47-09-11-2021-09-21-26-conta3.jpg', '2023-03-27', 'Conta à Pagar', 34, 1),
(16, 'fsfd', NULL, '27-03-2023-16-51-47-09-11-2021-09-21-26-conta3.jpg', '2023-03-27', 'Fornecedores', 2, 1),
(17, 'teste', NULL, '03-04-2023-14-58-19-luxo-premiun.jpg', '2023-04-03', 'Hóspedes', 23, 1),
(18, 'tesstee', NULL, '03-04-2023-14-58-30-09-11-2021-12-04-29-pdfteste.zip', '2023-04-03', 'Hóspedes', 23, 1),
(19, 'Arq', NULL, '03-04-2023-15-00-46-09-11-2021-13-08-20-arquivoteste.docx', '2023-04-03', 'Conta à Pagar', 40, 1),
(20, 'Arq', NULL, '03-04-2023-15-00-46-09-11-2021-13-08-20-arquivoteste.docx', '2023-04-03', 'Hóspedes', 23, 1),
(21, 'CNH', NULL, '03-04-2023-15-01-12-09-11-2021-10-17-10-pdfteste.pdf', '2023-04-03', 'Hóspedes', 23, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners_site`
--

CREATE TABLE `banners_site` (
  `id` int(11) NOT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `subtitulo` varchar(30) DEFAULT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `banners_site`
--

INSERT INTO `banners_site` (`id`, `titulo`, `subtitulo`, `descricao`, `foto`, `link`, `ativo`) VALUES
(1, 'Primeiro Banner', 'Subtitulo Banner', 'Descrição do Banner', '04-04-2023-11-50-18-POUSADA-03.jpg', 'Link se Tiver', 'Sim'),
(3, '', '', '', '04-04-2023-11-41-03-POUSADA-02.jpg', '', 'Sim'),
(4, '', '', '', '04-04-2023-11-50-25-POUSADA-01.jpg', '', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Administrador Sistema'),
(2, 'Gerente'),
(3, 'Recepcionista'),
(4, 'Recreador'),
(5, 'Camareira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos_publico`
--

CREATE TABLE `cargos_publico` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos_publico`
--

INSERT INTO `cargos_publico` (`id`, `nome`) VALUES
(0, 'Deputado Estadual'),
(0, 'Deputado Federal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_produtos`
--

CREATE TABLE `categorias_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_produtos`
--

INSERT INTO `categorias_produtos` (`id`, `nome`, `foto`, `ativo`) VALUES
(1, 'Bebidas', '28-03-2023-16-58-22-BEBIDAS.jpg', 'Sim'),
(2, 'Pratos', '28-03-2023-16-58-14-PRATOS.jpg', 'Sim'),
(3, 'Petiscos', '28-03-2023-16-58-05-PETISCOS.jpg', 'Sim'),
(4, 'Gelados', '28-03-2023-16-49-31-GELADOS.jpg', 'Sim'),
(8, 'Chips', '28-03-2023-16-49-13-CHIPS.jpg', 'Sim'),
(9, 'Sobremesas', '28-03-2023-15-48-47-SOBREMESAS.jpg', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_quartos`
--

CREATE TABLE `categorias_quartos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(2000) DEFAULT NULL,
  `especificacoes` varchar(2000) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `nome_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_quartos`
--

INSERT INTO `categorias_quartos` (`id`, `nome`, `descricao`, `especificacoes`, `foto`, `ativo`, `valor`, `nome_url`) VALUES
(5, 'Standard', 'O apartamento Standard é a melhor opção para quem quer conforto pelo menor custo. Possui cama box, banheiro amplo, frigobar, ar condicionado, tv a cabo, guarda-roupas, mesa de madeira e/ou aparador', 'BANHEIRO PRIVATIVO**AR CONDICIONADO**WI-FI**FRIGOBAR**COMPORTA CAMA EXTRA**COMPORTA BERÇO DE MADEIRA(SOLICITAR NA RESERVA)', '02-04-2023-21-19-43-standard2.jpeg', 'Sim', '299.99', 'standard'),
(6, 'Luxo', 'O apartamento Luxo é ideal para quem quer conforto e aconchego. Localizado no 2º andar, o quarto é muito espaçoso, com decoração moderna, cama box, prateleiras para itens pessoais, escrivaninha, tv a cabo, frigobar, ar condicionado.<br>O acesso ao segundo andar é feito por escadas, não sendo indicado para cadeirantes ou pessoas com mobilidade reduzida', 'BANHEIRO PRIVATIVO**AR CONDICIONADO**WI-FI**FRIGOBAR**CAMA KING SIZE**COMPORTA CAMA EXTRA**COMPORTA BERÇO DE MADEIRA**(SOLICITAR NA RESERVA)', '02-04-2023-21-19-20-luxo3.jpg', 'Sim', '399.99', 'luxo'),
(14, 'Luxo Superior', 'O apartamento Luxo Superior tem um quê a mais.<br>Com banheira de hidromassagem, essa categoria vai te proporcionar ainda mais conforto. O quarto espaçoso possui cama king size, tv a cabo, frigobar, ar condicionado, wi-fi, banheiro amplo com banheira de hidromassagem.', 'BANHEIRA DE HIDROMASSAGEM**AR CONDICIONADO**WI-FI**FRIGOBARCAMA**KING SIZE**COMPORTA CAMA EXTRA**COMPORTA BERÇO DE MADEIRA', '29-03-2023-09-50-37-01.webp', 'Sim', '799.00', 'luxo-superior'),
(15, 'Suite Master', 'A Suíte Master é o suprassumo de nossa pousada. Com quarto, sala de estar, banheira de hidromassagem e varanda, ela une conforto, beleza, espaço e exclusividade. Localizada em frente ao canteiro central, possui sala de estar com sofá e poltronas, frigobar estilo retrô, mesa de madeira com cadeiras e aparador. O quarto é composto por cama king size, tv a cabo, ar condicionado, guarda-roupas, escrivaninha e poltrona. O banheiro amplo com banheira de hidromassagem fica ainda mais confortável.<br>A suíte localizada no lado oposto à área de lazer é a mais silenciosa do hotel.<br>O descanso merecido está aqui!', 'BANHEIRA DE HIDROMASSAGEM**SALA DE ESTAR**DECK COM VISTA PARA A PISCINA**LOCALIZAÇÃO PRIVILEGIADA**CAMA KING SIZE**FRIGOBAR**WI-FI**AR CONDICIONADO', '02-04-2023-21-18-22-super-luxo3.jpg', 'Sim', '900.00', 'suite-master');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_servicos`
--

CREATE TABLE `categorias_servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_servicos`
--

INSERT INTO `categorias_servicos` (`id`, `nome`, `foto`, `ativo`) VALUES
(1, 'Passeios', '28-03-2023-17-00-43-PASSEIOS.jpg', 'Sim'),
(2, 'Transfer', '28-03-2023-17-00-37-TRANSFER.jpg', 'Sim'),
(3, 'Massagens', '28-03-2023-17-00-31-MASSAGEM.jpg', 'Sim'),
(4, 'Salão', '28-03-2023-17-00-24-SALÃO.jpg', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `facebook` varchar(256) NOT NULL,
  `linkedln` varchar(256) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `logo_rel` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `instancia` varchar(50) DEFAULT NULL,
  `api_whatsapp` varchar(5) NOT NULL,
  `no_show` int(11) DEFAULT NULL,
  `dias_cancelamento` int(11) DEFAULT NULL,
  `taxa_cancelamento` int(11) DEFAULT NULL,
  `marca_dagua` varchar(5) DEFAULT NULL,
  `info_reserva` varchar(2000) DEFAULT NULL,
  `info_checkin` varchar(2000) DEFAULT NULL,
  `prazo_devolucao` int(11) DEFAULT NULL,
  `ativo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`nome`, `email`, `telefone`, `endereco`, `instagram`, `facebook`, `linkedln`, `logo`, `icone`, `logo_rel`, `id`, `token`, `instancia`, `api_whatsapp`, `no_show`, `dias_cancelamento`, `taxa_cancelamento`, `marca_dagua`, `info_reserva`, `info_checkin`, `prazo_devolucao`, `ativo`) VALUES
('AHVN', 'testeleindecker@gmail.com', '(31) 97527-5084', 'Rua X Número 150 - Bairro Centro Belo Horizonte - MG', 'https://www.instagram.com/portal_hugo_cursos/', '', '', 'logo.png', 'icone.png', 'logo.jpg', 1, 'DBFY7-5NP-090U0', '54T270623112109OWN96', 'Sim', 50, 30, 30, 'Sim', 'O Check-In é feito a partir das 14:00 horas e o Check-Out até 12:00, caso ultrapasse esse horário poderá ser cobrada outra diária!', 'Horário do Café da Manhã de 07:00 ás 10:00, a senha do wifi é pousadafreitas, desejamos a você uma excelente estadia conosco.', 7, 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_site`
--

CREATE TABLE `dados_site` (
  `id` int(11) NOT NULL,
  `logo_site` varchar(100) DEFAULT NULL,
  `titulo_sobre` varchar(15) DEFAULT NULL,
  `descricao_sobre1` varchar(200) DEFAULT NULL,
  `descricao_sobre2` varchar(200) DEFAULT NULL,
  `descricao_sobre3` varchar(1000) DEFAULT NULL,
  `foto_sobre_index` varchar(100) DEFAULT NULL,
  `foto_sobre_pagina` varchar(100) DEFAULT NULL,
  `video_sobre_index` varchar(255) DEFAULT NULL,
  `foto_video_sobre` varchar(20) DEFAULT NULL,
  `foto_banner_mobile` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_site`
--

INSERT INTO `dados_site` (`id`, `logo_site`, `titulo_sobre`, `descricao_sobre1`, `descricao_sobre2`, `descricao_sobre3`, `foto_sobre_index`, `foto_sobre_pagina`, `video_sobre_index`, `foto_video_sobre`, `foto_banner_mobile`) VALUES
(1, '04-04-2023-14-05-54-logo_site.png', 'Sobre', 'Nossa pousada fica há 1 Hora de Belo Horizonte, super bem localizada, bem aconchegante, venha conhecer.', 'Área de Lazer e estrutura completa para sua diversão!', 'Nossa pousada fica há 1 Hora de Belo Horizonte, super bem localizada, bem aconchegante, venha conhecer. Nossa pousada fica há 1 Hora de Belo Horizonte, super bem localizada, bem aconchegante, venha conhecer. Nossa pousada fica há 1 Hora de Belo Horizonte, super bem localizada, bem aconchegante, venha conhecer. Nossa pousada fica há 1 Hora de Belo Horizonte, super bem localizada, bem aconchegante, venha conhecer.', '04-04-2023-14-13-17-SOBRE-1020X525.jpg', '04-04-2023-14-14-30-01.jpg', 'https://www.youtube.com/embed/SiwIEfzWCag', 'Vídeo', '04-04-2023-23-04-02-3xLC.gif');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`id`, `produto`, `quantidade`, `motivo`, `usuario`, `data`) VALUES
(1, 3, 10, 'Encontrados', 1, '2023-03-27'),
(2, 3, 3, 'Encontrados', 1, '2023-03-27'),
(3, 7, 5, 'Teste', 1, '2023-03-28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especificacoes`
--

CREATE TABLE `especificacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `especificacoes`
--

INSERT INTO `especificacoes` (`id`, `nome`, `foto`) VALUES
(2, 'Piscina', '04-04-2023-17-30-52-PISCINA.png'),
(3, 'Jacuzzi', '04-04-2023-17-30-43-JACUZZI.png'),
(4, 'Campo de Futebol', '04-04-2023-17-30-36-CAMPO-FUTEBOL.png'),
(5, 'Quadra de Tênis', '04-04-2023-17-30-30-TENIS.png'),
(6, 'Sala de Jogos', '04-04-2023-17-30-21-SALA-JOGOS.png'),
(7, 'Quadra de Voley', '04-04-2023-17-31-01-VOLEI.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pgto`
--

CREATE TABLE `formas_pgto` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formas_pgto`
--

INSERT INTO `formas_pgto` (`id`, `nome`) VALUES
(2, 'Pix / Transferência'),
(3, 'Cartão de Débito'),
(4, 'Cartão de Crédito'),
(6, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `razaoSocial` varchar(50) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nomeContato` varchar(50) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(250) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `razaoSocial`, `cnpj`, `telefone`, `nomeContato`, `celular`, `email`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `numero`, `complemento`, `data`) VALUES
(1, '3', '04.994.418/0001-13', '(51) 91515-155', 'TESE TESE', '5151515155', 'DEDE@EDE.COM', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '751', 'funcionou', '2023-09-11'),
(4, '2', '04.994.418/0001-12', '(15) 15151-515', 'Teste', '26262', 'rafael@leindecker.com', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '251', 'teste', '2023-09-16'),
(6, '1', '01.414.141/4141-41', '(51) 32458-940', 'Teste', '2515151515', 'rafael@leindecker.com', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '155', 'complemento', '2023-09-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_quartos`
--

CREATE TABLE `fotos_quartos` (
  `id` int(11) NOT NULL,
  `quarto` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fotos_quartos`
--

INSERT INTO `fotos_quartos` (`id`, `quarto`, `foto`) VALUES
(1, 6, '13-03-2023-14-51-40-luxo.webp'),
(2, 6, '13-03-2023-14-51-40-standard.webp'),
(7, 15, '02-04-2023-21-18-38-super-luxo.jpg'),
(8, 15, '02-04-2023-21-18-38-super-luxo2.jpg'),
(9, 15, '02-04-2023-21-18-38-super-luxo3.jpg'),
(10, 14, '02-04-2023-21-19-01-luxo-premiun.jpg'),
(11, 14, '02-04-2023-21-19-01-luxo-premiunm2.jpeg'),
(12, 14, '02-04-2023-21-19-01-luxo.jpg'),
(13, 6, '02-04-2023-21-19-33-luxo.jpg'),
(14, 6, '02-04-2023-21-19-33-luxo.webp'),
(15, 6, '02-04-2023-21-19-33-luxo3.jpg'),
(16, 5, '02-04-2023-21-19-50-standard.webp'),
(17, 5, '02-04-2023-21-19-50-standard2.jpeg'),
(18, 5, '02-04-2023-21-19-50-standard3.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `contrato` int(11) NOT NULL,
  `admissao` date NOT NULL,
  `ativos` varchar(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `turno` varchar(50) NOT NULL,
  `data1` date NOT NULL,
  `data2` date NOT NULL,
  `desligamento` date NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `contrato`, `admissao`, `ativos`, `nome`, `email`, `telefone`, `cpf`, `endereco`, `obs`, `cargo`, `turno`, `data1`, `data2`, `desligamento`, `data`) VALUES
(32, 5033, '2012-12-12', 'Sim', 'Rafael Leindecker', 'rafaelleindecker@gmail.com', '(51) 99317-6008', '008.646.530-93', 'Rua Tomé Antônio de Souza', 'teste', 'Camareira', 'Manhã', '2013-01-25', '2013-03-10', '0000-00-00', '2023-09-11'),
(33, 5034, '2023-09-07', 'Sim', 'Teste', 'rafael@leindecker.com', '(51) 32458-940', '008.646.530-92', 'Rua Tomé Antônio de Souza', 'teste', 'Camareira', 'Manhã', '2023-10-21', '2023-12-05', '0000-00-00', '2023-09-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria_site`
--

CREATE TABLE `galeria_site` (
  `id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `galeria_site`
--

INSERT INTO `galeria_site` (`id`, `foto`) VALUES
(1, '04-04-2023-18-25-56-01.jpg'),
(2, '04-04-2023-18-25-56-02.jpg'),
(3, '04-04-2023-18-25-56-03.jpg'),
(4, '04-04-2023-18-25-57-04.jpg'),
(5, '04-04-2023-18-25-57-05.jpg'),
(6, '04-04-2023-18-25-57-06.jpg'),
(7, '04-04-2023-18-25-57-07.jpg'),
(8, '04-04-2023-18-25-57-08.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_acessos`
--

CREATE TABLE `grupo_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupo_acessos`
--

INSERT INTO `grupo_acessos` (`id`, `nome`) VALUES
(1, 'Pessoas'),
(2, 'Cadastros'),
(3, 'Reservas'),
(4, 'Financeiro'),
(5, 'Produtos'),
(6, 'Serviços'),
(7, 'Vendas'),
(8, 'Site');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hospedes`
--

CREATE TABLE `hospedes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `data` date NOT NULL,
  `responsavel` varchar(5) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `reserva` int(11) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jornadas`
--

CREATE TABLE `jornadas` (
  `id` int(11) NOT NULL,
  `situacao` varchar(10) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `tipo_jornada` varchar(50) NOT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `produto` varchar(50) DEFAULT NULL,
  `hora_inicial` timestamp NULL DEFAULT NULL,
  `hora_final` timestamp NULL DEFAULT NULL,
  `tempo` time DEFAULT NULL,
  `total_kg` decimal(10,2) DEFAULT NULL,
  `obs` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jornadas`
--

INSERT INTO `jornadas` (`id`, `situacao`, `funcionario`, `tipo_jornada`, `setor`, `produto`, `hora_inicial`, `hora_final`, `tempo`, `total_kg`, `obs`) VALUES
(1, 'Aberta', 'Rafael Leindecker', 'Coleta', 'Rouparia', 'Diversos', '2024-10-24 11:59:15', '2024-10-24 11:59:15', '00:59:15', '40.00', 'Teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marketing`
--

CREATE TABLE `marketing` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `data_envio` date DEFAULT NULL,
  `envios` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `mensagem` varchar(500) DEFAULT NULL,
  `item1` varchar(100) DEFAULT NULL,
  `item2` varchar(100) DEFAULT NULL,
  `item3` varchar(100) DEFAULT NULL,
  `item4` varchar(100) DEFAULT NULL,
  `item5` varchar(100) DEFAULT NULL,
  `item6` varchar(100) DEFAULT NULL,
  `item7` varchar(100) DEFAULT NULL,
  `item8` varchar(100) DEFAULT NULL,
  `item9` varchar(100) DEFAULT NULL,
  `item10` varchar(100) DEFAULT NULL,
  `item11` varchar(100) DEFAULT NULL,
  `item12` varchar(100) DEFAULT NULL,
  `item13` varchar(100) DEFAULT NULL,
  `item14` varchar(100) DEFAULT NULL,
  `item15` varchar(100) DEFAULT NULL,
  `item16` varchar(100) DEFAULT NULL,
  `item17` varchar(100) DEFAULT NULL,
  `item18` varchar(100) DEFAULT NULL,
  `item19` varchar(100) DEFAULT NULL,
  `item20` varchar(100) DEFAULT NULL,
  `conclusao` varchar(500) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `audio` varchar(100) DEFAULT NULL,
  `forma_envio` varchar(50) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `hash2` varchar(100) DEFAULT NULL,
  `hash3` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marketing`
--

INSERT INTO `marketing` (`id`, `data`, `data_envio`, `envios`, `titulo`, `mensagem`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`, `item11`, `item12`, `item13`, `item14`, `item15`, `item16`, `item17`, `item18`, `item19`, `item20`, `conclusao`, `arquivo`, `audio`, `forma_envio`, `hash`, `hash2`, `hash3`) VALUES
(1, '2023-07-13', '2023-08-14', 8, 'Título de Teste', 'Mensagem inicial da campanha Mensagem inicial da campanha Mensagem inicial da campanha', 'Aqui Item 1', 'Aqui Item 2', 'Aqui Item 3', 'Aqui Item 4', 'Aqui Item 5', 'Aqui Item 6', 'Aqui Item 7', 'Aqui Item 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aqui vai ser mostrado a mensagem de conclusão', '08-08-2023-22-46-38-arte-whats-eu.png', '13-07-2023-18-52-36-WhatsApp-Ptt-2023-07-13-at-18.34.03.ogg', 'Teste', '3FMRN9KGJ64HJ8YDFRWO54T270623112109OWN96', 'H0OL6TBRKX45RHXJJ8HY54T270623112109OWN96', 'IFYQ5JN6BCYZFCC7Q4WG54T270623112109OWN96'),
(3, '2023-07-16', '2023-09-03', 9, 'Aniversariantes do Dia', 'afdasfdsfdasf', 'testessss%', ' tesseteee%', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fdadfsfdasf  fsf safds%', 'sem-foto.jpg', '08-08-2023-10-55-13-audio_teste.ogg', '', 'WP1DM8UP9FD63RXU0QQK54T270623112109OWN96', '', 'Z3B9M4G8PQVES5D35VLM54T270623112109OWN96'),
(10, '2023-08-14', NULL, NULL, 'fafdasf', 'fsasfafadfa', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '14-08-2023-17-50-24-bloqueio-sistemas.png', '', NULL, NULL, NULL, NULL),
(11, '2023-09-03', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'sem-foto.jpg', '', NULL, NULL, NULL, NULL),
(12, '2023-09-03', '2023-09-03', 4, 'Teste', 'Testando Mensagem', 'Teste1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', 'teste mensgem', '03-09-2023-22-07-21-logo_vila-removebg-preview-(1).png', '', '', 'W2NCENE2MOFM787AO3YQ54T270623112109OWN96', 'AEMK4TBXTUVQI0ITUTRN54T270623112109OWN96', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `hospede` int(11) DEFAULT NULL,
  `fornecedor` int(11) DEFAULT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parlamentares`
--

CREATE TABLE `parlamentares` (
  `id` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `cargos_publico` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `obs` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `parlamentares`
--

INSERT INTO `parlamentares` (`id`, `nome`, `cargos_publico`, `telefone`, `email`, `obs`) VALUES
(1, 'Rafael Leindecker', 'Deputado Estadual', '(51) 99317-6008', 'rafael@gmail.com', 'teste'),
(2, 'Lucas Leindecker', 'Deputado Estadual', '(51) 99317-6008', 'lucas@gmail.com', 'teste'),
(3, 'Deric Leindecker', 'Deputado Federal', '(51) 99317-6008', 'deric@gmail.com', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano_trabalho`
--

CREATE TABLE `plano_trabalho` (
  `id` int(11) NOT NULL,
  `unidades` varchar(100) NOT NULL,
  `tipos_recursos` int(11) NOT NULL,
  `parlamentar` varchar(50) NOT NULL,
  `numero_recurso` varchar(20) NOT NULL,
  `valor_plano` decimal(8,2) NOT NULL,
  `situacao` varchar(20) NOT NULL,
  `banco` varchar(20) NOT NULL,
  `agencia` varchar(20) NOT NULL,
  `conta` varchar(20) NOT NULL,
  `finalidade` varchar(20) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `data_cad` date NOT NULL,
  `anexo_plano` varchar(100) NOT NULL,
  `data_ent` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` varchar(256) NOT NULL,
  `anexo_termo` varchar(100) NOT NULL,
  `saldo_recurso` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `plano_trabalho`
--

INSERT INTO `plano_trabalho` (`id`, `unidades`, `tipos_recursos`, `parlamentar`, `numero_recurso`, `valor_plano`, `situacao`, `banco`, `agencia`, `conta`, `finalidade`, `usuario_lanc`, `data_cad`, `anexo_plano`, `data_ent`, `data_venc`, `data_fim`, `descricao`, `anexo_termo`, `saldo_recurso`) VALUES
(11, 'Associação Hospitalar Vila Nova', 0, 'Deric Leindecker', '777', '750000.00', 'Finalizado', '', '', '', 'Custeio', 1, '2023-11-11', 'sem-foto.png', '2023-11-01', '2024-10-30', '2023-10-31', '', 'sem-foto.png', '0.00'),
(12, 'Associação Hospitalar Vila Nova', 0, 'Rafael Leindecker', '5256', '999999.99', 'Finalizado', 'Banrisul', '0100', '0644684103', 'Custeio', 1, '2023-11-10', 'sem-foto.png', '2023-11-29', '2024-11-27', '2023-11-30', '', 'sem-foto.png', '0.00'),
(14, 'Associação Hospitalar Vila Nova', 0, 'Deric Leindecker', '123', '999999.99', 'Aguardando Recurso', 'Banrisul', '0100', '0644684103', 'Custeio', 1, '2024-01-12', 'sem-foto.png', '0000-00-00', '0000-00-00', '0000-00-00', 'teste', 'sem-foto.png', '0.00'),
(15, 'Charqueadas', 0, 'Lucas Leindecker', '999', '999999.99', 'Aguardando Aceite', '', '', '', 'Investimento', 1, '2024-02-07', 'sem-foto.png', '0000-00-00', '0000-00-00', '0000-00-00', '', 'sem-foto.png', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `valor_compra` decimal(8,2) DEFAULT NULL,
  `valor_venda` decimal(8,2) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `tem_estoque` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `nivel_estoque` int(11) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `fornecedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `valor_compra`, `valor_venda`, `estoque`, `tem_estoque`, `foto`, `ativo`, `nivel_estoque`, `categoria`, `fornecedor`) VALUES
(10, 'Refrigerante Lata', 'Refrigerante Lata ', '4.00', '6.00', 94, 'Sim', '28-03-2023-17-03-05-REFRIGERANTE-LATA.jpg', 'Sim', 10, 1, NULL),
(11, 'Suco Lata 350 ML', '', '4.00', '7.00', 98, 'Sim', '28-03-2023-17-26-54-SUCO-LATA.jpg', 'Sim', 10, 1, NULL),
(12, 'Suco Natural 500 ML', 'Suco Natural', '0.00', '9.00', 0, 'Não', '28-03-2023-17-30-25-SUCO-NATURAL.jpg', 'Sim', 0, 1, NULL),
(13, 'Amendoin Japonês', '', '0.00', '6.00', 0, 'Não', '28-03-2023-17-31-24-AMENDOIM.jpg', 'Sim', 0, 3, NULL),
(14, 'Bolinho de Bacalhau', '10 Unidades', '0.00', '22.00', 0, 'Não', '28-03-2023-17-31-54-BOLINHO-BACALHAU.jpg', 'Sim', 0, 3, NULL),
(15, 'Tábua de Frios', '', '0.00', '35.00', 0, 'Não', '28-03-2023-17-32-09-TABUA-DE-FRIOS.jpg', 'Sim', 0, 3, NULL),
(16, 'Macarrão Carbonara', '', '0.00', '26.00', 0, 'Não', '28-03-2023-17-32-34-CARBONARA.jpg', 'Sim', 0, 2, NULL),
(17, 'Salmão 400 Gramas', '', '0.00', '130.00', 0, 'Não', '28-03-2023-17-32-58-SALMÃO.jpg', 'Sim', 0, 2, NULL),
(18, 'Strogonoff', '', '0.00', '45.00', 0, 'Não', '28-03-2023-17-33-14-STROGONOFF.jpg', 'Sim', 0, 2, NULL),
(19, 'Cebolitos', '', '3.00', '6.00', 100, 'Sim', '28-03-2023-17-34-13-DORITOS.jpg', 'Sim', 10, 8, NULL),
(20, 'Doritos', '', '5.00', '10.00', 99, 'Sim', '28-03-2023-17-34-08-DORITOS.jpg', 'Sim', 20, 8, NULL),
(21, 'Fandangos', '', '4.00', '8.00', 100, 'Sim', '28-03-2023-17-34-28-FANDANGOS.jpg', 'Sim', 15, 8, NULL),
(22, 'Açaí 300 Ml', '', '0.00', '15.00', 0, 'Não', '28-03-2023-17-34-57-AÇAI.jpg', 'Sim', 0, 4, NULL),
(23, 'Picolé', '', '4.00', '8.00', 100, 'Sim', '28-03-2023-17-35-16-PICOLE.jpg', 'Sim', 15, 4, NULL),
(24, 'Sorvete Pote 300 ML', '', '4.00', '8.00', 100, 'Sim', '28-03-2023-17-35-41-SORVETE.jpg', 'Sim', 10, 4, NULL),
(25, 'Pudim 150 Gramas', '', '0.00', '13.00', 0, 'Não', '28-03-2023-17-36-11-PUDIM.jpg', 'Sim', 0, 9, NULL),
(26, 'Tiramissu', '', '0.00', '15.00', 0, 'Não', '28-03-2023-17-36-29-TIRAMISSÚ.jpg', 'Sim', 0, 9, NULL),
(27, 'Torta de Nozes', '', '0.00', '25.00', 0, 'Não', '28-03-2023-17-36-41-TORTA-DE-NOZES.jpg', 'Sim', 0, 9, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quartos`
--

CREATE TABLE `quartos` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `quartos`
--

INSERT INTO `quartos` (`id`, `numero`, `descricao`, `ativo`, `obs`, `tipo`) VALUES
(1, 1, '', 'Sim', '', 6),
(2, 2, '', 'Sim', '', 6),
(3, 3, '', 'Sim', '', 6),
(4, 4, '', 'Sim', '', 6),
(5, 5, '', 'Sim', '', 6),
(6, 6, '', 'Sim', '', 6),
(7, 7, '', 'Sim', '', 5),
(8, 8, '', 'Sim', '', 5),
(9, 9, '', 'Sim', '', 5),
(10, 10, '', 'Sim', '', 5),
(11, 11, '', 'Sim', '', 5),
(12, 12, '', 'Sim', '', 5),
(13, 13, '', 'Sim', '', 14),
(14, 14, '', 'Sim', '', 14),
(15, 15, '', 'Sim', '', 15),
(16, 16, '', 'Sim', '', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `hospede` int(11) DEFAULT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `pago` varchar(5) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) DEFAULT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receber`
--

INSERT INTO `receber` (`id`, `descricao`, `valor`, `hospede`, `data_lanc`, `data_venc`, `data_pgto`, `pago`, `usuario_lanc`, `referencia`, `arquivo`, `usuario_pgto`, `id_ref`, `obs`, `quantidade`, `hora`, `id_produto`) VALUES
(1, 'Entrada Reserva', '399.99', 23, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 1, NULL, NULL, NULL, NULL),
(2, 'Entrada Reserva', '200.00', 1, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 2, NULL, NULL, NULL, NULL),
(3, 'Entrada Reserva', '799.98', 1, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 3, NULL, NULL, NULL, NULL),
(4, 'Entrada Reserva', '799.00', 23, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 4, NULL, NULL, NULL, NULL),
(5, 'Entrada Reserva', '999.98', 23, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 5, NULL, NULL, NULL, NULL),
(6, 'Entrada Reserva', '599.99', 1, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Entrada', 'sem-foto.png', 1, 6, NULL, NULL, NULL, NULL),
(7, 'Restante Reserva', '399.99', 23, '2023-08-14', '2023-08-14', '2023-08-14', 'Sim', 1, 'Restante', 'sem-foto.png', 1, 1, NULL, NULL, NULL, NULL),
(8, 'teste', '150.00', 1, '2023-09-20', '2023-09-20', '2023-09-20', 'Sim', 1, 'Conta', 'sem-foto.png', 1, NULL, 'testte', NULL, NULL, NULL),
(9, 'teste2', '150.00', 23, '2023-09-20', '2023-09-28', NULL, 'Não', 1, 'Conta', 'sem-foto.png', NULL, NULL, '', NULL, NULL, NULL),
(10, 'teste', '150.00', 0, '2023-09-24', '2023-09-24', NULL, 'Não', 1, 'Conta', 'sem-foto.png', NULL, NULL, '', NULL, NULL, NULL),
(11, 'teste', '150.00', 23, '2023-09-25', '2023-09-25', NULL, 'Não', 1, 'Conta', 'sem-foto.png', NULL, NULL, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `hospede` int(11) NOT NULL,
  `tipo_quarto` int(11) NOT NULL,
  `quarto` int(11) NOT NULL,
  `funcionario` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `no_show` decimal(8,2) NOT NULL,
  `hospedes` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `valor_diaria` decimal(8,2) DEFAULT NULL,
  `data` date NOT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `forma_pgto` int(11) DEFAULT NULL,
  `hora_checkin` time DEFAULT NULL,
  `hora_checkout` time DEFAULT NULL,
  `valor_checkin` decimal(8,2) DEFAULT NULL,
  `valor_checkout` decimal(8,2) DEFAULT NULL,
  `tipo_pgto_checkin` int(11) DEFAULT NULL,
  `tipo_pgto_checkout` int(11) DEFAULT NULL,
  `placa` varchar(30) DEFAULT NULL,
  `funcionario_checkin` int(11) DEFAULT NULL,
  `funcionario_checkout` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `hospede`, `tipo_quarto`, `quarto`, `funcionario`, `check_in`, `check_out`, `valor`, `no_show`, `hospedes`, `obs`, `valor_diaria`, `data`, `desconto`, `forma_pgto`, `hora_checkin`, `hora_checkout`, `valor_checkin`, `valor_checkout`, `tipo_pgto_checkin`, `tipo_pgto_checkout`, `placa`, `funcionario_checkin`, `funcionario_checkout`) VALUES
(1, 23, 6, 1, 1, '2023-08-14', '2023-08-16', '799.98', '399.99', 1, '', '399.99', '2023-08-14', '0.00', 2, '18:36:56', NULL, '399.99', NULL, 2, NULL, '', 1, NULL),
(2, 1, 6, 2, 1, '2023-08-14', '2023-08-14', '399.99', '200.00', 1, '', '399.99', '2023-08-14', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 6, 3, 1, '2023-08-14', '2023-08-18', '1599.96', '799.98', 1, '', '399.99', '2023-08-14', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 23, 14, 13, 1, '2023-08-15', '2023-08-17', '1598.00', '799.00', 1, '', '799.00', '2023-08-14', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 23, 6, 4, 1, '2023-08-14', '2023-08-19', '1999.95', '999.98', 1, '', '399.99', '2023-08-14', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, 2, 1, '2023-08-15', '2023-08-18', '1199.97', '599.99', 1, '', '399.99', '2023-08-14', '0.00', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `saidas`
--

INSERT INTO `saidas` (`id`, `produto`, `quantidade`, `motivo`, `usuario`, `data`) VALUES
(1, 3, 5, 'Furto', 1, '2023-03-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `nome`, `valor`, `descricao`, `categoria`, `ativo`, `foto`) VALUES
(3, 'Massagem Bambu', '110.00', 'Massagem Bambu', 3, 'Sim', '28-03-2023-17-04-16-BAMBU.jpg'),
(4, 'Massagem Chinesa', '150.00', '', 3, 'Sim', '28-03-2023-17-39-16-CHINESA.jpg'),
(5, 'Massagem com Pedras', '150.00', '', 3, 'Sim', '28-03-2023-17-39-29-PEDRAS.jpg'),
(6, 'Passeio de Barco', '120.00', '', 1, 'Sim', '28-03-2023-18-11-37-BARCO.jpg'),
(7, 'Passeio de Bug', '180.00', '', 1, 'Sim', '28-03-2023-17-40-00-BUG.jpg'),
(8, 'Mergulho Cilindro', '250.00', '', 1, 'Sim', '28-03-2023-17-40-20-MERGULHO.jpg'),
(9, 'Barba', '25.00', '', 4, 'Sim', '28-03-2023-17-40-35-BARBA.jpg'),
(10, 'Corte Masculino', '30.00', '', 4, 'Sim', '28-03-2023-17-40-49-CORTE-MASCULINO.jpg'),
(11, 'Manicure', '45.00', '', 4, 'Sim', '28-03-2023-17-40-58-MANICURE.jpg'),
(12, 'Aeroporto Carro', '200.00', '', 2, 'Sim', '28-03-2023-17-41-23-CARRO.jpg'),
(13, 'Aeroporto Van', '350.00', '', 2, 'Sim', '28-03-2023-17-41-38-VAN.jpg'),
(14, 'Aeroporto Ônibus', '650.00', '', 2, 'Sim', '28-03-2023-17-41-57-MICRO-ONIBUS.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`id`, `nome`) VALUES
(3, 'Rouparia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_jornada`
--

CREATE TABLE `tipos_jornada` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipos_jornada`
--

INSERT INTO `tipos_jornada` (`id`, `nome`) VALUES
(3, 'Abastecimento'),
(4, 'Coleta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_recursos`
--

CREATE TABLE `tipos_recursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipos_recursos`
--

INSERT INTO `tipos_recursos` (`id`, `nome`) VALUES
(0, 'Emenda Parlamentar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turnos`
--

INSERT INTO `turnos` (`id`, `nome`) VALUES
(1, 'Manhã');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` int(11) NOT NULL,
  `razaoSocial` varchar(50) NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `nomeContato` varchar(50) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cep` varchar(15) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(250) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unidades`
--

INSERT INTO `unidades` (`id`, `razaoSocial`, `cnpj`, `telefone`, `nomeContato`, `celular`, `email`, `cep`, `endereco`, `bairro`, `cidade`, `estado`, `numero`, `complemento`, `data`) VALUES
(1, 'Restinga', '04.994.418/0001-13', '(51) 91515-155', 'TESE TESE', '5151515155', 'DEDE@EDE.COM', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '751', 'funcionou', '2023-09-11'),
(4, 'Charqueadas', '04.994.418/0001-12', '(15) 15151-515', 'Teste', '26262', 'rafael@leindecker.com', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '251', 'teste', '2023-09-16'),
(6, 'Associação Hospitalar Vila Nova', '01.414.141/4141-41', '(51) 32458-940', 'Teste', '2515151515', 'rafael@leindecker.com', '91750-170', 'Rua Tomé Antônio de Souza', 'Campo Novo', 'Porto Alegre', 'RS', '155', 'complemento', '2023-09-16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `senha_crip` varchar(130) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `senha_crip`, `nivel`, `ativo`, `telefone`, `endereco`, `foto`, `data`, `token`) VALUES
(1, 'Administrador', 'rafa@rafa.com.br', '123', '202cb962ac59075b964b07152d234b70', 'Administrador Sistema', 'Sim', '(51) 99317-6006', 'fsafa', '03-01-2024-08-40-47-rafa.jpeg', '2023-02-27', ''),
(7, 'teste ', 'testeleindecker@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Administrador', 'Sim', '(51) 99317-6008', '', 'sem-foto.jpg', '2023-11-03', '005d56021c828def2831be402be429e485665ac7e522e5405526b0f383175c9b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `usuario`, `permissao`) VALUES
(1, 1, 29),
(2, 2, 35),
(103, 1, 14);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `banners_site`
--
ALTER TABLE `banners_site`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias_produtos`
--
ALTER TABLE `categorias_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias_quartos`
--
ALTER TABLE `categorias_quartos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias_servicos`
--
ALTER TABLE `categorias_servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dados_site`
--
ALTER TABLE `dados_site`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `especificacoes`
--
ALTER TABLE `especificacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fotos_quartos`
--
ALTER TABLE `fotos_quartos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contrato` (`contrato`);

--
-- Índices para tabela `galeria_site`
--
ALTER TABLE `galeria_site`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hospedes`
--
ALTER TABLE `hospedes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `parlamentares`
--
ALTER TABLE `parlamentares`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `plano_trabalho`
--
ALTER TABLE `plano_trabalho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `quartos`
--
ALTER TABLE `quartos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receber`
--
ALTER TABLE `receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipos_jornada`
--
ALTER TABLE `tipos_jornada`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `banners_site`
--
ALTER TABLE `banners_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categorias_produtos`
--
ALTER TABLE `categorias_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categorias_quartos`
--
ALTER TABLE `categorias_quartos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `categorias_servicos`
--
ALTER TABLE `categorias_servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dados_site`
--
ALTER TABLE `dados_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `especificacoes`
--
ALTER TABLE `especificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `formas_pgto`
--
ALTER TABLE `formas_pgto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fotos_quartos`
--
ALTER TABLE `fotos_quartos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `galeria_site`
--
ALTER TABLE `galeria_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `hospedes`
--
ALTER TABLE `hospedes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `marketing`
--
ALTER TABLE `marketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `parlamentares`
--
ALTER TABLE `parlamentares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `plano_trabalho`
--
ALTER TABLE `plano_trabalho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `quartos`
--
ALTER TABLE `quartos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipos_jornada`
--
ALTER TABLE `tipos_jornada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
