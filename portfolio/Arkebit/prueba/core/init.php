<?php
	//Arreglos para la configuracion de las conexiones
	//ej para llamar un valor de globals
	//echo Config::get('postgresql/host');
	session_start();

	$GLOBALS['config'] = array(
		'postgresql' => array(
			'host' => 'localhost',
			'username' => 'rock',
			'password' => 'holaarkebit',
			'db' => 'prueba',
			'port' => '5432'
			),
		'remember' => array(
			'cookie_name' => 'hash',
			'cookie_expiry' => 604800
			),
		'session' => array(
			'session_name' => 'user',
			'token_name' => 'token'
			)
		);

	//Agregar las clases
	//podria agregarce una a una con require_once, pero usaremos una funcion
	//con la cual se podra agregar todas las clases
	spl_autoload_register(function($class) {
		require_once 'classes/' . $class . '.php';
	});

	require_once 'functions/sanitize.php';
	
	if (cookie::exists(config::get('remember/cookie_name')) && !session::exists(config::get('session/session_name'))){
		$hash = cookie::get(config::get('remember/cookie_name'));
		$hashCheck = db::getInstance()->get('catalogos.userssession', array('hash', '=', $hash));

		if ($hashCheck->count()) {
			$user = new user($hashCheck->first()->user_id);
			$user->login();
		}
	}
