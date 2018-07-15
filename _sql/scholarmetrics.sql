-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2018 at 09:03 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scholarmetrics`
--

-- --------------------------------------------------------

--
-- Table structure for table `cites`
--

CREATE TABLE `cites` (
  `id` int(10) UNSIGNED NOT NULL,
  `shortlink` text COLLATE utf8mb4_unicode_ci,
  `name` text COLLATE utf8mb4_unicode_ci,
  `year` int(11) DEFAULT NULL,
  `cites_last_year_count` int(11) DEFAULT NULL,
  `cites_last_year_percent` int(11) DEFAULT NULL,
  `rank_percent` int(11) DEFAULT NULL,
  `h_index` int(11) DEFAULT NULL,
  `link_googleScholar` text COLLATE utf8mb4_unicode_ci,
  `current_school` text COLLATE utf8mb4_unicode_ci,
  `position` text COLLATE utf8mb4_unicode_ci,
  `PhDYear` int(11) DEFAULT NULL,
  `PhDSchool` text COLLATE utf8mb4_unicode_ci,
  `years` int(11) DEFAULT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci,
  `middle_name` text COLLATE utf8mb4_unicode_ci,
  `last_name` text COLLATE utf8mb4_unicode_ci,
  `interests` text COLLATE utf8mb4_unicode_ci,
  `link_researchGate` text COLLATE utf8mb4_unicode_ci,
  `link_linkedin` text COLLATE utf8mb4_unicode_ci,
  `link_twitter` text COLLATE utf8mb4_unicode_ci,
  `link_website` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `created_at`, `updated_at`, `type`, `value`) VALUES
(1, '2018-07-15 04:03:22', '2018-07-15 04:03:22', 'about', '<p>Tracking scholarly performance is challenging, especially given the continuous stream of new publications and resulting citation activity. Over the past three years, I have been collecting data about urban planning scholarship, most recently posting rankings of ACSP member schools on my blog at <a target=\"_blank\" rel=\"nofollow\" href=\"http://tomwsanchez.com/\">tomwsanchez.com</a>, which includes faculty rankings for&nbsp;<a target=\"_blank\" rel=\"nofollow\" href=\"http://tomwsanchez.com/faculty-scholarly-productivity-and-reputation-in-planning-a-preliminary-citation-analysis/\">2013</a>,&nbsp;<a target=\"_blank\" rel=\"nofollow\" href=\"http://tomwsanchez.com/2014-urban-planning-citation-analysis/\">2014</a>, and <a target=\"_blank\" rel=\"nofollow\" href=\"http://tomwsanchez.com/2015-urban-planning-citation-analysis/\">2015</a>. During this time, I have also been working on a tool to make these data accessible to faculty and their departments. Although the website is in its early stages, I am looking to get feedback on data accuracy (e.g., faculty rosters) and ideas for additional analyses/metrics.  In the works are more complete profile information for individual faculty and departments, peer comparisons based on research areas and faculty rank, and network analyses of co-authorship.\n            </p>\n            <p>See also:</p>\n            <ul>\n                <li><a target=\"_blank\" rel=\"nofollow\" href=\"http://jpe.sagepub.com/content/early/2016/03/16/0739456X16633500.abstract\">Sanchez, Thomas W. 2016. Faculty Performance Evaluation using Citation Analysis: An Update, Journal of Planning Education and Research, (forthcoming). DOI: 10.1177/0739456X16633500.</a></li>\n                <li><a target=\"_blank\" rel=\"nofollow\" href=\"http://wuj.cgpublisher.com/product/pub.173/prod.376\">Sanchez, Thomas W. 2014. Academic Visibility and the Webometric Future, The Journal of the World Universities Forum, 6(2): 37-52.</a></li>\n            </ul>\n            <p>For more references visit the <a target=\"_blank\" rel=\"nofollow\" href=\"https://www.mendeley.com/groups/1318573/citation-analysis-bibliometrics-and-webometrics/\">“Citation Analysis, Bibliometrics, and Webometrics”</a>&nbsp;Mendeley Group.</p>'),
(2, '2018-07-15 04:03:22', '2018-07-15 04:03:22', 'year', '2018');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` text COLLATE utf8mb4_unicode_ci,
  `name` text COLLATE utf8mb4_unicode_ci,
  `ip_address` text COLLATE utf8mb4_unicode_ci,
  `country_name` text COLLATE utf8mb4_unicode_ci,
  `country_code` text COLLATE utf8mb4_unicode_ci,
  `state` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2018_07_04_110453_create_cites_table', 1),
(32, '2018_07_04_111238_create_schools_table', 1),
(33, '2018_07_04_111303_create_positions_table', 1),
(34, '2018_07_04_111316_create_position_ranks_table', 1),
(35, '2018_07_07_123607_create_history_table', 1),
(36, '2018_07_08_141239_create_contents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `position_ranks`
--

CREATE TABLE `position_ranks` (
  `id` int(10) UNSIGNED NOT NULL,
  `percent` int(11) DEFAULT NULL,
  `higher_num` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `position_name` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `rank` int(11) DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `faculty` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `median` int(11) DEFAULT NULL,
  `mean` int(11) DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `name`, `surname`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'root', 'Root', 'Root', 'mikhail.garmashov@gmail.com', '$2y$10$V8eBcngR9ts/i2ZGEpTliuGq.1IgPS/ZhqRmYrjWGxWri2.xEMckC', NULL, '2018-07-15 04:03:22', '2018-07-15 04:03:22'),
(2, 'Thomas', 'Thomas', 'Sanchez', 'tomwsanchez@yahoo.com', '$2y$10$7o1HNA/F6T9JSE/FaZK1reWzmPa4RV00xLgtD8pu0Z/.CSr3potIC', NULL, '2018-07-15 04:03:22', '2018-07-15 04:03:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cites`
--
ALTER TABLE `cites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_ranks`
--
ALTER TABLE `position_ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cites`
--
ALTER TABLE `cites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `position_ranks`
--
ALTER TABLE `position_ranks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
