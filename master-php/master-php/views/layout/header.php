<?php ob_start();?>
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda de Camisetas</title>

		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script type="text/javascript" src="<?=base_url?>assets/javascript/deleteUser.js"></script>
		<script type="text/javascript" src="<?=base_url?>assets/javascript/deleteCategoryJS.js"></script>
		<link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>
		<link rel="stylesheet" href="<?=base_url?>assets/css/estilos.css"/>


	</head>
		<body>
			<div id="container">

				<!-- CABECERA -->
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<div class="container-fluid">
						<a class="navbar-brand" href="<?=base_url?>">
						<img src="<?=base_url?>assets/img/camiseta.png" alt="logo" width="100" height="100" class="d-inline-block align-text-top">
						tienda de Camisetas
						</a>
					</div>
				</nav>

				<!-- MENU -->

				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="container-fluid">

						<a class="navbar-brand" href="<?=base_url?>">Inicio</a>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">

								<?php $categorias = Utils::showCategorias(); ?>

									<?php while($cat = $categorias->fetch_object()): ?>
										<li class = "nav-item">
											<a class="nav-link" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
										</li>
									<?php endwhile; ?>

									<li class = "nav-item">
										<a class="nav-link" href="<?=base_url?>categoria/showBargains">Ofertas<a>
									</li>
							</ul>
						</div>
				</nav>

		<?php require_once ("assets\carouselIndex\carouselIndex.php"); ?>