<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Contenidos publicados</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Contenidos</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="form-group row">
					<label for="PUBLICAR" class="col-sm-1 col-form-label">Areas</label>
					<div class="col-sm-11 select2-purple">
						<select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
							<option>Área vida Practica (0 - 6 meses)</option>
							<option>Área vida Practica (6 – 12 meses)</option>
							<option>Área vida Practica (1 - 3 años)</option>
							<option>Área vida Practica (3 – 5 años)</option>
							<option>Área Sensorial (0 - 6 meses)</option>
							<option>Área Sensorial (6 – 12 meses)</option>
							<option>Área Sensorial (1 - 3 años)</option>
							<option>Área Sensorial (3 – 5 años)</option>
							<option>Área Lenguaje (0 - 6 meses)</option>
							<option>Área Lenguaje (6 – 12 meses)</option>
							<option>Área Lenguaje (1 - 3 años)</option>
							<option>Área Lenguaje (3 – 5 años)</option>
							<option>Áreas matemáticas (0 - 6 meses)</option>
							<option>Áreas matemáticas (6 – 12 meses)</option>
							<option>Áreas matemáticas (1 - 3 años)</option>
							<option>Áreas matemáticas (3 – 5 años)</option>
							<option>Área de educación (0 - 6 meses)</option>
							<option>Área de educación (6 – 12 meses)</option>
							<option>Área de educación (1 - 3 años)</option>
							<option>Área de educación (3 – 5 años)</option>
						</select>
					</div>
				</div>
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<?php if (isset($contenidos)) { ?>
								<?php foreach ($contenidos as $contenido) { ?>
									<div class="col-md-12 col-lg-6 col-xl-4">
										<div class="card mb-2">
											<img class="card-img-top" height="250" src="<?php echo base_url(); ?>dist/img/Monte<?= random_int(1, 5) ?>.png" alt="<?= $contenido->TITULO ?>">
											<div class="card-img-overlay d-flex flex-column justify-content-center">
												<h5 style="color:black; border-radius: 5px; background: #ffc107; opacity: 0.5;" class="card-title  mt-5 pt-2"><?= $contenido->TITULO ?></h5>
												<p style="color:black; border-radius: 5px; background: #ffc107; opacity: 0.5;" class="card-text pb-2 pt-1 "><?= $contenido->SUB_TITULO ?></p>
												<a style="color:black; border-radius: 5px; background: #ffc107; opacity: 0.5;" class="" href="<?php echo base_url(); ?>contenido/numero/<?= $contenido->ID_CONTENIDO ?>" class="text-white">
													Publicado: <?= $contenido->FECHA_PUBLICACION ?><br/>
													Autor: <?= $contenido->NOMBRE ?> <?= $contenido->APELLIDO_PAT ?> <?= $contenido->APELLIDO_MAT ?>
												</a>
											</div>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</section>
<!-- /.content -->