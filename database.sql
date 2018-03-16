-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 16 2018 г., 22:07
-- Версия сервера: 5.7.21-0ubuntu0.17.10.1
-- Версия PHP: 5.6.34-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app-local`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sort` int(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `sort`, `status`) VALUES
(1, 'Футболки', 1000, 1),
(2, 'Регланы, Свитшоты', 1, 1),
(3, 'Лонгсливы', 1, 1),
(4, 'Куртки, ветровки', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `id_user` int(255) DEFAULT '0',
  `name` varchar(35) DEFAULT NULL,
  `number_phone` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `products` longtext NOT NULL,
  `price` float NOT NULL,
  `date` int(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_list`
--

INSERT INTO `order_list` (`id`, `id_user`, `name`, `number_phone`, `email`, `products`, `price`, `date`, `status`) VALUES
(1, 1, NULL, NULL, NULL, '{\"13\":1,\"11\":1}', 3820, 1520867712, 1),
(2, 0, 'Кирилл Абрамович', '+380970570128', 'ewfqqwf@2rar.rr', '{\"10\":1}', 650, 1520867759, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(0, 'В ожидании обработки'),
(1, 'Обрабатывается'),
(2, 'В процессе доставке'),
(3, 'Доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `is_new` int(1) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` int(1) NOT NULL,
  `image1` varchar(1000) NOT NULL,
  `image2` varchar(1000) NOT NULL,
  `image3` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `price`, `is_new`, `brand`, `description`, `status`, `image1`, `image2`, `image3`) VALUES
(1, 'YAPPI 1701122 ', 1, 299, 0, 'YAPPI', '<p><strong>Состав:&nbsp;</strong>100% хлопок</p>\r\n\r\n<p><strong>Вырез:&nbsp;</strong>округлый</p>\r\n\r\n<p><strong>Принт:&nbsp;</strong>цифровая печать, с дышащим эффектом</p>\r\n\r\n<p><strong>Крой:&nbsp;</strong>приталенный, точное соответствие размеру</p>\r\n\r\n<p><strong>Уход:&nbsp;</strong>машинная или ручная стирка в холодной вод</p>\r\n', 1, '/uploads/images/products/1520605919-207.jpg', '/uploads/images/products/1520605986-198.jpg', ''),
(2, 'YAPPI 1701121', 1, 299, 0, 'YAPPI ', '<p><strong>Состав:&nbsp;</strong>100% хлопок</p>\r\n\r\n<p><strong>Вырез:&nbsp;</strong>округлый</p>\r\n\r\n<p><strong>Принт:&nbsp;</strong>цифровая печать, с дышащим эффектом</p>\r\n\r\n<p><strong>Крой:&nbsp;</strong>приталенный, точное соответствие размеру</p>\r\n\r\n<p><strong>Уход:&nbsp;</strong>машинная или ручная стирка в холодной воде</p>\r\n', 1, '/uploads/images/products/1520606103-5.jpg', '/uploads/images/products/1520606103-192.jpg', ''),
(3, '\"Горы\" - Light Inside', 1, 450, 0, 'Light Inside', '<p>Футболка мужская &ldquo;Горы&rdquo; (серая)</p>\r\n\r\n<p>Стиль: повседневный (casual)</p>\r\n\r\n<p>Фасон: полуприлегающий</p>\r\n\r\n<p>Принт: шелкотрафарет/цифровая печать</p>\r\n\r\n<p>Состав: 95%- хлопок, 5%- эластан</p>\r\n\r\n<p>Уход: машинная или ручная стирка t 30, утюжка с изнанки</p>\r\n', 1, '/uploads/images/products/1520606313-115.jpg', '/uploads/images/products/1520606313-176.jpg', '/uploads/images/products/1520606313-56.jpg'),
(4, 'From Kyiv (черная) - HARD', 1, 245, 0, 'Hard Kyiv', '<p>Футболка HARD From Kyiv with HARD (Коллекция A / W 17-18). Состав - 97% хлопок, 3% - эластан. Футболка с плотной манжетной резинкой на горловине, и рукавах которая практически не растягивается.</p>\r\n\r\n<p>Принт - высококачественная шелкотрафаретная печать, не смывается после множества стирок.</p>\r\n\r\n<p>HARD - киевский бренд одежды, главный по жеста</p>\r\n', 1, '/uploads/images/products/1520606467-115.jpg', '/uploads/images/products/1520606467-12.jpg', '/uploads/images/products/1520606467-76.jpg'),
(5, 'ВР ЖЕСТЬ (белая) - HARD', 1, 500, 0, 'Hard Kyiv', '<p>Принт ЖЕСТЬ ВР - это принт посвященный Верховной Раде Украины. Качественно состав ВР практически не отличается от предыдущих составов. Крышование бизнеса, круговая порука и слепое выполнение указов сверху. Попытка сделать вид, что ничего не изменилось. Но это далеко не так. Принт - попытка напомнить, что депутаты - это не группа неприкасаемых, которые будут править вечно, а исполнители, пожеланий народа. По каким рано или поздно спросят, об их работе.</p>\r\n\r\n<p>Идея принта ЖЕСТЬ ВР - киевский бренд HARD и депутат Верховной Рады Украины Сергей Лещенко (Демократический альянс, экс-журналист Украинской правды). Автор фотографии - Алина Грабарская.</p>\r\n\r\n<p>Футболка HARD (Коллекция S / S 18). Состав - 97% хлопок, 3% - эластан. Футболка с плотной манжетной резинкой на горловине, и рукавах которая практически не растягивается.</p>\r\n\r\n<p>Принт - высококачественный, шелкотрафаретная печать, не смывается после множества стирок.</p>\r\n\r\n<p>HARD - киевский бренд одежды, главный по жести</p>\r\n\r\n<p>Сделано в Украине.</p>\r\n', 1, '/uploads/images/products/1520606668-1.jpg', '/uploads/images/products/1520606668-174.jpg', '/uploads/images/products/1520606668-33.jpg'),
(6, 'F 16-03 - Nawski', 1, 425, 0, 'Nawski', '<p>Стильная мужская футболка - это не только удобная и комфортная одежда. Для уверенных и целеустремленных мужчин этот предмет гардероба - возможность быть в тренде и всегда оставаться оригинальным.</p>\r\n\r\n<p>Модель от украинского бренда Nawski декорирована с использованием геометрических элементов. Изделие имеет свободный крой и оставляет безграничную свободу для активных движений. Ткань - натуральный хлопок - имеет высокий показатель качества и износостойкости.</p>\r\n', 1, '/uploads/images/products/1520606845-4.jpg', '/uploads/images/products/1520606845-139.jpg', '/uploads/images/products/1520606845-217.jpg'),
(7, 'Smoke Lips - KARUA', 1, 780, 0, 'KARUA', '<p>Мужская футболка прямого фасона. Выполнена из импортных ткани и фурнитуры. Ткань очень эластичная и приятная на ощупь. За счет вплетения нитей эластана, после стирки изделие обретает изначальну форму.</p>\r\n\r\n<p>Рисунок нанесен по методу прямой цифровой печати специальными текстильными чернилами.</p>\r\n\r\n<p>При такой стирке структура ткани будет менее всего подвержена деформации, что положительно сказывается на сроке службы изделия.</p>\r\n\r\n<p><strong>Состав:</strong>&nbsp;95% Хлопок, 5% Эластан</p>\r\n\r\n<p><strong>Материал:</strong>&nbsp;Стрейч-кулир</p>\r\n', 1, '/uploads/images/products/1520606975-162.jpg', '', ''),
(8, 'Футболка 8802 чёрная - ThePARA', 1, 480, 1, 'ThePARA', '<p>Удлинённая мужская футболка, выполненная из натуральной кулирной глади. Задняя полочка футболки удлинённая. По бокам изделие декорировано холитенами и шнурком.</p>\r\n\r\n<p>Состав: 100% коттон.</p>\r\n\r\n<p>Материал: кулир.</p>\r\n', 1, '/uploads/images/products/1520607068-39.jpg', '/uploads/images/products/1520607068-116.jpg', '/uploads/images/products/1520607068-207.jpg'),
(9, 'Мужская футболка белая Urban - LUD', 1, 299, 1, 'LUD', '<p><strong>Состав</strong>: 92% хлопок и 8% ликра</p>\r\n', 1, '/uploads/images/products/1520607254-173.jpg', '', ''),
(10, 'Lines BLK с принтом', 2, 650, 1, 'URBAN PLANET STREETWEAR', '<p>Мужской свитшот Lines BLK с принтом представляет собой идеальное сочетание спортивной функциональной одежды и стильного предмета гардероба. Для уверенных в себе мужчин, не желающих своим внешним видом сливаться с серым городским асфальтом, предлагаем примерять классический свитшот из натуральной ткани (90% хлопок и 10% эластан). Сложно представить что-то более удобное для повседневной носки.</p>\r\n', 1, '/uploads/images/products/1520607412-147.jpg', '/uploads/images/products/1520607412-150.jpg', '/uploads/images/products/1520607412-72.jpg'),
(11, 'Лонгслив черно-серый MS Dark GREYYYY 18', 3, 320, 0, 'Morning.Star', '<p>Лонгслив сделан из высококачественного хлопка (кулир пенье), который держит форму и создает вид приталенного кроя. Данная модель выдерживает больше 100 стирок и прослужит долгие годы в носке при этом имея вид нового изделия.</p>\r\n', 1, '/uploads/images/products/1520607547-243.jpg', '/uploads/images/products/1520607547-18.jpg', '/uploads/images/products/1520607547-66.jpg'),
(12, ' Лонгслив Бородач - DOcK', 3, 539, 1, 'DOcK', '<p>Лонгслив из хлопкового трикотажа с фирменной нашивкой Dock.</p>\r\n\r\n<p><strong>Состав:&nbsp;</strong>95% хлопок, 5% эластан</p>\r\n\r\n<p><strong>Рекомендации по уходу:&nbsp;</strong>Отбеливание запрещено; Аккуратный отжим; Глажка при температуре не выше 100˚С. Стирка при 30 ˚С</p>\r\n\r\n<p><strong>Параметры модели на фото:&nbsp;</strong>97/80/95 Рост 179 Вес 75</p>\r\n\r\n<p><strong>Размер изделия на модели:&nbsp;</strong>S</p>\r\n', 1, '/uploads/images/products/1520607687-37.jpg', '/uploads/images/products/1520607687-120.jpg', '/uploads/images/products/1520607687-82.jpg'),
(13, 'Куртка черная - Roussin fashion studio', 4, 3500, 1, 'ROUSSIN', '<p>Материал: 100% п/э (плащевка)</p>\r\n\r\n<p>Утеплитель: модал (сырье - эвкалиптовая древесина)</p>\r\n', 1, '/uploads/images/products/1520607890-57.jpg', '/uploads/images/products/1520607890-45.jpg', ''),
(14, 'Неопрен - DOcK', 4, 440, 1, 'DOcK', '<p>Кофта с капюшоном, необработанные края, свободный крой.</p>\r\n\r\n<p><strong>Состав:&nbsp;</strong>70% хлопок 30% нейлон</p>\r\n\r\n<p><strong>Рекомендации по уходу:&nbsp;</strong>Отбеливание запрещено; Аккуратный отжим; Глажка при температуре не выше 100˚С. Стирка при 30 ˚С</p>\r\n\r\n<p><strong>Параметры модели на фото:&nbsp;</strong>97/82/94 Рост 188 Вес 73</p>\r\n\r\n<p><strong>Размер изделия на модели:&nbsp;</strong>S</p>\r\n', 1, '/uploads/images/products/1520607991-158.jpg', '/uploads/images/products/1520607991-122.jpg', '/uploads/images/products/1520607991-100.jpg'),
(15, 'Джинсовая куртка с мехом MS 18', 4, 999, 1, 'Morning.Star', '<p>Идеальное решение для активного образа жизни. Сделан из высококачественного европейского денима. Воротник укрыт мехом. Внутри тоже овчина</p>\r\n\r\n<p>Сделано из 100% коттона!</p>\r\n', 1, '/uploads/images/products/1520608095-232.jpg', '/uploads/images/products/1520608095-102.jpg', '/uploads/images/products/1520608095-64.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(13) DEFAULT NULL,
  `password` varchar(1000) NOT NULL,
  `register_data` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone_number`, `password`, `register_data`) VALUES
(1, 'Администратор', 'admin@gmail.com', '+380970000000', '$2y$10$TKj0JHDA6yShZ/vQ8O5FBeIo0/LAppsTROutJ8umq03/g.KgQK7YK', 1520603211),
(2, 'Владислав Кобренко', 'neeon.corp@gmail.com', '', '$2y$10$0Imz.5.kKiCC5ZTmkZSYBera3bf5WGWBmKbgdaiafr.020564JmKC', 1520609040),
(3, 'new user', 'email@eqwqwe.eqw', NULL, '$2y$10$hawRmsGOmCIZS9LX6qGnfePkyAoq.TingclpalfJO8w2GH/5oz9dK', 1520866676);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
