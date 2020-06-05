

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `personnel` (
  `id_personel` int(11) NOT NULL,
  `pe_nomPrenom` varchar(45) NOT NULL,
  `pe_mail` text NOT NULL,
  `pe_telephone` int(10) NOT NULL,
  `pe_password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `personnel` (`id_personel`, `pe_nomPrenom`, `pe_mail`, `pe_telephone`, `pe_password`) VALUES
(1, 'roger', 'roger@gmail.com', 1265996, '1234');



CREATE TABLE `rdv` (
  `mail` varchar(45) NOT NULL,
  `dateLivraison` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `nomPrenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(10) NOT NULL,
  `adresse` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nbFoyer` tinyint(10) NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `idpublic` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `user` (`id`, `nomPrenom`, `mail`, `telephone`, `adresse`, `nbFoyer`, `password`, `idpublic`) VALUES
(1, 'Carvalho Yohan', 'yohan.carvalho.59@gmail.com', 785652322, '30 rue de Lesdain', 4, 'lohEA/LonJ.Qk', '5ebd54e35027c'),
(16, 'Basile briendo', 'basile@gmail.com', 2147483647, 'lille', 4, 'lotc7XJOUBcJI', '5ebd56c13b8d8');


ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id_personel`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

