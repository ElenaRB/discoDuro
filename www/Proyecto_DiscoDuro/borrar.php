<?php
require_once("./../seguridad/ficherosbd.php");
if (!isset($_POST['codigo'])){
	header("Location: formularioSubida.php");
	exit;
}
	$id=$_POST['codigo'];
	$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
	if (!$canal){
		echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
	exit;
	}
	mysqli_set_charset($canal,"utf8");

	
	if (unlink(__ALMACEN__.$id)){
		$sql="delete from ficheros where id=?";
		$consulta=mysqli_prepare($canal,$sql);
		if (!$consulta){
			echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
			exit;
		}
		mysqli_stmt_bind_param($consulta,"s",$codigo1);
		$codigo1=$codigo;
		mysqli_stmt_execute($consulta);
		
	}else { die("mal");}
	mysqli_stmt_close($close);
	mysqli_close($canal);
	header("Location:formularioSubida.php?mensaje=".urlencode("fichero borrado"));
	exit;
?>