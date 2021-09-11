<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Datos de area</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form class="form-horizontal" method="<?php echo ($isPost) ? 'post' : 'get' ?>" action="<?php echo base_url(); ?>area/<?php echo $action; ?>">
    <div class="card-body">
      <div class="form-group row">
        <label for="NOMBRE" class="col-sm-2 col-form-label">Nombre</label>
        <div class="col-sm-10">
          <input type="text" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="NOMBRE" name="NOMBRE" value="<?php echo isset($area) ? $area->NOMBRE : ""; ?>" required placeholder="Ingrese su nombre">
        </div>
      </div>
      <div class="form-group row">
        <label for="DESCRIPCION" class="col-sm-2 col-form-label">Descripcion</label>
        <div class="col-sm-10">
          <input type="text" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="DESCRIPCION" name="DESCRIPCION" value="<?php echo isset($area) ? $area->DESCRIPCION : ""; ?>" required placeholder="Ingrese su descripcion">
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <?php if ($isPost) { ?>
        <button type="submit" class="btn btn-info"><?php echo $boton; ?></button>
      <?php } else { ?>
        <a href="<?php echo base_url() ?>area/<?php echo $action; ?>" class="btn btn-info"><?php echo $boton; ?></a>
      <?php } ?>
      <a href="<?php echo base_url() ?>area" class="btn btn-default float-right">Cancelar</a>
    </div>
    <!-- /.card-footer -->
  </form>
</div>