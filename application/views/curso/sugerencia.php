<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Cursos publicados</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cursos</li>
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
						<select class="selectSearch" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
							<?php foreach ($area_categoria as $ar) { ?>
								<?php if (isset($filtro)) {
									$bandera = false; ?>
									<?php foreach ($filtro as $idAC) { ?>
										<?php if ($idAC == $ar->ID_CATDIM) { ?>
											<option value="<?= $ar->ID_CATDIM ?>" selected><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
										<?php
											$bandera = true;
											break;
										} ?>
									<?php } ?>
									<?php if (!$bandera) { ?>
										<option value="<?= $ar->ID_CATDIM ?>"><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
									<?php } ?>
								<?php } else { ?>
									<option value="<?= $ar->ID_CATDIM ?>"><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<?php if (isset($cursos)) { ?>
								<?php foreach ($cursos as $curso) { ?>
									<div class="col-md-12 col-lg-6 col-xl-4">
										<div class="card mb-2">
											<?php
											$entrada = $imagenes[$curso->ID_AREA . ''];
											$claves_aleatorias = array_rand($entrada, 1);
											?>
											<img class="card-img-top" height="250" src="<?php echo base_url(); ?>/img/areas/<?= $curso->ID_AREA ?>/<?= $entrada[$claves_aleatorias] ?>" alt="<?= $curso->TITULO ?>">
											<div class="card-img-overlay d-flex flex-column justify-content-center">
												<h5 style="font-size:1.5em; font-weight: bold; color:black; border-radius: 5px; background: #d7dddd; opacity: 0.5;" class="card-title  mt-5 pt-2"><?= $curso->TITULO ?></h5>
												<p style="font-weight: bold; color:black; border-radius: 5px; background: #d7dddd; opacity: 0.5;" class="card-text pb-2 pt-1 "><?= $curso->SUB_TITULO ?></p>
												<div style="font-weight: bold; color:black; border-radius: 5px; background: #d7dddd; opacity: 0.5;">
													Publicado: <?= $curso->FECHA_PUBLICACION ?><br />
													Autor: <?= $curso->NOMBRE ?> <?= $curso->APELLIDO_PAT ?> <?= $curso->APELLIDO_MAT ?>
												</div>
												<div class="row">
													<div class="col-md-5">
														<a href="<?php echo base_url(); ?>curso/inscribirse/<?= $curso->ID_CURSO ?>" class="btn btn-block btn-success">Inscribirse</a>
													</div>
												</div>
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