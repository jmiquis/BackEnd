<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda de Camisetas</title>
		<link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
		<script type="text/javascript" src="<?=base_url?>assets/javascript/deleteUser.js"></script>
		<script type="text/javascript" src="<?=base_url?>assets/javascript/deleteCategory.js"></script>
		
	</head>
	<body>
		<div id="container">
			<!-- CABECERA -->
			<header id="header">
				<div id="logo">
					<img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo" />
					<a href="<?=base_url?>">
						Tienda de camisetas
					</a>
				</div>
			</header>

			<!-- MENU -->
			<?php $categorias = Utils::showCategorias(); ?>
			<nav id="menu">
				<ul>
					<li>
						<a href="<?=base_url?>">Inicio</a>
					</li>
					<?php while($cat = $categorias->fetch_object()): ?>
						<li>
							<a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
						</li>
					<?php endwhile; ?>
					<li>
					<a href="<?=base_url?>categoria/showBargains">Ofertas<a>
					</li>
				</ul>
			</nav>

			<div id="content">