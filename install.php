#!/usr/bin/php
<?php

if ($argc < 3)
{
	echo "./install.php login password\n";
	exit();
}

/* AUTH */
$user = $argv[1];
$pwd = $argv[2];

file_put_contents(".credentials", "$user\n$pwd");
$link = mysqli_connect('127.0.0.1', $user, $pwd);

if (!$link)
	die('Erreur de connexion ('.mysqli_connect_errno().') '.mysqli_connect_error());

if (mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `nervous_aliens` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;"));
	echo "Creating database...\n";
if (mysqli_query($link, "USE `nervous_aliens`;"));
	echo "Selecting nervous_aliens DB...\n";

if (mysqli_query($link, "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;"));
	echo "Creating table users...\n";


echo "Install terminated !\n";

?>
