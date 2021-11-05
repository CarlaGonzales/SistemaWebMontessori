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
    .titulo,
    .contenido {
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
                    <!-- /.card-header -->
                    <div class="card-body" style="background-color: #d4f8d9;">
                        <div class="row">
                            <div class="col-9 contenido">
                                <?php if (isset($actividades)) { ?>
                                    <?php $bandera = true; ?>
                                    <?php foreach ($actividades as $actividad) { ?>
                                        <?php
                                        if ($bandera && !(isset($actividad->TERMINADO) && $actividad->TERMINADO > 0)) {
                                            $bandera = false;
                                            $style = '';
                                        } else {
                                            $style = 'style="display: none;"';
                                        }
                                        ?>
                                        <div class='descripcion' id="desc-<?= $actividad->ID_ACTIVIDAD ?>" <?= $style ?>>
                                            <?= $actividad->DESCRIPCION ?>
                                        </div>
                                        <?php unset($actividad->DESCRIPCION); ?>
                                        <div style="display: none;"><?= json_encode($actividad) ?></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-3">
                                <?php if (isset($actividades)) { ?>
                                    <?php foreach ($actividades as $actividad) { ?>
                                        <div class="titulo" id="<?= $actividad->ID_ACTIVIDAD ?>">
                                            <div class="row">
                                                <?= $actividad->TITULO ?>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-app bg-<?= (isset($actividad->TERMINADO) && $actividad->TERMINADO > 0) ? 'success' : 'primary' ?>" onclick="setIdTerminar(<?= $actividad->ID_ACTIVIDAD ?>)" data-toggle="modal" data-target="#terminarModal">
                                                        <i class="fas fa-<?= (isset($actividad->TERMINADO) && $actividad->TERMINADO > 0) ? 'check-square' : 'square' ?>"></i> <?= (isset($actividad->TERMINADO) && $actividad->TERMINADO > 0) ? 'Terminado' : 'Terminar' ?>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="btn btn-app bg-info" onclick="setIdSugerencia(<?= $actividad->ID_ACTIVIDAD ?>)" data-toggle="modal" data-target="#sugerenciaModal">
                                                        <i class="fas fa-comment"></i> Sugerencia
                                                    </a>
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
<div class="modal fade" id="terminarModal" tabindex="-1" role="dialog" aria-labelledby="terminarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="terminarModalLabel">Terminar actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_close" action"#">
                <div class="modal-body">
                    <input id="close_actividad" name="ID_ACTIVIDAD" type="hidden">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Ingrese un resumen de lo aprendido o aplicado sobre esta actividad</label>
                        <textarea class="form-control" name="DESCRIPCION_FIN" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="TERMINADO">Terminar actividad</label>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="TERMINADO" value="1">Si
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="TERMINADO" value="0">No
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sugerenciaModal" tabindex="-1" role="dialog" aria-labelledby="sugerenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sugerenciaModalLabel">Sugerencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_suregencia" action"#">
                <div class="modal-body">
                    <input id="sugerencia_actividad" name="ID_ACTIVIDAD" type="hidden">
                    <div class="form-group">
                        <textarea class="form-control" name="SUGERENCIA" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>