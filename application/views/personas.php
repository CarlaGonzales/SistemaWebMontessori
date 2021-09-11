<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Lista de Personas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Personas</li>
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
						<a class="btn btn-app" href="<?php echo base_url() ?>personas/nuevo">
							<i class="fas fa-plus"></i> Nuevo
						</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nombre(s) Apellido(s)</th>
									<!--<th>Fecha Nacimiento</th>-->
									<th>Direccion</th>
									<th>Celular</th>
									<th>Correo</th>
									<th>Rol</th>
									<th>Dato Auditoria</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($personas as $persona) { ?>
									<tr>
										<td><?= $persona->NOMBRE ?> <?= $persona->APELLIDO_PAT ?> <?= $persona->APELLIDO_MAT ?></td>
										<!--<td><?= $persona->FECHA_NAC ?></td>-->
										<td><?= $persona->DIRECCION ?></td>
										<td><?= $persona->CELULAR ?></td>
										<td><?= $persona->CORREO ?> <?= isset($persona->ID_USUARIO) ? '<i class="fas fa-user"></i>' : '' ?> </td>
										<td><?= $persona->ROL ?></td>
										<td>
											<?php $this->load->view('segmentos/auditoria', array('data' => $persona)); ?>
										</td>
										<td>
											<?php if (!isset($persona->ID_USUARIO)) { ?>
												<a href="<?php echo base_url() ?>usuarios/habilitar/<?php echo $persona->ID_PERSONA; ?>"><span class="badge bg-primary"><i class="fas fa-user"></i> habilitar</span></a>
											<?php } else { ?>
												<a href="<?php echo base_url() ?>usuarios/deshabilitar/<?php echo $persona->ID_USUARIO; ?>"><span class="badge bg-warning"><i class="fas fa-user"></i> deshabilitar</span></a>
											<?php } ?>
											<a href="<?php echo base_url() ?>personas/editar/<?php echo $persona->ID_PERSONA; ?>"><span class="badge bg-success"><i class="fas fa-edit"></i> Editar</span></a>
											<a href="<?php echo base_url() ?>personas/eliminar/<?php echo $persona->ID_PERSONA; ?>"><span class="badge bg-danger"><i class="fas fa-trash-alt"></i>Eliminar</span< /a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Nombre(s) Apellido(s)</th>
									<!--<th>Fecha Nacimiento</th>-->
									<th>Direccion</th>
									<th>Celular</th>
									<th>Correo</th>
									<th>Rol</th>
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