-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 02 2021 г., 12:19
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `larav_vue_blog_v6_passport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2021_02_16_195421_create_wpressImage_category_table', 1),
(10, '2021_02_16_195648_create_wpressImages_blog_post_table', 1),
(11, '2021_02_16_200932_create_wpressImage_imagesStocks_table', 1),
(12, '2021_06_04_133656_add_apikey_columns_to_users_table', 1),
(13, '2021_08_02_075937_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 2),
(2, 'App\\User', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit articles', 'web', '2021-08-02 09:18:34', '2021-08-02 09:18:34'),
(2, 'delete articles', 'web', '2021-08-02 09:18:34', '2021-08-02 09:18:34');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'AdminX', 'web', '2021-08-02 09:18:34', '2021-08-02 09:18:34');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `api_token`) VALUES
(1, 'Admin', 'admin@ukr.net', '$2y$10$SxPCHZps4c40A/aypIAEyOKb9htBg5lr5KQ/30Z.CcbAFKDUSYDDC', NULL, NULL, NULL, NULL),
(2, 'Dima', 'dimmm931@gmail.com', '$2y$10$DkOQqPpQ0DAR3Ko7wg0xVOl4lHQM2HiXNvgqcaomB3.Fwr7LprHG2', NULL, NULL, NULL, NULL),
(3, 'Olya', 'olya@gmail.com', '$2y$10$yhlpCSSc4Mg8BOjmv4Ub6.gqHjoYXrytEL3vop1quih5D5F/TaWZa', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimages_blog_post`
--

CREATE TABLE `wpressimages_blog_post` (
  `wpBlog_id` int(10) UNSIGNED NOT NULL,
  `wpBlog_title` varchar(222) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpBlog_text` text COLLATE utf8mb4_unicode_ci,
  `wpBlog_author` int(11) DEFAULT NULL,
  `wpBlog_created_at` timestamp NULL DEFAULT NULL,
  `wpBlog_category` int(10) UNSIGNED DEFAULT NULL COMMENT 'Category',
  `wpBlog_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimages_blog_post`
--

INSERT INTO `wpressimages_blog_post` (`wpBlog_id`, `wpBlog_title`, `wpBlog_text`, `wpBlog_author`, `wpBlog_created_at`, `wpBlog_category`, `wpBlog_status`) VALUES
(1, 'Mr. Kaley Kuphal DDS', 'Off with his head!\"\' \'How dreadfully savage!\' exclaimed Alice. \'And where HAVE my shoulders got to? And oh, I wish I hadn\'t drunk quite so much!\' Alas! it was the fan and two or three times over to.', 1, NULL, 5, '1'),
(2, 'Ms. Brenda Windler III', 'However, I\'ve got to?\' (Alice had been (Before she had wept when she looked at it gloomily: then he dipped it into one of the earth. Let me see: I\'ll give them a new idea to Alice, \'Have you seen.', 1, NULL, 3, '1'),
(3, 'Lizzie Shields', 'White Rabbit, with a table set out under a tree a few minutes, and she put them into a doze; but, on being pinched by the officers of the gloves, and she drew herself up and walking off to the door.', 1, NULL, 3, '1'),
(4, 'Gayle Abshire DVM', 'Queen in front of them, with her face like the Queen?\' said the March Hare said--\' \'I didn\'t!\' the March Hare. \'Yes, please do!\' but the Rabbit coming to look down and looked at the number of.', 1, NULL, 3, '1'),
(5, 'Hans Sawayn', 'Like a tea-tray in the same thing as \"I get what I see\"!\' \'You might just as well as she went on muttering over the edge with each hand. \'And now which is which?\' she said aloud. \'I must go back by.', 1, NULL, 2, '1'),
(6, 'Brionna Davis MD', 'YOUR business, Two!\' said Seven. \'Yes, it IS his business!\' said Five, in a low voice. \'Not at all,\' said the Rabbit\'s little white kid gloves: she took courage, and went on planning to herself how.', 1, NULL, 5, '1'),
(7, 'Gardner Homenick', 'Dinah, and saying \"Come up again, dear!\" I shall have to ask them what the moral of THAT is--\"Take care of the sort. Next came the guests, mostly Kings and Queens, and among them Alice recognised.', 1, NULL, 2, '1'),
(8, 'Felicia Leannon', 'Alice, (she had grown in the middle. Alice kept her eyes filled with cupboards and book-shelves; here and there. There was a general clapping of hands at this: it was quite out of the hall: in fact.', 1, NULL, 3, '1'),
(9, 'Oswald Mayert', 'HAVE my shoulders got to? And oh, I wish I hadn\'t quite finished my tea when I find a pleasure in all directions, tumbling up against each other; however, they got their tails in their paws. \'And.', 1, NULL, 2, '1'),
(10, 'Chaz Koch', 'Queen, the royal children; there were three little sisters,\' the Dormouse said--\' the Hatter added as an explanation. \'Oh, you\'re sure to do such a hurry that she was not an encouraging opening for.', 1, NULL, 1, '1'),
(11, 'Emilie Schulist', 'I begin, please your Majesty?\' he asked. \'Begin at the great puzzle!\' And she opened the door began sneezing all at once. \'Give your evidence,\' said the Pigeon; \'but I know who I am! But I\'d better.', 1, NULL, 1, '1'),
(12, 'Mrs. Margarete Sipes', 'It was so small as this is May it won\'t be raving mad after all! I almost wish I had to kneel down on her face in her hands, and began:-- \'You are old,\' said the Caterpillar. \'Well, I\'ve tried to.', 1, NULL, 1, '1'),
(13, 'Pamela Lueilwitz', 'Next came the royal children; there were TWO little shrieks, and more faintly came, carried on the twelfth?\' Alice went on saying to herself \'It\'s the oldest rule in the pool, and the other paw.', 1, NULL, 2, '1'),
(14, 'Mr. Carleton Osinski DVM', 'She drew her foot as far as they came nearer, Alice could not possibly reach it: she could do to ask: perhaps I shall never get to the part about her repeating \'YOU ARE OLD, FATHER WILLIAM,\"\' said.', 1, NULL, 5, '1'),
(15, 'Kyra White', 'And she squeezed herself up closer to Alice\'s side as she leant against a buttercup to rest her chin in salt water. Her first idea was that it might tell her something worth hearing. For some.', 1, NULL, 3, '1'),
(16, 'Mr. Elmore Blick', 'While she was shrinking rapidly; so she went on talking: \'Dear, dear! How queer everything is queer to-day.\' Just then her head was so large a house, that she had put on your shoes and stockings for.', 1, NULL, 4, '1'),
(17, 'Silas Wilkinson', 'Alice did not sneeze, were the two creatures got so much contradicted in her haste, she had wept when she had forgotten the little door, so she set to work throwing everything within her reach at.', 1, NULL, 5, '1'),
(18, 'Prof. Chance Kovacek', 'Alice\'s elbow was pressed so closely against her foot, that there was Mystery,\' the Mock Turtle: \'crumbs would all wash off in the night? Let me see: I\'ll give them a new pair of the court. (As that.', 1, NULL, 5, '1'),
(19, 'Jevon Dach', 'King. Here one of these cakes,\' she thought, \'till its ears have come, or at any rate,\' said Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Pigeon; \'but I haven\'t had a VERY good opportunity.', 1, NULL, 1, '1'),
(20, 'Eunice Dickens', 'It was high time you were or might have been a holiday?\' \'Of course it is,\' said the Cat, \'or you wouldn\'t have come here.\' Alice didn\'t think that will be much the same as the large birds.', 1, NULL, 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_category`
--

CREATE TABLE `wpressimage_category` (
  `wpCategory_id` int(10) UNSIGNED NOT NULL,
  `wpCategory_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_category`
--

INSERT INTO `wpressimage_category` (`wpCategory_id`, `wpCategory_name`, `created_at`, `updated_at`) VALUES
(1, 'News', NULL, NULL),
(2, 'Art', NULL, NULL),
(3, 'Sport', NULL, NULL),
(4, 'Geeks', NULL, NULL),
(5, 'Drops', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `wpressimage_imagesstock`
--

CREATE TABLE `wpressimage_imagesstock` (
  `wpImStock_id` int(10) UNSIGNED NOT NULL,
  `wpImStock_name` varchar(77) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wpImStock_postID` int(10) UNSIGNED DEFAULT NULL COMMENT 'Author ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `wpressimage_imagesstock`
--

INSERT INTO `wpressimage_imagesstock` (`wpImStock_id`, `wpImStock_name`, `wpImStock_postID`, `created_at`, `updated_at`) VALUES
(1, 'product1.png', 1, NULL, NULL),
(2, 'product2.png', 2, NULL, NULL),
(3, 'product3.png', 3, NULL, NULL),
(4, 'product4.png', 4, NULL, NULL),
(5, 'product5.png', 5, NULL, NULL),
(6, 'product6.png', 6, NULL, NULL),
(7, 'product7.jpg', 7, NULL, NULL),
(8, 'product8.jpg', 8, NULL, NULL),
(9, 'product9.jpg', 9, NULL, NULL),
(10, 'product10.jpg', 10, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`);

--
-- Индексы таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  ADD PRIMARY KEY (`wpBlog_id`),
  ADD KEY `wpressimages_blog_post_wpblog_category_foreign` (`wpBlog_category`);

--
-- Индексы таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  ADD PRIMARY KEY (`wpCategory_id`);

--
-- Индексы таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  ADD PRIMARY KEY (`wpImStock_id`),
  ADD KEY `wpressimage_imagesstock_wpimstock_postid_foreign` (`wpImStock_postID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  MODIFY `wpBlog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `wpressimage_category`
--
ALTER TABLE `wpressimage_category`
  MODIFY `wpCategory_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  MODIFY `wpImStock_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wpressimages_blog_post`
--
ALTER TABLE `wpressimages_blog_post`
  ADD CONSTRAINT `wpressimages_blog_post_wpblog_category_foreign` FOREIGN KEY (`wpBlog_category`) REFERENCES `wpressimage_category` (`wpCategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `wpressimage_imagesstock`
--
ALTER TABLE `wpressimage_imagesstock`
  ADD CONSTRAINT `wpressimage_imagesstock_wpimstock_postid_foreign` FOREIGN KEY (`wpImStock_postID`) REFERENCES `wpressimages_blog_post` (`wpBlog_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
