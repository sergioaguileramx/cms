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
				'name' => array(
						'required'=> true,
						'min'=> 4,
						'max'=>50
					)
			));
			if ($validation->passed()){

				try {
					$user->update(array(
						'nombre' => input::get('name')
					));
					session::flash('home', 'Tu perfil ha sido actualizado');
					redirect::to('index.php');
				} catch (Exception $e) {
					die($e->getMessage());
				}
			} else {
				foreach ($validation->errors() as $error) {
						echo $error, "<br>";
					}	
			}
		}
	}

?>

	<form action="" method="post">
		<div class="field">
			<label for="name">Name:</label>
			<input type="text" name="name" value="<?php echo escape($user->data()->nombre); ?>">

			<input type="submit" value="Update">
			<input type="hidden" name="token" value="<?php echo token::generate(); ?>">
		</div>
	</form>