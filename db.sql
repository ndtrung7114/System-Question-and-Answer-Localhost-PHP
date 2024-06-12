-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 11:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `vote` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `question_id`, `comment_content`, `date`, `time`, `vote`, `image`) VALUES
(46, 19, 61, 'S: Specific, M: Measurable, A: Achievable, R: Relevant, T: Time bound', '2024-04-29', '23:30:53', 0, ''),
(47, 23, 60, 'i am same with you', '2024-04-29', '00:01:05', 0, ''),
(48, 22, 57, '29/4 bro', '2024-04-29', '00:30:50', 0, ''),
(49, 22, 57, 'it is 30/4 in Viet Nam', '2024-04-29', '01:10:49', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `comment_rep`
--

CREATE TABLE `comment_rep` (
  `comment_rep_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_rep`
--

INSERT INTO `comment_rep` (`comment_rep_id`, `user_id`, `comment_id`, `question_id`, `content`, `date`, `time`, `image`) VALUES
(39, 23, 46, 61, 'thanks ', '2024-04-29', '23:58:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `amount_questions` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `about`, `amount_questions`) VALUES
(1, 'Web 1', 'The subject is taught by Mr. Long', 11),
(2, 'User Interface Design', 'The subject is taught by Mr. Omar', 3),
(3, 'Vovinam', 'The subject is taught by Mr. Nghi', 2),
(4, 'Professor Project Management', 'The subject is taught by Mr. Tuan Anh', 2),
(11, 'Web 22', 'The subject is taught by Mr.Tobi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notice_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `activate` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notice_id`, `user_id`, `question_id`, `activate`, `date`, `time`) VALUES
(7, 23, 61, 0, '2024-04-29', '23:30:53'),
(8, 22, 60, 0, '2024-04-29', '00:01:05'),
(9, 19, 57, 0, '2024-04-29', '00:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `view` int(255) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `vote` int(11) NOT NULL,
  `comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `user_id`, `module_id`, `title`, `content`, `date`, `image`, `view`, `time`, `vote`, `comment`) VALUES
(57, 19, 1, 'Coursework Deadline?', 'Can anyone tell me what the course deadline is?', '2024-04-29', 'banh my.jpg', 11, '22:48:17', 0, 2),
(58, 20, 1, 'Best Subject?', 'How to achieve the best subject award?\r\n(image is not related to question ^.^)', '2024-04-29', 'krillin.jpg', 1, '23:00:05', 0, 0),
(59, 21, 2, 'Who?', 'I do not know, who is teacher at this subject', '2024-04-29', '', 2, '23:06:56', 0, 0),
(60, 22, 3, 'Help?', 'I do not remember all the moves in martial arts', '2024-04-29', '', 5, '23:10:31', 0, 1),
(61, 23, 4, 'Small question', 'What does SMART stand for?', '2024-04-29', '', 17, '23:12:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `save_comment`
--

CREATE TABLE `save_comment` (
  `save_comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `save_comment`
--

INSERT INTO `save_comment` (`save_comment_id`, `user_id`, `comment_id`) VALUES
(19, 19, 48);

-- --------------------------------------------------------

--
-- Table structure for table `save_question`
--

CREATE TABLE `save_question` (
  `save_question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `save_question`
--

INSERT INTO `save_question` (`save_question_id`, `user_id`, `question_id`) VALUES
(16, 19, 61),
(17, 19, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reputation` int(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `job` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`, `name`, `reputation`, `country`, `birth`, `job`, `avatar`, `create_at`, `role`) VALUES
(19, 'Goku', 'trunghack999@gmail.com', '$2y$10$L/hbrcaqKX9c9hAT0wEw4OHDN55Y2LE0SXAh2T6kq0AF1IiyLiHNW', '', 0, 'Viet Nam', '2024-04-04', 'IT', 'goku.jpg', '2024-04-19', 1),
(20, 'Krillin', 'trungndgch220848@fpt.edu.vn', '$2y$10$P8vUNo1.pIjHRxvzQgR1Fehki3w/1QnVvMAJGKDnB07PJ7KPqmOay', '', 0, 'Viet Nam', '2024-04-02', 'IT', 'krillin.jpg', '2024-04-01', 0),
(21, 'Vegeta', 'vegeta@gmail.com', '$2y$10$cE4mENvgXuWPpkaU5/8guORvRZsZ2hiOhkaOESeukrdVWpif0TVbS', '', 0, 'Japan', '2024-03-31', 'IT', 'vegeta.jpg', '2024-03-05', 0),
(22, 'Gohan', 'gohan@gmail.com', '$2y$10$zUXlHaWzUqYxCObA88Gv4OVh376qLb7/Sbu2imLAuEFQ4RvGJc9vi', '', 0, 'England', '2024-03-12', 'IT', 'gohan.jpg', '2024-04-27', 0),
(23, 'Piccolo', 'piccolo@gmail.com', '$2y$10$zNoVi0k21fP.XDcksp27KO5l16BhwaWNxnGu5WzjFDoYatoTLpz7m', '', 1, 'Viet Nam', '2024-02-20', 'IT', 'piccolo.jpg', '2024-04-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `user_id`, `question_id`) VALUES
(26, 19, 61);

-- --------------------------------------------------------

--
-- Table structure for table `vote_comment`
--

CREATE TABLE `vote_comment` (
  `vc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `comment_rep`
--
ALTER TABLE `comment_rep`
  ADD PRIMARY KEY (`comment_rep_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `save_comment`
--
ALTER TABLE `save_comment`
  ADD PRIMARY KEY (`save_comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `save_question`
--
ALTER TABLE `save_question`
  ADD PRIMARY KEY (`save_question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `vote_comment`
--
ALTER TABLE `vote_comment`
  ADD PRIMARY KEY (`vc_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `comment_rep`
--
ALTER TABLE `comment_rep`
  MODIFY `comment_rep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `save_comment`
--
ALTER TABLE `save_comment`
  MODIFY `save_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `save_question`
--
ALTER TABLE `save_question`
  MODIFY `save_question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vote_comment`
--
ALTER TABLE `vote_comment`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_rep`
--
ALTER TABLE `comment_rep`
  ADD CONSTRAINT `comment_rep_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_rep_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_rep_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `save_comment`
--
ALTER TABLE `save_comment`
  ADD CONSTRAINT `save_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `save_comment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `save_question`
--
ALTER TABLE `save_question`
  ADD CONSTRAINT `save_question_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `save_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_comment`
--
ALTER TABLE `vote_comment`
  ADD CONSTRAINT `vote_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_comment_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
