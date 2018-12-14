<?php
function inicioSesion(){
	session_name("SESION");
	session_cache_limiter('nocache');
	session_start();
}


//Con esta función se comprueba si el usuario está validado (Viene desde validar.php)
function validado(&$usuario, &$cuota){
	$validado=false;
	if (isset($_SESSION['validado']) && $_SESSION['validado']){
		$validado=true;
        $usuario=$_SESSION['usuario'];
        $cuota =$_SESSION['cuota'];
	}
	return $validado;
}

?>
