<?php
	require_once 'core/init.php';

	if(!$username = input::get('user')) {
		redirect::to('index.php');
	} else {
		$user = new user($username);
		if(!$user->exists()){
			redirect::to(404);
		} else {
			$data = $user->data();
		}
?>
		<h3><?php echo escape($data->username); ?></h3>
		<p>Nombre: <?php echo escape($data->nombre); ?></p>
<?php
}