<?php
$params['app']->doInclude('/vistas/helpers/plantilla.php');
$mensajes = mensajesPeticionAnterior();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $params['tituloPagina'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= $params['app']->resuelve('/css/estilo.css') ?>" >
	<?php if($params['css'] != null) { ?>
		<link rel="stylesheet" type="text/css" href="css/<?= $params['css'] ?>" >
	<?php } ?>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<?= $mensajes ?>
<div id="contenedor">
<?php
$params['app']->doInclude('/vistas/comun/cabecera.php');
$params['app']->doInclude('/vistas/comun/menu.php');
?>
	<main>
			<?= $params['contenidoPrincipal'] ?>
	</main>
<?php
$params['app']->doInclude('/vistas/comun/pie.php');
?>
</div>
</body>
</html>
