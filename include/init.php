<?php 
//------ CONNEXION BDD
$bdd = new PDO('mysql:host=localhost;dbname=mairie', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//------ SESSION
session_start();

//------ CONSTANTE (chemin)
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . '/PHP/Stage-Mairie-master/');
// Cette constante retourne le chemin physique du dossier 10-boutique sur le serveur
// Lors de l'enregistrement d'image / photos, nous aurons besoin du chemin complet vers le dossier photo pour enregistrer la photo

// $_SERVER['DOCUMENT_ROOT'] --> C:/xampp/htdocs (chemin physique vers le dossier htdocs sur le serveur)
// echo RACINE_SITE . '<hr>';

define("URL", 'http://localhost/PHP/Stage-Mairie-master/');
// Cette constante servira par exemple à enregistrer l'URL d'une photo / image dans la BDD, on ne peut pas conserver la photo elle même dans la BDD

//------ FAILLES XSS
foreach($_POST as $key => $value)
{
    $_POST[$key] = strip_tags(trim($value));
}

//------ INCLUSION
require_once('fonction.php');
?>

<script src="js/script.js"></script>
