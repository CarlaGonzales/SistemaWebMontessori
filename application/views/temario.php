<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>CURSO: <?= $curso->TITULO ?><a href="<?php echo base_url() ?>curso/miscursos" class="btn btn-default float-right">Regresar a mis Cursos</a></h5>
                <h1>Lista de actividades</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Actividades</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<style>
    .titulo {
        border: 1px solid #000000;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        padding: 10px;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <?php if (isset($actividades)) { ?>
                                    <?php foreach ($actividades as $actividad) { ?>
                                        <div class='descripcion' id="desc-<?= $actividad->ID_ACTIVIDAD ?>" style="display: none;"><?= $actividad->DESCRIPCION ?></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-3">
                                <?php if (isset($actividades)) { ?>
                                    <?php foreach ($actividades as $actividad) { ?>
                                        <div class="titulo" id="<?= $actividad->ID_ACTIVIDAD ?>" style="border:solid black solid;">
                                            <?= $actividad->TITULO ?>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch" data-toggle="modal" data-target="#exampleModal">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label" for="customSwitch1">terminar</label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ingrese un resumen de lo aprendido o aplicado sobre estas actividad</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Sugiere camios en la actividad?</label>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Sugerencia</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>