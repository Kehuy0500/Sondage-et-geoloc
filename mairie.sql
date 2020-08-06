-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 02 août 2020 à 15:55
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `artisans`
--

CREATE TABLE `artisans` (
  `id_membre` int(11) NOT NULL,
  `siret` int(20) NOT NULL,
  `nomE` varchar(150) NOT NULL,
  `telE` int(15) NOT NULL,
  `adresseE` varchar(150) NOT NULL,
  `img` varchar(150) NOT NULL,
  `horaire` text NOT NULL,
  `role` enum('admin','modo','artisan','user') NOT NULL,
  `annonce` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artisans`
--

INSERT INTO `artisans` (`id_membre`, `siret`, `nomE`, `telE`, `adresseE`, `img`, `horaire`, `role`, `annonce`) VALUES
(9, 606060606, 'L\'étoile Polaire', 606060606, '55 rue du soleil, 7500, Paris', '', '', '', ''),
(13, 606060606, 'La Boulangerie d\'Acôté', 606060606, 'Rue de la lune, 75000, Paris', '', '', '', ''),
(22, 606060606, 'zrheheh', 606060606, 'gagrerggeg', '', '', '', ''),
(1, 606060606, 'gzrgg', 606060606, 'zgzgzr', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `id_forum` int(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `id_forum`, `nom`, `pseudo`, `date`, `msg`) VALUES
(1, 7, 'A', 'A', '0000-00-00 00:00:00', 'AAAAAAAAAAAAAAAAAAAAA'),
(2, 7, '', 'Admin1', '2020-07-27 15:19:40', 'Bonjour, j\'ai eu également le même problème...'),
(4, 7, '', 'Admin1', '2020-07-27 15:51:52', 'Bonjour, pour résoudre ce problème il faut tout simplement....'),
(5, 6, '', 'Admin1', '2020-07-27 15:52:36', 'Hello!'),
(6, 5, '', 'Admin1', '2020-07-27 15:53:49', 'こんにちわ !!');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `id_forum` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `status` int(4) NOT NULL,
  `heure` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`id_forum`, `id_membre`, `pseudo`, `categories`, `titre`, `msg`, `status`, `heure`) VALUES
(1, 0, '', 'amelioration', 'A', '', 3, '2020-07-03 16:10:15'),
(2, 1, '', 'construction', 'B', '', 0, '2020-07-03 16:10:15'),
(4, 3, '', 'general', 'D', '', 1, '2020-07-03 16:13:00'),
(5, 0, 'Admin1', 'ecologie', 'E', '', 1, '2020-07-03 16:34:57'),
(6, 0, 'Admin1', 'ecologie', 'F', '', 1, '2020-07-27 14:35:42'),
(7, 0, 'Admin1', 'general', 'G', 'ceci est un message de test', 1, '2020-07-27 14:51:40');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(150) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mdp` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `ville` varchar(150) NOT NULL,
  `cp` int(15) NOT NULL,
  `tel` int(15) NOT NULL,
  `civilite` enum('m','f','','') NOT NULL,
  `role` int(4) NOT NULL DEFAULT 0,
  `artisan` int(2) DEFAULT 0,
  `nomE` varchar(150) NOT NULL COMMENT 'Nom d''etablissement',
  `siret` varchar(50) NOT NULL,
  `telE` int(15) NOT NULL,
  `adresseE` varchar(150) NOT NULL,
  `siteweb` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `nom`, `prenom`, `mdp`, `email`, `adresse`, `ville`, `cp`, `tel`, `civilite`, `role`, `artisan`, `nomE`, `siret`, `telE`, `adresseE`, `siteweb`) VALUES
(1, 'Admin1', 'Joestar', 'Joseph', 'AdminMT', 'Joestar-joseph@testoutlook.fr', '55 rue du soleil', 'Paris', 75000, 0, 'm', 1, 0, '', '', 0, '', ''),
(2, 'Admin2', 'Von einzbern', 'Ilya', 'AdminMT', 'Ilyvon@outlooktest.com', '55 rue du soleil', 'Paris', 75000, 606060606, 'f', 1, 0, '', '', 0, '', ''),
(9, 'Modo1', 'C', 'C', 'Artisan', 'C@testOutlook.fr', '55 rue du soleil', 'Paris', 75000, 606060606, 'm', 2, 1, 'A', '0606060606', 606060606, '55 rue du soleil', 'EnfantduSoleil'),
(13, 'artisan2', 'D', 'D', 'Artisan', 'D@testOutlook.fr', '55 rue du soleil', 'Paris', 75000, 606060606, 'm', 3, 1, 'D', '0606060606', 606060606, '55 rue du soleil', 'EnfantduSoleil'),
(22, 'artisan', 'artisan', 'artisan', 'Artisan', 'artisan@test', '55 rue du soleil', 'Paris', 75000, 606060606, 'm', 3, 0, 'artisan', '0606060606', 606060606, '55 rue du soleil', 'EnfantduSoleil'),
(24, 'Modo2', 'A', 'A', 'Modo', 'A@outest', '55 Rue du soleil', 'Paris', 75000, 6060606, 'm', 2, 0, '', '', 0, '', ''),
(25, 'User1', 'B', 'B', 'User', 'B@outest', '55 Rue du soleil', 'Paris', 75000, 6060606, 'f', 0, 0, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'post.png',
  `date` datetime NOT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `writer`, `image`, `date`, `posted`) VALUES
(10, 'Le framework MaterializeCSS', 'Material Design\r\nCréé et conçu par Google, le Material Design est un langage de conception qui combine les principes classiques d\'un design réussi ainsi que l\'innovation et la technologie. Le but de Google et de développer une technique de conception pour une expérience utilisateur unifiée au travers de leurs produits sur n\'importe quelle plateforme.\r\n\r\nMaterial est la métaphore\r\nLa métaphore du Material Design définie la relation entre l\'espace et le mouvement. L\'idée est que la technologie est inspirée du papier et de l\'encre et est utilisée afin de faciliter la création et l\'innovation. Surfaces et bords fournissent des repères visuels familiers qui permettent aux utilisateurs de comprendre rapidement la technologie au-delà du monde physique.\r\n\r\nFranc, animé, voulu\r\nLes éléments et les composants tels que grilles, typographie, couleurs et médias ne sont pas seulement plaisants à voir, il créent aussi un sens de la hiérarchie, du sens et de l\'attention.\r\n\r\nLe mouvement donne du sens\r\nLe mouvement permet à l\'utilisateur de faire la parallèle entre ce qu\'il voit à l\'écran et la vie réelle. En fournissant à la fois un retour et de la familiarité, ceci permet à l\'utilisateur de s’immerger aisément dans une technologie nouvelle. Le mouvement est cohérent et continu en plus de donner à l\'utilisateur des informations supplémentaires sur les élements et trasnformations.', 'admin@localhost', '3.jpg', '2016-01-08 20:55:14', 1),
(11, 'Article avec image d\'un bureau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna eget iaculis sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mi nisi, aliquet non viverra eget, hendrerit eleifend enim. Praesent finibus tortor at scelerisque varius. Etiam malesuada eros lobortis neque ullamcorper, quis aliquet arcu ornare. Nam vulputate quam turpis, eget varius massa lacinia ut. Phasellus laoreet maximus consectetur. Nam pulvinar arcu massa, in aliquam diam tempus at. Ut ac quam cursus elit porttitor aliquam pharetra sed ligula. Nam eleifend eleifend erat, a congue nisi. Duis dapibus facilisis nulla, a gravida velit posuere vel. Suspendisse ac iaculis lacus. Integer ornare velit sapien, ac vulputate arcu ultricies nec. Suspendisse id felis sagittis, eleifend neque tempor, egestas ligula. Cras quis diam consectetur, pharetra justo facilisis, dictum ipsum. Suspendisse nec mauris a nibh iaculis convallis in sit amet justo.\r\n\r\nPhasellus purus nunc, pharetra at neque nec, semper placerat eros. Maecenas vel commodo nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ultrices mauris vel dapibus dignissim. Duis porttitor a augue at blandit. Nulla facilisi. Quisque iaculis, eros vitae egestas pulvinar, dolor sapien ultricies massa, eget imperdiet erat mi id dui. Pellentesque et pretium purus. Aenean lacinia turpis quis orci fringilla pellentesque. Praesent at dapibus justo, eget interdum nulla.\r\n\r\nPhasellus in sapien laoreet, ullamcorper orci vitae, congue erat. Donec nec pharetra mi, eu accumsan risus. Mauris vestibulum justo ultrices venenatis semper. Donec rhoncus, justo a ullamcorper tempus, leo felis varius ex, quis hendrerit velit purus et dui. Suspendisse sed nibh risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus eros elit, tempus id lacus sit amet, vulputate porta enim. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum commodo felis lacus, vel aliquet ligula ultricies sed.\r\n\r\nEtiam condimentum felis eu nisl vestibulum suscipit. In mollis sodales leo, vitae pretium odio faucibus vel. Nulla porttitor accumsan nunc, vitae ornare tortor dignissim ac. Etiam pretium, ipsum non ultrices pharetra, tellus arcu porta nulla, ut scelerisque nunc tortor vel ligula. Quisque mi diam, fringilla nec sapien gravida, viverra cursus libero. Proin tristique lobortis enim, vel blandit sem. Donec posuere est vitae nibh suscipit, ut porttitor sem malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris at mauris at turpis egestas egestas. Aenean congue ullamcorper dolor sed varius. Integer nec malesuada est. Integer viverra mattis orci, at aliquet enim dictum nec.', 'ma@locolhost.rt', '20.jpg', '2020-07-13 01:52:33', 1),
(12, 'article test', 'if(isset($_GET[\'action\']) &amp;&amp; $_GET[\'action\'] == &quot;deconnexion&quot;) Si l\'internaute clic sur le lien deconnexion, nous arriverons sur la page connexion.php avec l\'information suivante dans l\'url ?action=deconnexion. C\'est la raison pour laquelle nous utilisons la superglobale $_GET afin de detecter cette action et de déconnecter l\'internaute via session_destroy();.\r\nAu passage, nous en profitons pour améliorer l\'espace membre et dire que si l\'internaute est déjà connecté mais qu\'il tente d\'aller sur la page de connexion (volontairement ou involontairement), nous le renverrons automatiquement dans son espace de profil : header(&quot;location:profil.php&quot;);.\r\nCela parait logique, est-ce que vous voyez la page de connexion GMAIL alors que vous êtes connecté ? non, cela a été prévu dans le code...\r\nEt oui le code c\'est aussi ça, PENSER A TOUT ! le fonctionnel, les contrôles, la sécurité, traquer les éventuelles incohérences, la recherche, les tests, etc. On dit qu\'1 site est totalement terminé lorsque tous les cas sont prévus par le script ! Autant dire qu\'il y a beaucoup de sites qui ne sont pas terminés...\r\nVous pouvez faire des tests : Connectez vous et déconnectez vous ! accèdez au site en tant qu\'Admin, en tant que Membre, en tant que Visiteur. Tenter d\'aller sur la page de profil en étant seulement visiteur. Vous pouvez aussi tenter d\'aller sur la page de connexion en étant déjà connecté en tant que membre. Cela vous permettra de voir comment le site réagi.', 'ma@locolhost.rt', 'post.png', '2020-07-07 23:29:54', 1),
(13, 'voiture a vendre', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'ma@locolhost.rt', 'post.png', '2020-07-01 16:21:58', 1),
(14, 'velo  a vendre', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'ma@locolhost.rt', 'post.png', '2020-07-13 01:52:21', 1),
(24, 'bonjour', 'bla bla bla bla bla bla lbzl', 'ma@locolhost.rt', '24.jpg', '2020-07-13 01:52:07', 0),
(25, 'bonne nuit', 'blajkdhsoumbgdqbf biumdfvuoblfdd', 'ma@locolhost.rt', '25.jpg', '2020-07-12 17:50:44', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE `sondage` (
  `id_sondage` int(11) NOT NULL,
  `status` int(3) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `votes` int(255) NOT NULL,
  `oui` int(255) NOT NULL,
  `non` int(255) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sondage`
--

INSERT INTO `sondage` (`id_sondage`, `status`, `titre`, `votes`, `oui`, `non`, `date`) VALUES
(1, 2, 'A', 220, 122, 100, '2020-07-09 15:08:33.763078'),
(2, 2, 'B', 10, 0, 0, '2020-02-09 15:08:33.763078'),
(3, 2, 'C', 4, 0, 0, '2020-07-09 15:08:33.763078'),
(4, 2, 'D', 4, 0, 0, '2020-07-02 15:08:33.763078'),
(5, 2, 'E', 0, 0, 0, '2020-07-20 16:53:08.935861'),
(6, 2, 'F', 0, 0, 0, '2020-07-20 16:53:54.818925'),
(7, 2, 'G', 0, 0, 0, '2020-07-20 16:54:23.527509'),
(8, 2, 'H', 0, 0, 0, '2020-07-20 16:54:26.826007'),
(9, 1, 'L', 0, 0, 0, '2020-07-20 16:54:31.686748'),
(12, 0, 'K', 0, 0, 0, '2020-07-29 14:53:30.312365'),
(13, 0, 'I', 0, 0, 0, '2020-07-29 15:02:29.760400'),
(15, 0, 'J', 0, 0, 0, '2020-07-30 14:27:36.679687');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artisans`
--
ALTER TABLE `artisans`
  ADD KEY `artisans_ibfk_1` (`id_membre`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `IDForum` (`id_forum`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_forum`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo_2` (`pseudo`),
  ADD KEY `pseudo` (`pseudo`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD PRIMARY KEY (`id_sondage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `sondage`
--
ALTER TABLE `sondage`
  MODIFY `id_sondage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artisans`
--
ALTER TABLE `artisans`
  ADD CONSTRAINT `artisans_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id_forum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
