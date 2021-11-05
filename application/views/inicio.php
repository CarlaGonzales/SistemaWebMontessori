<link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Inicio</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">DataTables</li>
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
				<style>
					.fotorama {
						width: 800px;
						margin: auto;
					}

					.fotorama .any {
						text-shadow: 0 1px 0 rgba(255, 255, 255, .5);
						font-family: Georgia, serif;
						font-size: 1.5em;
						/* Tamaño de fuente */
						text-align: center;
						height: 100%;
						box-sizing: border-box;
						padding-top: 50px;
						line-height: normal;
					}

					.fotorama .inverse {
						color: green;
						/* Color de fuente */
						text-shadow: 0 1px 0 #000;
						/* Formato sombra fuente */
					}
				</style>
				<div class="card">
					<div class="card-header">
						<h2 class="text-success">Sistema web basado en el metodo Montessori para padres primerizos </h2>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="fotorama" data-width="800" data-height="500">
							<div data-img="<?php echo base_url(); ?>dist/img/Monte1.png" class="any inverse">
							Los niños aprenden de lo que les rodea
							</div>
							<div data-img="<?php echo base_url(); ?>dist/img/Monte2.png" class="any inverse">No hables mal de tu niño/a</div>
							<div data-img="<?php echo base_url(); ?>dist/img/Monte1.png" class="any inverse">Si criticas mucho a un niño, aprenderá a juzgar.</div>
							<div data-img="<?php echo base_url(); ?>dist/img/Monte4.png" class="any inverse">
							Si se le ridiculiza con frecuencia será una persona tímida
							</div>
							<div data-img="<?php echo base_url(); ?>dist/img/Monte5.png" class="any inverse">Ayuda al niño a asimilar lo que antes no había podido asimilar</div>
							<div data-img="<?php echo base_url(); ?>dist/img/Inicio.jpg" class="any inverse">No forzar al niño en su aprendizaje evolutivo, la clave es acompaña</div>
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