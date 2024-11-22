-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Nov-2024 às 22:00
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `book`
--

CREATE TABLE `book` (
  `idBook` int(11) NOT NULL,
  `IdImovel` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `book`
--

INSERT INTO `book` (`idBook`, `IdImovel`, `path`, `data_upload`, `nome`) VALUES
(1, 21, 'book/TERRACE Book Tecnico.pdf', '2024-10-17 10:25:54', 'Certidão José.pdf'),
(2, 2, 'book/Book Blend.pdf', '2024-10-17 10:26:52', 'CNH José.pdf'),
(3, 22, 'book/671115db35e6c.pdf', '2024-10-17 10:49:15', 'HM072-INTENSE-CAMPOS ELÍSEOS-Book do Corretor-BONECO-R01.pdf'),
(4, 23, 'book/673cd6d59c3b3.pdf', '2024-11-19 15:20:05', 'epic_book_digital.pdf'),
(5, 24, 'book/673cdb4d36ad2.pdf', '2024-11-19 15:39:09', 'Lumi_Book Vertical.pdf'),
(6, 25, 'book/673cde01936b4.pdf', '2024-11-19 15:50:41', 'vox_book_digital.pdf'),
(7, 26, 'book/673cdf584ce2a.pdf', '2024-11-19 15:56:24', 'one_book_vertical_(breve lançamento) - VERSAO FINAL.pdf'),
(8, 27, 'book/673ce1b46e1bc.pdf', '2024-11-19 16:06:28', 'Icon_Book Vertical (lançamento).pdf'),
(9, 28, 'book/673ce8bd0d388.pdf', '2024-11-19 16:36:29', 'Wide_book_vertical_jun-22.pdf'),
(10, 31, 'book/673cecf54c06c.pdf', '2024-11-19 16:54:29', 'Neo_book_vertical_set-22.pdf'),
(11, 34, 'book/673dd09f507da.pdf', '2024-11-20 09:05:51', 'Book Residencial Celestial.pdf'),
(12, 35, 'book/673dd2f26574b.pdf', '2024-11-20 09:15:46', 'Book Residencial Colorado.pdf'),
(13, 36, 'book/673dd5811bb64.pdf', '2024-11-20 09:26:41', 'BOOK-COSTA-DOS-VENTOS-30x20.pdf'),
(14, 37, 'book/673dda1516c07.pdf', '2024-11-20 09:46:13', 'Book Costa do Alpês.pdf'),
(15, 38, 'book/673dde9830b20.pdf', '2024-11-20 10:05:28', '639.6_css_cores_do_poente_fdr_dig_1080x1920px_v3.pdf'),
(16, 39, 'book/673de4b5b2c83.pdf', '2024-11-20 10:31:33', 'Book_Villagio_Garden_Final.pdf'),
(17, 40, 'book/673e129552d1d.pdf', '2024-11-20 13:47:17', 'Book Maxy São Bernardo.pdf'),
(18, 41, 'book/673e16ea535bb.pdf', '2024-11-20 14:05:46', 'book-maxy-bela-alianca-1.pdf'),
(19, 42, 'book/673e1b1bbef0b.pdf', '2024-11-20 14:23:39', 'MABA2-BookMobile.pdf'),
(20, 45, 'book/673e37d9161bf.pdf', '2024-11-20 16:26:17', 'BOOK - LINK VILA UNIÃO.pdf'),
(21, 48, 'book/673e3fb387134.pdf', '2024-11-20 16:59:47', 'BOOK TREINAMENTO CORRETORES -CANTO-DA-MATA-30x20 (1).pdf'),
(22, 50, 'book/673e58f769a47.pdf', '2024-11-20 18:47:35', 'Novo Book Corretor Smart Ouro  Verde_dez 23.pdf'),
(23, 52, 'book/673f3e1183ada.pdf', '2024-11-21 11:05:05', 'BOOK RES CANOAS.pdf'),
(24, 53, 'book/673f424505cfc.pdf', '2024-11-21 11:23:01', 'BOOK RISE - PARQUE PRADO .pdf'),
(25, 54, 'book/673f44970a786.pdf', '2024-11-21 11:32:55', 'Book Seleto.pdf'),
(26, 56, 'book/673f735294b93.pdf', '2024-11-21 14:52:18', 'Ebook-Perolas.pdf'),
(27, 58, 'book/673f79eeac909.pdf', '2024-11-21 15:20:30', 'BOOK Vive e Realize 4_compressed.pdf'),
(28, 59, 'book/673f857d31933.pdf', '2024-11-21 16:09:49', 'Book_Dom_Pedro_Digital.pdf'),
(29, 60, 'book/673f88d6b0e55.pdf', '2024-11-21 16:24:06', 'Book Intense Valinhos.pdf'),
(30, 61, 'book/Book San Pietro DIGITAL.pdf', '2024-11-21 17:23:52', 'Book San Pietro DIGITAL.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadimovel`
--

CREATE TABLE `cadimovel` (
  `IdImovel` int(11) NOT NULL,
  `NomeImovel` varchar(50) NOT NULL,
  `Estado` varchar(2) DEFAULT NULL,
  `Cidade` varchar(30) DEFAULT NULL,
  `Bairro` varchar(200) DEFAULT NULL,
  `Estagio` varchar(15) DEFAULT NULL,
  `Tipo` varchar(20) DEFAULT NULL,
  `Quartos` varchar(11) DEFAULT NULL,
  `Suites` varchar(11) DEFAULT NULL,
  `Vagas` varchar(11) DEFAULT NULL,
  `Preco` double(20,2) DEFAULT NULL,
  `DataEntrega` date DEFAULT NULL,
  `Area` varchar(10) DEFAULT NULL,
  `Descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadimovel`
--

INSERT INTO `cadimovel` (`IdImovel`, `NomeImovel`, `Estado`, `Cidade`, `Bairro`, `Estagio`, `Tipo`, `Quartos`, `Suites`, `Vagas`, `Preco`, `DataEntrega`, `Area`, `Descricao`) VALUES
(2, 'Living Blend', 'SP', 'Campinas', 'Av. Governador Pedro de Toledo, 334 - Bonfim', 'Em construção', 'Apartamento', '2 a 3', '1 a 2', '1 a 2', 450000.00, '2025-06-01', '55 a 80', 'Morar aqui é uma ótima escolha para quem busca uma localização privilegiada e infraestrutura completa. Com ruas arborizadas, opções de transporte público e variedade de serviços e comércios, o Bonfim é um lugar tranquilo e bem estruturado, uma ótima escolha de lugar para se viver.\r\nO Bonfim fica próximo a importantes vias de acesso, como as avenidas Orozimbo Maia e Andrade Neves, facilitando o deslocamento para outras regiões da cidade, além de estar a poucos minutos do centro de Campinas, facilitando muito o dia a dia.\r\nPara quem gosta de praticar esportes e atividades ao ar livre, o Bonfim também oferece diversas opções de parques e praças, como o Bosque dos Jequitibás e a Praça Arautos da Paz, onde é possível fazer caminhadas, praticar exercícios físicos e relaxar em contato com a natureza.'),
(3, 'Santorini Residence', 'SP', 'Campinas', 'R. Alzira Marcondes, 200 - Jardim Ipaussurama', 'Em construção', 'Apartamento', '2', '0', '1', 270000.00, '2027-01-01', '38 a 40', 'O Santorini Residence está localizado na Av. John Boyd Dunlop, a região que mais cresce e se desenvolve em Campinas. \r\n\r\nEssa região possui grande diversidade de comércios e serviços, como escolas, hospitais e mercados. Pra se ter uma o empreendimento será construído praticamente em frente ao Hospital da Pucc e ainda conta com a estação Roseiras do BRT bem em frente ao condomínio. \r\n\r\nAssim sendo, aqui você tem fácil acesso às principais avenidas da cidade e também à Rodovia Anhanguera facilitando bastante a vida de se locomove pelas cidades vizinhas. '),
(4, 'Alameda Cerejeiras', 'SP', 'Campinas', 'Ouro Verde', 'Em construção', 'Apartamento', '2', '0', '1', 264000.00, '2026-08-01', '46', 'Lançamento Alameda das Cerejeiras na região do Ouro Verde.\r\n\r\nAptos de 2 dorms. com 1 vaga de garagem, unidades de 46 m².\r\n\r\nRegião valorizada em expansão, bairro novo e planejado, com condomínios independentes, entregue com as áreas comuns equipadas e decoradas. Lazer para toda a família, qualidade de vida e segurança para seus moradores.\r\n\r\nProduto pelo Minha Casa Minha Vida.\r\n\r\nAgende sua visita e garanta sua unidade.'),
(5, 'Mangará Campinas', 'SP', 'Campinas', 'Av. Graça Aranha, 175 – Vila Miguel Vicente Cury', 'Na Planta', 'Apartamento', '2', '1', '1', 372000.00, '2027-08-01', '45 a 89', 'A parceria entre DIRECIONAL e ACRO apresenta um conceito que olha para frente sem perder suas raízes. E é delas que surge o nosso nome: coração em Tupi significa Mangará. Um projeto que não apenas transforma o espaço físico, mas respeita a história e faz a emoção bater mais forte no peito de quem vive aqui.\r\n\r\nNo coração do Santa Genebra, ruas tranquilas e arborizadas se entrelaçam com uma área verde e um parque linear que abraça o seu lar e dita um novo compasso para viver. São apartamento de 2 dormitórios com suíte, varanda grill* lazer completo e vaga! Lazer dentro e fora de casa! Mangará Campinas, um parque pra chamar de seu!'),
(6, 'Encantos de Capri', 'SP', 'Hortolândia', 'R. Serra Dourada, Jardim Nova Alvorada', 'Na Planta', 'Apartamento', '2', '0 a 1', '1', 269000.00, '2026-01-01', '50 a 53', 'Conheça o Portal Encantos de Capri, o mais novo lançamento da BRZ Empreendimentos em frente ao Lago da Fé em Hortolândia.\r\n\r\nApartamentos na planta com 55 m² com excelente distribuição de espaço. São ao todo 2 quartos, com opção de suíte, sala para 2 ambientes em cozinha americana e uma maravilhosa varanda.\r\n\r\nO Condomínio é um verdadeiro convite a bem-estar. Possui lazer completo com piscina, academia, Quadra de beach tennis entre outros diversos itens de lazer. Tudo isso em meio a segurança de um condomínio fechado com itens de tecnologia como mercado privativo e vaga para carro elétrico.'),
(7, 'AUTHENTIC', 'SP', 'Campinas', 'Rua Antonio Lapa, 934, Cambuí', 'Na Planta', 'Apartamento', '3 a 4', '3', '3 a 4', 2424490.00, '2027-08-01', '155 a 311', 'Bem-vindo ao Authentic Cambuí.\r\nUm empreendimento de alto padrão no charmoso bairro Cambuí, em Campinas.\r\n\r\nLocalização privilegiada na esquina da Rua dos Bandeirantes com a Antônio Lapa, próximo a ruas arborizadas, boutiques elegantes e restaurantes de alta gastronomia.\r\n\r\n45 unidades Torre única com 25 andares e vistas panorâmicas Acabamentos de luxo Vantagens do Bairro Cambuí Gastronomia sofisticada, cultura vibrante, serviços essenciais e espaços verdes para momentos relaxantes. Antecipe-se ao lançamento e descubra seu futuro lar no Authentic Cambuí.'),
(8, 'Liv ', 'SP', 'Paulínia', 'Rua Paineira, 379 Alto de Pinheiros', 'Na Planta', 'Apartamento', '2', '0', '1 a 2', 269000.00, '2027-06-01', '44 a 45', 'Conheça o Liv Residencial, seu próximo apê em Paulínia! Aqui você mora em um apê de 2 dormitórios, varanda e opção de vagas de garagem cobertas, para tirar de vez seu carro do sol! Mas também não dá para esquecer do lazer, né? Com 2 churrasqueiras, piscina com raia e até uma quadra de areia, no Liv você encontra mais de 15 itens de lazer perfeitos para curtir seu final de semana.\r\n\r\nE aí, bora conhecer? ;)'),
(9, 'ARVO', 'SP', 'Hortolândia', 'R. Hjalmar Holdrich Gerhard Lindquist, 907 Parque Ortolândia', 'Em construção', 'Apartamento', '2', '1', '1', 269000.00, '2026-01-01', '50 a 75', 'Por aqui, quando pensamos em um empreendimento, o seu bem-estar e qualidade de vida sempre são prioridades. E tudo isso fica ainda mais claro quando olhamos para o Arvo Residencial. Com +20 itens de lazer e um apê com suíte e até varanda gourmet, tuudo foi planejado com o seu bem-estar em foco. Tem piscina com raia para aproveitar os dias de calor, Espaço churras para curtir um churrasquinho de final de semana e até o Longibeach: o espaço perfeito para jogar beach tennis ou vôlei de praia.\r\n\r\nE aí, curtiu? Então bora conhecer o Arvo ;)'),
(21, 'Terrace Resort Residence', 'SP', 'Campinas', 'Av. Padre Gaspar Bertoni 79 Jd Aurélia', 'Em construção', 'Apartamento', '3', '1', '2', 519656.20, '2027-10-01', '69.38', 'Terrace Resort Residence   Apartamentos de 69m² - 3 dormitórios com suíte, 2 vagas de garagem cobertas.  Condomínio Clube Resort, com 47 Espaços de Lazer Jardim Aurélia. A partir de R$519.656,20 (primeiras 20 unidades) Apartamentos de 69m² - 3 dormitórios com suíte, 2 vagas de garagem cobertas.  Condomínio Clube Resort, com 47 Espaços de Lazer Jardim Aurélia. Pontos de referência: ✅ Próximo do Balão do Tavares, Avenida Lix da Cunha ✅ Avenida do Supermercado Galassi ✅ Perto da Loja 1 da Sorveteria Sergel ✅ Rotatória do Posto de Combustíveis Chácara do Vovô ✅ Perto da Padaria São Judas  ✅ Perto da rotatória do Restaurante Cuiabar.'),
(22, 'HM Intense Campos Elíseos', 'SP', 'Campinas', 'Rua Danilo Glauco Pereira Vilagelin, n° 121 - Jardim Campos Elíseos', 'Na Planta', 'Apartamento', '1 a 2', '0', '0 a 2', 237800.00, '2027-08-01', '33.62 a 43', 'O empreendimento **HM Intense Campos Elíseos** conta com aproximadamente 5.800 m², 304 unidades distribuídas em 2 torres de 18 andares (com 8 unidades por andar e 2 elevadores). As plantas variam entre 33 m², 42 m² e 43 m², com opções de 1 e 2 dormitórios, sendo que 90% das unidades possuem vaga de garagem. A portaria tem um design moderno com acabamentos em madeira.\r\n\r\nA área de lazer é equipada e decorada, oferecendo piscina adulto e infantil, espaço gourmet com churrasqueira e forno de pizza, playkids, academia, pet place, praça familiar, pomar, bicicletário e praça lual.'),
(23, 'Epic', 'Sp', 'Monte Mor', 'Jard. Residencial Veneza 1', 'Na Planta', 'Apartamento', '2', '0', '1', 220000.00, '2026-12-01', '38 a 59', 'Com uma portaria com ferramentaria, mini mercado e um lounge inspirado nas recepções dos hotéis, fica fácil dizer que o Epic justifica seu nome logo de cara.\r\n\r\nAqui, seu futuro apê tem 2 dormitórios, opção de varanda e uma área de lazer impecável! Se liga em tudo à sua disposição: uma piscina com raia para curtir os dias quentes, o espaço churras e espaço festas para aproveitar as suas comemorações e vááários boulevards floridos entre as torres, aqui o que não faltam são opções para aproveitar o seu tempo livre.\r\n\r\nRenda Ideal: R$ 3.000,00'),
(24, 'Lumi', 'Sp', 'Sumaré', 'Bela Vista', 'Na Planta', 'Apartamento', '2', '0', '1', 236000.00, '2026-10-01', '40 a 63', 'Conheça o Lumi Residencial, um condomínio com o conforto que você já conhece + um lazer que te surpreende. No lumi, seu futuro 2 dorms. conta com varanda, opção de garden nas unidades térreas e + de 20 itens de lazer! Tem portaria com lounge para causar uma ótima primeira impressão, piscina com raia para curtir o fds do jeito certo, espaço pet para aproveitar com seu melhor amigo e muuuuito mais…\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(25, 'Vox', 'Sp', 'Sumaré', 'Jardim Denadai', 'Na Planta', 'Apartamento', '2', '0', '1', 234000.00, '2027-02-01', '40 a 63', 'Conheça o Vox, um empreendimento com apartamentos de 2 dormitórios acompanhados de uma área de lazer que foge do esperado. Lounge de recepção, Cine Open Air, LongiGolf e piscina com raia são só algumas das opções de lazer que você tem por aqui\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(26, 'One', 'SP', 'Sumaré', 'Jardim Monte Santo', 'Na Planta', 'Apartamento', '2', '0', '1', 240000.00, '2025-10-01', '40 a 63', 'Uma torre única rodeada de lazer. Esse é o One, seu futuro apê em Sumaré. Aqui, você encontra apês com 2 dormitórios, varanda e opção de garden com 2 vagas de garagem. E quando o assunto é lazer, no One você conta com uma piscina com raia para dar aquele mergulho nos dias quentes, espaço pet para aproveitar com seu melhor amigo, LongiFit para manter a saúde em dia e mais de 10 outros itens de lazer para curtir seu tempo livre.  .  Renda Ideal: R$ 3.500,00'),
(27, 'Icon', 'SP', 'Sumaré', 'Nova Veneza', 'Na Planta', 'Apartamento', '2', '0', '1', 240000.00, '2026-02-01', '40 a 63', 'Conheça o Icon Residence Club, um condomínio com uma área de lazer planejada para fazer inveja em muitos clubes por aí.\r\n\r\nAqui, seu futuro apê tem 2 quartos, varanda, vaga para 2 carros e garden em todas as unidades do térreo. Mas você deve estar se perguntando \"e o lazer de clube?”. Pode ficar tranquilo, porque aqui você curte uma piscininha perfeita para o calor, uma quadra gramada e outra de areia para jogar o que quiser, e 2 churrasqueiras, ideais para aquele churrasco no final de semana.\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(28, 'Wide', 'SP', 'Monte Mor', 'Jardim Roseira', 'Em construção', 'Casa Sobreposta', '2', '0', '1', 230000.00, '2024-12-01', '40 a 55', 'Se eu te dissesse que agora você pode morar em uma casa americana, daquelas que você só vê em filmes e ainda ter todo o lazer e segurança que um condomínio fechado pode oferecer, você acreditaria?\r\n\r\nVocê encontra isso e muito mais aqui no Wide Monte Mor, o primeiro condomínio de Townhouses da cidade! São townhouses de 2 dorms. com a opção de garden ou varanda, trazendo todo o conforto que você e sua família merecem. Sem falar nos mais de 15 itens de lazer! Tem piscina, salão de festa, churrasqueira e vááárias alamedas temáticas espalhadas pelo empreendimento.\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(30, 'Evo', 'SP', 'Sumaré', 'Bela Vista', 'Na Planta', 'Apartamento', '2', '1', '1', 254000.00, '2027-03-01', '46 a 69', 'Do lado de dentro: suíte, varanda gourmet e opção de garden. Do lado de fora: piscina com raia. LongiBeach, quadra de futebol e mais de 20 outros itens de lazer. Curtiu? Esse é só um gostinho do que te espera no Evo, seu futuro apê em Sumaré!'),
(31, 'Neo', 'SP', 'Hortolândia', 'Jardim Monaco', 'Em construção', 'Apartamento', '2', '0 a 1', '1', 267000.00, '2025-02-01', '50 a 79', 'Quando pensamos em um condomínio completo, pensamos em piscina, salão de festa, churrasqueira e talvez uma quadrinha de futebol, né? Se essa é a definição de completo, o Neo chegou em Hortolândia para ser mais que completo!\r\n\r\nCom seus dois quartos, suíte, as opções de garden para o térreo e uma varanda gourmet para os demais andares, o Neo é o empreendimento perfeito para você que sempre busca o melhor.\r\n.\r\nRenda Ideal: R$ 4.000,00'),
(33, 'Encantos de Toscana', 'SP', 'Hortolândia', 'Viário Santa Fé', 'Em construção', 'Apartamento', '2', '1', '1', 271000.00, '2025-08-01', '50 a 53', 'PORTAL ENCANTOS DE TOSCANA - Portaria fechada com controle de acesso - Paisagismo em todo o empreendimento HORTOLÂNDIA | SP\r\n\r\nSETEMBRO/2023 até Setembro/25\r\n\r\n● CONDOMÍNIO FECHADO ● 4 E 8 APTOS POR ANDAR ● 300 UNIDADES ● PORTAL DE ACESSO ● 15 ANDARES\r\n\r\n● 350 VAGAS\r\n\r\n● APTOS DE 44,74m²/ à 54,94m²\r\n\r\n● PISCINAS ADULTO ● SOLÁRIO ● CHURRASQUEIRA ● SALÃO DE FESTAS COM CHURRASQUEIRA ● PET PLACE ● EMPÓRIO ● HOUSI CAFÉ ● VENDING MACHINE ADEGA/PET/FARMÁCIA ● BICICLETÁRIO\r\n\r\n\r\n\r\n• EMPÓRIO • CHURRASQUEIRA • PISCINAS ADULTO E INFANTIL • SOLÁRIO • SALÃO DE FESTAS • PET PLACE • BICICLETÁRIO • PLAYGROUND • QUADRA DE BEACH TENNIS • ACADEMIA • COWORKING\r\n\r\n\r\n\r\nITENS DE LAZER E CONVENIÊNCIA\r\n\r\nPortaria fechada com controle de acesso Paisagismo em todo o empreendimento Salão de festas com: Cozinha de apoio Churrasqueira Varanda Banheiros Churrasqueira com: Bicicletário Coworking Piscinas adulto e infantil Solário: espaço para sol e descanso Playground Quadra de Beach Tennis Pet Place\r\n.\r\nRenda Ideal: R$ 4.500,00'),
(34, 'Celestial', 'SP', 'Campinas', 'Jardim Yeda', 'Na Planta', 'Apartamento', '2', '0', '1', 270000.00, '2026-02-01', '36 a 39', 'Trazendo mais modernidade para um bairro quase todo de casas, o Residencial Celestial chega como a marca de um \r\nnovo tempo no Jardim Yeda. E mais do que suas torres altas, elevadores, apartamentos superconfortáveis e lazer com \r\npiscina, o que vai encantar você são as noites de céu estrelado na sua sacada! Mas durante o dia, morar perto da Havan, \r\nsupermercados, creches, escolas, faculdades e importantes vias de acesso, também vai fazer muita diferença na sua vida.\r\n.\r\nRenda Ideal: R$ 3.800,00'),
(35, 'Colorado', 'SP', 'Campinas', 'Jardim Yeda', 'Em construção', 'Apartamento', '2', '0', '0 a 1', 250000.00, '2026-01-01', '36 a 37', 'O Residencial Colorado tem tudo que você sempre buscou, apartamentos de 2 dormitórios em condomínio fechado com excelente localização no Jardim Yeda, que vai trazer toda a praticidade e conforto para a sua vida.\r\n\r\nViva próximo a tudo que você precisa no dia a dia, com a comodidade de torres com elevador e a segurança de um condomínio fechado. E o melhor, os subsídios do programa do governo te ajudam a economizar muito dinheiro na hora de realizar esse sonho.\r\n.\r\nRenda ideal: R$ 3.800,00'),
(36, 'Costa dos Ventos', 'SP', 'Campinas', 'Fazenda São Quirino', 'Na Planta', 'Apartamento', '2', '0', '1', 285000.00, '2026-07-01', '36 a 39', 'Condomínio Costa dos Ventos\r\n\r\n\r\nApartamentos de 2 dormitórios na Região do Jardim Madalena, em condomínio fechado com lazer completo.\r\n\r\nMais que um apartamento, o novo jeito MRV de viver. O Costa dos Ventos oferece: lazer equipado, coleta seletiva, sistema de segurança, portas especiais, laminado na sala e quartos e muito mais.\r\n.\r\nRenda Ideal: R$ 4.500,00'),
(37, 'Costa dos Alpes', 'SP', 'Campinas', 'Jardim Paraíso Viracopos', 'Em Construção', 'Apartamento', '2', '0', '1', 266000.00, '2025-07-01', '36 a 39', 'Costa dos Alpes é lugar ideal para você e sua família, em torre única, com elevador e área de lazer o condomínio vai te proporcionar muita comodidade e fácil acesso a diversas regiões da cidade.\r\n\r\nOs apartamentos contam com 2 dormitórios com opção de varanda, que será um verdadeiro mirante de Campinas e da região do Jardim Paraíso de Viracopos. Seus dias se tornaram muito mais práticos vivendo próximo a escolas, supermercados, parques e muito mais.\r\n.\r\nRenda Ideal: R$ 4.000,00'),
(38, 'Cores do Poente', 'SP', 'Campinas', 'Sete Sóis, Florence ', 'Na Planta', 'Apartamento', '2', '0', '0 a 1', 223000.00, '2025-07-01', '40', 'As cidades inteligentes são uma verdadeira evolução no jeito de morar. E o Cores do Poente torna tudo isso possível dentro de um apê pensado para quem quer começar uma vida nova morando num apê que é seu: apartamentos com 2 dormitórios com opção de área privativa: mais espaço para aproveitar, opção de vaga de garagem, área de lazer que encanta, espaço com playground, pet place e bicicletário e mais: espaço gourmet com churrasqueira.\r\n.\r\nRenda Ideal: R$ 3.000,00'),
(39, 'Villagio', 'SP', 'Campinas', 'Vila Garden', 'Em Construção', 'Apartamento', '2', '0', '0 a 1', 295000.00, '2025-07-01', '36 a 39', 'Conheça a sua última oportunidade de morar no Villa Garden! O 9° condomínio desse excelente projeto, Villagio Garden. Condomínio fechado com apartamentos de 1 e 2 dormitórios na Região da Vila Industrial com elevador, todos com vaga de garagem. Conforto, tranquilidade, segurança e lazer você encontra aqui.\r\n\r\nMais que um apartamento, o novo jeito MRV de viver. O Villagio Garden oferece: lazer equipado, coleta seletiva, sistema de segurança, energia solar nas áreas comuns, laminado na sala e quartos (excéto térreo) e muito mais.\r\n.\r\nRenda Ideal: R$ 5.000,00'),
(40, 'Maxy São Bernardo', 'SP', 'Campinas', 'São Bernardo', 'Na Planta', 'Apartamento', '2', '1', '1', 420000.00, '2027-07-01', '52', 'Descubra o novo empreendimento em Campinas, Breve lançamento MAXY Sao Bernardo. Apartamentos de 2 dormitórios com suite, localizados no bairro Sao Bernardo em Campinas, oferecendo conforto e praticidade.  Os apartamentos do MAXY Sao Bernardo foram projetados para proporcionar o máximo de conforto e funcionalidade. Cada unidade conta com dois dormitórios, sendo um deles uma suíte, e áreas úteis de 56,74 m² e 56,67 m². Com um total de 152 unidades distribuídas em um terreno de 3.852,78 m², o empreendimento oferece oito unidades por andar e é servido por quatro elevadores, garantindo rapidez e eficiência no deslocamento. Cada apartamento possui vaga de garagem, além de vagas adicionais para visitantes e motos, proporcionando comodidade e segurança para os moradores e seus convidados.\r\n.\r\nRenda Ideal: R$ 10.000,00'),
(41, 'Maxy Bela Aliança 1', 'SP', 'Campinas', 'Bela Aliança', 'Em Construção', 'Apartamento', '2', '0', '1', 310000.00, '2024-12-01', '51 e 52', 'Apartamento Max Bela Aliança proximo da Pirelli. 2 DORMS. varanda integrada lazer entregue equipado e decorado vaga na garagem melhor região da John Boyd a 3 min do Shopping Parque das Bandeiras. 2 plantas pensadas para deixar a sua vida melhor\r\n\r\nPreparação para 2 pontos de ar-condicionado\r\n\r\nPersiana de enrolar que permite o dobro de luminosidade\r\n\r\nVaranda integrada à cozinha Tomada USB na sala\r\n\r\nMaxy Bela Aliança 1\r\n\r\n\r\n\r\n2 dorms., sala com varanda integrada 51,41 m² e 52,25 m²\r\n\r\n168 vagas, sendo 5 vagas para PCD 9\r\n.\r\nRenda Ideal: R$ 6.000,00'),
(42, 'Maxy Bela Aliança 2', 'SP', 'Campinas', 'Bela Aliança', 'Na Planta', 'Apartamento', '2', '0', '1', 290000.00, '2026-02-01', '52', 'Obras iniciadas no Maxy Bela Aliança. Muito conforto, segurança e praticidade em mais um empreendimento de sucesso na Região da Avenida John Boyd Dunlop em Campinas.\r\n\r\nPlantas de 52m² com 2 dormitórios, uma ampla Varanda Gourmet, dormitórios espaçosos e vaga de garagem em um empreendimento com lazer completo. O Maxy Bela Aliança será construído bem ao lado do Bela Aliança Bairro e Parque Condomínio, e em frente a estação do Terminal BRT Satélite Iris, na região da Av. Jonh Boyd Dunlop.\r\n\r\nO Bela Aliança traz um novo conceito de bairro planejado com grandes áreas verdes preservadas, lazer de clube, terrenos amplos e infraestrutura completa de comércio e serviços.'),
(43, 'Maxy Santana', 'SP', 'Hortolândia', 'Parque Ortolândia', 'Pronto', 'Apartamento', '2', '0', '1', 320000.00, '2023-12-01', '56 a 94', 'CONDOMÍNIO MAXY SANTANA \" da incorporadora FYP, na Avenida Santana, próximo à UNASP. São apartamentos de 2 dorms com suíte e lazer que atende toda família. Localizado na Avenida Santana, onde a entrada e acesso ao seu condomínio te oferece muita segurança. próximo à vários comércios e serviços que facilitam o seu dia a dia. Aproveite, e já se antecipe fazendo seu cadastro para obter vantagens de lançamento.\r\n.\r\nRenda Ideal: R$ 7.000,00'),
(44, 'Recanto dos Ipês', 'SP', 'Campinas', 'Jardim Florence 2', 'Na Planta', 'Apartamento', '2', '0', '1', 228000.00, '2027-12-01', '46', 'O Recanto dos Ipês espera você e sua família com apartamentos em um condomínio fechado e área de lazer completa.\r\nO empreendimento conta com a melhor e mais moderna infraestrutura do mercado, na melhor localização do distrito do Campo Grande. '),
(45, 'Residencial Link', 'SP', 'Campinas', 'Vila União', 'Na Planta', 'Apartamento', '2', '0', '0 a 1', 250000.00, '2027-12-01', '40 e 41', 'Um novo empreendimento imobiliário está chegando a Campinas, com apartamentos de 2 dormitórios, varanda e lazer completo. Estrategicamente localizado,próximo a serviços essenciais o Residencial Link promete conforto e praticidade para diversos perfis de moradores e investidores.\r\nDestaque para as áreas de lazer, como piscina e espaços de convivência, que prometem momentos de relaxamento e diversão. Design contemporâneo e infraestrutura de qualidade, o lançamento promete transformar sua vida.\r\n.\r\nRenda Ideal: 3.800,00'),
(48, 'Canto da Mata', 'SP', 'Campinas', 'Região do Matão', 'Na Planta', 'Apartamento', '2', '0', '1', 250000.00, '2026-07-01', '37 a 40', 'Os apartamentos em Campinas estão em excelente localização em um condomínio fechado com todo o conforto, tranquilidade, segurança. Residencial Canto Da Mata vai te surpreender com apartamento de 2 dormitórios que possuem ambientes integrados. O lazer vai te proporcionar experiências em família e momentos para celebrar com amigos, com área de lazer para toda a família incluindo piscina adulto e infantil, salão de festas, espaço de gourmet e muito mais.\r\n.\r\nRenda Ideal: R$ 4.000,00'),
(49, 'Jardins Novolar', 'SP', 'Campinas', 'Jardim Floresta, Campo Grande', 'Na Planta', 'Apartamento', '2', '0', '1', 245000.00, '2027-12-01', '41 a 43', 'A Novolar chega em Campinas com a tradição de uma das principais Construtoras do Brasil. Parte do Grupo Patrimar, com mais de 60 anos de história, atuamos em Minas Gerais, São Paulo e Rio de Janeiro, construindo empreendimentos que combinam sustentabilidade, inovação, diferenciais exclusivos e qualidade em todos os detalhes. Um empreendimento que traz tudo o que você precisa para viver dias inesquecíveis. Inovação, qualidade e sustentabilidade, perto de tudo, inclusive do verde e da tranquilidade.\r\n.\r\nRenda Ideal: R$ 3.800,00'),
(50, 'HM Smart Ouro Verde', 'SP', 'Campinas', 'Parque Universitario de Viracopos', 'Em Construção', 'Apartamento', '2', '0', '1', 230000.00, '2025-10-01', '35 a 36', 'Descrição do imóvelHM SMART BEM MORAR OURO VERDE - LANÇAMENTO APARTAMENTO\r\n\r\nAPARTAMENTOS NA PLANTA DE 02 DORMITÓRIOS\r\nA PARTIR DE R$ 170 MIL\r\nPREVISÃO DE ENTREGA: 1º SEMESTRE 2025\r\n\r\n***Valores e condições SOB CONSULTA\r\nPois variam de acordo com a torre, andar, especificações, entre outros detalhes.\r\nENTRE EM CONTATO PARA ADQUIRIR SEU PRIMEIRO IMÓVEL!!\r\n* Programa Casa Verde e Amarela\r\n* Subsídio de até R$ 47 mil\r\n\r\nExcelente localização, em frente ao BRT, 6 min. Shopping Spazio Ouro Verde, 7 min. Rod. dos Bandeirantes.\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(52, 'Canoas', 'SP', 'Campinas', 'Rua Antônio José Pereira 80 (Região do Jardim Morumbi)', 'Na Planta', 'Apartamento', '2', '0', '1', 255000.00, '2027-06-01', '44 e 45', 'Conquiste a independência e a estabilidade de morar no apê que sempre sonhou. Aqui você garante uma vida mais prática e cheia de comodidade em uma região que oferece tudo que você gosta e precisa. O Residencial Canoas é a sua chance de navegar rumo aos seus melhores dias.\r\n\r\nSão apartamentos de 2 dormitórios com varanda ou opção de área privativa. E o lazer é incrível: desfrute o melhor da vida em um condomínio com piscinas, playground, pet place, bicicletário e área gourmet.\r\n.\r\nRenda Ideal: 3.500,00'),
(53, 'Rise', 'SP', 'Campinas', 'Parque Prado', 'Na Planta', 'Apartamento', '2', '0', '1', 264000.00, '2028-01-01', '42 e 43', 'No Parque Prado a felicidade está em cada esquina, com natureza, infraestrutura e equilíbrio. Viver nessa região é um privilégio para quem se permite voar mais alto. More próximo do Parque Prado com a Direcional. São apartamentos de 2 dorms, varanda grill, lazer completo em uma das melhores regiões de Campinas!\r\n.\r\nRenda Ideal: R$ 4.500,00'),
(54, 'Seleto', 'SP', 'Campinas', 'Jardim Yeda', 'Na Planta', 'Apartamento', '2', '0', '1', 280000.00, '2027-05-01', '44', 'Em breve na região da Amoreiras em Campinas, mais um sucesso de Vendas Prix e Direcional.\r\n\r\nSão Apartamentos de 2 dormitórios com varanda grill, lazer completo e vaga! Um condomínio moderno, seguro e cheio de diversão pra toda família. Em uma região que está em constante crescimento. Antecipe-se ao lançamento!\r\n.\r\nRenda Ideal: R$ 5.500,00'),
(56, 'Recanto das Perolas', 'SP', 'Hortolândia', 'bairro Jardim Santa Esmeralda', 'Na Planta', 'Apartamento e Casas ', '2', '0', '1', 230000.00, '2027-06-01', '40 a 55', '\r\nO RECANTO DAS PEROLAS é o mais novo lançamento da construtora ZUMA ENGENHARIA, localizado no bairro Jardim Santa Esmeralda em Hortolândia SP.\r\nEste empreendimento está no Programa Minha Casa Minha Vida, é perfeito para você. Chegou a hora de você conquistar o seu primeiro apartamento com muito conforto, segurança e praticidade.\r\n\r\nCom uma área privativa de 40m² este apartamento oferece plantas de 2 dormitórios, proporcionando ambientes modernos e aconchegante, você terá todo o espaço necessário para viver com qualidade de vida. Além disso, você terá 1 vaga de garagem já demarcada e vinculada ao seu apartamento garantindo a comodidade que você merece.\r\n.\r\nRenda Ideal: R$ 3.500,00'),
(58, 'Viva e Realize 4', 'SP', 'Campinas', 'Jardim Garcia', 'Na Planta', 'Apartamento', '2', '0', '1', 261000.00, '2027-03-01', '42 e 43', 'Mais um lançamento de apartamentos no Jardim Garcia, à poucos minutos do Shopping Unimart.\r\n\r\nUm empreendimento que tem tudo o que você procura: localização estratégica, lazer completo, tranquilidade, segurança e privacidade.\r\n\r\nO melhor custo-benefício da região!\r\n\r\nApartamentos de 2 dormitórios com varanda, ponto de ar condicionado, 1 vaga de garagem.\r\n\r\nOpção de plantas com quintal privativo.\r\n.\r\nRenda Ideal: R$ 5.500,00'),
(59, 'Viva e Realize D. Pedro', 'SP', 'Campinas', 'Região Dom Pedro', 'Na Planta', 'Apartamento', '2', '0', '1', 280000.00, '2026-07-01', '41 a 43', 'Mais um lançamento do Viva e Realize de excelente qualidade e comodidades pensadas de acordo com as\r\nsuas necessidades.\r\nUm empreendimento que tem tudo o que você procura: localização estratégica, perto do Parque D. Pedro\r\nShopping, lazer completo, tranquilidade, segurança e privacidade. O melhor custo-benefício da região, que\r\nainda oferece as facilidades e vantagens do programa Minha Casa Minha Vida da Caixa Econômica Federal\r\n.\r\nRenda Ideal: R$ 5.000,00'),
(60, 'HM Intense Valinhos', 'SP', 'Valinhos', 'Santa Ecolastica', 'Na Planta', 'Apartamento', '2', '0', '1', 300000.00, '2027-06-01', '53', 'HM Intense Valinhos\r\nApós sucesso de vendas em Campinas e Hortolândia.\r\n\r\nVem aí, breve lançamento em Valinhos!\r\n\r\nSão apartamentos de 2 dormitórios, 1 vaga de garagem. \r\n\r\nLazer completo com piscina, academia, pet place, coworking e muito mais!\r\n.\r\nRenda Ideal: R$ 5.000,00'),
(61, 'San Pietro', 'SP', 'Campinas', 'Mansões Santo Antônio', 'Na Planta', 'Apartamento', '1 a 2', '0 a 1', '1 a 2', 440000.00, '2027-06-01', '51 a 60', 'Inspirado na tradição européia, na tranquilidade das campinas e na beleza da arte renascentista, SAN PIETRO é mais do que um empreendimento; é a harmonia de bem viver. Descubra um novo padrão de vida, o seu lar na cidade mais desejada do interior paulista. Seja bem-vindo ao SAN PIETRO, onde a sua residência não é apenas um lugar para morar, mas um oásis em meio à metrópole.\r\n.\r\nRenda Ideal: R$ 9.000,00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `Id_cliente` varchar(16) NOT NULL,
  `idUser` int(11) NOT NULL,
  `Nome_Completo` varchar(255) DEFAULT NULL,
  `IdImovel` int(11) NOT NULL,
  `E_MAIL` varchar(255) NOT NULL,
  `Telefone` varchar(20) NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Estagio` int(11) DEFAULT NULL,
  `Data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`Id_cliente`, `idUser`, `Nome_Completo`, `IdImovel`, `E_MAIL`, `Telefone`, `Descricao`, `Estagio`, `Data_hora`) VALUES
('AoyBYcVKstiGAYrX', 2, 'Alef Jesus', 4, 'alef_endless@gmail.com', '19 99102-9276', 'gostou', 5, '2024-11-08 19:40:07'),
('fSw7chZpMMI8SmGC', 1, 'Rafael Oliveira', 9, 'rafael_endless@gmail.com', '19 99102-9675', 'vai deixar mais para frente', 10, '2024-11-08 20:31:49'),
('lNtL5woVYgsrJjNZ', 4, 'José Aviador', 8, 'Jose@gmail.com', '19 998453624', 'Cliente vai enviar documentação', 7, '2024-11-19 13:51:45'),
('vhgJEmGDahtXe25t', 1, 'ERICA DANIELLE DA SILVA SANTOS', 4, 'lv.doces3@gmail.com', '19991950356', 'r5wr6j6j', 5, '2024-11-08 20:32:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `IdDocumento` int(11) NOT NULL,
  `Id_cliente` varchar(16) NOT NULL,
  `idUser` int(11) NOT NULL,
  `RG_CPF` varchar(255) DEFAULT NULL,
  `Carteira_Trabalho` varchar(255) DEFAULT NULL,
  `Certidao_Casamento_Nascimento` varchar(255) DEFAULT NULL,
  `Holerites` varchar(255) DEFAULT NULL,
  `Comprovante_Residencia` varchar(255) DEFAULT NULL,
  `FGTS` varchar(255) DEFAULT NULL,
  `Imposto_Renda` varchar(255) DEFAULT NULL,
  `Ficha_COHAB` varchar(255) DEFAULT NULL,
  `Ficha_MOP` varchar(255) DEFAULT NULL,
  `Ficha_Cadastral` varchar(255) DEFAULT NULL,
  `RG_CPF_prop` varchar(255) DEFAULT NULL,
  `Carteira_Trabalho_prop` varchar(255) DEFAULT NULL,
  `Holerites_prop` varchar(255) DEFAULT NULL,
  `FGTS_prop` varchar(255) DEFAULT NULL,
  `Imposto_Renda_prop` varchar(255) DEFAULT NULL,
  `Dependente` varchar(255) DEFAULT NULL,
  `outros_I` varchar(255) DEFAULT NULL,
  `outros_II` varchar(255) DEFAULT NULL,
  `Data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`IdDocumento`, `Id_cliente`, `idUser`, `RG_CPF`, `Carteira_Trabalho`, `Certidao_Casamento_Nascimento`, `Holerites`, `Comprovante_Residencia`, `FGTS`, `Imposto_Renda`, `Ficha_COHAB`, `Ficha_MOP`, `Ficha_Cadastral`, `RG_CPF_prop`, `Carteira_Trabalho_prop`, `Holerites_prop`, `FGTS_prop`, `Imposto_Renda_prop`, `Dependente`, `outros_I`, `outros_II`, `Data_hora`) VALUES
(3, 'AoyBYcVKstiGAYrX', 2, 'documentos/AoyBYcVKstiGAYrX_672e6a1366691.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a13667c7.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a1366a7f.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a1366b8e.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a1366c97.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a1366fa6.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a13670a9.pdf', NULL, 'documentos/AoyBYcVKstiGAYrX_672e6a1366ea2.pdf', 'documentos/AoyBYcVKstiGAYrX_672e6a1366d9e.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-08 19:44:19'),
(4, 'vhgJEmGDahtXe25t', 1, 'documentos/673ba0d3d304e.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c3a91.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c3c41.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c3d73.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c3eb8.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca521.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca6dc.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca1dd.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca376.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c3ffe.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c4129.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c4298.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c4485.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c46ca.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7c4879.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca813.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7ca947.pdf', 'documentos/vhgJEmGDahtXe25t_673b7de7caa6f.pdf', '2024-11-18 17:48:23'),
(5, 'lNtL5woVYgsrJjNZ', 4, 'documentos/lNtL5woVYgsrJjNZ_673c985024834.pdf', 'documentos/lNtL5woVYgsrJjNZ_673c985024bb4.pdf', 'documentos/lNtL5woVYgsrJjNZ_673c985024cf2.pdf', 'documentos/lNtL5woVYgsrJjNZ_673c985024e19.pdf', 'documentos/lNtL5woVYgsrJjNZ_673c985024f39.pdf', NULL, NULL, NULL, NULL, 'documentos/673c9c85bc591.pdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-19 13:53:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagemprincipal`
--

CREATE TABLE `imagemprincipal` (
  `IdImagem` int(11) NOT NULL,
  `IdImovel` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `imagemprincipal`
--

INSERT INTO `imagemprincipal` (`IdImagem`, `IdImovel`, `path`, `data_upload`, `nome`) VALUES
(1, 2, 'arquivos/66b3d98af18fc.jpg', '2024-08-07 17:31:06', 'livingblend.jpg'),
(2, 3, 'arquivos/66bbc9b1171d2.jpg', '2024-08-13 18:01:37', 'Perspectiva_Avenida_Fachada_Santorini_HD-1-scaled.jpg'),
(3, 4, 'arquivos/66bd1eaa27d39.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0008.jpg'),
(4, 5, 'arquivos/66be53846f674.jpg', '2024-08-15 16:14:12', 'Perspectiva-Fachada-MangaraCampinas.jpg'),
(5, 6, 'arquivos/66be59bf439d1.jpg', '2024-08-15 16:40:47', '65d8f304cc488627723a8fb3_CAPRI_FACHADA DA TORRE_PRANCHA_EM ALTA.jpg'),
(6, 7, 'arquivos/66be6454c20b4.jpg', '2024-08-15 17:25:56', 'fachada.jpg'),
(7, 8, 'arquivos/66be6a8730bf3.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_FACHADA_HR.jpg'),
(8, 9, 'arquivos/66be6e0f66043.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-FACHADA-R05.jpg'),
(13, 21, 'arquivos/6710249dda967.jpg', '2024-10-16 17:39:57', 'principal.jpg'),
(14, 22, 'arquivos/671115db34ec9.jpg', '2024-10-17 10:49:15', 'prédio.jpg'),
(15, 23, 'arquivos/673cd6d596dd6.jpg', '2024-11-19 15:20:05', 'capa Epic.jpg'),
(16, 24, 'arquivos/673cdb4d30263.jpg', '2024-11-19 15:39:09', 'fachada_HR.jpg'),
(17, 25, 'arquivos/673cde018ea35.jpg', '2024-11-19 15:50:41', 'portaria_HR.jpg'),
(18, 26, 'arquivos/673cdf584c78f.jpg', '2024-11-19 15:56:24', 'LONGITUDE_ONE SUMARE_FACHADA_A_BAIXA.jpg'),
(19, 27, 'arquivos/673ce1b46d292.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-PORTARIA.jpg'),
(20, 28, 'arquivos/673ce8bd07879.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_PORTARIA_EXTRA_R05.jpg'),
(21, 30, 'arquivos/673ceb4c971d1.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_FACHADA_HR01.jpg'),
(22, 31, 'arquivos/673cecf549fb5.jpg', '2024-11-19 16:54:29', 'SQUAD_LONGITUDE_NEO_DETALHE_FACHADA_R01.jpg'),
(23, 33, 'arquivos/673cf71d76861.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.10.jpg'),
(24, 34, 'arquivos/673dd09f4fac2.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_GUARITA-ENTARDECER_2022_12_01.jpg'),
(25, 35, 'arquivos/673dd2f262f96.jpg', '2024-11-20 09:15:46', 'RESIDENCIALCOLORADO_PPCFACHADAENTARDECER_09-12-2022.jpg'),
(26, 36, 'arquivos/673dd581198c3.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_GUARITA-ENTARDECER-OP02_2023_05_30.jpg'),
(27, 37, 'arquivos/673dda1515808.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_FACHADA_RF.jpg'),
(28, 38, 'arquivos/673dde9830279.jpg', '2024-11-20 10:05:28', 'MRV_CORES-DO-POENTE_GUARITA-ENTARDECER_FINAL.jpg'),
(29, 39, 'arquivos/673de4b5b0085.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_GUARITA_2021_11_23.jpg'),
(30, 40, 'arquivos/673e12954f111.jpg', '2024-11-20 13:47:17', 'fachada.jpg'),
(31, 41, 'arquivos/673e16ea5284b.jpg', '2024-11-20 14:05:46', 'BAL-PISCINA-RF-1536x864.jpg'),
(32, 42, 'arquivos/673e1b1bbc9b2.jpg', '2024-11-20 14:23:39', 'Captura de tela 2024-11-20 142201.jpg'),
(33, 43, 'arquivos/673e2e8d956e4.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_FACHADA_R02-1024x1024.jpg'),
(34, 44, 'arquivos/673e3117be784.jpg', '2024-11-20 15:57:27', 'Portaria.noite_-scaled.jpg'),
(35, 45, 'arquivos/673e37d9111d9.jpg', '2024-11-20 16:26:17', 'residencial-link-vila-uniao-breve-lancamento1039340.jpg'),
(36, 48, 'arquivos/673e3fb3868ad.jpg', '2024-11-20 16:59:47', 'MRV_CANTO DA MATA - GUARITA_IMPRESSAO_150DPI.jpg'),
(37, 49, 'arquivos/673e51929d522.jpg', '2024-11-20 18:16:02', '02-fachada-noturna.jpg'),
(38, 50, 'arquivos/673e58f769122.jpg', '2024-11-20 18:47:35', 'Fachada_840c8c824e.jpg'),
(39, 52, 'arquivos/673f3e1182b7a.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_PPC_TORRE_FINAL_2024.07.1857eb78f0-5bc4-4b98-be43-359ab360c384.jpg'),
(40, 53, 'arquivos/673f424504a6a.jpg', '2024-11-21 11:23:01', 'Perspectiva-Fachada-RiseParquePrado-1.jpg.jpg'),
(41, 54, 'arquivos/673f449706516.jpg', '2024-11-21 11:32:55', 'piscina-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(43, 56, 'arquivos/673f735293688.jpg', '2024-11-21 14:52:18', 'Guarita_Dia-scaled.jpg'),
(44, 58, 'arquivos/673f79eeabcb1.jpg', '2024-11-21 15:20:30', '1ef03fc9-fc53-60ec-beb2-0e9c2a6949bd.jpg'),
(45, 59, 'arquivos/673f857d2f6c7.jpg', '2024-11-21 16:09:49', 'piscina.jpg'),
(46, 60, 'arquivos/673f88d6acd5d.jpg', '2024-11-21 16:24:06', 'hm_intense_valinhos_fachada_8d8a3bca63.jpg'),
(47, 61, 'arquivos/673f93cc64d90.png', '2024-11-21 17:10:52', 'sem-titulo-5-878bf5f215b9d003a07ec2edabb9402016c633cf-10.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagensimovel`
--

CREATE TABLE `imagensimovel` (
  `IdImagem` int(11) NOT NULL,
  `IdImovel` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `imagensimovel`
--

INSERT INTO `imagensimovel` (`IdImagem`, `IdImovel`, `path`, `data_upload`, `nome`) VALUES
(4, 2, 'arquivos/66b3d98aeeb74.jpg', '2024-08-07 17:31:06', '2a7a90cf-821b-45f8-b46a-c63568e3b162.jpg'),
(5, 2, 'arquivos/66b3d98aeedb7.jpg', '2024-08-07 17:31:06', '9b575df8-b964-4598-ab58-4ab65df1f029.jpg'),
(6, 2, 'arquivos/66b3d98aeefa1.jpg', '2024-08-07 17:31:06', '42fe0c71-a056-4d7c-8c91-da8b8e2c3c9d.jpg'),
(7, 2, 'arquivos/66b3d98af1243.jpg', '2024-08-07 17:31:06', '48b0d66b-e4da-416c-9ab8-3a17e1c6532c.jpg'),
(8, 2, 'arquivos/66b3d98af13e7.jpg', '2024-08-07 17:31:06', '353b03d1-cec3-43c8-9189-e0c472abbbc9.jpg'),
(9, 2, 'arquivos/66b3d98af1568.jpg', '2024-08-07 17:31:06', 'Imagem do WhatsApp de 2024-01-25 à(s) 19.57.17_91637702.jpg'),
(10, 2, 'arquivos/66b3d98af16ee.jpg', '2024-08-07 17:31:06', 'Imagem do WhatsApp de 2024-01-25 à(s) 19.57.17_e0cc2251.jpg'),
(11, 2, 'arquivos/66b3d98af18fc.jpg', '2024-08-07 17:31:06', 'Imagem do WhatsApp de 2024-01-25 à(s) 19.57.18_53e9c492.jpg'),
(12, 2, 'arquivos/66b3d98af1a9d.jpg', '2024-08-07 17:31:06', 'Imagem do WhatsApp de 2024-01-25 à(s) 19.58.05_5f13a5d1.jpg'),
(13, 3, 'arquivos/66bbc9b117709.jpg', '2024-08-13 18:01:37', 'Perspectiva_Espaco_Convivio_Santorini_Residence_HD-scaled.jpg'),
(14, 3, 'arquivos/66bbc9b118db2.jpg', '2024-08-13 18:01:37', 'Perspectiva_Espaco_Funcional_Santorini_Residence_HD-scaled.jpg'),
(15, 3, 'arquivos/66bbc9b118ffe.jpg', '2024-08-13 18:01:37', 'Perspectiva_Apartamento_Canto_Ampliado_Santorini_Residence_HD-scaled.jpg'),
(16, 3, 'arquivos/66bbc9b119222.jpg', '2024-08-13 18:01:37', 'Perspectiva_Espaco_HappyHour_Santorini_Residence_HD-scaled.jpg'),
(17, 3, 'arquivos/66bbc9b11a6ec.jpg', '2024-08-13 18:01:37', 'Perspectiva_ADN_Shop_Santorini_Residence_HD-scaled.jpg'),
(18, 3, 'arquivos/66bbc9b11a88c.jpg', '2024-08-13 18:01:37', 'Perspectiva_Academia_Fitness_Santorini_Residence_HD-scaled.jpg'),
(19, 3, 'arquivos/66bbc9b11aa5d.jpg', '2024-08-13 18:01:37', 'Perspectiva_Espaco_SteakHouse_Santorini_Residence_HD-scaled.jpg'),
(20, 3, 'arquivos/66bbc9b11abe7.jpg', '2024-08-13 18:01:37', 'Perspectiva_Espaco_PetCare_Santorini_Residence_HD-scaled.jpg'),
(21, 3, 'arquivos/66bbc9b11adc7.jpg', '2024-08-13 18:01:37', 'Perspectiva_Coworking_Santorini_Residence_HD-scaled.jpg'),
(22, 3, 'arquivos/66bbc9b11af46.jpg', '2024-08-13 18:01:37', 'Perspectiva_Avenida_Fachada_Santorini_HD-1-scaled.jpg'),
(23, 4, 'arquivos/66bd1eaa28337.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0014.jpg'),
(24, 4, 'arquivos/66bd1eaa2853c.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0012.jpg'),
(25, 4, 'arquivos/66bd1eaa286ab.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0011.jpg'),
(26, 4, 'arquivos/66bd1eaa288cc.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0013.jpg'),
(27, 4, 'arquivos/66bd1eaa28a58.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0008.jpg'),
(28, 4, 'arquivos/66bd1eaa28bc6.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0015.jpg'),
(29, 4, 'arquivos/66bd1eaa28d52.jpg', '2024-08-14 18:16:26', 'IMG-20240423-WA0009.jpg'),
(32, 5, 'arquivos/66be53846fa68.jpg', '2024-08-15 16:14:12', 'Perspectiva-Fachada-MangaraCampinas.jpg'),
(33, 5, 'arquivos/66be53846fcb4.jpg', '2024-08-15 16:14:12', '1723748569743.jpg'),
(34, 5, 'arquivos/66be53846fe4e.jpg', '2024-08-15 16:14:12', '1723748569830.jpg'),
(35, 5, 'arquivos/66be53846ffcc.jpg', '2024-08-15 16:14:12', '1723748569792.jpg'),
(36, 5, 'arquivos/66be538470134.jpg', '2024-08-15 16:14:12', '1723748569817.jpg'),
(37, 5, 'arquivos/66be538470310.jpg', '2024-08-15 16:14:12', '1723748569757.jpg'),
(38, 5, 'arquivos/66be5384716a1.jpg', '2024-08-15 16:14:12', '1723748569805.jpg'),
(39, 5, 'arquivos/66be53847180c.jpg', '2024-08-15 16:14:12', '1723748569782.jpg'),
(40, 5, 'arquivos/66be538471997.jpg', '2024-08-15 16:14:12', '1723748569731.jpg'),
(41, 5, 'arquivos/66be538471b3a.jpg', '2024-08-15 16:14:12', '1723748569770.jpg'),
(42, 6, 'arquivos/66be59bf43bbb.jpg', '2024-08-15 16:40:47', '65d8f304cc488627723a8fb3_CAPRI_FACHADA DA TORRE_PRANCHA_EM ALTA.jpg'),
(43, 6, 'arquivos/66be59bf43d63.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154338.jpg'),
(44, 6, 'arquivos/66be59bf43f14.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154444.jpg'),
(45, 6, 'arquivos/66be59bf44066.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154433.jpg'),
(46, 6, 'arquivos/66be59bf454dd.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154417.jpg'),
(47, 6, 'arquivos/66be59bf456a2.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154358.jpg'),
(48, 6, 'arquivos/66be59bf4586f.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154353.jpg'),
(49, 6, 'arquivos/66be59bf45a1c.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154348.jpg'),
(50, 6, 'arquivos/66be59bf46d8d.jpg', '2024-08-15 16:40:47', 'IMG_20240518_154320.jpg'),
(51, 7, 'arquivos/66be6454c22e6.jpg', '2024-08-15 17:25:56', 'fachada.jpg'),
(52, 7, 'arquivos/66be6454c249c.jpg', '2024-08-15 17:25:56', '1723752739143.jpg'),
(53, 7, 'arquivos/66be6454c26ba.jpg', '2024-08-15 17:25:56', '1723752739254.jpg'),
(54, 7, 'arquivos/66be6454c2826.jpg', '2024-08-15 17:25:56', '1723752739231.jpg'),
(55, 7, 'arquivos/66be6454c29b6.jpg', '2024-08-15 17:25:56', '1723752739189.jpg'),
(56, 7, 'arquivos/66be6454c2b2e.jpg', '2024-08-15 17:25:56', '1723752739103.jpg'),
(57, 7, 'arquivos/66be6454c2c9c.jpg', '2024-08-15 17:25:56', '1723752739082.jpg'),
(58, 7, 'arquivos/66be6454c2e19.jpg', '2024-08-15 17:25:56', '1723752739122.jpg'),
(59, 7, 'arquivos/66be6454c4301.jpg', '2024-08-15 17:25:56', '1723752739166.jpg'),
(60, 7, 'arquivos/66be6454c4482.jpg', '2024-08-15 17:25:56', '1723752739062.jpg'),
(61, 7, 'arquivos/66be6454c45ff.jpg', '2024-08-15 17:25:56', '1723752739209.jpg'),
(62, 8, 'arquivos/66be6a8732067.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_TERRACO_HR.jpg'),
(63, 8, 'arquivos/66be6a87333cc.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_QUADRA_AREIA_HR.jpg'),
(64, 8, 'arquivos/66be6a87335a4.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_PORTARIA_HR.jpg'),
(65, 8, 'arquivos/66be6a8733769.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_POMAR_HR.jpg'),
(66, 8, 'arquivos/66be6a8733914.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_PLAYGROUND_HR.jpg'),
(67, 8, 'arquivos/66be6a8734cf3.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_PISCINA_HR.jpg'),
(68, 8, 'arquivos/66be6a8734f01.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_PET_PLACE_HR.jpg'),
(69, 8, 'arquivos/66be6a87350a0.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_LIVING_HR.jpg'),
(70, 8, 'arquivos/66be6a873522f.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_FESTAS_HR.jpg'),
(71, 8, 'arquivos/66be6a873539b.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_FACHADA_HR.jpg'),
(72, 8, 'arquivos/66be6a873556c.jpg', '2024-08-15 17:52:23', 'LONGITUDE_PAULINIA_CAMPO_HR.jpg'),
(73, 9, 'arquivos/66be6e0f66240.jpg', '2024-08-15 18:07:27', 'HR_LONGITUDE_ARVO_LIVING_A.jpg'),
(74, 9, 'arquivos/66be6e0f6642f.jpg', '2024-08-15 18:07:27', 'HR_LONGITUDE_ARVO_LIVING_B.jpg'),
(75, 9, 'arquivos/66be6e0f66608.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-ACADEMIA-R02.jpg'),
(76, 9, 'arquivos/66be6e0f67a31.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-AEREA-R01.jpg'),
(77, 9, 'arquivos/66be6e0f67bec.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-FACHADA-R05.jpg'),
(78, 9, 'arquivos/66be6e0f67dea.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-FACHADA-R05_corte2.jpg'),
(79, 9, 'arquivos/66be6e0f67f87.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-GOLF-R06.jpg'),
(80, 9, 'arquivos/66be6e0f6810c.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-PISCINA-R05.jpg'),
(81, 9, 'arquivos/66be6e0f68281.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-PLAYGROUND-R05.jpg'),
(82, 9, 'arquivos/66be6e0f683f8.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-PORTARIA-R03.jpg'),
(83, 9, 'arquivos/66be6e0f68603.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-QUADRA AREIA-R05.jpg'),
(84, 9, 'arquivos/66be6e0f68771.jpg', '2024-08-15 18:07:27', 'SQUAD-LONGITUDE-ARVO-IMG-SALAO-R05.jpg'),
(95, 21, 'arquivos/6710249ddcf07.jpg', '2024-10-16 17:39:57', 'beach.jpg'),
(96, 21, 'arquivos/6710249ddd1e8.jpg', '2024-10-16 17:39:57', 'beauty care.jpg'),
(97, 21, 'arquivos/6710249ddd430.jpg', '2024-10-16 17:39:57', 'car wash.jpg'),
(98, 21, 'arquivos/6710249ddd60b.jpg', '2024-10-16 17:39:57', 'cine air.jpg'),
(99, 21, 'arquivos/6710249ddd783.jpg', '2024-10-16 17:39:57', 'golf.jpg'),
(100, 21, 'arquivos/6710249ddf9d9.jpg', '2024-10-16 17:39:57', 'gym.jpg'),
(101, 21, 'arquivos/6710249ddfba8.jpg', '2024-10-16 17:39:57', 'lavanderia.jpg'),
(102, 21, 'arquivos/6710249ddfd37.jpg', '2024-10-16 17:39:57', 'massagem.jpg'),
(103, 21, 'arquivos/6710249ddfea7.jpg', '2024-10-16 17:39:57', 'piscina1.jpg'),
(104, 21, 'arquivos/6710249de002b.jpg', '2024-10-16 17:39:57', 'piscina2.jpg'),
(105, 21, 'arquivos/6710249de0210.jpg', '2024-10-16 17:39:57', 'podcast.jpg'),
(106, 21, 'arquivos/6710249de0430.jpg', '2024-10-16 17:39:57', 'salão.jpg'),
(107, 22, 'arquivos/671115db350f3.jpg', '2024-10-17 10:49:15', 'academia.jpg'),
(108, 22, 'arquivos/671115db352a6.jpg', '2024-10-17 10:49:15', 'entrada.jpg'),
(109, 22, 'arquivos/671115db3543e.jpg', '2024-10-17 10:49:15', 'espaco gourmet.jpg'),
(110, 22, 'arquivos/671115db355b1.jpg', '2024-10-17 10:49:15', 'espaco kids.jpg'),
(111, 22, 'arquivos/671115db3571d.jpg', '2024-10-17 10:49:15', 'Espaco pet.jpg'),
(112, 22, 'arquivos/671115db35886.jpg', '2024-10-17 10:49:15', 'piscina.jpg'),
(113, 22, 'arquivos/671115db359f5.jpg', '2024-10-17 10:49:15', 'playground.jpg'),
(114, 22, 'arquivos/671115db35b70.jpg', '2024-10-17 10:49:15', 'praças.jpg'),
(115, 22, 'arquivos/671115db35cda.jpg', '2024-10-17 10:49:15', 'prédio.jpg'),
(116, 23, 'arquivos/673cd6d59701a.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-SALÃO-R11.jpg'),
(117, 23, 'arquivos/673cd6d5972d9.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-QUARTO 03-R03.jpg'),
(118, 23, 'arquivos/673cd6d59b7cd.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-PORTARIA-R14.jpg'),
(119, 23, 'arquivos/673cd6d59b971.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-PLAY-R13.jpg'),
(120, 23, 'arquivos/673cd6d59bb07.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-PISCINA-R14.jpg'),
(121, 23, 'arquivos/673cd6d59bc7f.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-PET PLACE-R11.jpg'),
(122, 23, 'arquivos/673cd6d59bdf4.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-FACHADA-R13.jpg'),
(123, 23, 'arquivos/673cd6d59bf65.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-CROSS TRAINING-R11.jpg'),
(124, 23, 'arquivos/673cd6d59c0d6.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-IMG-CHUTE A GOL-R13.jpg'),
(125, 23, 'arquivos/673cd6d59c249.jpg', '2024-11-19 15:20:05', 'SQUAD-LONGITUDE-RESIDENCIAL EPIC-FOTO INSERÇÃO.jpg'),
(126, 24, 'arquivos/673cdb4d30485.jpg', '2024-11-19 15:39:09', 'dorm_HR.jpg'),
(127, 24, 'arquivos/673cdb4d34b31.jpg', '2024-11-19 15:39:09', 'festas_HR3.jpg'),
(128, 24, 'arquivos/673cdb4d3609b.jpg', '2024-11-19 15:39:09', 'petplace_HR.jpg'),
(129, 24, 'arquivos/673cdb4d362b5.jpg', '2024-11-19 15:39:09', 'piscina_HR2.jpg'),
(130, 24, 'arquivos/673cdb4d36453.jpg', '2024-11-19 15:39:09', 'playground_HR.jpg'),
(131, 24, 'arquivos/673cdb4d36602.jpg', '2024-11-19 15:39:09', 'quadra_areia_HR.jpg'),
(132, 24, 'arquivos/673cdb4d3678e.jpg', '2024-11-19 15:39:09', 'quadra_grama_HR.jpg'),
(133, 24, 'arquivos/673cdb4d36916.jpg', '2024-11-19 15:39:09', 'portaria_HR2.jpg'),
(134, 25, 'arquivos/673cde01900a7.jpg', '2024-11-19 15:50:41', 'beach_tennis_HR.jpg'),
(135, 25, 'arquivos/673cde0191490.jpg', '2024-11-19 15:50:41', 'churras_HR.jpg'),
(136, 25, 'arquivos/673cde01916af.jpg', '2024-11-19 15:50:41', 'fachada_HR.jpg'),
(137, 25, 'arquivos/673cde0191869.jpg', '2024-11-19 15:50:41', 'festas_HR.jpg'),
(138, 25, 'arquivos/673cde01919e4.jpg', '2024-11-19 15:50:41', 'fotomontagem_R00_HR.jpg'),
(139, 25, 'arquivos/673cde0191b57.jpg', '2024-11-19 15:50:41', 'petplace_HR.jpg'),
(140, 25, 'arquivos/673cde0191d28.jpg', '2024-11-19 15:50:41', 'piscina_HR.jpg'),
(141, 25, 'arquivos/673cde0191eae.jpg', '2024-11-19 15:50:41', 'playground_HR.jpg'),
(142, 25, 'arquivos/673cde01932cd.jpg', '2024-11-19 15:50:41', 'praca_HR.jpg'),
(143, 25, 'arquivos/673cde01934ed.jpg', '2024-11-19 15:50:41', 'quadra_HR.jpg'),
(144, 26, 'arquivos/673cdf584c974.jpg', '2024-11-19 15:56:24', 'LONGITUDE_ONE SUMARE_PISCINA_BAIXA.jpg'),
(145, 26, 'arquivos/673cdf584cb05.jpg', '2024-11-19 15:56:24', 'LONGITUDE_ONE SUMARE_PLAY_BAIXA.jpg'),
(146, 26, 'arquivos/673cdf584ccb0.jpg', '2024-11-19 15:56:24', 'LONGITUDE_ONE SUMARE_PORTARIA_A_BAIXA.jpg'),
(147, 27, 'arquivos/673ce1b46d4eb.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-AERIA.jpg'),
(148, 27, 'arquivos/673ce1b46d6cb.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-BEACH TENIS.jpg'),
(149, 27, 'arquivos/673ce1b46d86f.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-FACHADA 02.jpg'),
(150, 27, 'arquivos/673ce1b46da04.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-FACHADA-01 (1).jpg'),
(151, 27, 'arquivos/673ce1b46dba2.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-FACHADA-01.jpg'),
(152, 27, 'arquivos/673ce1b46dd31.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-FOTO INSERCAO.jpg'),
(153, 27, 'arquivos/673ce1b46dec7.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-PISCINA.jpg'),
(154, 27, 'arquivos/673ce1b46e043.jpg', '2024-11-19 16:06:28', 'SQUAD-LONGITUDE-ICON-RESIDENCIAL-SALÃO DE FESTAS.jpg'),
(155, 28, 'arquivos/673ce8bd08d49.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_CARWASH_R05.jpg'),
(156, 28, 'arquivos/673ce8bd0b8b7.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_CHURRASQUEIRA_R04.jpg'),
(157, 28, 'arquivos/673ce8bd0bad7.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_CHUTEAGOL01_R04.jpg'),
(158, 28, 'arquivos/673ce8bd0cd56.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_CROSSTRAINING_R04.jpg'),
(159, 28, 'arquivos/673ce8bd0cf10.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_PISCINA_R04_rev.jpg'),
(160, 28, 'arquivos/673ce8bd0d0ac.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_PLAYGROUND_R04.jpg'),
(161, 28, 'arquivos/673ce8bd0d21c.jpg', '2024-11-19 16:36:29', 'SQUAD_WIDE_PORTARIA_R05.jpg'),
(162, 30, 'arquivos/673ceb4c98622.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_CAMPO_HR.jpg'),
(163, 30, 'arquivos/673ceb4c98843.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_ESPAÇO_CHURRASQUEIRA_HR.jpg'),
(164, 30, 'arquivos/673ceb4c98a88.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_FESTAS_HR.jpg'),
(165, 30, 'arquivos/673ceb4c98cac.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_FITNESS_HR.jpg'),
(166, 30, 'arquivos/673ceb4c98e81.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_FOTOMONTAGEM_HR.jpg'),
(167, 30, 'arquivos/673ceb4c99027.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_PISCINA_HR02_B.jpg'),
(168, 30, 'arquivos/673ceb4c991ce.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_PISTA_GOLFE_HR.jpg'),
(169, 30, 'arquivos/673ceb4c9936a.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_PLAYGROUND_HR01.jpg'),
(170, 30, 'arquivos/673ceb4c99509.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_PORTARIA_HR01.jpg'),
(171, 30, 'arquivos/673ceb4c9967c.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_QUADRA_DE_AREIA_HR.jpg'),
(172, 30, 'arquivos/673ceb4c997eb.jpg', '2024-11-19 16:47:24', 'LONGITUDE_SUMARE_RECEPCAO_HR01.jpg'),
(173, 31, 'arquivos/673cecf54a23c.jpg', '2024-11-19 16:54:29', 'SQUAD_LONGITUDE_NEO_IMG_BEACH_R07.jpg'),
(174, 31, 'arquivos/673cecf54a455.jpg', '2024-11-19 16:54:29', 'SQUAD_LONGITUDE_NEO_IMG_PISCINA_R07.jpg'),
(175, 31, 'arquivos/673cecf54b7d5.jpg', '2024-11-19 16:54:29', 'SQUAD_LONGITUDE_NEO_IMG_PORTARIA_R07.jpg'),
(176, 31, 'arquivos/673cecf54b9f1.jpg', '2024-11-19 16:54:29', 'SQUAD-LONGITUDE-NEO-IMG-FACHADA-R04.jpg'),
(177, 31, 'arquivos/673cecf54bbe8.jpg', '2024-11-19 16:54:29', 'SQUAD-LONGITUDE-NEO-IMG-LAZER-R07.jpg'),
(178, 31, 'arquivos/673cecf54bd70.jpg', '2024-11-19 16:54:29', 'SQUAD-LONGITUDE-NEO-IMG-PLAYGROUND-R08.jpg'),
(179, 31, 'arquivos/673cecf54bef6.jpg', '2024-11-19 16:54:29', 'SQUAD-LONGITUDE-NEO-IMG-SALAO-R08.jpg'),
(180, 33, 'arquivos/673cf71d76adc.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.11.jpg'),
(181, 33, 'arquivos/673cf71d78a7d.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.11-_2_.jpg'),
(182, 33, 'arquivos/673cf71d78c25.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.12.jpg'),
(183, 33, 'arquivos/673cf71d78dc3.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.12-_1_.jpg'),
(184, 33, 'arquivos/673cf71d79e21.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.12-_2_.jpg'),
(185, 33, 'arquivos/673cf71d79fba.jpg', '2024-11-19 17:37:49', 'WhatsApp-Image-2024-02-02-at-10.25.12-_3_.jpg'),
(186, 34, 'arquivos/673dd09f4fcd8.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_APTO201-TR-QUARTO_2022_12_01.jpg'),
(187, 34, 'arquivos/673dd09f4ff4b.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_APTO203-TR-SALA_2022_12_01.jpg'),
(188, 34, 'arquivos/673dd09f50168.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_GUARITA-DIURNA_2022_12_01.jpg'),
(189, 34, 'arquivos/673dd09f5030f.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_PISCINA_2022_12_01.jpg'),
(190, 34, 'arquivos/673dd09f504a7.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_PLAYGROUND_2022_12_01.jpg'),
(191, 34, 'arquivos/673dd09f5061e.jpg', '2024-11-20 09:05:51', 'RESIDENCIAL-CELESTIAL_PE_QUADRA_2022_12_01.jpg'),
(192, 35, 'arquivos/673dd2f263193.jpg', '2024-11-20 09:15:46', 'RESIDENCIAL-COLORADO_PPC-PLAYGROUND_09-12-2022.jpg'),
(193, 35, 'arquivos/673dd2f26333a.jpg', '2024-11-20 09:15:46', 'RESIDENCIALCOLORADO_PPCQUARTOMAIOR_29-11-2022.jpg'),
(194, 35, 'arquivos/673dd2f265182.jpg', '2024-11-20 09:15:46', 'RESIDENCIALCOLORADO_PPCQUARTOMENOR_29-11-2022.jpg'),
(195, 35, 'arquivos/673dd2f265388.jpg', '2024-11-20 09:15:46', 'RESIDENCIALCOLORADO_PPCSALA_08-12-2022.jpg'),
(196, 35, 'arquivos/673dd2f265554.jpg', '2024-11-20 09:15:46', 'RESIDENCIALCOLORADO_PPCVOOGERAL_09-12-2022.jpg'),
(197, 36, 'arquivos/673dd5811abe2.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_APTO203-TR-VARANDA_2023_05_19.jpg'),
(198, 36, 'arquivos/673dd5811ae18.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_AREA-PRIVATIVA_2023_05_19.jpg'),
(199, 36, 'arquivos/673dd5811afb2.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_CHURRASQUEIRA_2023_05_19.jpg'),
(200, 36, 'arquivos/673dd5811b1d6.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_GUARITA-ENTARDECER-OP02_2023_05_30.jpg'),
(201, 36, 'arquivos/673dd5811b3ad.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_IMPLGERAL_2023_05_30-(1).jpg'),
(202, 36, 'arquivos/673dd5811b53e.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_PISCINA-OP02_2023_05_19.jpg'),
(203, 36, 'arquivos/673dd5811b6ea.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_QUARTO-CASAL_2023_05_19.jpg'),
(204, 36, 'arquivos/673dd5811b86e.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_QUARTO-SOLTEIRO_2023_05_19.jpg'),
(205, 36, 'arquivos/673dd5811b9f3.jpg', '2024-11-20 09:26:41', 'RESIDENCIAL-COSTA-DOS-VENTOS_PE_SALA_2023_05_19.jpg'),
(206, 37, 'arquivos/673dda1515ae3.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_AEREA_GERAL_RF.jpg'),
(207, 37, 'arquivos/673dda1516076.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_GUARITA_RF.jpg'),
(208, 37, 'arquivos/673dda15162ab.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_HALL_RF.jpg'),
(209, 37, 'arquivos/673dda151642b.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_LIVING_RF.jpg'),
(210, 37, 'arquivos/673dda1516597.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_PISCINA_TARDE_R01371697f6-c44e-4c83-b3f5-12f32baf9752.jpg'),
(211, 37, 'arquivos/673dda15166f1.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_QUARTO_CASAL_RF.jpg'),
(212, 37, 'arquivos/673dda1516842.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_QUARTO_RF.jpg'),
(213, 37, 'arquivos/673dda1516a1c.jpg', '2024-11-20 09:46:13', 'COSTA-DOS-ALPES_VARANDA_RF.jpg'),
(214, 38, 'arquivos/673dde98304af.jpg', '2024-11-20 10:05:28', 'MRV_CORES-DO-POENTE_AEREA-3D_FINAL.jpg'),
(215, 38, 'arquivos/673dde9830666.jpg', '2024-11-20 10:05:28', 'MRV_CORES-DO-POENTE_CHURRASQUEIRA_FINAL.jpg'),
(216, 38, 'arquivos/673dde983080e.jpg', '2024-11-20 10:05:28', 'MRV_CORES-DO-POENTE_GERAL-LAZER_FINAL.jpg'),
(217, 38, 'arquivos/673dde98309a7.jpg', '2024-11-20 10:05:28', 'MRV_CORES-DO-POENTE_GUARITA-ENTARDECER_FINAL.jpg'),
(218, 39, 'arquivos/673de4b5b024d.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_FESTAS_2021_11_23.jpg'),
(219, 39, 'arquivos/673de4b5b03ce.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_GOURMET_2021_11_23.jpg'),
(220, 39, 'arquivos/673de4b5b0545.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_GUARITA_2021_11_23.jpg'),
(221, 39, 'arquivos/673de4b5b06e1.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_IMP3D-GERAL_2022_03_11.jpg'),
(222, 39, 'arquivos/673de4b5b090a.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_JOGOS_2021_11_23.jpg'),
(223, 39, 'arquivos/673de4b5b0a84.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_KIDS_2021_11_23.jpg'),
(224, 39, 'arquivos/673de4b5b0bfb.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_PISCINA_2022_03_11.jpg'),
(225, 39, 'arquivos/673de4b5b0d68.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_PLAYGROUND_2021_11_23.jpg'),
(226, 39, 'arquivos/673de4b5b0ed3.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_QUADRA_2021_11_23.jpg'),
(227, 39, 'arquivos/673de4b5b105f.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_QUARTOSOLTEIRO_2022_01_13.jpg'),
(228, 39, 'arquivos/673de4b5b121b.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_SALA_2022_01_13.jpg'),
(229, 39, 'arquivos/673de4b5b2ab8.jpg', '2024-11-20 10:31:33', 'VILLAGIO-GARDEN_PE_SUITE_2022_01_13.jpg'),
(230, 40, 'arquivos/673e1295505e5.jpg', '2024-11-20 13:47:17', 'academia.jpg'),
(231, 40, 'arquivos/673e129551c49.jpg', '2024-11-20 13:47:17', 'churrasqueira.jpg'),
(232, 40, 'arquivos/673e129551ebe.jpg', '2024-11-20 13:47:17', 'garagem.jpg'),
(233, 40, 'arquivos/673e1295520a5.jpg', '2024-11-20 13:47:17', 'lazer externo.jpg'),
(234, 40, 'arquivos/673e1295522a1.jpg', '2024-11-20 13:47:17', 'pet place.jpg'),
(235, 40, 'arquivos/673e129552443.jpg', '2024-11-20 13:47:17', 'pet shower.jpg'),
(236, 40, 'arquivos/673e1295525e7.jpg', '2024-11-20 13:47:17', 'piscina .jpg'),
(237, 40, 'arquivos/673e129552762.jpg', '2024-11-20 13:47:17', 'portaria.jpg'),
(238, 40, 'arquivos/673e1295528d7.jpg', '2024-11-20 13:47:17', 'quadra.jpg'),
(239, 40, 'arquivos/673e129552a43.jpg', '2024-11-20 13:47:17', 'salao de festas.jpg'),
(240, 40, 'arquivos/673e129552baf.jpg', '2024-11-20 13:47:17', 'Torre baixo.jpg'),
(241, 41, 'arquivos/673e16ea52a3a.jpg', '2024-11-20 14:05:46', 'BAL_ACADEMIA_RF-1536x864.jpg'),
(242, 41, 'arquivos/673e16ea52bbc.jpg', '2024-11-20 14:05:46', 'BAL_CHURRAS_RF-1536x864.jpg'),
(243, 41, 'arquivos/673e16ea52d2f.jpg', '2024-11-20 14:05:46', 'BAL_COWORKING_RF-1536x864.jpg'),
(244, 41, 'arquivos/673e16ea52e9c.jpg', '2024-11-20 14:05:46', 'BAL_JOGOS_RF-1536x864.jpg'),
(245, 41, 'arquivos/673e16ea53005.jpg', '2024-11-20 14:05:46', 'BAL_KIDS_RF-1536x864.jpg'),
(246, 41, 'arquivos/673e16ea53182.jpg', '2024-11-20 14:05:46', 'BAL_PLAY_RF-1536x864.jpg'),
(247, 41, 'arquivos/673e16ea532ea.jpg', '2024-11-20 14:05:46', 'BAL_QUADRA_RF-1536x864.jpg'),
(248, 41, 'arquivos/673e16ea53451.jpg', '2024-11-20 14:05:46', 'LIVING_BAL_RF-1536x864.jpg'),
(249, 42, 'arquivos/673e1b1bbcbfc.jpg', '2024-11-20 14:23:39', 'BAL_ACADEMIA_RF-1536x864.jpg'),
(250, 42, 'arquivos/673e1b1bbcdff.jpg', '2024-11-20 14:23:39', 'BAL_CHURRAS_RF-1536x864.jpg'),
(251, 42, 'arquivos/673e1b1bbd036.jpg', '2024-11-20 14:23:39', 'BAL_COWORKING_RF-1536x864.jpg'),
(252, 42, 'arquivos/673e1b1bbd1d0.jpg', '2024-11-20 14:23:39', 'BAL_JOGOS_RF-1536x864.jpg'),
(253, 42, 'arquivos/673e1b1bbd355.jpg', '2024-11-20 14:23:39', 'BAL_KIDS_RF-1536x864.jpg'),
(254, 42, 'arquivos/673e1b1bbeb11.jpg', '2024-11-20 14:23:39', 'BAL_PLAY_RF-1536x864.jpg'),
(255, 42, 'arquivos/673e1b1bbed17.jpg', '2024-11-20 14:23:39', 'BAL_QUADRA_RF-1536x864.jpg'),
(256, 43, 'arquivos/673e2e8d95934.jpg', '2024-11-20 15:46:37', 'QUARTZO_BRINQUEDOTECA_RF-1024x1024.jpg'),
(257, 43, 'arquivos/673e2e8d95b3a.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_BEACH_TENNIS_R01-1024x1024.jpg'),
(258, 43, 'arquivos/673e2e8d95ce3.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_BOULEVARD_R02-1-1024x1024.jpg'),
(259, 43, 'arquivos/673e2e8d95e84.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_GOURMET_R01-1024x1024.jpg'),
(260, 43, 'arquivos/673e2e8d96004.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_PET_RF-1024x1024.jpg'),
(261, 43, 'arquivos/673e2e8d96183.jpg', '2024-11-20 15:46:37', 'QUARTZO_CAM_QUADRA_R01-1024x1024.jpg'),
(262, 43, 'arquivos/673e2e8d962ff.jpg', '2024-11-20 15:46:37', 'QUARTZO_COWORKING_RF-1024x1024.jpg'),
(263, 43, 'arquivos/673e2e8d96f22.jpg', '2024-11-20 15:46:37', 'QUARTZO_DELIVERY_RF-1024x1024.jpg'),
(264, 43, 'arquivos/673e2e8d970e6.jpg', '2024-11-20 15:46:37', 'QUARTZO_ESPACO-BELEZA_RF-1024x1024.jpg'),
(265, 43, 'arquivos/673e2e8d97334.jpg', '2024-11-20 15:46:37', 'QUARTZO_FITNESS_RF-1024x1024.jpg'),
(266, 43, 'arquivos/673e2e8d97554.jpg', '2024-11-20 15:46:37', 'QUARTZO_JOGOS_RF-1024x1024.jpg'),
(267, 43, 'arquivos/673e2e8d9778a.jpg', '2024-11-20 15:46:37', 'QUARTZO_MINI-MERCADO_RF-1024x1024.jpg'),
(268, 43, 'arquivos/673e2e8d97947.jpg', '2024-11-20 15:46:37', 'QUARTZO_OFICINA_RF-1024x1024.jpg'),
(269, 43, 'arquivos/673e2e8d97ad0.jpg', '2024-11-20 15:46:37', 'QUARTZO_PET-WASH_RF-1024x1024.jpg'),
(270, 43, 'arquivos/673e2e8d97c52.jpg', '2024-11-20 15:46:37', 'QUARTZO_PISCINA_RF-1024x1024.jpg'),
(271, 43, 'arquivos/673e2e8d97dcf.jpg', '2024-11-20 15:46:37', 'QUARTZO_SALAO-FESTAS_RF-1024x1024.jpg'),
(272, 44, 'arquivos/673e3117be958.jpg', '2024-11-20 15:57:27', 'Churrasqueira-1-scaled.jpg'),
(273, 44, 'arquivos/673e3117beb85.jpg', '2024-11-20 15:57:27', 'Estacionamento.dia_-scaled.jpg'),
(274, 44, 'arquivos/673e3117bed2a.jpg', '2024-11-20 15:57:27', 'PetPlace-scaled.jpg'),
(275, 44, 'arquivos/673e3117beea4.jpg', '2024-11-20 15:57:27', 'Piscina-1-scaled.jpg'),
(276, 44, 'arquivos/673e3117bf022.jpg', '2024-11-20 15:57:27', 'Playground-scaled.jpg'),
(277, 44, 'arquivos/673e3117bf1d4.jpg', '2024-11-20 15:57:27', 'Salao_Festa-scaled.jpg'),
(278, 45, 'arquivos/673e37d9128eb.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-churrasqueira.jpg'),
(279, 45, 'arquivos/673e37d913e74.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-espaco-yoga.jpg'),
(280, 45, 'arquivos/673e37d914078.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-fitness.jpg'),
(281, 45, 'arquivos/673e37d9142fa.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-lounge-festas.jpg'),
(282, 45, 'arquivos/673e37d915903.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-mini-market.jpg'),
(283, 45, 'arquivos/673e37d915b2d.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-pet-place.jpg'),
(284, 45, 'arquivos/673e37d915d41.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-piscina-1.jpg'),
(285, 45, 'arquivos/673e37d915ee1.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-playground.jpg'),
(286, 45, 'arquivos/673e37d91604f.jpg', '2024-11-20 16:26:17', 'arbore-engenharia-link-campinas-salao-de-festas.jpg'),
(287, 48, 'arquivos/673e3fb386ac1.jpg', '2024-11-20 16:59:47', 'MRV_CANTO DA MATA - IMPLA LAZER_IMPRESSAO_150DPI.jpg'),
(288, 48, 'arquivos/673e3fb386c8c.jpg', '2024-11-20 16:59:47', 'MRV_CANTO DA MATA - PISCINA_IMPRESSAO_150DPI.jpg'),
(289, 48, 'arquivos/673e3fb386e1e.jpg', '2024-11-20 16:59:47', 'MRV_CANTO DA MATA - PLAY_IMPRESSAO_150DPI.jpg'),
(290, 48, 'arquivos/673e3fb386f93.jpg', '2024-11-20 16:59:47', 'MRV_CANTO DA MATA - SALA COZINHA_IMPRESSAO_150DPI.jpg'),
(291, 49, 'arquivos/673e51929ebbc.jpg', '2024-11-20 18:16:02', '03-portaria.jpg'),
(292, 49, 'arquivos/673e51929ee06.jpg', '2024-11-20 18:16:02', '04-piscina.jpg'),
(293, 49, 'arquivos/673e51929efe6.jpg', '2024-11-20 18:16:02', '06-salao-de-festas.jpg'),
(294, 49, 'arquivos/673e51929f189.jpg', '2024-11-20 18:16:02', '07-churrasqueira.jpg'),
(295, 49, 'arquivos/673e51929f338.jpg', '2024-11-20 18:16:02', '08-quadra-de-areia.jpg'),
(296, 49, 'arquivos/673e51929f4f1.jpg', '2024-11-20 18:16:02', '09-quadra-recreativa.jpg'),
(297, 49, 'arquivos/673e51929f670.jpg', '2024-11-20 18:16:02', '11-playground.jpg'),
(298, 49, 'arquivos/673e51929f7e4.jpg', '2024-11-20 18:16:02', '13-pet-place.jpg'),
(299, 49, 'arquivos/673e51929f961.jpg', '2024-11-20 18:16:02', '14-vista-aerea-lazer.jpg'),
(300, 49, 'arquivos/673e51929fadf.jpg', '2024-11-20 18:16:02', '17-ferramentas-compartilhadas.jpg'),
(301, 49, 'arquivos/673e51929fc58.jpg', '2024-11-20 18:16:02', '19-vista-1.jpg'),
(302, 50, 'arquivos/673e58f76938b.jpg', '2024-11-20 18:47:35', 'Brinquedoteca_536c2f5402.jpg'),
(303, 50, 'arquivos/673e58f7695ca.jpg', '2024-11-20 18:47:35', 'Coworking_5e39713d05.jpg'),
(304, 50, 'arquivos/673e58f769770.jpg', '2024-11-20 18:47:35', 'Gourmet_837cce6ae5.jpg'),
(305, 50, 'arquivos/673e58f7698d7.jpg', '2024-11-20 18:47:35', 'Portaria_d1fe4b893e.jpg'),
(306, 52, 'arquivos/673f3e1182d74.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_IMP.3D_GERAL_FINAL_2024.07.188adee29d-93d2-42db-a795-15456e71ab4d.jpg'),
(307, 52, 'arquivos/673f3e1182f15.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_INSERÇO_FOTO_FINAL_2024.07.18a5d8e544-c4bc-4581-8aa5-ff32f1301d1b.jpg'),
(308, 52, 'arquivos/673f3e11830a5.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_INTERNA_GARDEM_FINAL_2024.07.18943717d9-6caa-425e-bbf8-5c48c0a9aa87.jpg'),
(309, 52, 'arquivos/673f3e1183219.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_INTERNA_QUARTO_CASAL_FINAL_2024.07.187ce33eb7-2911-40d2-9321-849205570bbd.jpg'),
(310, 52, 'arquivos/673f3e1183398.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_INTERNA_QUARTO_SOLTEIRO_FINAL_2024.07.18ae5be4eb-854e-4162-ad68-2729041beac2.jpg'),
(311, 52, 'arquivos/673f3e118350e.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_INTERNA_SALA_COZINHA_FINAL_2024.07.186b322f7c-8312-4263-8840-3ddb48833bba.jpg'),
(312, 52, 'arquivos/673f3e1183687.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_PPC_GOURMET_FINAL_2024.07.18a32255f5-8abd-45e1-b693-f48945a715e4.jpg'),
(313, 52, 'arquivos/673f3e11837ff.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_PPC_GUARITA_FINAL_2024.07.1852171823-5c8a-4a46-bac4-edb4eaddf21a (1).jpg'),
(314, 52, 'arquivos/673f3e118396e.jpg', '2024-11-21 11:05:05', 'MRV_CANOAS_PPC_PISCINA_FINAL_2024.07.180127eaad-f8d5-4671-b2ff-79ca2e182955.jpg'),
(315, 53, 'arquivos/673f424504c9b.jpg', '2024-11-21 11:23:01', 'Perspectiva-CarWash-RiseParquePrado.jpg.jpg'),
(316, 53, 'arquivos/673f424504e33.jpg', '2024-11-21 11:23:01', 'Perspectiva-Churrasqueira-RiseParquePrado.jpg.jpg'),
(317, 53, 'arquivos/673f424504fb3.jpg', '2024-11-21 11:23:01', 'Perspectiva-Coworking-RiseParquePrado.jpg.jpg'),
(318, 53, 'arquivos/673f42450512b.jpg', '2024-11-21 11:23:01', 'Perspectiva-Guarita-RiseParquePrado.jpg.jpg'),
(319, 53, 'arquivos/673f4245052a7.jpg', '2024-11-21 11:23:01', 'Perspectiva-Living-RiseParquePrado.jpg.jpg'),
(320, 53, 'arquivos/673f424505442.jpg', '2024-11-21 11:23:01', 'Perspectiva-LoungeExterno-RiseParquePrado.jpg.jpg'),
(321, 53, 'arquivos/673f4245055d0.jpg', '2024-11-21 11:23:01', 'Perspectiva-Piscina-RiseParquePrado.jpg.jpg'),
(322, 53, 'arquivos/673f424505745.jpg', '2024-11-21 11:23:01', 'Perspectiva-Playbaby-RiseParquePrado.jpg.jpg'),
(323, 53, 'arquivos/673f4245058b6.jpg', '2024-11-21 11:23:01', 'Perspectiva-SaladeJogos-RiseParquePrado.jpg.jpg'),
(324, 53, 'arquivos/673f424505a20.jpg', '2024-11-21 11:23:01', 'Perspectiva-SalaodeFestas-RiseParquePrado.jpg.jpg'),
(325, 53, 'arquivos/673f424505b97.jpg', '2024-11-21 11:23:01', 'Perspectiva-SportBar-RiseParquePrado.jpg.jpg'),
(326, 54, 'arquivos/673f449707ba0.jpg', '2024-11-21 11:32:55', 'Apto-sala-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(327, 54, 'arquivos/673f449707dac.jpg', '2024-11-21 11:32:55', 'Apto-varanda-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(328, 54, 'arquivos/673f449707f5f.jpg', '2024-11-21 11:32:55', 'bicicletario-Breve-Lancamento-Amoreira-Direcional.png.jpg'),
(329, 54, 'arquivos/673f4497080e5.jpg', '2024-11-21 11:32:55', 'fitness-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(330, 54, 'arquivos/673f449708294.jpg', '2024-11-21 11:32:55', 'garden-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(331, 54, 'arquivos/673f449708415.jpg', '2024-11-21 11:32:55', 'gourmet-2-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(332, 54, 'arquivos/673f44970858e.jpg', '2024-11-21 11:32:55', 'gourmet-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(333, 54, 'arquivos/673f4497086fc.jpg', '2024-11-21 11:32:55', 'pet-place-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(334, 54, 'arquivos/673f44970886a.jpg', '2024-11-21 11:32:55', 'playground-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(335, 54, 'arquivos/673f4497089f5.jpg', '2024-11-21 11:32:55', 'Portaria_SeletoAmoreiras.jpg.jpg'),
(336, 54, 'arquivos/673f449708bf7.jpg', '2024-11-21 11:32:55', 'praca-2-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(337, 54, 'arquivos/673f449708d8a.jpg', '2024-11-21 11:32:55', 'quadra-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(338, 54, 'arquivos/673f449708f1f.jpg', '2024-11-21 11:32:55', 'redario-Breve-Lancamento-Amoreira-Direcional.jpg.jpg'),
(339, 54, 'arquivos/673f4497090e4.jpg', '2024-11-21 11:32:55', 'salao-de-festas-Breve-Lancamento-Amoreira-Direcional-tura-2q-meio-2pav-be-up-riva.jpg.jpg'),
(341, 56, 'arquivos/673f7352938ca.jpg', '2024-11-21 14:52:18', 'Casa_Dia-scaled.jpg'),
(342, 56, 'arquivos/673f735293a9a.jpg', '2024-11-21 14:52:18', 'Cozinha-As-scaled.jpg'),
(343, 56, 'arquivos/673f735293c0e.jpg', '2024-11-21 14:52:18', 'Estar-Jantar-scaled.jpg'),
(344, 56, 'arquivos/673f735293dba.jpg', '2024-11-21 14:52:18', 'Guarita_Dia-scaled.jpg'),
(345, 56, 'arquivos/673f735293f50.jpg', '2024-11-21 14:52:18', 'PetPlace-scaled.jpg'),
(346, 56, 'arquivos/673f7352940da.jpg', '2024-11-21 14:52:18', 'Playground-scaled.jpg'),
(347, 56, 'arquivos/673f735294245.jpg', '2024-11-21 14:52:18', 'Predio_Dia-scaled.jpg'),
(348, 56, 'arquivos/673f7352943b2.jpg', '2024-11-21 14:52:18', 'Predio_Tarde-scaled.jpg'),
(349, 56, 'arquivos/673f73529451e.jpg', '2024-11-21 14:52:18', 'Quarto-Casalcasa-scaled.jpg'),
(350, 56, 'arquivos/673f735294698.jpg', '2024-11-21 14:52:18', 'Quarto-Casal-scaled.jpg'),
(351, 56, 'arquivos/673f735294820.jpg', '2024-11-21 14:52:18', 'Quarto-Kids-scaled.jpg'),
(352, 56, 'arquivos/673f7352949ed.jpg', '2024-11-21 14:52:18', 'Sobrado_Dia-scaled.jpg'),
(353, 58, 'arquivos/673f79eeabe8f.jpg', '2024-11-21 15:20:30', '1ef03fc9-fc52-6de0-a408-0e9c2a6949bd.jpg'),
(354, 58, 'arquivos/673f79eeac028.jpg', '2024-11-21 15:20:30', '1ef03fc9-fc53-60ec-beb2-0e9c2a6949bd.jpg'),
(355, 58, 'arquivos/673f79eeac1b8.jpg', '2024-11-21 15:20:30', '1ef03fca-2f2b-6460-b230-0e9c2a6949bd.jpg'),
(356, 58, 'arquivos/673f79eeac338.jpg', '2024-11-21 15:20:30', '1ef03fca-2fb5-6c64-b70f-0e9c2a6949bd.jpg'),
(357, 58, 'arquivos/673f79eeac4be.jpg', '2024-11-21 15:20:30', '1ef03fca-60de-6ed0-aef0-0e9c2a6949bd.jpg'),
(358, 58, 'arquivos/673f79eeac633.jpg', '2024-11-21 15:20:30', '1ef03fca-93c4-6a7a-a553-0e9c2a6949bd.jpg'),
(359, 58, 'arquivos/673f79eeac79b.jpg', '2024-11-21 15:20:30', '1ef03fca-94ab-6f56-aace-0e9c2a6949bd.jpg'),
(360, 59, 'arquivos/673f857d30dae.jpg', '2024-11-21 16:09:49', 'academia.jpg'),
(361, 59, 'arquivos/673f857d31044.jpg', '2024-11-21 16:09:49', 'fachada.jpg'),
(362, 59, 'arquivos/673f857d311dd.jpg', '2024-11-21 16:09:49', 'kids.jpg'),
(363, 59, 'arquivos/673f857d31354.jpg', '2024-11-21 16:09:49', 'piscina.jpg'),
(364, 59, 'arquivos/673f857d314c7.jpg', '2024-11-21 16:09:49', 'portaria.jpg'),
(365, 59, 'arquivos/673f857d31652.jpg', '2024-11-21 16:09:49', 'salão.jpg'),
(366, 59, 'arquivos/673f857d317c3.jpg', '2024-11-21 16:09:49', 'steak house.jpg'),
(367, 60, 'arquivos/673f88d6acf32.jpg', '2024-11-21 16:24:06', '03_HM_26_05_PLAYGROUND_V08_c6f4c2c1f0.jpg'),
(368, 60, 'arquivos/673f88d6ae176.jpg', '2024-11-21 16:24:06', '05_HM_26_GOURMET_V06_efaf62e0b0.jpg'),
(369, 60, 'arquivos/673f88d6ae380.jpg', '2024-11-21 16:24:06', '06_HM_26_PETPLACE_V06_3988458ae5.jpg'),
(370, 60, 'arquivos/673f88d6ae53b.jpg', '2024-11-21 16:24:06', '07_HM_26_04_HM_FIT_V05_71d2a64897.jpg'),
(371, 60, 'arquivos/673f88d6ae6cb.jpg', '2024-11-21 16:24:06', '09_HM_26_PIZZA_CHURRASCO_V06_8914925194.jpg'),
(372, 60, 'arquivos/673f88d6ae854.jpg', '2024-11-21 16:24:06', '10_HM_26_PISCINA_V07_84ec775840.jpg'),
(373, 60, 'arquivos/673f88d6ae9c8.jpg', '2024-11-21 16:24:06', '11_HM_26_FITNESS_V06_657c60fd3d.jpg'),
(374, 60, 'arquivos/673f88d6aeb40.jpg', '2024-11-21 16:24:06', 'hm_intense_valinhos_fachada_8d8a3bca63.jpg'),
(375, 60, 'arquivos/673f88d6aecbf.jpg', '2024-11-21 16:24:06', 'hm_intense_valinhos_portaria_1a58d0a8a4_dba4e09450.jpg'),
(376, 61, 'arquivos/673f93cc6506c.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-3.png'),
(377, 61, 'arquivos/673f93cc652ab.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-4.png'),
(378, 61, 'arquivos/673f93cc65441.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-5.png'),
(379, 61, 'arquivos/673f93cc655c4.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-6.png'),
(380, 61, 'arquivos/673f93cc65744.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-7.png'),
(381, 61, 'arquivos/673f93cc658bf.png', '2024-11-21 17:10:52', 'sem-titulo-2-9492da60b92c6a9686e696e7bf995e80a2e233b6-8.png'),
(382, 61, 'arquivos/673f93cc65a77.png', '2024-11-21 17:10:52', 'sem-titulo-5-878bf5f215b9d003a07ec2edabb9402016c633cf-10.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `EmailUser` varchar(60) DEFAULT NULL,
  `SenhaUser` varchar(255) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `NomeCompleto` varchar(255) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `data_upload` datetime NOT NULL DEFAULT current_timestamp(),
  `nomeFoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`EmailUser`, `SenhaUser`, `idUser`, `NomeCompleto`, `cargo`, `path`, `data_upload`, `nomeFoto`) VALUES
('alan_usuario@endless.com', '$2y$10$0egsonzdX0BoW/cav5Ge9O/WBKk8UiAw0E/TJbTBVQIZ7l97bwFc.', 1, 'Alan Bezerra dos Santos', 'Corretor', 'arquivos/671a3d637b62c.jpg', '2024-10-02 13:46:03', 'endless2DcomFundo.jpg'),
('vinicius_admin@endless.com', '$2y$10$XRO2717LWytCXLPkFnV6xOOHA2jNWOzb1fCvsNzcdgQeNpakRL1eq', 2, 'Vinicius da Silva Santos', 'Administrador', 'arquivos/670fb7dfd876f.png', '2024-10-08 14:52:50', 'endless3DsemFundo.png'),
('murilo_usuario@endless.com', '$2y$10$.9PJGAotW.Cfsu8QxM1f7.13ZfyOae/vxkJNuw/xdLDsz8qopmI76', 3, 'Murilo Albieri Marques', 'Corretor', '', '2024-10-29 21:31:32', ''),
('ericasantosconsultoria@endless.com', '$2y$10$rA9.phqIMq5HQxATc2Scpe9c69V1mMz2Te3q9ANrwUMZ8vfngVjcO', 4, 'Erica Danielle da Silva Santos', 'Corretor', 'arquivos/673c98c265403.jpg', '2024-11-19 14:48:11', 'foto_Erica.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `IdImovel` (`IdImovel`);

--
-- Índices para tabela `cadimovel`
--
ALTER TABLE `cadimovel`
  ADD PRIMARY KEY (`IdImovel`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_cliente`),
  ADD KEY `fk_IdImovel_cliente` (`IdImovel`),
  ADD KEY `fk_idUser_cliente` (`idUser`);

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`IdDocumento`),
  ADD KEY `fk_idUser` (`idUser`),
  ADD KEY `fk_IdCliente` (`Id_cliente`);

--
-- Índices para tabela `imagemprincipal`
--
ALTER TABLE `imagemprincipal`
  ADD PRIMARY KEY (`IdImagem`),
  ADD KEY `IdImovel` (`IdImovel`);

--
-- Índices para tabela `imagensimovel`
--
ALTER TABLE `imagensimovel`
  ADD PRIMARY KEY (`IdImagem`),
  ADD KEY `fk_IdImovel` (`IdImovel`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `book`
--
ALTER TABLE `book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `cadimovel`
--
ALTER TABLE `cadimovel`
  MODIFY `IdImovel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `IdDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imagemprincipal`
--
ALTER TABLE `imagemprincipal`
  MODIFY `IdImagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `imagensimovel`
--
ALTER TABLE `imagensimovel`
  MODIFY `IdImagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `IdImovel` FOREIGN KEY (`IdImovel`) REFERENCES `cadimovel` (`IdImovel`);

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_IdImovel_cliente` FOREIGN KEY (`IdImovel`) REFERENCES `cadimovel` (`IdImovel`),
  ADD CONSTRAINT `fk_idUser_cliente` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`);

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_IdCliente` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`),
  ADD CONSTRAINT `fk_idUser` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idUser`);

--
-- Limitadores para a tabela `imagemprincipal`
--
ALTER TABLE `imagemprincipal`
  ADD CONSTRAINT `imagemprincipal_ibfk_1` FOREIGN KEY (`IdImovel`) REFERENCES `cadimovel` (`IdImovel`);

--
-- Limitadores para a tabela `imagensimovel`
--
ALTER TABLE `imagensimovel`
  ADD CONSTRAINT `fk_IdImovel` FOREIGN KEY (`IdImovel`) REFERENCES `cadimovel` (`IdImovel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
