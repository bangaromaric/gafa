<?php

 
define('HOST', 'localhost');
define('USER','root');
define('PASSWORD','');
define('BDD','voiture');
define('PORT','3306');

try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=voiture;charset=utf8', 'root', '',$pdo_options);
	//$bdd = new PDO ('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
catch(Exception $err)
{
	die('erreur ['.$err->getCode().'] '.$err->getMessage());
}


/*
	Nous allons utiliser PDO qui est une interface arrivée avec PHP 5 permettant de gérer toutes les opérations sur une base de données.
	L'avantage de PDO est qu'il permet d'écrire un code générique qui utilisera exactement les mêmes méthodes PHP quelque soit le SGBD (Système de Gestion
	de Base de Données) utilisé. Vous retrouverez la documentation associée ici : http://php.net/manual/en/book.pdo.php
	
	
	Table users
CREATE TABLE IF NOT EXISTS `users` (
`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
`login` varchar(150) NOT NULL,
`pass` varchar(50) NOT NULL,
`mail` varchar(150) NOT NULL,
`token` varchar(50) NOT NULL,
`token_date` datetime NOT NULL,
`valid` tinyint(1) NOT NULL DEFAULT ’1',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

<pre>

[id]
Comme au-dessus.

[login]
Comme au-dessus.

[pass]
Cryptage sha1 du mot de passe.

[mail]
Utile pour récupérer le mot de passe en cas de perte.

[token]
Utile pour enregistrer le token de connection

[token_date ]
Utile pour enregistrer la date du token de connection


[valid]
Comme au-dessus.
*/

?>
