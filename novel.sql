-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 03 2021 г., 15:26
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `novel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `character`
--

CREATE TABLE `character` (
  `id_character` int(11) NOT NULL,
  `id_novel` int(11) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `original_name` varchar(255) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `name_in_russian` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `character`
--

INSERT INTO `character` (`id_character`, `id_novel`, `image`, `original_name`, `gender`, `name_in_russian`, `role`, `description`) VALUES
(1, 32, 'https://s2.vndb.org/ch/29/22529.jpg', '主人公', 'male', 'Сатоши Кобояши', 'Протагонист', 'Спокойный и покладистый тип. Довольно хорошо разбирается в вещах, хотя и не очень сообразителен. Присоединился к Соко, чтобы помочь ей.');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_novel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `novel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `id_novel`, `id_user`, `name`, `novel`, `text`, `reply`, `created_at`, `updated_at`) VALUES
(45, 31, 4, 'user', 'Вершина Хаоса', '1', 0, '2021-01-06 09:24:20', '2021-01-06 12:24:20'),
(46, 33, 1, 'admin', 'В поисках утраченного будущего', 'Комментарий', 0, '2021-02-10 11:12:50', '2021-02-10 14:12:50'),
(47, 33, 1, '{{ $data->user->login }}', NULL, 'Chto-to', 46, '2021-02-10 11:13:19', '2021-02-10 14:13:19'),
(48, 33, 1, '{{ $data->user->login }}', NULL, '1`2313', 47, '2021-02-10 11:16:06', '2021-02-10 14:16:06');

-- --------------------------------------------------------

--
-- Структура таблицы `developer`
--

CREATE TABLE `developer` (
  `id_developer` int(11) NOT NULL,
  `developer` varchar(255) DEFAULT NULL,
  `logo` longtext DEFAULT NULL,
  `foundation_date` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `developer`
--

INSERT INTO `developer` (`id_developer`, `developer`, `logo`, `foundation_date`, `description`, `location`, `language`) VALUES
(9, 'Type-Moon', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Type-moon.svg/1280px-Type-moon.svg.png', '2000', 'Type-Moon (яп. タイプムーン Тайпу-Му:н) — японская компания, занимающаяся разработкой видеоигр, больше всего известная своими визуальными новеллами. Основана сценаристом Киноко Насу и иллюстратором Такаси Такэути. Компания также известна под именем Notes Co., Ltd. (яп. 有限会社ノーツ Ю:гэн-кайся Но:цу). После создания визуальной новеллы Tsukihime, которая принесла им известность, как игры кружка додзинси, Type-Moon была реорганизована и создала также популярную визуальную новеллу Fate/stay night. Обе их работы были адаптированы в аниме и мангу, что обеспечило им глобальную фан-базу.\r\n\r\nType-Moon (яп. タイプムーン Тайпу-Му:н) — японская компания, занимающаяся разработкой видеоигр, больше всего известная своими визуальными новеллами. Основана сценаристом Киноко Насу и иллюстратором Такаси Такэути. Компания также известна под именем Notes Co., Ltd. (яп. 有限会社ノーツ Ю:гэн-кайся Но:цу). После создания визуальной новеллы Tsukihime, которая принесла им известность, как игры кружка додзинси, Type-Moon была реорганизована и создала также популярную визуальную новеллу Fate/stay night. Обе их работы были адаптированы в аниме и мангу, что обеспечило им глобальную фан-базу.\r\n\r\n', 'Япония', 'Японский'),
(11, '07th Expansion', 'https://bananavape.ru/img/nophoto.jpg', '2002', '07th Expansion - это японский кружок додзинов, специализирующийся на создании визуальных новелл и музыки. Они начали рисовать для коллекционной карточной игры Leaf Fight, но известны созданием серии игр When They Cry. Ремейк игры на дополнительных консолях для Higurashi When They Cry был разработан компанией Alchemist .', 'Япония', 'Японский');

-- --------------------------------------------------------

--
-- Структура таблицы `directory_genre`
--

CREATE TABLE `directory_genre` (
  `id_genre` int(11) NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `directory_genre`
--

INSERT INTO `directory_genre` (`id_genre`, `genre`) VALUES
(1, 'Драма'),
(2, 'Комедия'),
(3, 'Научная фантастика'),
(4, 'Романтика'),
(5, 'Хоррор'),
(6, 'Экшн'),
(7, 'Детектив'),
(8, 'Триллер'),
(12, 'Мистика'),
(13, 'Повседневность'),
(14, 'Пародия'),
(15, 'Приключения'),
(16, 'Школа'),
(17, 'Фантастика'),
(18, 'Фентези'),
(19, 'Этти'),
(20, 'Хентай');

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id_favorites` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_novel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`id_favorites`, `id_user`, `id_novel`) VALUES
(5, 7, 32),
(6, 7, 31),
(7, 4, 28);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL,
  `id_novel` int(11) DEFAULT NULL,
  `image1` longtext DEFAULT NULL,
  `image2` longtext DEFAULT NULL,
  `image3` longtext DEFAULT NULL,
  `image4` longtext DEFAULT NULL,
  `image5` longtext DEFAULT NULL,
  `image6` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id_image`, `id_novel`, `image1`, `image2`, `image3`, `image4`, `image5`, `image6`) VALUES
(2, 10, 'https://anivisual.net/_sf/22/07803615.png', 'https://anivisual.net/_sf/22/41700900.png', 'https://anivisual.net/_sf/22/77309417.png', 'https://anivisual.net/_sf/22/14137321.png', 'https://anivisual.net/_sf/22/25212157.png', 'https://anivisual.net/_sf/22/63932931.png'),
(5, 12, 'https://anivisual.net/_sf/28/29418738.png', 'https://anivisual.net/_sf/28/42808136.png', 'https://anivisual.net/_sf/28/16565827.png', 'https://anivisual.net/_sf/28/79676490.png', 'https://anivisual.net/_sf/28/58196232.png', NULL),
(8, 13, 'https://anivisual.net/_sf/2/71204208.jpg', 'https://anivisual.net/_sf/2/23455330.jpg', 'https://anivisual.net/_sf/2/02815028.jpg', NULL, NULL, NULL),
(20, 25, 'https://anivisual.net/_sf/3/41248412.jpg', 'https://anivisual.net/_sf/3/80944572.jpg', 'https://anivisual.net/_sf/3/12539439.jpg', NULL, NULL, NULL),
(10, 14, 'https://anivisual.net/_sf/0/37043911.png', 'https://anivisual.net/_sf/0/97972167.png', 'https://anivisual.net/_sf/0/11749944.png', NULL, NULL, NULL),
(13, 17, 'https://anivisual.net/_sf/30/38969782.png', 'https://anivisual.net/_sf/30/18626739.png', 'https://anivisual.net/_sf/30/69361871.png', 'https://anivisual.net/_sf/30/18807137.png', 'https://anivisual.net/_sf/30/20340786.png', NULL),
(12, 16, 'https://anivisual.net/_sf/22/94299352.jpg', 'https://anivisual.net/_sf/22/06284327.jpg', 'https://anivisual.net/_sf/22/78478225.jpg', 'https://anivisual.net/_sf/22/11570594.jpg', NULL, NULL),
(14, 18, 'https://anivisual.net/_sf/16/88103056.png', 'https://anivisual.net/_sf/16/17154098.png', 'https://anivisual.net/_sf/16/16563394.png', 'https://anivisual.net/_sf/16/42169540.png', 'https://anivisual.net/_sf/16/10980828.png', 'https://anivisual.net/_sf/16/95620760.png'),
(15, 19, 'https://anivisual.net/_sf/23/54137379.jpg', 'https://anivisual.net/_sf/23/81432650.jpg', 'https://anivisual.net/_sf/23/06674407.jpg', 'https://anivisual.net/_sf/23/48775039.jpg', 'https://anivisual.net/_sf/23/02604065.jpg', NULL),
(16, 20, 'https://anivisual.net/_sf/13/96118408.jpg', 'https://anivisual.net/_sf/13/83327273.jpg', 'https://anivisual.net/_sf/13/38098074.jpg', 'https://anivisual.net/_sf/13/03850081.jpg', 'https://anivisual.net/_sf/13/52149889.jpg', 'https://anivisual.net/_sf/13/74117218.jpg'),
(17, 21, 'https://anivisual.net/_sf/0/97452003.png', 'https://anivisual.net/_sf/0/29196207.png', 'https://anivisual.net/_sf/0/36401901.png', 'https://anivisual.net/_sf/0/14559509.png', 'https://anivisual.net/_sf/0/94809085.png', NULL),
(18, 22, 'https://anivisual.net/_sf/2/54740541.png', 'https://anivisual.net/_sf/2/65207103.png', 'https://anivisual.net/_sf/2/47198717.png', 'https://anivisual.net/_sf/2/67429638.png', NULL, NULL),
(19, 23, 'https://anivisual.net/_sf/1/21964842.png', 'https://anivisual.net/_sf/1/53455110.png', 'https://anivisual.net/_sf/1/16380135.png', NULL, NULL, NULL),
(21, 26, 'https://anivisual.net/_sf/0/63869551.png', 'https://anivisual.net/_sf/0/03609140.png', 'https://anivisual.net/_sf/0/83180729.png', NULL, NULL, NULL),
(22, 27, 'https://anivisual.net/_sf/1/06857590.jpg', 'https://anivisual.net/_sf/1/89518339.jpg', 'https://anivisual.net/_sf/1/64457126.jpg', 'https://anivisual.net/_sf/1/16465710.jpg', 'https://anivisual.net/_sf/1/33825271.jpg', NULL),
(23, 28, 'https://anivisual.net/_sf/0/57490587.jpg', 'https://anivisual.net/_sf/0/62742618.jpg', 'https://anivisual.net/_sf/0/19962587.jpg', 'https://anivisual.net/_sf/8/66586777.jpg', NULL, NULL),
(24, 29, 'https://anivisual.net/_sf/2/80919829.jpg', 'https://anivisual.net/_sf/2/59606195.png', 'https://anivisual.net/_sf/2/45229455.png', NULL, NULL, NULL),
(25, 30, 'https://anivisual.net/_sf/1/38679989.jpg', 'https://anivisual.net/_sf/1/65149120.jpg', 'https://anivisual.net/_sf/1/18003814.jpg', NULL, NULL, NULL),
(26, 31, 'https://anivisual.net/_sf/22/77524671.png', 'https://anivisual.net/_sf/22/19490912.png', 'https://anivisual.net/_sf/22/41095137.png', 'https://anivisual.net/_sf/22/96390221.png', 'https://anivisual.net/_sf/22/99443112.png', NULL),
(27, 32, 'https://anivisual.net/_sf/23/01069348.jpg', 'https://anivisual.net/_sf/23/24131179.jpg', 'https://anivisual.net/_sf/23/78028659.jpg', 'https://anivisual.net/_sf/23/48385099.jpg', 'https://anivisual.net/_sf/23/79131909.jpg', NULL),
(28, 33, 'https://anivisual.net/_sf/10/1002_Ushinawareta.jpg', 'https://anivisual.net/_sf/10/10554059.png', 'https://anivisual.net/_sf/10/43180556.png', 'https://anivisual.net/_sf/10/81389453.png', 'https://anivisual.net/_sf/10/07773358.png', 'https://anivisual.net/_sf/10/34282538.png');

-- --------------------------------------------------------

--
-- Структура таблицы `novel`
--

CREATE TABLE `novel` (
  `id_novel` int(11) NOT NULL,
  `id_developer` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_in_english` varchar(255) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `background` longtext DEFAULT NULL,
  `year_release` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `genres` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `age_raiting` varchar(255) DEFAULT NULL,
  `developer` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `link` longtext DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `novel`
--

INSERT INTO `novel` (`id_novel`, `id_developer`, `name`, `name_in_english`, `image`, `background`, `year_release`, `description`, `type`, `duration`, `genres`, `platform`, `age_raiting`, `developer`, `country`, `language`, `link`, `active`, `created_at`, `updated_at`) VALUES
(10, 9, 'Fate/Hollow Ataraxia', NULL, 'https://anivisual.net/_sf/22/2265.png', 'https://anivisual.net/_sf/22/2265_MBS.jpg', '2005', '\"Fate/Hollow Ataraxia\" - оригинальное продолжение новеллы \"Fate/Stay Night\", в котором игроку подарят возможность вернуться в знакомые места и с удовольствием провести время в компании любимых персонажей, сыграть в несколько тематических мини-игр и узнать новую, мистическую историю, произошедшую в том же городе Фуюки, спустя пол года окончания пятой войны святого Грааля.', 'Новелла с выборами', '30-50 часов', 'Драма, Комедия, Романтика, Экшн, Мистика, Повседневность, Хентай', 'Windows', '18+', 'Type-Moon', 'Япония', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 15:00:44'),
(12, NULL, 'Phoenix Wright: Ace Attorney Trilogy', NULL, 'https://anivisual.net/_sf/28/2829.png', NULL, '2019', 'Phoenix Wright: Ace Attorney Trilogy — сборник из трех первых частей серии.\r\n\r\nГлавный герой игры — амбициозный молодой адвокат, который стремится приобрести славу высококвалифицированного специалиста в этой области. Он берется защищать любого клиента, независимо от того, насколько безнадежно его положение.\r\n\r\nИгроку необходимо собирать улики, распутывать противоречивые показания очевидцев и определять, чьи свидетельства правдивы, а чьи — нет. После этого, разобравшись во всех перипетиях дела, предстоит провести блестящую защиту в зале суда.', 'Новелла смешанных типов', 'Более 50 часов', 'Драма, Комедия, Детектив, Мистика, Повседневность', 'Windows', '12+', NULL, 'Япония', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 15:00:43'),
(13, NULL, 'Девушка в скорлупе', 'Kara No Shoujo', 'https://anivisual.net/_sf/2/250.png', 'https://anivisual.net/_sf/2/250_5506067.jpg', '2008', 'Действие данной детективной новеллы происходит в 1956 году. На Токио обрушивается серия жестоких убийств, жертвой одного из которых стала невеста главного героя новеллы - детектива по имени Токисака Рейдзи. Спустя шесть лет история повторяется, и у Рейдзи появляется шанс на этот раз поймать преступника, о чем и просит его старый друг из полиции. Помимо этого вам вместе с героем предстоит расследовать еще два дела: серийное убийство юных студенток, в связи с которым вам придется работать под прикрытием в качестве преподавателя католической академии, и поиск истинного \"я\" одной из ее студенток, ставшей вашим заказчиком.', 'Новелла с выборами', '10-30 часов', 'Драма, Хоррор, Детектив, Триллер, Хентай', 'Windows', '18+', NULL, 'Япония', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 15:00:42'),
(14, NULL, 'Katawa Shoujo', NULL, 'https://anivisual.net/_sf/0/99.jpg', 'https://anivisual.net/_sf/0/99_433869.jpg', '2012', 'Хисао Накай - обычный ученик средней школы и учится в ней последний год. Однажды он находит в шкафчике письмо от неизвестного отправителя и приходит в указанное место встречи. Автором письма оказывается девушка, которая любит его, но при разговоре с ней он теряет сознание. Очнувшись в больнице, он узнает, что причиной его обморока является неожиданно проявившая себя болезнь сердца - аритмия. После долгого лечения в больнице от аритмии, он вынужденно переводится в школу Ямаку, где, несмотря на трудности, обретает друзей и любовь.', 'Новелла с выборами', '30-50 часов', 'Драма, Комедия, Романтика, Повседневность, Школа, Хентай', 'Windows', '18+', NULL, '4ch', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 09:58:52'),
(17, NULL, 'Летние воспоминания о Белл', NULL, 'https://anivisual.net/_sf/30/3084.jpg', 'https://anivisual.net/_sf/30/3084_bandicam_1512.png', '2020', 'Подросток, загнанный в ловушку воспоминаниями, встречает девочку, потерявшую память. Что они смогут изменить, что смогут сохранить? Куда приведёт их судьба? Их история начинается здесь.', 'Новелла с выборами', '2-10 часов', 'Драма, Романтика, Мистика, Повседневность', 'Windows', '12+', 'Yi Xiazhiling Zhizuo Zu & ZiX Solutions', 'Неизвестно', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 10:01:45'),
(16, NULL, 'На крыльях мечты', NULL, 'https://anivisual.net/_sf/22/2298.jpg', NULL, '2012', 'Как-то раз, прогуливаясь, Аой случайно ловит брошенный кем-то бумажный самолётик. Герой решает посмотреть, кто же его запустил. И вот тут-то всё и началось… </p>\r\n\r\nВы будете улыбаться. Вы будете смеяться. Вы будете грустить и с нетерпением ожидать, что случится дальше. Всё это вместе с героями, которые совершенно незаметно станут для вас родными и близкими.\r\n\r\nДобро пожаловать в авиаклуб :) </p>\r\n\r\nВизуальная новелла If my heart had wings вышла в 2012 году и с тех пор была высоко оценена игроками с самых разных уголков планеты. </p>\r\n\r\nВ русскую версию включена вся игра целиком. </p>', 'Новелла с выборами', '30-50 часов', 'Драма, Комедия, Романтика, Повседневность, Приключения, Школа, Хентай', 'Windows', '18+', NULL, 'Япония', 'Русский', NULL, 1, '2020-12-29 16:52:53', '2020-12-30 14:57:03'),
(18, NULL, 'Девушка в скорлупе - Второй эпизод', 'Kara no Shoujo The Second Episode', 'https://anivisual.net/_sf/16/1668.png', 'https://anivisual.net/_sf/16/1668_Kara.no.Shoujo..jpg', '2013', 'Вторая история разворачивается в Токио, в декабре 1957-го года (через 6 лет после Картагры и через полтора года после Kara no Shoujo). Нам вновь предстоит играть роль детектива Рейдзи Токисаки. На протяжении долгого времени Рейдзи пытался найти исчезнувшую девушку по имени Токо, но все его усилия оказались напрасными. Здравый смысл подсказывает, что скорее всего Токо уже давно мертва - однако наш герой до сих пор не может смириться с этим и продолжает поиски, гоняясь за призрачными надеждами.\r\n\r\nВ это время в городе происходит несколько странных убийств: какой-то садист вспарывает своим жертвам животы и помещает туда глиняную куклу, похожую на маленького ребёнка. Почерк преступления подозрительно напоминает предыдущий случай с \"чёрным яйцом\", так что эти убийства сразу же привлекают внимание детектива Токисаки. Неужели маньяк, полтора года назад похитивший Токо, снова вернулся? Или эти инциденты не связаны между собой, и новые убийства совершает другой человек...? В любом случае, Рейдзи решает заняться расследованием этого дела и докопаться до истины.\r\n\r\nНо Рейдзи - не единственный герой, за которого нам предстоит играть. В Kara no Shoujo 2 повествование ведётся от лица нескольких персонажей. Расклад примерно такой: 30% игрового времени мы проведём в роли детектива Токисаки. Ещё 30% отведено молодому человеку по имени Масаки Томоюки (один из главных подозреваемых в новой цепочке убийств). 10% получит наша старая знакомая из \"Картагры\" - светловолосая девушка Тодзи Аоки (она занимается расследованием слухов о возрождении религиозной секты Сэнрикё). Ещё 10% событий показаны с точки зрения школьницы Юкари Токисаки (сестра Рейдзи), а оставшиеся 20% разделены между несколькими второстепенными персонажами. Это позволяет подробно рассмотреть события 1957-го года с различных ракурсов.', 'Новелла с выборами', '30-50 часов', 'Драма, Детектив, Хентай', 'Windows', '18+', 'Innocent Grey', 'Япония', 'Русский', NULL, 1, '2020-12-30 05:00:52', '2020-12-30 09:59:00'),
(21, 11, 'Когда плачут чайки', 'Umineko no Naku Koro ni', 'https://anivisual.net/_sf/0/94.jpg', 'https://anivisual.net/_sf/0/94_umineko_no_naku.jpg', '2007', 'Действие происходит на острове Роккенджима, принадлежащем очень богатому семейству Уширoмия. По обычаю все члены семьи собираются на этом острове, дабы обсудить текущее финансовое состояние дел в семье. Из-за слабого здоровья главы семьи, Уширомии Кинзо, в этом году, помимо привычных дел, будут также обсуждаться вопросы распределения будущего наследства.\r\nНо на следующий день сильный тайфун отрезает семейство от внешнего мира, и начинается серия таинственных убийств, вынудившая восемнадцать членов семьи, застрявших на острове, сражаться за свои жизни в смертельном противостоянии между вымыслом и реальностью.', 'Кинетическая новелла (без выборов)', 'Более 50 часов', 'Драма, Хоррор, Экшн, Детектив, Мистика', 'Windows', '16+', '07th Expansion', 'Япония', 'Русский', NULL, 1, '2020-12-30 06:26:04', '2020-12-30 15:05:53'),
(19, NULL, 'NIGHTSHADE', NULL, 'https://anivisual.net/_sf/23/2307.jpg', 'https://anivisual.net/_sf/23/2307_904267723_previ.jpg', '2018', 'Благодаря годам непрерывной войны, Ига и Кога независимо увеличили свои войска. Обе армии шиноби питали друг к другу взаимную ненависть, накопившуюся за долгую историю противостояния. Однако, в течение девятого года эры Теншоу, войска Ига обратились в прах, из-за Восстания ниндзя в провинции Ига, начатого Одой Нобунагой. Немногих выживших выходцев Ига приняли в войсках Кога.\r\n\r\nСемнадцать лет спустя закончилась эпоха Сэнгоку и в стране наступил вечный мир. Мечтая выполнять свой долг синоби, Уэно Энджу, дочь Уэно Кандо, главы войск Кога, тренировалась каждый день.\r\n\r\nНаконец, ее отбирают на первую миссию. Случилось что-то серьезное. Это происшествие пустит под откос не только судьбу одной Энджу, но и всей деревни…', 'Новелла с выборами', '30-50 часов', 'Драма, Романтика, Экшн, Приключения', 'Windows', '16+', 'The Hounds of God', 'Япония', 'Русский', NULL, 1, '2020-12-30 06:17:10', '2020-12-30 10:01:41'),
(20, NULL, 'Subarashiki Hibi ~Furenzoku Sonzai~', NULL, 'https://anivisual.net/_sf/13/1392.jpg', 'https://anivisual.net/_sf/13/1392_028.jpg', '2010', 'Внимание!\r\nНовелла содержит много сцен насилия, жестокости и др. Поэтому рекомендуется возраст 18+.\r\n\r\nВечером 12-го июля 2012 года старшеклассница по имени Такасима Закуро совершает самоубийство. На первый взгляд это кажется всем закономерным последствием травли со стороны одноклассников, пока не всплывает, что прямо перед смертью Такасима Закуро предсказала приближение конца света.\r\n\r\nУчителя пытаются скрыть от общественности очевидную связь между самоубийством Закуро и произошедшим ранее самоубийством еще одного старшеклассника. А школьники тем временем до смерти напуганы, ведь пророчество Закуро странным образом коррелирует с пророчеством интернет-предсказателя Web Bot Project, по слухам имеющего возможность анализировать коллективное бессознательное всего человечества. Кроме всего прочего, похоже, вся школа получает от покойной Закуро пугающие послания с обратным отсчетом до даты конца — 20-го июля.\r\n\r\nИстория подается с точек зрения шести персонажей, каждый из которых играет свою роль в разворачивающихся событиях. И каждая версия произошедшего сильно отличается от других…', 'Новелла с выборами', '30-50 часов', 'Драма, Школа, Хентай, Триллер', 'Windows', '18+', 'KeroQ', 'Япония', 'Русский', NULL, 1, '2020-12-30 06:20:44', '2020-12-30 09:48:37'),
(22, 11, 'Когда плачут чайки: Крах', 'Umineko no Naku Koro ni Chiru', 'https://anivisual.net/_sf/2/228.png', 'https://anivisual.net/_sf/2/228_2736916.jpg', '2009', 'Umineko no Naku Koro ni Chiru рассказывают вторую половину истории и приближают к сути тайны. Эти игры - не просто ответы на первые четыре арки, но и продолжение истории в новом свете.', 'Кинетическая новелла (без выборов)', 'Более 50 часов', 'Драма, Романтика, Хоррор, Экшн, Детектив, Мистика', 'Windows', '16+', '07th Expansion', 'Япония', 'Русский', NULL, 1, '2020-12-30 06:30:07', '2020-12-30 15:06:08'),
(23, 9, 'Судьба/Ночь Схватки', 'Fate/Stay Night', 'https://anivisual.net/_sf/1/100.png', 'https://anivisual.net/_sf/1/100_fate_stay_night.jpg', '2004', 'Ученик старшей школы, Эмия Широ, становится невольным участником так называемой «войны Святого Грааля», время от времени проходящей в японском городе Фуюки. Это борьба семерых магов за обладание легендарным артефактом — Святым Граалем, который исполнит любое желание победителя и, таким образом, изменит его судьбу. Каждый маг с момента своего начала участия в войне призывает слугу — одну из великих героических душ прошлого или будущего - сражающегося на стороне своего хозяина. Есть семь слуг, все они принадлежат к разным боевым классам: мечник (Сэйбер), лучник (Арчер), копейщик (Лансер), всадник (Райдер), берсеркер, убийца (Ассасин) и маг (Кастер). Битва ведется до тех пор, пока не останется одна пара мастера и слуги. Эмия Широ против собственной воли призывает мечницу — слугу, поставившую себе цель добраться до Грааля любым путём. Однако, он не желает участвовать в битве, так как в прошлой войне потерял всех своих родных. Эмии начинает помогать Тосака Рин — сильный маг, которая учится в той же школе, что и Широ. Но правила войны Святого Грааля указывают на то, что рано или поздно им предстоит сразиться между собой, а наиболее возможный исход для проигравшего — смерть.', 'Новелла с выборами', 'Более 50 часов', 'Драма, Комедия, Романтика, Экшн, Мистика, Повседневность, Приключения, Хентай', 'Windows', '18+', 'Type-Moon', 'Япония', 'Русский', NULL, 1, '2020-12-30 06:35:39', '2020-12-30 11:08:21'),
(25, NULL, 'Когда плачут цикады: Ответы', 'Higurashi no Naku Koro ni: Kai', 'https://anivisual.net/_sf/3/320.png', 'https://anivisual.net/_sf/3/320_Higurashi.no.Na.jpg', '2004', 'Действие происходит вокруг праздника Ватанагаси, где уже 4 года подряд на каждый праздник находят одного жестоко убитого человека, а второй пропадает безвести.\r\n1983 год, в деревню Хинамидзава переезжает Кэйити Маэбара. Он быстро входит в дружный коллектив школьного клуба. Но, внезапно, ему начинают открываться загадки, которыми насыщена не только сама деревня, но и, почти, каждый житель.', 'Кинетическая новелла (без выборов)', 'Более 50 часов', 'Драма, Комедия, Хоррор, Детектив, Мистика, Повседневность', 'Windows', '16+', '07th Expansion', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:14:09', '2020-12-30 10:24:16'),
(26, NULL, 'Когда плачут цикады. Главы загадок', 'Higurashi no Naku Koro', 'https://anivisual.net/_sf/0/95.jpg', 'https://anivisual.net/_sf/0/95_340642.jpg', '2002', 'В том, что в тихом омуте водятся черти, юному Кэйити пришлось убедиться на своём собственном опыте. Переехав с родителями из города в живописную деревушку Хинамидзаву и подружившись в маленькой местной школе с очаровательными одноклассницами, он даже не подозревал, насколько обманчиво его представление об этом безмятежном крае и его обитателях. Но, как позднее выяснил Кэйити, за фасадом деревенской идиллии скрывается тёмная история зверских убийств и бесследных исчезновений, а под покровом благостной тиши действуют какие-то ужасные силы. Постепенно страшная тайна, скрытая в сельской глуши, стала приоткрываться перед его изумлёнными глазами...', 'Кинетическая новелла (без выборов)', 'Более 50 часов', 'Драма, Комедия, Хоррор, Детектив, Мистика, Повседневность', 'Windows', '16+', '07th Expansion', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:29:29', '2020-12-30 14:57:02'),
(27, NULL, 'Clannad', NULL, 'https://anivisual.net/_sf/1/143.jpg', 'https://anivisual.net/_sf/1/143_CLANNAD.full.14.jpg', '2004', 'Новелла повествует об Оказаки Томое, ученике старшей школы, чья жизнь не складывается после смерти матери и серьёзной ссоры с отцом. Он нехотя ходит в школу, частенько опаздывает, прогуливает уроки и общается со своим лучшим другом, таким же безалаберным старшеклассником, Сунохарой. Томою ждало довольно безрадостное будущее, пока он не встретил одну девушку и не познал ценность дружбы и семьи.', 'Новелла с выборами', 'Более 50 часов', 'Драма, Комедия, Романтика, Мистика, Повседневность, Школа', 'Windows', '12+', 'Key', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:32:58', '2020-12-30 10:34:04'),
(28, NULL, 'Песнь Сайи', 'Saya no Uta', 'https://anivisual.net/_sf/0/3.jpg', 'https://anivisual.net/_sf/0/3_12210620.jpg', '2009', 'Трудно сказать, повезло ли Фуминори в жизни. С одной стороны, он чудом (и новейшими медицинскими разработками) выжил в автомобильной аварии, в которой погибли все его родственники. С другой стороны, удовольствия от этого немного - теперь восприятие мира Фуминори безнадёжно искалечено, а за ним медленно, но верно следует и рассудок. Сами посудите - каково жить молодому студенту, когда в его глазах лучшие друзья похожи на бесформенные груды плоти, коридоры и улицы завалены потрохами, а ранее приятные вкусы и запахи теперь вызывают лишь отвращение? Неудивительно, что поначалу он не желает иметь с этим сошедшим с ума миром ничего общего... Пока не встречает в своей палате абсолютно нормальную, даже красивую, девочку. Разумеется, так называемая Сайя становится единственной отрадой несчастного Фуминори, а поиск её отца - главной целью его жизни. Но несчастный, разумеется, не подозревает, чем является его милая Сайя...', 'Новелла с выборами', '2-10 часов', 'Драма, Романтика, Хоррор, Мистика, Этти, Хентай', 'Windows', '18+', 'Nitroplus', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:38:06', '2020-12-30 10:39:40'),
(29, NULL, 'Страна Колес, Вечная юность', 'Sharin no Kuni, Yuukyuu no Shounenshoujo', 'https://anivisual.net/_sf/2/232.png', 'https://anivisual.net/_sf/2/232_bg_side.jpg', '2009', 'До событий Himawari no Shoujo остаются ещё долгие годы, Акуцу Масаоми пока лишь кадет. Прибыв к месту проведения последнего экзамена он встречается со столь же амбициозным Хигучи Сабуро. Но ни Акуцу ни Хигучи ещё не подозревают, что представляет собой экзамен, и через что им придётся пройти.', 'Новелла с выборами', '10-30 часов', 'Драма, Комедия, Романтика, Повседневность, Фантастика, Хентай', 'Windows', '18+', 'Akabei Soft2', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:43:35', '2020-12-30 10:44:05'),
(30, NULL, 'ef - the first tale', NULL, 'https://anivisual.net/_sf/1/175.jpg', 'https://anivisual.net/_sf/1/175_ef.jpg', '2006', 'Ef - the first tale первая часть истории Ef - A Fairy Tale of the Two.\r\nВключает в себя Пролог и две главы.\r\nПервая глава представляет собой завершенную историю, которая рассказывает о взаимоотношениях двух молодых людей - Хироно Хиро и Миямуры Мияко. Во второй главе главными героями становятся Цуцуми Кёске и Шиндо Кей.', 'Новелла с выборами', '10-30 часов', 'Драма, Комедия, Романтика, Повседневность, Школа, Хентай', 'Windows', '18+', 'minori', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:48:03', '2020-12-31 09:08:09'),
(31, NULL, 'Вершина Хаоса', 'ChäoS;HEAd', 'https://anivisual.net/_sf/22/2259.jpg', 'https://anivisual.net/_sf/22/2259_357838.jpg', '2008', 'История Chaos;Head происходит в Сибуе в 2008 году и развиваются вокруг Такуми Нисидзё, ученика средних классов частной Академии Суимей. Странные и жестокие убийства происходят в районе Сибуи, названные «Безумием Нового Поколения» (яп. ニュージェネレーション). События истории берут начало 28 сентября, когда Такуми разговаривает в онлайне с другом по имени Грим (яп. グリム Гуриму). Он пытается поскорее сообщить последние события «Нового Поколения», но Такуми не интересуется местными или международными новостями. Человек по имени Сёгун (яп. 将軍) присоединяется к чату в середине разговора. После этого Грим покидает чат, и Сёгун начинает говорить. Он говорит очень загадочными и запутанными предложениями, из-за чего Такуми начинает нервничать. Затем Сёгун отсылает ему кучу ссылок с фотографиями: на одной из них изображено жестокое убийство человека, прибитого крестообразными кольями к стене.\r\n\r\nНа следующий день Такуми видит настоящую сцену убийства. Таинственная девушка с розовыми волосами в конце переулка прибивает мужчину кольями к стене. Такуми понимает, что он является свидетелем жестокого убийства, фотографии которого он видел накануне. Убеждённый, что девушка, так или иначе, связана с Сёгуном, Такуми пытается избегать событий, связанных с Новым Поколением. Однако он был свидетелем преступления, из-за чего им вскоре заинтересовалась полиция.\r\n\r\nПолиция подозревает его, но Такуми убеждён, что он жертва Сёгуна. Такуми оказывается в некой спирали паранойи и непонимания. Он отчаянно пытается обезопасить себя и выяснить, почему является жертвой. В конце концов, он связывается с другими людьми, вовлеченными в минувшие события, в том числе с девушкой, которая совершила убийство. Он уже не уверен в том, где заканчивается реальность и кому можно доверять. Он втянут в масштабную и, казалось бы, невозможную схему, план которой скрыт за кулисами мистической компании NOZOMI Group.', 'Новелла с выборами', '10-30 часов', 'Драма, Научная фантастика, Хоррор, Детектив, Мистика, Повседневность, Приключения, Фантастика', 'Windows', '16+', '5pb & Nitroplus', 'Япония', 'Русский', NULL, 1, '2020-12-30 07:57:48', '2020-12-31 09:35:21'),
(32, NULL, 'Caucasus ~Nanatsuki no Nie~', NULL, 'https://anivisual.net/_sf/23/2344.png', 'https://anivisual.net/_sf/23/2344_HY4EEF.jpg', '2009', 'Однажды два студента посещают деревню, чтобы исследовать легенду, передаваемую из поколения в поколение. Однако началась сильная метель, и они чудом выжили. Достигнув дороги, они увидели карету, остановившуюся прямо перед ними. Из неё вышла девушка и позвала их переночевать в своём замке. Встретив там множество довольно интересных людей, наши герои были приглашены на особенную и, в какой-то мере, странную свадьбу. Невеста должна была провести ночь в гробу, прежде чем официально стать женой своего суженого. Только вот на следующий день жених был найден обезглавленным в своей комнате. Более того, мост, соединявший замок с остальным миром, внезапно оказался разрушен.', 'Новелла с выборами', '10-30 часов', 'Драма, Детектив, Хентай, Триллер', 'Windows', '18+', 'Innocent Grey', 'Япония', 'Русский', NULL, 1, '2020-12-30 08:01:09', '2021-01-01 11:10:03'),
(33, NULL, 'В поисках утраченного будущего', 'Ushinawareta Mirai wo Motomete', 'https://anivisual.net/_sf/10/1002.png', 'https://anivisual.net/_sf/10/1002_Ushinawareta.jpg', '2010', 'Количество учащихся в школе Утихама продолжало увеличиваться в последние годы, в результате чего было принято решение о постройке нового учебного здания. История разворачивается во время последнего школьного фестиваля в старой школе. Все лидеры клубов решают приложить максимум усилий, что бы последний фестиваль стал лучшим. Со - является одним из членов печально известного клуба астрономии, деятельность которого состоит в решении различных проблем вместо ученического совета. Однажды, он ввязывается в драку с членами клуба дзюдо, в последствии чего теряет сознание и приходит в себя лишь вечером, в мед-кабинете. Внезапно, здание начинает трясти. Слегка испугавшись, он побежал вверх по лестнице, туда, где, как казалось, находился источник сотрясения, и встречает там загадочную обнажённую девушку, которая, похоже, знает его. На следующий день эта девушка, Юй, заявляется в клуб астрономии, желая в него вступить.', 'Новелла с выборами', '10-30 часов', 'Драма, Комедия, Научная фантастика, Романтика, Школа, Хентай', 'Windows', '18+', 'Trumple', 'Япония', 'Русский', NULL, 1, '2020-12-30 08:03:29', '2020-12-31 12:21:34');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `access`, `remember_token`, `avatar`, `name`, `status`, `background`) VALUES
(2, '2@2', 'moderator', '$2y$10$YOcqm1sb/cYPjyW1mpYN8uf3bgp2gbIzdxgDOxVimFStrNHdbKq2G', 'Модератор', 'O9fLNjFUv6muTxxkm3cQaRpvFKsTvlIY8ARwJlYfJGTRl1CorbL53zXAMyza', NULL, NULL, NULL, NULL),
(3, '3@3', 'editor', '$2y$10$0cYzl8bbpDwQ.SqxNw4Qo.3D7pwEWBQOa.uzT3ELyFcNlq2OaqqHC', 'Редактор', 'lmMuMJH9ihmX7pO3qQkrWFQJ2m6iOfSQNou4YUFBRGEYNpUPAy7apnBEBNY7', NULL, NULL, NULL, NULL),
(4, '4@4', 'user', '$2y$10$nYLt88kPCxm4P9JYEEP5DudLyf4/tyHMThtIXoG9z91dcQGqlVcdm', 'Пользователь', 'rZl7rDi5ArGTQhnGuKTohqRSMIpMXfwseNzkWd1DWi18EMzDXm2ZeGATHUZx', NULL, NULL, NULL, NULL),
(5, '4@1', 'sad', '$2y$10$8Sb9JAW8nFavwQi7QvhEmeNSyvEk6KuhK2EhXp6PvHtwcYAax.Iue', 'Пользователь', NULL, NULL, NULL, NULL, NULL),
(6, '332@1', '12341', '$2y$10$JtxCBTmEsXbNtLwkvJNn1.cv2nLOQY4JzUYKX0dMdEabdRSCRTfEW', 'Пользователь', '8t3u9UhqFzkngu2sIacoQmeJhoDea3Zo6IcAczlqnlmvpJVCLtE7WYcHXYoY', NULL, NULL, NULL, NULL),
(8, '2@3241', '2', '$2y$10$ye7onNnJva8V9lIUmobZNuCH7q.002IS4VwMwUV2MUvMWEnVFP.me', 'Пользователь', NULL, NULL, NULL, NULL, NULL),
(10, '1@2131', '1', '$2y$10$fOUhLvY3MVgfiVhoW2rB6.Fp96bf3RAtpi9d/3SdzdLkQbtd/ZSna', 'Пользователь', 'ksnm4LU6iAVgIqgUytYzsbcEGjYzteI3zJYz5TI7eJb9E9xYpc6bcxcyno34', NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `character`
--
ALTER TABLE `character`
  ADD PRIMARY KEY (`id_character`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Индексы таблицы `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`id_developer`);

--
-- Индексы таблицы `directory_genre`
--
ALTER TABLE `directory_genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id_favorites`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`);

--
-- Индексы таблицы `novel`
--
ALTER TABLE `novel`
  ADD PRIMARY KEY (`id_novel`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `character`
--
ALTER TABLE `character`
  MODIFY `id_character` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `developer`
--
ALTER TABLE `developer`
  MODIFY `id_developer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `directory_genre`
--
ALTER TABLE `directory_genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id_favorites` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `novel`
--
ALTER TABLE `novel`
  MODIFY `id_novel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
