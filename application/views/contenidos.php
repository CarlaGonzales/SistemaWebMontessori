<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Lista de contenidos</h1>
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
				<div class="card">
					<div class="card-header">
						<a class="btn btn-app" href="<?php echo base_url() ?>contenido/nuevo">
							<i class="fas fa-plus"></i> Nuevo
						</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Titulo</th>
									<th>Sub titulo</th>
									<th>Estado</th>
									<th>Dato Auditoria</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($contenidos)) { ?>
									<?php foreach ($contenidos as $contenido) { ?>
										<tr>
											<td><?= $contenido->TITULO ?></td>
											<td><?= $contenido->SUB_TITULO ?></td>
											<td>
												<?php if (isset($contenido->FECHA_PUBLICACION)) { ?>
													<b class="text-success">Publicado: <?= $contenido->FECHA_PUBLICACION ?></b>
													<a href="<?php echo base_url() ?>contenido/ocultar/<?php echo $contenido->ID_CONTENIDO; ?>"><span class="badge bg-warning"><i class="fas fa-tachometer-alt"></i> Ocultar</span></a>
												<?php } else { ?>
													<b class="text-danger">Sin publicar</b>
													<a href="<?php echo base_url() ?>contenido/publicar/<?php echo $contenido->ID_CONTENIDO; ?>"><span class="badge bg-primary"><i class="fas fa-tachometer-alt"></i> Publicar</span></a>
												<?php } ?>
											</td>
											<td>
												<?php $this->load->view('segmentos/auditoria', array('data' => $contenido)); ?>
											</td>
											<td>
												<a href="<?php echo base_url() ?>contenido/editar/<?php echo $contenido->ID_CONTENIDO; ?>"><span class="badge bg-success"><i class="fas fa-edit"></i> Editar</span></a>
												<a href="<?php echo base_url() ?>contenido/eliminar/<?php echo $contenido->ID_CONTENIDO; ?>"><span class="badge bg-danger"><i class="fas fa-trash-alt"></i>Eliminar</span< /a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Titulo</th>
									<th>Sub titulo</th>
									<th>Estado</th>
									<th>Dato Auditoria</th>
									<th>Acciones</th>
								</tr>
							</tfoot>
						</table>
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