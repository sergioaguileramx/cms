
<?php
	class Config {
		public static function get($path = null){
			if ($path) {
				$config = $GLOBALS['config'];
				$path = explode('/', $path);

				//print_r($path);
				foreach ($path as $bit) {
					//echo $bit, ' ';
					if (isset($config[$bit])) {
						$config = $config[$bit];
					}
				}

				return $config;
			}
			return false;
		}
	}

/**
	esto es para utilizar las variables en init.php
	podriamos utilizarlas de la sigueinte manera, si qquisieramos 
	llamar la variable Host del arreglo POSTGRESQL del arreglo GLOBALS
	$GLOBALS['config']['postgresql']['host'];
	sin embargo seria utlizar mucho codigo cada vez que quisieramos
	mandar llamar una variable por eso contaremos con la siguiente funcion;
	con la cual mandaremos llamar la clase config e imprimiremos el valor requerido
	Una manera de llamar esos valores seria utilizando la siguiente linea
	echo Config::get('postgresql/host');

**/