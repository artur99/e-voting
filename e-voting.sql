-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2015 at 02:10 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evotus`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidati_vot`
--

CREATE TABLE IF NOT EXISTS `candidati_vot` (
`id` int(11) NOT NULL,
  `id_sesiune` int(11) NOT NULL,
  `nume` text NOT NULL,
  `detalii` text NOT NULL,
  `voturi` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidati_vot`
--

INSERT INTO `candidati_vot` (`id`, `id_sesiune`, `nume`, `detalii`, `voturi`) VALUES
(1, 1, 'Victor-Viorel Ponta', '<span style="font-weight: bold;">Victor-Viorel Ponta</span> (n. 20 septembrie 1972, București) este un om politic român cu origini albaneze si italiene, președinte al Partidul Social Democrat din februarie 2010, copreședinte al Uniunii Social-Liberale, deputat de Gorj. Ponta este din 7 mai 2012 prim-ministru al României.', 0),
(2, 1, 'Klaus Iohannis', '<span style="font-weight: bold;">Klaus Werner Iohannis</span>&nbsp;<span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">a fost profesor de fizică și inspector școlar înainte de a deveni primar al municipiului&nbsp;</span>Sibiu<span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">&nbsp;în anul&nbsp;</span>2000<span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">, funcție în care a fost reales în 2004, 2008 și 2012, de fiecare dată din partea&nbsp;</span>Forumului Democrat al Germanilor din România<span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">. În 2007 Sibiul a fost&nbsp;</span> Capitală Culturală Europeană<span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">, lui Iohannis fiindu-i atribuit meritul de fi modernizat infrastructura și pus în valoare potențialul economic și turistic al orașului.</span>', 0),
(3, 1, 'Elena Gabriela Udrea', '<span style="font-weight: bold;">Elena Udrea</span> (nume complet <span style="font-weight: bold;">Elena Gabriela Udrea</span>; n. 26 decembrie 1973, Buzău, România) este o politiciană română care din 2008 deține funcția de deputat. În trecut a deținut funcțiile de consilier prezidențial, șef al Cancelariei Prezidențiale, ministru al turismului și ministru al dezvoltării regionale și turismului. Udrea este considerată o apropiată a președintelui Traian Băsescu, căruia îi datorează ascensiunea politică', 0),
(4, 1, 'Călin Popescu-Tăriceanu', '<span style="font-weight: bold;">Călin Constantin Anton Popescu-Tăriceanu</span> (n. 14 ianuarie 1952, București) este un om politic român, prim-ministru al României între 28 decembrie 2004 și 22 decembrie 2008, președinte al Partidului Național Liberal din 2005 până în 2009.', 0),
(5, 1, 'Monica Macovei', '<span style="font-weight: bold;">Monica Macovei</span> (n. 4 februarie 1959, București) este o juristă și politiciană română, care a îndeplinit funcția de ministru al justiției între 2004 și 2007. Din 2009 deține funcția de europarlamentar din partea României, fiind realeasă în 2014. În august 2014 și-a anunțat candidatura pentru președinția României la alegerile din 2014. A fost asociată cu organizația pentru apărarea drepturilor omului APADOR-CH până în 2004, inițial drept consultant pro bono, iar apoi ca vice-președinte și președinte.', 0),
(6, 1, 'Hunor Kelemen', '<span style="font-weight: bold;">Hunor Kelemen</span> (n. 18 octombrie 1967, Cârța, Harghita, România) este un politician român de etnie maghiară din România, ales începând cu legislatura 2000-2004 deputat de Harghita din partea UDMR.', 0),
(8, 1, 'Cristian Dan Diaconescu', '<span style="color: rgb(37, 37, 37); font-family: sans-serif; font-weight: bold; line-height: 22.3999996185303px;">Cristian Dan Diaconescu</span><span style="color: rgb(37, 37, 37); font-family: sans-serif; line-height: 22.3999996185303px;">&nbsp;(n. 9 decembrie 1967, Caracal) este un ziarist român, politician, prezentator, fondator al televiziunilor OTV și DDTV. Este absolvent al Facultății de Mecanică din cadrul Institutului Politehnic din București. În 2010, el a format Partidul Poporului.</span>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE IF NOT EXISTS `error_log` (
`id` int(11) NOT NULL,
  `eroare` text NOT NULL,
  `timp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `error_log`
--

INSERT INTO `error_log` (`id`, `eroare`, `timp`) VALUES
(1, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 59', 1431259932),
(2, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 59', 1431259932),
(3, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 59', 1431259932),
(4, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(5, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(6, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(7, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(8, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(9, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(10, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(11, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(12, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(13, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 60', 1431259932),
(15, 'Array to string conversion in D:\\Host\\E-votus\\app\\template\\fill.php on line 55', 1431259932),
(16, 'Array to string conversion in D:\\Host\\E-votus\\app\\template\\fill.php on line 55', 1431259932),
(17, 'include(): Failed opening ''D:\\Host\\E-votus/app/dd.pgp'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\template\\index.php on line 4', 1431259932),
(18, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/ajax.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 32', 1431259932),
(19, 'Undefined variable: num in D:\\Host\\E-votus\\app\\ajax.php on line 29', 1431259932),
(20, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/votare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 44', 1431259932),
(21, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/votare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 44', 1431259932),
(22, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/votare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 43', 1431259932),
(23, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/votare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 45', 1431259932),
(24, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/sub/'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\template\\votare.php on line 44', 1431259932),
(25, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/sub/votare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\template\\votare.php on line 44', 1431259932),
(26, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 5', 1431259932),
(27, 'Undefined index: nume in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 13', 1431259932),
(28, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 135', 1431259932),
(29, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\functions.php on line 134', 1431259932),
(30, 'Object of class mysqli_result could not be converted to int in D:\\Host\\E-votus\\app\\functions.php on line 144', 1431259932),
(31, 'Object of class mysqli_result could not be converted to int in D:\\Host\\E-votus\\app\\functions.php on line 144', 1431259932),
(32, 'Object of class mysqli_result could not be converted to int in D:\\Host\\E-votus\\app\\functions.php on line 144', 1431259932),
(33, 'Object of class mysqli_result could not be converted to int in D:\\Host\\E-votus\\app\\functions.php on line 144', 1431259932),
(34, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 49', 1431259932),
(35, 'date() expects parameter 2 to be long, string given in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 54', 1431259932),
(36, 'Undefined index: sfarsit in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 54', 1431259932),
(37, 'Undefined index: detaliii in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 54', 1431259932),
(38, 'Undefined variable: c2 in D:\\Host\\E-votus\\app\\functions.php on line 199', 1431259932),
(39, 'Trying to get property of non-object in D:\\Host\\E-votus\\app\\template\\pag\\votare.php on line 16', 1431259932),
(40, 'file_get_contents(files/main.css): failed to open stream: No such file or directory in D:\\Host\\E-votus\\app\\data\\css.php on line 17', 1431259932),
(41, 'file_get_contents(files/main.js): failed to open stream: No such file or directory in D:\\Host\\E-votus\\app\\data\\js.php on line 12', 1431259932),
(42, 'file_get_contents(files/main.js): failed to open stream: No such file or directory in D:\\Host\\E-votus\\app\\data\\js.php on line 12', 1431259932),
(43, 'file_get_contents(files/main.js): failed to open stream: No such file or directory in D:\\Host\\E-votus\\app\\data\\js.php on line 12', 1431259932),
(44, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/bec-admin.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\functions.php on line 55', 1431259932),
(45, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/pag/admin-bec/sesiuni.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\template\\admin-bec.php on line 50', 1431259932),
(46, 'include(): Failed opening ''D:\\Host\\E-votus/app/template/pag/admin-bec/sesiuni.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-votus\\app\\template\\admin-bec.php on line 50', 1431259932),
(47, 'Undefined variable: chars in D:\\Host\\E-votus\\app\\functions.php on line 135', 1431259932),
(48, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 56', 1431259932),
(49, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 56', 1431259932),
(50, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 58', 1431259932),
(51, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 58', 1431259932),
(52, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(53, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(54, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(55, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(56, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(57, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(58, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(59, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(60, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(61, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(62, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 59', 1431259932),
(63, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(64, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(65, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(66, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(67, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(68, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 60', 1431259932),
(69, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 62', 1431259932),
(70, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(71, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(72, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(73, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(74, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(75, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(76, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(77, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(78, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\admin-bec\\editare.php on line 38', 1431259932),
(79, 'Undefined variable: descriere in D:\\Host\\E-vote\\app\\ajax.php on line 74', 1431259932),
(80, 'Undefined variable: desc in D:\\Host\\E-vote\\app\\ajax.php on line 74', 1431259932),
(81, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-bec/editare_cand.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-bec.php on line 81', 1431259932),
(82, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 162', 1431259932),
(83, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 162', 1431259932),
(84, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 162', 1431259932),
(85, 'Undefined index: id in D:\\Host\\E-vote\\app\\ajax.php on line 196', 1431259932),
(86, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 163', 1431259932),
(87, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 163', 1431259932),
(88, 'getimagesize(): Filename cannot be empty in D:\\Host\\E-vote\\app\\ajax.php on line 163', 1431259932),
(89, 'Undefined index: id in D:\\Host\\E-vote\\app\\ajax.php on line 197', 1431259932),
(90, 'Undefined index: descriere in D:\\Host\\E-vote\\app\\template\\pag\\votare\\votare.php on line 15', 1431259932),
(91, 'Undefined variable: primadm in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 10', 1431259932),
(92, 'Undefined variable: primadm in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 10', 1431259932),
(93, 'Undefined variable: primadm in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 10', 1431259932),
(94, 'Undefined index: postal in D:\\Host\\E-vote\\app\\functions.php on line 267', 1431259932),
(95, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-prim/reclamatii.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 57', 1431259932),
(96, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-prim/reclamatii.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 57', 1431259932),
(97, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-prim/adaugare.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-prim.php on line 57', 1431259932),
(98, 'ob_clean(): failed to delete buffer. No buffer to delete in D:\\Host\\E-vote\\app\\controller.php on line 13', 1431259932),
(99, 'ob_clean(): failed to delete buffer. No buffer to delete in D:\\Host\\E-vote\\app\\controller.php on line 13', 1431259932),
(100, 'ob_start(): failed to create buffer in D:\\Host\\E-vote\\app\\controller.php on line 9', 1431259932),
(101, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(102, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(103, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(104, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(105, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(106, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(107, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(108, 'Undefined variable: js in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 35', 1431259932),
(109, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(110, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(111, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(112, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(113, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(114, 'preg_replace(): Unknown modifier ''g'' in D:\\Host\\E-vote\\app\\phpdata\\minifier.php on line 34', 1431259932),
(115, 'Undefined offset: 1 in D:\\Host\\E-vote\\app\\phpdata\\switcher2.php on line 21', 1431259932),
(116, 'Undefined index: pg in D:\\Host\\E-vote\\app\\phpdata\\switcher2.php on line 19', 1431259932),
(117, 'Undefined variable: type in D:\\Host\\E-vote\\app\\controller.php on line 9', 1431259932),
(118, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/admin-prime.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\phpdata\\switcher.php on line 68', 1431259932),
(119, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/admin-prime.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\phpdata\\switcher.php on line 64', 1431259932),
(120, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/admin-prime.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\phpdata\\switcher.php on line 64', 1431259932),
(121, 'Undefined variable: pg2 in D:\\Host\\E-vote\\app\\template\\votare.php on line 18', 1431259932),
(122, 'Undefined variable: pg2 in D:\\Host\\E-vote\\app\\template\\votare.php on line 18', 1431259932),
(123, 'Undefined variable: primadm in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 10', 1431259932),
(124, 'Undefined variable: primadm in D:\\Host\\E-vote\\app\\phpdata\\switcher.php on line 95', 1431259932),
(125, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(126, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(127, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(128, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(129, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(130, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(131, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(132, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(133, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(134, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(135, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 50', 1431259932),
(136, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 52', 1431259932),
(137, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 52', 1431259932),
(138, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 52', 1431259932),
(139, 'include(): Failed opening ''D:\\Host\\E-vote/app/template/pag/admin-urna/index.php'' for inclusion (include_path=''.;C:\\Programs\\xampp\\php\\PEAR'') in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 52', 1431259932),
(140, 'Undefined variable: p in D:\\Host\\E-vote\\app\\template\\admin-urna.php on line 48', 1431259932),
(141, 'Object of class mysqli_result could not be converted to int in D:\\Host\\E-vote\\app\\ajax.php on line 342', 1431259932),
(142, 'Undefined index: token in D:\\Host\\E-vote\\app\\phpdata\\switcher.php on line 45', 1431259932),
(143, 'Undefined index: data in D:\\Host\\E-vote\\app\\template\\pag\\admin-urna\\sesiune.php on line 11', 1431259932),
(144, 'A non well formed numeric value encountered in D:\\Host\\E-vote\\app\\template\\pag\\admin-dev\\hack.php on line 8', 1431259932),
(145, 'A non well formed numeric value encountered in D:\\Host\\E-vote\\app\\template\\pag\\admin-dev\\hack.php on line 8', 1431259932);

-- --------------------------------------------------------

--
-- Table structure for table `hack_log`
--

CREATE TABLE IF NOT EXISTS `hack_log` (
`id` int(11) NOT NULL,
  `headere` text NOT NULL,
  `post` text NOT NULL,
  `get` text NOT NULL,
  `ip` text NOT NULL,
  `timp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hack_log`
--

INSERT INTO `hack_log` (`id`, `headere`, `post`, `get`, `ip`, `timp`) VALUES
(1, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:2:"65";s:6:"Accept";s:3:"*/*";s:6:"Origin";s:16:"http://localhost";s:16:"X-Requested-With";s:14:"XMLHttpRequest";s:10:"User-Agent";s:102:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36";s:12:"Content-Type";s:48:"application/x-www-form-urlencoded; charset=UTF-8";s:7:"Referer";s:25:"http://localhost/E-votus/";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=o89al53mprpepcg898fl1kj276";}', 'a:3:{s:3:"cnp";s:13:"123456789123''";s:5:"email";s:23:"david1989mail@yahoo.com";s:6:"parola";s:8:"testtest";}', 'a:1:{s:2:"pg";s:10:"ajax/login";}', '127.0.0.1', 1427904570),
(2, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:2:"65";s:6:"Accept";s:3:"*/*";s:6:"Origin";s:16:"http://localhost";s:16:"X-Requested-With";s:14:"XMLHttpRequest";s:10:"User-Agent";s:102:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36";s:12:"Content-Type";s:48:"application/x-www-form-urlencoded; charset=UTF-8";s:7:"Referer";s:25:"http://localhost/E-votus/";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=o89al53mprpepcg898fl1kj276";}', 'a:3:{s:3:"cnp";s:13:"123456789123''";s:5:"email";s:23:"david1989mail@yahoo.com";s:6:"parola";s:8:"testtest";}', 'a:1:{s:2:"pg";s:10:"ajax/login";}', '127.0.0.1', 1427904614),
(3, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:2:"65";s:6:"Accept";s:3:"*/*";s:6:"Origin";s:16:"http://localhost";s:16:"X-Requested-With";s:14:"XMLHttpRequest";s:10:"User-Agent";s:102:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36";s:12:"Content-Type";s:48:"application/x-www-form-urlencoded; charset=UTF-8";s:7:"Referer";s:25:"http://localhost/E-votus/";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=o89al53mprpepcg898fl1kj276";}', 'a:3:{s:3:"cnp";s:13:"123456789123''";s:5:"email";s:23:"david1989mail@yahoo.com";s:6:"parola";s:8:"testtest";}', 'a:1:{s:2:"pg";s:10:"ajax/login";}', '127.0.0.1', 1427907607),
(4, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:2:"70";s:6:"Accept";s:3:"*/*";s:6:"Origin";s:16:"http://localhost";s:16:"X-Requested-With";s:14:"XMLHttpRequest";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:48:"application/x-www-form-urlencoded; charset=UTF-8";s:7:"Referer";s:28:"http://localhost/E-votus/out";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=gsveo3meorsfhem0usim0lp7g3";}', 'a:3:{s:3:"cnp";s:13:"1234567890123";s:5:"email";s:23:"david1989mail@gmail.com";s:6:"parola";s:11:"'' or ''1''=''1";}', 'a:1:{s:2:"pg";s:10:"ajax/login";}', '127.0.0.1', 1430211834),
(5, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430435817),
(6, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430436092),
(7, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430436139),
(8, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430436162),
(9, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430436165),
(10, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:3:"121";s:13:"Cache-Control";s:9:"max-age=0";s:6:"Accept";s:74:"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";s:6:"Origin";s:16:"http://localhost";s:10:"User-Agent";s:101:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36";s:12:"Content-Type";s:33:"application/x-www-form-urlencoded";s:7:"Referer";s:42:"http://localhost/E-votus/votare/reclamatie";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=f724o1h0o52ul45k6d5fctfd52";}', 'a:2:{s:3:"tel";s:30:"<script>alert("22");</script>''";s:10:"reclamatie";s:31:"<script>alert("22");</script> ''";}', 'a:1:{s:2:"pg";s:17:"votare/reclamatie";}', '127.0.0.1', 1430436290),
(11, 'a:12:{s:4:"Host";s:9:"localhost";s:10:"Connection";s:10:"keep-alive";s:14:"Content-Length";s:2:"62";s:6:"Accept";s:3:"*/*";s:6:"Origin";s:16:"http://localhost";s:16:"X-Requested-With";s:14:"XMLHttpRequest";s:10:"User-Agent";s:102:"Mozilla/5.0 (Windows NT 6.3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36";s:12:"Content-Type";s:48:"application/x-www-form-urlencoded; charset=UTF-8";s:7:"Referer";s:24:"http://localhost/E-vote/";s:15:"Accept-Encoding";s:13:"gzip, deflate";s:15:"Accept-Language";s:32:"en-US,en;q=0.8,ro;q=0.6,es;q=0.4";s:6:"Cookie";s:36:"PHPSESSID=78kj8dnl2hkqdk4lgf6gm1j7d6";}', 'a:3:{s:3:"cnp";s:13:"1234567890123";s:5:"email";s:15:"test@asdasd.com";s:6:"parola";s:11:"'' or ''1''=''1";}', 'a:1:{s:2:"pg";s:10:"ajax/login";}', '127.0.0.1', 1430894698);

-- --------------------------------------------------------

--
-- Table structure for table `persoane`
--

CREATE TABLE IF NOT EXISTS `persoane` (
  `cnp` bigint(20) unsigned NOT NULL,
  `nume` text NOT NULL,
  `prenume` text NOT NULL,
  `nastere` int(11) NOT NULL,
  `email` text,
  `parola` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persoane`
--

INSERT INTO `persoane` (`cnp`, `nume`, `prenume`, `nastere`, `email`, `parola`) VALUES
(1200904256099, 'Albu\r\n', 'Ștefan', 19200904, 'example@domain.com', 'efad826f94ec5d1856e0f07c3d03b7efd05fc923'),
(1234567890123, 'Vultur', 'David', 19890718, 'david1989mail@yahoo.com', 'efad826f94ec5d1856e0f07c3d03b7efd05fc923'),
(1281212237740, 'Popescu\r\n', 'Maria\r\n', 19281212, NULL, NULL),
(1321205243185, 'Marin\r\n', 'Andrei\r\n', 19321205, NULL, NULL),
(1381116228546, 'Tudor\r\n', 'Alexandra\r\n', 19381116, NULL, NULL),
(1411215043606, 'Ionescu\r\n', 'Alexandru\r\n', 19411215, NULL, NULL),
(1440405297313, 'Albu\r\n', 'Ioana\r\n', 19440405, NULL, NULL),
(1560616209301, 'Chițu\r\n', 'Alexandra\r\n', 19560616, NULL, NULL),
(1611104061640, 'Constantin\r\n', 'Alexandru\r\n', 19611104, NULL, NULL),
(1740415443743, 'Manole\r\n', 'Alexandru\r\n', 19740415, NULL, NULL),
(1770927398879, 'Mazilescu\r\n', 'Stefan\r\n', 19770927, NULL, NULL),
(1781105031135, 'Mazilescu\r\n', 'Andrei\r\n', 19781105, NULL, NULL),
(1781123327111, 'Radu\r\n', 'Maria\r\n', 19781123, NULL, NULL),
(2150129444494, 'Oprea\r\n', 'Andreea\r\n', 19150129, NULL, NULL),
(2160606024413, 'Gheorghe\r\n', 'David\r\n', 19160606, NULL, NULL),
(2330123074711, 'Nemeș\r\n', 'Andrei\r\n', 19330123, NULL, NULL),
(2330518121688, 'Dumitrescu\r\n', 'Maria\r\n', 19330518, NULL, NULL),
(2380921445247, 'Chițu\r\n', 'Elena\r\n', 19380921, NULL, NULL),
(2511214277693, 'Marin\r\n', 'Ioana\r\n', 19511214, NULL, NULL),
(2571208174516, 'Tabacu\r\n', 'Elena\r\n', 19571208, NULL, NULL),
(2680212237915, 'Barbu\r\n', 'Darius', 19680212, NULL, NULL),
(2740304465346, 'Nistor\r\n', 'Alexandra\r\n', 19740304, NULL, NULL),
(2800608468291, 'Vasile\r\n', 'Stefan\r\n', 19800608, NULL, NULL),
(2800914173048, 'Nistor\r\n', 'Elena\r\n', 19800914, NULL, NULL),
(2851103231706, 'Preda', 'Elena\r\n', 19851103, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `primarii`
--

CREATE TABLE IF NOT EXISTS `primarii` (
`id` int(11) NOT NULL,
  `codpostal` text NOT NULL,
  `parola` text NOT NULL,
  `nume` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `primarii`
--

INSERT INTO `primarii` (`id`, `codpostal`, `parola`, `nume`) VALUES
(1, '123456', '143705d52279ede0e4912e1b33f34b2877293172', 'Primaria Fălticeni');

-- --------------------------------------------------------

--
-- Table structure for table `reclamatii`
--

CREATE TABLE IF NOT EXISTS `reclamatii` (
`id` int(11) NOT NULL,
  `telefon` text NOT NULL,
  `reclamatie` text NOT NULL,
  `ip` text NOT NULL,
  `email` text NOT NULL,
  `timp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reclamatii`
--

INSERT INTO `reclamatii` (`id`, `telefon`, `reclamatie`, `ip`, `email`, `timp`) VALUES
(1, '1902830918230', 'As vrea sa reclamez o frauda ;p: P:P : :P :::P :P :P :P P:P :P:P:P:P:P', '::1', 'david1989mail@yahoo.com', 1430217769),
(2, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430435817),
(3, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430436092),
(4, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430436139),
(5, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430436162),
(6, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430436166),
(7, '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt;''', '&lt;script&gt;alert(&quot;22&quot;);&lt;/script&gt; ''', '::1', 'david1989mail@yahoo.com', 1430436290),
(8, 'qweqwe', 'qweqew<br />\r\n<br />\r\nasd', '::1', 'david1989mail@yahoo.com', 1430436299),
(9, 'qweqwe', 'qweqew<br />\r\n<br />\r\nasd', '::1', 'david1989mail@yahoo.com', 1430436326),
(10, '', '', '::1', 'david1989mail@yahoo.com', 1430504108),
(11, '555', '555', '::1', 'example@domain.com', 1431334792),
(12, '555', '555', '::1', 'example@domain.com', 1431334864),
(13, '123', '123', '', 'david1989mail@yahoo.com', 1436792212);

-- --------------------------------------------------------

--
-- Table structure for table `sesiuni_vot`
--

CREATE TABLE IF NOT EXISTS `sesiuni_vot` (
`id` int(11) NOT NULL,
  `titlu` text NOT NULL,
  `detalii` text NOT NULL,
  `inceput` int(11) NOT NULL,
  `incheiere` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sesiuni_vot`
--

INSERT INTO `sesiuni_vot` (`id`, `titlu`, `detalii`, `inceput`, `incheiere`) VALUES
(1, 'Votează Președintele Rom&acirc;niei 2014', 'Votează președintele României pentru anii 2014-2018 in sesiunea din 2014. Președintele României deține puterea executivă', 1437930000, 1437943200);

-- --------------------------------------------------------

--
-- Table structure for table `setari`
--

CREATE TABLE IF NOT EXISTS `setari` (
  `nume` varchar(100) NOT NULL,
  `valoare` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setari`
--

INSERT INTO `setari` (`nume`, `valoare`) VALUES
('admin-bec-pass-1', '796f0eab5b77858e197a0f206e648c30ce62fc9d'),
('admin-bec-pass-2', '7e47823c2adb3683e819b3f05dc561163221c909'),
('admin-dev-pass-1', '57ed15568e99392098e91d8c88ba9fbc07f85b48'),
('admin-dev-pass-2', '5bffc38f9a84eed49028f839f74b5a388562d0f4');

-- --------------------------------------------------------

--
-- Table structure for table `voturi`
--

CREATE TABLE IF NOT EXISTS `voturi` (
`id` int(11) NOT NULL,
  `cnp` bigint(20) NOT NULL,
  `sesiune_vot` int(11) NOT NULL,
  `ip` text NOT NULL,
  `timp` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voturi`
--

INSERT INTO `voturi` (`id`, `cnp`, `sesiune_vot`, `ip`, `timp`) VALUES
(2, 1281212237740, 1, 'urna-123456', 1432324604);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidati_vot`
--
ALTER TABLE `candidati_vot`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hack_log`
--
ALTER TABLE `hack_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persoane`
--
ALTER TABLE `persoane`
 ADD PRIMARY KEY (`cnp`);

--
-- Indexes for table `primarii`
--
ALTER TABLE `primarii`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reclamatii`
--
ALTER TABLE `reclamatii`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesiuni_vot`
--
ALTER TABLE `sesiuni_vot`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setari`
--
ALTER TABLE `setari`
 ADD UNIQUE KEY `nume` (`nume`);

--
-- Indexes for table `voturi`
--
ALTER TABLE `voturi`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidati_vot`
--
ALTER TABLE `candidati_vot`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `error_log`
--
ALTER TABLE `error_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `hack_log`
--
ALTER TABLE `hack_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `primarii`
--
ALTER TABLE `primarii`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reclamatii`
--
ALTER TABLE `reclamatii`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sesiuni_vot`
--
ALTER TABLE `sesiuni_vot`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `voturi`
--
ALTER TABLE `voturi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
