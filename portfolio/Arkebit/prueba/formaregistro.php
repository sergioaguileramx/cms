<?php

	require_once 'core/init.php';

	if(input::exists()) {
		if(token::check(input::get('token'))) {
			$validate = new validate();
			$validation = $validate->check($_POST, array(
				'name' => array(
						'required'=> true,
						'min'=> 4,
						'max'=>50
					),
				'ap_pa' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>30
					),
				'ap_ma' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>30
					),
				'username' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>30,
						'unique'=> 'catalogos.participante'
					),
				'email' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>50
					),
				'age' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>10
					),
				'city' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>30
					),
				'state'	=> array(
						'required'=> true,
						'min'=> 2,
						'max'=>30
					),
				'country' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>20
					),
				'company' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>60
					),
				'job' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>50
					),
				'difusion' => array(
						'required'=> true,
						'min'=> 2,
						'max'=>50
					),
				'password' => array(
						'required'=> true,
						'min'=> 6
					),
				'password_again' => array(
						'required'=> true,
						'matches' => 'password'
					)
			));

			if($validation->passed()){
				//register user
				$user = new user();
				$salt = hash::salt(32);
				try {
					$user->create(array(
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
					session::flash('home', 'Bienvenido, te has registrado correctamente, ahora puedes iniciar sesion!');
					redirect::to('index.php');
				} catch(Exception $e){
					die($e->getMessage());
				}
			} else {
				//output errors
				foreach ($validation->errors() as $error){
					echo $error, "</br>";

				}
			}
		}
	}

?>

<form action='' method="post">

		<div class="registration_field">
		<label for="name">Nombre: </label>
		<input type="text" name="name" id="name" value="<?php echo escape(input::get('name')); ?>" autocomplete="off">
		</div>

		<div class="registration_field">
		<label for="ap_pa">Apellido Paterno: </label>
		<input type="text" name="ap_pa" id="ap_pa" autocomplete="off" value="<?php echo escape(input::get('ap_pa')); ?>">
		</div>

		<div class="registration_field">
		<label for="ap_ma">Apelido Materno: </label>
		<input type="text" name="ap_ma" id="ap_ma" autocomplete="off" value="<?php echo escape(input::get('ap_ma')); ?>">
		</div>

		<div class="registration_field" >
		<label for="username">Nombre de usuario: </label>
		<input type="text" name="username" id="username" autocomplete="on" value="<?php echo escape(input::get('username')); ?>">
		</div>

		<div class="registration_field" >
		<label for="email">Email: </label>
		<input type="email" name="email" id="email" value="<?php echo escape(input::get('email')); ?>">
		</div>

		<div class="registration_field" >
		<label for="age">Edad: </label>
		<input type="number" name="age" id="age" value="<?php echo escape(input::get('age')); ?>">
		</div>

		<div class="registration_field" >
		<label for="city">Ciudad: </label>
		<input type="text" name="city" id="city" value="<?php echo escape(input::get('city')); ?>">
		</div>

		<div class="registration_field" >
		<label for="state">Estado: </label>
		<input type="text" name="state" id="state" value="<?php echo escape(input::get('state')); ?>">
		</div>

		<div class="registration_field" >
		<label for="country">Pais: </label>
		<input type="text" name="country" id="country" value="<?php echo escape(input::get('country')); ?>">
		</div>

		<div class="registration_field" >
		<label for="company">Escuela o empresa: </label>
		<input type="text" name="company" id="company" value="<?php echo escape(input::get('company')); ?>">
		</div>

		<div class="registration_field" >
		<label for="job">Giro: </label>
		<input type="text" name="job" id="job" value="<?php echo escape(input::get('job')); ?>">
		</div>

		<div class="registration_field" >
		<label for="difusion">Como se entero? </label>
		<input type="text" name="difusion" id="difusion" value="<?php echo escape(input::get('difusion')); ?>">
		</div>

		<div class="registration_field" >
		<label for="password">Password: </label>
		<input type="password" name="password" id="password">
		</div>

		<div class="registration_field" >
		<label for="password_again">Confirme password: </label>
		<input type="password" name="password_again" id="password_again">
		</div>

		<input type="hidden" name="token" value="<?php echo token::generate(); ?>">

		<input type="submit" value="Register">
	</form>