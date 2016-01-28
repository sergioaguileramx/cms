<!-- 
	En este archivo se agrega un poco de seguridad al sistema
-->

<?php
	//HTMLentitites convierte los caracteres aplicacbles a entidades HTML
	//Esto significa que todos los caracteres que tienen su equivalente HTML 
	//son convertidos a estas entidades 
	function escape($string) {
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}