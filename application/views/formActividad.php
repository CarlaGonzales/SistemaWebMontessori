<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Datos de actividad</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="<?php echo ($isPost) ? 'post' : 'get' ?>" action="<?php echo base_url(); ?>actividad/<?php echo $action; ?>">
        <div class="card-body">
            <div class="form-group row">
                <label for="CURSO" class="col-sm-2 col-form-label">Curso</label>
                <div class="col-sm-10">
                    <div><?= $curso->TITULO ?></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="TITULO" class="col-sm-2 col-form-label">Nombre Actividad</label>
                <div class="col-sm-10">
                    <input type="text" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="TITULO" name="TITULO" value="<?php echo isset($actividad) ? $actividad->TITULO : ""; ?>" required placeholder="Ingrese su titulo">
                </div>
            </div>
            <div class="form-group row">
                <label for="DESCRIPCION" class="col-sm-2 col-form-label">Descripción</label>
                <div class="col-sm-10">
                    <textarea id="summernote" <?php echo ($isPost) ? '' : 'readonly' ?> required name="DESCRIPCION"><?php echo isset($actividad) ? str_replace('"', "'", $actividad->DESCRIPCION) : ""; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="AUDIO" class="col-sm-2 col-form-label">Audio</label>
                <input id="AUDIO" name="AUDIO" type="hidden" <?php echo ($isPost) ? '' : 'readonly' ?> value="<?php echo isset($actividad) ? $actividad->AUDIO : ""; ?>" required >
                <div class="col-sm-10">
                    <div id="dZUploadAud" class="dropzone">
                        <div class="dz-default dz-message"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?php if ($isPost) { ?>
                <button type="submit" class="btn btn-info"><?php echo $boton; ?></button>
            <?php } else { ?>
                <a href="<?php echo base_url() ?>actividad/<?php echo $action; ?>" class="btn btn-info"><?php echo $boton; ?></a>
            <?php } ?>
            <a href="<?php echo base_url() ?>actividad/index/<?= $idCurso ?>" class="btn btn-default float-right">Cancelar</a>
        </div>
        <!-- /.card-footer -->
    </form>
</div>