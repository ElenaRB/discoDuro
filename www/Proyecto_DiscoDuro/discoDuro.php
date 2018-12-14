<?php
	require_once("./../../seguridad/ficheros/ficherosbd.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>Subida de ficheros</title>
<style type="text/css">
body {
	font-family: verdana;
}
header {
		padding: 20px;
		font-size: 2em;
		font-weight: bold;
		background-color: red;
		color: white;
		margin-bottom: 15px;
	}
article {
	width: 80%;
	margin: 0 auto;
	text-align: justify;
}
table {
	border-collapse: collapse;
	margin: 0 auto;
}
tr:nth-child(even){
	background-color: #cacaca;
}
th {
	background-color: green;
	color: white;
}
th, td {
	padding: 10px;
}
.arriba {
	border-top: 1px solid black;
}
.enlaceboton {
	text-decoration:none;
	color: white;
	border: 1px solid black;
	padding:5px;
	background-color: black;
}
.enlace {
	border: 3px solid black;
	margin-right: 5px;
}

#footer {
   position:fixed;
   left:0px;
   bottom:0px;
   height:30px;
   width:100%;
   background:#999;
   font-size: .8em;
   font-weight: bold;
   color: white;
}
.nada {
	font-size: .5em;
}
caption {
	background-color: green;
	color: white;
	font-weight: bold;
}

</style>

</head>
<body>
<header>
UPLOAD
<div id="id">Usuario:
    <?=$usuario?> <a href='cerrar.php' class='enlaceboton'>Cerrar Sesión</a></div>
</header>
<section>
<article>
<?php
if(isset($_GET['mensaje'])){
	echo "<span style='color:red;'>".$_GET['mensaje']."</span>";
}
?>
</article>
<article>
<?php 
	$canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
	if (!$canal){
		echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error()."<br />";
	exit;
	}
	mysqli_set_charset($canal,"utf8");

	$sql="select id, nombre, tamanyo, tipo, usuario from ficheros order by nombre";
	$consulta=mysqli_prepare($canal,$sql);
	if (!$consulta){
		echo "Ha ocurrido el error: ".mysqli_errno($canal)." ".mysqli_error($canal)."<br />";
	exit;	
	}
	

	mysqli_stmt_execute($consulta);
	mysqli_stmt_bind_result($consulta, $id, $nombre,$tamanyo, $tipo, $usuario);
	echo"<table><caption>Fitxers</caption>";
	while(mysqli_stmt_fetch($consulta)){
		echo "<tr>";
		echo "<td>$nombre</td><td>$tamanyo</td>";
		?>
		<td>
		<form action="borrar.php" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="submit" value="Borrar" />
		</form>
		</td>
		<td>
		<form action="descargar.php" method="post">
			<input type="hidden" name="id" value="<?=$id?>" />
			<input type="submit" value="Descargar" />
		</form>
		</td>
		<?php
		echo "</tr>";
	}
	echo"</table>";
	mysqli_stmt_close($consulta);
	unset($consulta);
?>
</article>

<article>

<hr style="width: 100%;" />
<form enctype="multipart/form-data" action="subir.php" method="post">
<table>
<caption>Carga de ficheros</caption>
<tr>
	<td>Fichero(s):<input type="hidden" name="MAX_FILE_SIZE" value="2500000" /></td>
	<td><input type="file" name="ficheros[]" multiple="multiple" /></td>
	<td></td>
</tr>

<tr>
<td colspan="2"><input type="submit" value="Subir" />
</tr>
</table>
</form>
</article>
</section>
</body>
</html>