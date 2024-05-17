SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `portfolio_admin` (`id`, `username`, `password`) VALUES
(1, 'Happy', '$2y$10$sJ3xoCEiL1QRCXYUpC.mB.I90eIV1VeOJmuvtI0Ey6tkaFChbZoSG'),
(7, 'LilwenGo', '$2y$10$sdiw.uRnzzYmHuvoFBcbS.TFn/CzkQ1EfEM8EnWaYAvaq.Qxv13Tq');

INSERT INTO `portfolio_techno` (`id`, `techno_name`) VALUES
(1, 'JavaScript'),
(2, 'PHP'),
(3, 'C'),
(4, 'HTML'),
(5, 'CSS'),
(6, 'SCSS'),
(7, 'Laravel'),
(8, 'SQL'),
(9, 'MySQL');

COMMIT;