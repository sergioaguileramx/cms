<?php
	require_once 'core/init.php';

	$user = new user();

	if (!$user->isLoggedIn()) {
		redirect::to('index.php');
	}

	if (input::exists()) {
		if (token::check(input::get('token'))) {

			$validate = new validate();
			$validation = $validate->check($_POST, array(
				'password_current' => array(
						'required'=> true,
						'min'=> 6,
						'max'=>50
					),
				'password_new' => array(
						'required'=> true,
						'min'=> 6,
						'max'=>50
					),
				'password_new_again' => array(
						'min'=> 6,
						'max'=>50,
						'matches' => 'password_new'
					)
			));
			if ($validation->passed()){
				if (hash::make(input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
					echo "tu password es incorrecto";
				} else {
					$salt = hash::salt(32);
					$user->update(array(
						'password' => hash::make(input::get('password_new'), $salt),
						'salt' => $salt,
						));
					session::flash('home', 'El password a sido cambiado!');
					redirect::to('index.php');
				}
			} else {
				foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}	
			}
		}
	}

?>

<form action="" method="POST">
	<divc class='field'>
		<label for="password_current">current password</label>
		<input type="password" name="password_current" id="password_current">
	</div>

	<div class="field">
		<label for="password_new">New password</label>
		<input type="password" name="password_new" id="password_new">
	</div>

	<div class="field">
		<label for="password_new_again">Repeat new password:</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>

	<input type="submit" value="Change password">
	<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
</form>