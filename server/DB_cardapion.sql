
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";

--
-- Banco de dados: `cardapion`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `user_criou_id` varchar(20) COLLATE utf8_bin NOT NULL,
  `nome_categoria` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comidas`
--

CREATE TABLE `comidas` (
  `id_comida` int(10) UNSIGNED NOT NULL,
  `nome_comida` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `descricao` text COLLATE utf8_bin DEFAULT NULL,
  `preco` decimal(6,0) NOT NULL,
  `categoria_comida_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `comida_foto_id` int(10) UNSIGNED NOT NULL,
  `categorias_user_criou_id` varchar(20) COLLATE utf8_bin NOT NULL,
  `fotos_users_upload_id` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_criou_id` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos`
--

CREATE TABLE `fotos` (
  `id_fotos` int(10) UNSIGNED NOT NULL,
  `users_upload_id` varchar(20) COLLATE utf8_bin NOT NULL,
  `nome_foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `path` varchar(200) COLLATE utf8_bin NOT NULL,
  `data_upload` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(11) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `tel` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `senha` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_criou` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT 'APP_ADM'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`,`user_criou_id`),
  ADD KEY `categorias_FKIndex1` (`user_criou_id`);

--
-- Índices para tabela `comidas`
--
ALTER TABLE `comidas`
  ADD PRIMARY KEY (`id_comida`,`categoria_comida_id`,`user_criou_id`,`categorias_user_criou_id`,`fotos_users_upload_id`,`comida_foto_id`),
  ADD KEY `comidas_FKIndex2` (`user_criou_id`),
  ADD KEY `comidas_FKIndex3` (`comida_foto_id`,`fotos_users_upload_id`),
  ADD KEY `categoria_comida_id` (`categoria_comida_id`) USING BTREE,
  ADD KEY `categoria_ibfk_2` (`categorias_user_criou_id`);

--
-- Índices para tabela `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id_fotos`,`users_upload_id`),
  ADD KEY `fotos_FKIndex1` (`users_upload_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comidas`
--
ALTER TABLE `comidas`
  MODIFY `id_comida` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id_fotos` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comidas`
--
ALTER TABLE `comidas`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`categoria_comida_id`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `categoria_ibfk_2` FOREIGN KEY (`categorias_user_criou_id`) REFERENCES `categorias` (`user_criou_id`),
  ADD CONSTRAINT `comidas_ibfk_2` FOREIGN KEY (`comida_foto_id`,`fotos_users_upload_id`) REFERENCES `fotos` (`id_fotos`, `users_upload_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

INSERT INTO `users` (`login`, `nome`, `cpf`, `email`, `tel`, `data_nasc`, `senha`, `user_criou`) VALUES ('admin', 'ADMINISTRADOR', '12345678912', 'contato@cardapion.com.br', '18997123456', '28-05-2023', MD5('admin'), 'APP_ADM');