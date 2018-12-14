<?php
$mensaje="";
if (isset($_GET['mensaje'])){
	$mensaje=strip_tags(trim($_GET['mensaje']));
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Login</title>
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
Login
</header>
<section>
<article>
<span style="color: red;font-weight:bold;"><?=$mensaje?></span><br/><br/>
<!-- Formulario de inicio de sesión-->
<form action="validar.php" method="post">
<table>
<caption>Identificación</caption>
<tr>
	<td>Usuario:</td>
	<td><input type="text" name="usuario" size="20" maxlength="20" /></td>
</tr>
<tr>
	<td>Contraseña: </td>
	<td><input type="password" name="clave" size="20" maxlength="20" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="Validar" />
</tr>
</table>
</form>
</article>
</section>
</body>
</html>