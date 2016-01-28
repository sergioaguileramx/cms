<html>
<head></head>
<body>
<header>
	<h1>Hola Arkebit</h1>
</header>
<div id="container-login">
<?php 
	require_once '/core/init.php';

	echo 'hola';

	if(session::exists('home')){
		echo "<p>" . session::flash('home') . "</p>";
	}
	$user = new user();
	if($user->isLoggedIn()) {
	?>
		<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>
		<ul>
			<li><a href="logout.php">Log out</a></li>
			<li><a href="update.php">Update Details</a></li>
			<li><a href="changepassword.php">change Password</a></li>
		</ul>
	<?php
		if($user->hasPermission('admin')){
			echo '<p>Administrador</p>';
		}	
	} else {
		echo "<p>Te invitamos a <a href='register.php'>registrarte </a> o <a  href='login.php'>inicia sesion</a></p>";
	}
?>
</div>
</body>
</html>
