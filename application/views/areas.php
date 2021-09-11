<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Lista de areas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Areas</li>
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
						<a class="btn btn-app" href="<?php echo base_url() ?>area/nuevo">
							<i class="fas fa-plus"></i> Nuevo
						</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Dato Auditoria</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($areas)) { ?>
									<?php foreach ($areas as $area) { ?>
										<tr>
											<td><?= $area->NOMBRE ?></td>
											<td>
												<?php $this->load->view('segmentos/auditoria', array('data' => $area)); ?>
											</td>
											<td>
												<a href="<?php echo base_url() ?>area/editar/<?php echo $area->ID_AREA; ?>"><span class="badge bg-success"><i class="fas fa-edit"></i> Editar</span></a>
												<a href="<?php echo base_url() ?>area/eliminar/<?php echo $area->ID_AREA; ?>"><span class="badge bg-danger"><i class="fas fa-trash-alt"></i>Eliminar</span< /a>
											</td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Nombre</th>
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