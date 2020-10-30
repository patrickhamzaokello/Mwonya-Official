-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2020 at 06:09 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kede`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Bacon and Eggs', 2, 4, 'assets/images/artwork/clearday.jpg'),
(2, 'Pizza head', 5, 10, 'assets/images/artwork/energy.jpg'),
(3, 'Summer Hits', 3, 1, 'assets/images/artwork/goinghigher.jpg'),
(4, 'The movie soundtrack', 2, 9, 'assets/images/artwork/funkyelement.jpg'),
(5, 'Best of the Worst', 1, 3, 'assets/images/artwork/popdance.jpg'),
(6, 'Hello World', 3, 6, 'assets/images/artwork/ukulele.jpg'),
(7, 'Best beats', 4, 7, 'assets/images/artwork/sweet.jpg'),
(8, 'Let the Trap Say Amen', 6, 3, 'assets/images/artwork/lecraeart.jpg'),
(9, 'All Things Work Together ', 6, 3, 'assets/images/artwork/lecrae2.jpg'),
(10, 'I am I was', 7, 3, 'assets/images/artwork/21savage.jpg'),
(11, 'Scorpion', 8, 3, 'assets/images/artwork/Drake.jpg'),
(12, 'Wasteland Baby', 9, 11, 'assets/images/artwork/Hozier.jpg'),
(13, 'Fearless', 10, 2, 'assets/images/artwork/justinbieber.jpg'),
(14, 'Free Spirit', 11, 5, 'assets/images/artwork/Khalid.jpg'),
(15, 'Sunday Service Choir', 12, 12, 'assets/images/artwork/sundayservice.jpg'),
(16, 'Suncity', 11, 5, 'assets/images/artwork/Suncitykhalid.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `profilephoto` varchar(300) NOT NULL,
  `genre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`, `profilephoto`, `genre`) VALUES
(1, 'Mickey Mouse', 'assets/images/artistprofiles/mickey.png', 3),
(2, 'Goofy', 'assets/images/artistprofiles/goof.png', 4),
(3, 'Bart Simpson', 'assets/images/artistprofiles/bart.png', 1),
(4, 'Homer', 'assets/images/artistprofiles/homer.png', 7),
(5, 'Bruce Lee', 'assets/images/artistprofiles/bruelee.png', 10),
(6, 'Lecrae', 'assets/images/artistprofiles/lecrae.png', 3),
(7, '21 Savage', 'assets/images/artistprofiles/21savage.png', 3),
(8, 'Drake', 'assets/images/artistprofiles/drake.png', 3),
(9, 'Hozier', 'assets/images/artistprofiles/mickey.png', 11),
(10, 'Justin Bieber', 'assets/images/artistprofiles/justinbieber.png', 2),
(11, 'Khalid', 'assets/images/artistprofiles/khalid.png', 5),
(12, 'Kanye West', 'assets/images/artistprofiles/kanyewest.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip-hop'),
(4, 'Rap'),
(5, 'R & B'),
(6, 'Classical'),
(7, 'Techno'),
(8, 'Jazz'),
(9, 'Folk'),
(10, 'Country'),
(11, 'Alternative'),
(12, 'Christian & Gospel');

-- --------------------------------------------------------

--
-- Table structure for table `likedsongs`
--

DROP TABLE IF EXISTS `likedsongs`;
CREATE TABLE IF NOT EXISTS `likedsongs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songId` int(11) NOT NULL,
  `artistId` int(11) NOT NULL,
  `songorder` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likedsongs`
--

INSERT INTO `likedsongs` (`id`, `songId`, `artistId`, `songorder`, `username`) VALUES
(1, 51, 6, 1, 'pkasemer'),
(2, 63, 8, 2, 'pkasemer'),
(3, 64, 10, 3, 'pkasemer'),
(7, 62, 8, 4, 'pkasemer'),
(8, 63, 8, 5, 'pkasemer'),
(9, 65, 7, 6, 'pkasemer'),
(10, 77, 11, 7, 'pkasemer'),
(11, 73, 11, 8, 'pkasemer');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(7, 'Bulldozer', 'reece-kenney', '2017-12-04 00:00:00'),
(8, 'Patrickpk', 'reece-kenney', '2017-12-04 00:00:00'),
(23, 'MOM', 'johnpk', '2020-05-10 00:00:00'),
(24, 'sevenseeds', 'sedricksedu', '2020-05-11 00:00:00'),
(43, 'Favorite Songs', 'pkasemer', '2020-05-20 00:00:00'),
(58, 'Summer Hits', 'Tiffany', '2020-05-20 00:00:00'),
(107, 'Chill Beats', 'Tiffany', '2020-05-22 00:00:00'),
(109, 'john', 'sedrick', '2020-05-25 00:00:00'),
(111, 'Summer Hits', 'pkasemer', '2020-05-27 00:00:00'),
(112, 'Chill Beats', 'pkasemer', '2020-05-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

DROP TABLE IF EXISTS `playlistsongs`;
CREATE TABLE IF NOT EXISTS `playlistsongs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(62, 31, 58, 1),
(63, 54, 58, 2),
(64, 58, 58, 3),
(65, 60, 58, 4),
(66, 61, 58, 5),
(67, 60, 43, 4),
(73, 62, 43, 7),
(75, 51, 58, 6),
(76, 51, 58, 7),
(77, 51, 58, 8),
(78, 51, 107, 1),
(79, 59, 58, 9),
(82, 72, 112, 1),
(83, 69, 112, 2),
(84, 73, 112, 3);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Acoustic Breeze', 1, 5, 8, '2:37', 'assets/music/bensound-acousticbreeze.mp3', 1, 56),
(2, 'A new beginning', 1, 5, 1, '2:35', 'assets/music/bensound-anewbeginning.mp3', 2, 32),
(3, 'Better Days', 1, 5, 2, '2:33', 'assets/music/bensound-betterdays.mp3', 3, 56),
(4, 'Buddy', 1, 5, 3, '2:02', 'assets/music/bensound-buddy.mp3', 4, 34),
(5, 'Clear Day', 1, 5, 4, '1:29', 'assets/music/bensound-clearday.mp3', 5, 30),
(6, 'Going Higher', 2, 1, 1, '4:04', 'assets/music/bensound-goinghigher.mp3', 1, 63),
(7, 'Funny Song', 2, 4, 2, '3:07', 'assets/music/bensound-funnysong.mp3', 2, 32),
(8, 'Funky Element', 2, 1, 3, '3:08', 'assets/music/bensound-funkyelement.mp3', 2, 56),
(9, 'Extreme Action', 2, 1, 4, '8:03', 'assets/music/bensound-extremeaction.mp3', 3, 75),
(10, 'Epic', 2, 4, 5, '2:58', 'assets/music/bensound-epic.mp3', 3, 41),
(11, 'Energy', 2, 1, 6, '2:59', 'assets/music/bensound-energy.mp3', 4, 46),
(12, 'Dubstep', 2, 1, 7, '2:03', 'assets/music/bensound-dubstep.mp3', 5, 50),
(13, 'Happiness', 3, 6, 8, '4:21', 'assets/music/bensound-happiness.mp3', 5, 22),
(14, 'Happy Rock', 3, 6, 9, '1:45', 'assets/music/bensound-happyrock.mp3', 4, 28),
(15, 'Jazzy Frenchy', 3, 6, 10, '1:44', 'assets/music/bensound-jazzyfrenchy.mp3', 3, 42),
(16, 'Little Idea', 3, 6, 1, '2:49', 'assets/music/bensound-littleidea.mp3', 2, 31),
(17, 'Memories', 3, 6, 2, '3:50', 'assets/music/bensound-memories.mp3', 1, 43),
(18, 'Moose', 4, 7, 1, '2:43', 'assets/music/bensound-moose.mp3', 5, 28),
(19, 'November', 4, 7, 2, '3:32', 'assets/music/bensound-november.mp3', 4, 37),
(20, 'Of Elias Dream', 4, 7, 3, '4:58', 'assets/music/bensound-ofeliasdream.mp3', 3, 32),
(21, 'Pop Dance', 4, 7, 2, '2:42', 'assets/music/bensound-popdance.mp3', 2, 38),
(22, 'Retro Soul', 4, 7, 5, '3:36', 'assets/music/bensound-retrosoul.mp3', 1, 44),
(23, 'Sad Day', 5, 2, 1, '2:28', 'assets/music/bensound-sadday.mp3', 1, 30),
(24, 'Sci-fi', 5, 2, 2, '4:44', 'assets/music/bensound-scifi.mp3', 2, 33),
(25, 'Slow Motion', 5, 2, 3, '3:26', 'assets/music/bensound-slowmotion.mp3', 3, 25),
(26, 'Sunny', 5, 2, 4, '2:20', 'assets/music/bensound-sunny.mp3', 4, 44),
(27, 'Sweet', 5, 2, 5, '5:07', 'assets/music/bensound-sweet.mp3', 5, 40),
(28, 'Tenderness ', 3, 3, 7, '2:03', 'assets/music/bensound-tenderness.mp3', 4, 41),
(29, 'The Lounge', 3, 3, 8, '4:16', 'assets/music/bensound-thelounge.mp3 ', 3, 44),
(30, 'Ukulele', 3, 3, 9, '2:26', 'assets/music/bensound-ukulele.mp3 ', 2, 41),
(31, 'Tomorrow', 3, 3, 1, '4:54', 'assets/music/bensound-tomorrow.mp3 ', 1, 70),
(46, '2 Sides of the Game (feat. Waka)', 6, 8, 3, '3:13', 'assets/music/2 Sides of the Game (feat. Waka).mp3', 3, 76),
(47, 'Blue Strips', 6, 8, 3, '4:01', 'assets/music/Blue Strips.mp3', 6, 67),
(48, 'By Chance', 6, 8, 3, '3:19', 'assets/music/By Chance.mp3', 13, 37),
(49, 'Cant Block It', 6, 8, 3, '2:58', 'assets/music/Blue Strips.mp3', 11, 38),
(50, 'Fly Away (feat. nobigdyl.)', 6, 8, 3, '3:48', 'assets/music/Fly Away (feat. nobigdyl.).mp3', 12, 28),
(51, 'Get Back Right', 6, 8, 3, '3:05', 'assets/music/Get Back Right.mp3 ', 1, 173),
(52, 'Holy Water', 6, 8, 3, '3:26', 'assets/music/Holy Water.mp3 ', 5, 50),
(53, 'I Cant Lose (feat. 24hrs)', 6, 8, 3, '3:06', 'assets/music/I Cant Lose (feat. 24hrs).mp3 ', 9, 41),
(54, 'Only God Can Judge Me', 6, 8, 3, '2:57', 'assets/music/Only God Can Judge Me.mp3', 7, 42),
(55, 'Plugged In', 6, 8, 3, '3:12', 'assets/music/Plugged In.mp3', 4, 42),
(56, 'Preach', 6, 8, 3, '2:55', 'assets/music/Preach.mp3', 2, 83),
(57, 'Switch (feat. ShySpeaks)', 6, 8, 3, '4:02', 'assets/music/Switch (feat. ShySpeaks).mp3', 10, 42),
(58, 'Yet', 6, 8, 3, '3:12', 'assets/music/Yet.mp3', 8, 49),
(59, 'Facts', 6, 9, 3, '4:01', 'assets/music/Facts.mp3', 2, 143),
(60, 'Blessings', 6, 9, 3, '3:51', 'assets/music/Blessings.mp3', 4, 108),
(61, 'Broke', 6, 9, 3, '2:59', 'assets/music/Broke.mp3', 3, 93),
(62, 'Survival', 8, 11, 3, '2:16', 'assets/music/survival.mp3', 1, 42),
(63, 'Nonstop', 8, 11, 3, '3:58', 'assets/music/Nonstop.mp3', 2, 16),
(64, 'Can\'t Get Enough', 10, 13, 2, '1:46', 'assets/music/Can\'t Get Enough.mp3', 1, 7),
(65, 'A lot', 7, 10, 3, '3:05', 'assets/music/alot.mp3', 1, 2),
(66, 'Count Your Blessings', 12, 15, 12, '3:13', 'assets/music/CountYourBlessings.mp3', 1, 1),
(67, '9.13', 11, 16, 5, '3:36', 'assets/music/9.13.mp3', 1, 1),
(68, 'Vertigo', 11, 16, 5, '2:28', 'assets/music/vertigo.mp3', 2, 1),
(69, 'Saturday Nights', 11, 16, 5, '4:44', 'assets/music/saturdaynights.mp3', 3, 1),
(70, 'Salem\'s Interlude', 11, 16, 5, '3:26', 'assets/music/salem\'sinterlude.mp3', 4, 1),
(71, 'Motion', 11, 16, 5, '2:28', 'assets/music/motion.mp3', 5, 1),
(72, 'Better', 11, 16, 5, '4:44', 'assets/music/Better.mp3', 6, 2),
(73, 'Suncity', 11, 16, 5, '3:26', 'assets/music/Suncity.mp3', 7, 1),
(74, 'Intro', 11, 14, 5, '4:44', 'assets/music/intro.mp3', 1, 2),
(75, 'Bad Luck', 11, 14, 5, '3:26', 'assets/music/badluck.mp3', 2, 2),
(76, 'My Bad', 11, 14, 5, '2:28', 'assets/music/mybad.mp3', 3, 2),
(77, 'Twenty One', 11, 14, 5, '4:44', 'assets/music/twentyone.mp3', 12, 6),
(78, 'Right Back', 11, 14, 5, '3:26', 'assets/music/rightback.mp3', 6, 2),
(79, 'Nina Cried Power', 9, 12, 11, '2:28', 'assets/music/ninacriedpower.mp3', 1, 1),
(80, 'Almost', 9, 12, 11, '4:44', 'assets/music/almost.mp3', 2, 3),
(81, 'Movement', 9, 12, 11, '3:26', 'assets/music/Movement.mp3', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'reece-kenney', 'Reece', 'Kenney', 'Reece@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2017-06-28 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(2, 'donkey-kong', 'Donkey', 'Kong', 'Dk@yahoo.com', '7c6a180b36896a0a8c02787eeafb0e4c', '2017-06-28 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(3, 'simon-cowell', 'Simon', 'Cowell', 'Simon@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2017-10-29 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(6, 'Simon-cowell10', 'Reece', 'Kenney', 'Reecekenney50111@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2017-11-16 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(14, 'pkasemer', 'Patrick', 'Okello', 'Pkasemer@gmail.com', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-10 00:00:00', 'assets/images/profile-pics/head_emerald.png'),
(16, 'pkasemers', 'Patrick', 'Okello', 'Pkasemer@gmail.coms', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-18 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(17, 'Tiffany', 'Tiffany', 'Nalaaki', 'Tiffanymaggie@gmail.com', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-20 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(18, 'johnpatrick', 'Johnpatrick', 'Ejana', 'Ejana@gmail.com', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-25 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(19, 'sedrick', 'Sedrick', 'Otolo', 'sedrickupdatedemail@gmail.com', '9ae0147d65724f72f74804af4aac6f13', '2020-05-25 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(20, 'brenda', 'Brenda', 'Obote', 'Brendaa@gmail.com', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-25 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(21, 'kasfamom', 'Kasfa', 'Aceng', 'Kasfa@gmail.com', 'faf3acef0512c03d216b8fbbeeea79a6', '2020-05-25 00:00:00', 'assets/images/profile-pics/picture.jpg'),
(22, 'patricialoyce', 'Patricia', 'Adong', 'Patriciaadong@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-05-27 00:00:00', 'assets/images/profile-pics/picture.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
