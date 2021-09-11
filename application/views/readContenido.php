<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Datos de contenido</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  
    <div class="card-body">
      <div class="form-group row">
        <label for="TITULO" class="col-sm-2 col-form-label">Título</label>
        <div class="col-sm-6">
          <?php echo isset($contenido) ? $contenido->TITULO : ""; ?>
        </div>
        <label for="TITULO" class="col-sm-2 col-form-label">Autor</label>
        <div class="col-sm-2">
          <?=$contenido->NOMBRE?> <?=$contenido->APELLIDO_PAT?> <?=$contenido->APELLIDO_MAT?>
        </div>
      </div>
      <div class="form-group row">
        <label for="SUB_TITULO" class="col-sm-2 col-form-label">Sub título</label>
        <div class="col-sm-10">
        <?php echo isset($contenido) ? $contenido->SUB_TITULO : ""; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="DESCRIPCION" class="col-sm-2 col-form-label">Contenido</label>
        <div class="col-sm-10">
          <?php echo isset($contenido) ? str_replace('"', "'", $contenido->DESCRIPCION) : ""; ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="FECHA_REG" class="col-sm-2 col-form-label">Fecha Creacion</label>
        <div class="col-sm-4">
          <?php echo isset($contenido) ? $contenido->FECHA_REG : ""; ?>
        </div>
        <label for="FECHA_ACT" class="col-sm-2 col-form-label">Fecha Actualizacion</label>
        <div class="col-sm-4">
          <?php echo isset($contenido) ? $contenido->FECHA_ACT : ""; ?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <a href="<?php echo base_url() ?>contenido/listar" class="btn btn-default float-right">Cancelar</a>
    </div>
    <!-- /.card-footer -->
</div>