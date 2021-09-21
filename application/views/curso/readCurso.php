<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Datos de curso</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->

  <div class="card-body">
    <div class="form-group row">
      <label for="TITULO" class="col-sm-2 col-form-label">Título</label>
      <div class="col-sm-6">
        <?php echo isset($curso) ? $curso->TITULO : ""; ?>
      </div>
      <label for="TITULO" class="col-sm-2 col-form-label">Autor</label>
      <div class="col-sm-2">
        <?= $curso->NOMBRE ?> <?= $curso->APELLIDO_PAT ?> <?= $curso->APELLIDO_MAT ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="SUB_TITULO" class="col-sm-2 col-form-label">Sub título</label>
      <div class="col-sm-10">
        <?php echo isset($curso) ? $curso->SUB_TITULO : ""; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="DESCRIPCION" class="col-sm-2 col-form-label">Curso</label>
      <div class="col-sm-10">
        <?php echo isset($curso) ? str_replace('"', "'", $curso->DESCRIPCION) : ""; ?>
      </div>
    </div>
    <div class="form-group row">
      <label for="FECHA_REG" class="col-sm-2 col-form-label">Fecha Creacion</label>
      <div class="col-sm-4">
        <?php echo isset($curso) ? $curso->FECHA_REG : ""; ?>
      </div>
      <label for="FECHA_ACT" class="col-sm-2 col-form-label">Fecha Actualizacion</label>
      <div class="col-sm-4">
        <?php echo isset($curso) ? $curso->FECHA_ACT : ""; ?>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <a href="<?php echo base_url() ?>curso/<?php  echo $lnkBoton; ?>/<?php echo $curso->ID_CURSO ?>" class="btn btn-primary"><?php  echo $lblBoton?></a>
    <a href="<?php echo base_url() ?>curso/sugerencias" class="btn btn-default float-right">Cancelar</a>
  </div>
  <!-- /.card-footer -->
</div>