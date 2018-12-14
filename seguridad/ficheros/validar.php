<?php
//Recibimos del formulario de iniciar la sesión el usuario y la clave
$usuario="";
if (!isset($_POST['usuario'])){
	header("Location: login.php");
	exit;
}
$usuario=strip_tags(trim($_POST['usuario']));
$clave="";
if (!isset($_POST['clave'])){
	header("Location: login.php");
	exit;
}
$clave=strip_tags(trim($_POST['clave']));

if (empty($usuario) || strlen($usuario)>20 || empty($clave) || strlen($clave)>20){
	header("Location: login.php?mensaje=".urlencode("Usuario inexistente o clave no reconocida"));
	exit;
}

//Crear canal y mostrar mensaje de error en caso de no realizarse correctamente
$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
if (!$canal){
	echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
exit;
}
mysqli_set_charset($canal,"utf8");


$sql="select usuario, clave, couta from usuarios where usuario=?";
//Se prepara la consulta
$consulta=mysqli_prepare($canal,$sql);
if (!$consulta){
	echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
exit;	
}
mysqli_stmt_bind_param($consulta,"s",$uusuario);
	
$uusuario=$usuario;

mysqli_stmt_execute($consulta);
mysqli_stmt_bind_result($consulta, $uusuario, $cclave, $ccuota);
mysqli_stmt_fetch($consulta);
    
//se verifican las claves (La introducida y la recibida gracias a la consulta), si no son iguales se muestra el mensaje de contraseña incorrecta
if (!password_verify($clave, $cclave)) {
    header("Location:login.php?mensaje=".urlencode("Contraseña incorrecta"));
    exit;
}

//Se inicia sesión
session_name("SESION");
session_cache_limiter('nocache');
session_start();

//Datos básicos del usuario (secretos) -->Pasan a validar.php para poner a true la validación
$_SESSION['validado']=true;
$_SESSION['usuario']=$usuario;
$_SESSION['cuota']=$ccuota;		

//Cierre de la consulta
mysqli_stmt_close($consulta);
unset($consulta);
mysqli_close($canal);
?>