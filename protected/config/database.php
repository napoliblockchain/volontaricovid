<?php

// This is the database connection configuration.
// echo gethostname(); // may output e.g,: sandie
// exit;

$array_config_database = array(
	'emulatePrepare' => true,
	'charset' => 'utf8',
);

switch (gethostname()){
		case 'vmi256030.contaboserver.net': //napoliblockchain.it
		case 'blockchain1':					//napoliblockchain.tk
		case 'sergio-HP-255-G7-Notebook-PC': // NUOVO PC Ubuntu SERGIO
			$array_config_database['username'] = 'root';
			$array_config_database['connectionString'] = 'mysql:host=127.0.0.1;port=3306;dbname=';
			$array_config_database['password'] = '';
			break;

		default:
			$array_config_database['username'] = 'root';
			$array_config_database['connectionString'] = 'mysql:host=127.0.0.1;port=3306;dbname=npay';
			$array_config_database['password'] = '';

}

return $array_config_database;
