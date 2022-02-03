-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03-Fev-2022 às 23:21
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devsbook`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `postcomments`
--

CREATE TABLE `postcomments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postlikes`
--

CREATE TABLE `postlikes` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `postlikes`
--

INSERT INTO `postlikes` (`id`, `id_post`, `id_user`, `created_at`) VALUES
(3, 3, 12, '2022-02-03 18:26:23'),
(4, 2, 12, '2022-02-03 18:26:38'),
(5, 9, 14, '2022-02-03 18:39:17'),
(6, 10, 12, '2022-02-03 18:59:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `type`, `created_at`, `body`) VALUES
(1, 14, 'text', '2022-01-16 09:55:00', 'Opa, tudo bem?'),
(2, 14, 'text', '2022-01-16 22:16:48', 'na morte da bezerra'),
(3, 14, 'text', '2022-01-17 10:01:49', 'nao funcionou'),
(4, 12, 'text', '2022-01-18 09:57:37', 'alguma coisa'),
(5, 12, 'text', '2022-01-19 09:25:01', 'novo post para testar\r\nse esta pulando linha\r\nok'),
(6, 12, 'text', '2022-01-19 09:28:25', 'teste'),
(7, 12, 'text', '2022-01-19 09:30:11', 'outro teste'),
(8, 12, 'text', '2022-01-19 09:30:33', 'teste de linha\r\noutra linha\r\nmais uma linha'),
(9, 12, 'text', '2022-01-19 09:30:48', 'agora 2 linhas\r\naqui vai'),
(10, 14, 'text', '2022-01-25 23:55:11', 'de novo na morte da bezerra'),
(11, 12, 'text', '2022-02-03 23:15:52', 'Hoje consegui superar meus limites by \r\nYami Sukehiro capitão dos black bulls');

-- --------------------------------------------------------

--
-- Estrutura da tabela `userrelation`
--

CREATE TABLE `userrelation` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `userrelation`
--

INSERT INTO `userrelation` (`id`, `user_from`, `user_to`) VALUES
(1, 12, 14),
(2, 14, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `city` varchar(100) NOT NULL,
  `work` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT 'default.jpg',
  `cover` varchar(100) DEFAULT NULL,
  `token` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `birthdate`, `city`, `work`, `avatar`, `cover`, `token`) VALUES
(12, 'thiago pinheiro', 'thiago@hhh.com', '$2y$10$UUmGR8z7mNKUxG08h8rW1up6JZRt4TtR0YKUyahd4I7zRdULEi8Ga', '1984-09-29', 'são paulo', 'lamace', '50a213c372ab4f545476187c15426431jpg', '7bcd9d8e7ad7e6fb5512f32ee9f155dajpg', 'eef30309a75862a183a6967af32db2b9'),
(14, 'elisangela my love', 'elisangela@querida.com', '$2y$10$FX5eXIbKw6TWWNdOENvG8eeQ0/sWNjMOV4LyKQ0GnGe6Dg4PNaiBu', '1983-05-31', '', '', 'be3645341c79979f3cfdb9b1f0fea6e8jpg', 'cover.jpg', '2a1712363d2f12aeadc503e089627100');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `postlikes`
--
ALTER TABLE `postlikes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `userrelation`
--
ALTER TABLE `userrelation`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `postlikes`
--
ALTER TABLE `postlikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `userrelation`
--
ALTER TABLE `userrelation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
