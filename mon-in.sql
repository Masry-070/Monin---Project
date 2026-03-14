-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 feb 2026 om 11:46
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mon-in`
--
CREATE DATABASE IF NOT EXISTS `mon-in` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mon-in`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`id`, `session_id`, `post_id`, `created_at`) VALUES
(6, 'svcvjgnsdugr9egh0oq0tqloj0', 3, '2026-02-11 10:24:22'),
(12, 'svcvjgnsdugr9egh0oq0tqloj0', 2, '2026-02-11 10:27:06'),
(16, 'vqr6f4l7rnufbquclnean0jg58', 1, '2026-02-11 10:30:16'),
(18, 'vqr6f4l7rnufbquclnean0jg58', 2, '2026-02-11 10:43:49'),
(19, 'its9ruqalp5b2g0iqp55hn8tts', 3, '2026-02-11 10:44:30'),
(20, 'its9ruqalp5b2g0iqp55hn8tts', 2, '2026-02-11 10:44:32');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `content`, `created_at`, `user_id`) VALUES
(1, 'Just finished implementing a microserver architecture for our main product. The journey was challenging but the scalability improvements are already showing!Anyone else working on similar migrations?', '2026-02-09 14:47:45', 1),
(2, 'Looking for recommendations on the best CI/CD tools for PHP projects. Currently using GitHub Actions but exploring alternatives. What\'s your stack?', '2026-02-09 14:49:31', 1),
(3, 'I\'m improving my Symfony skills. I\'m impementing a Graph with Symfony-ux. It\'s nice!', '2026-02-09 14:50:07', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `skills` varchar(255) NOT NULL,
  `interests` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `headline`, `about`, `skills`, `interests`) VALUES
(1, 'Sarah Johnson', 'assets/img/Floor.jpg', 'Senior Software Engineer at TechCorp', 'Passionate about building scalable applications and mentoring junior developers. 10+ years of experience in full-stack development.', 'PHP, JavaScript, Python, MySQL, Docker, AWS', 'Technology, Open Source, Machine Learning, Cloud Computing'),
(2, 'Michael Chen', 'assets/img/Jan.jpg', 'Product Manager; ex-Google', 'I\'m a product owner for many PHP projects', 'PHP, MySQL, SCRUM', 'Fishing, Symfony, Laravel');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Beperkingen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
