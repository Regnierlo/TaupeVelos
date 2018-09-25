<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$connect = mysql_connect('localhost', 'root') or die ('erreur de connexion');

mysql_select_db('BOUTIQUE', $connect) or die ('erreur de connexion base');

?>
