<?php
		include_once '/core/init.php';
/** $salt = hash::salt(32);
	print_r($salt);


	$usercreate = db::getInstance()->insert('catalogos.participante', array(
						'nombre' => input::get('name'),
						'apellidopaterno' => input::get('ap_pa'),
						'apellidomaterno' => input::get('ap_ma'),
						'email' => input::get('email'),
						'ciudad' => input::get('city'),
						'estado' => input::get('state'),
						'pais' => input::get('country'),
						'edad' => input::get('age'),
						'password' => hash::make(input::get('password'), $salt),
						'salt' => $salt,
						'difusion' => input::get('difusion'),
						'company' => input::get('company'),
						'giro' => input::get('job'),
						'joined' => date('Y-m-d H:i:s'),
						'grupo' => 1,
						'username' => input::get('username')
						));

	if ($usercreate) {
		echo "registrado";
	} else {
		echo "vuelva a intentar";
	}	**/

	echo "prueba";
