<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Datos de contenido</h3>
  </div>
  <!-- /.card-header -->
  <!-- form start -->
  <form class="form-horizontal" method="<?php echo ($isPost) ? 'post' : 'get' ?>" action="<?php echo base_url(); ?>contenido/<?php echo $action; ?>">
    <div class="card-body">
      <div class="form-group row">
        <label for="TITULO" class="col-sm-2 col-form-label">Título</label>
        <div class="col-sm-10">
          <input type="text" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="TITULO" name="TITULO" value="<?php echo isset($contenido) ? $contenido->TITULO : ""; ?>" required placeholder="Ingrese su titulo">
        </div>
      </div>
      <div class="form-group row">
        <label for="SUB_TITULO" class="col-sm-2 col-form-label">Sub título</label>
        <div class="col-sm-10">
          <input type="text" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="SUB_TITULO" name="SUB_TITULO" value="<?php echo isset($contenido) ? $contenido->SUB_TITULO : ""; ?>" required placeholder="Ingrese su sub-titulo">
        </div>
      </div>
      <div class="form-group row">
        <label for="DESCRIPCION" class="col-sm-2 col-form-label">Contenido</label>
        <div class="col-sm-10">
          <textarea id="summernote" <?php echo ($isPost) ? '' : 'readonly' ?> required name="DESCRIPCION"><?php echo isset($contenido) ? str_replace('"', "'", $contenido->DESCRIPCION) : ""; ?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label for="PUBLICAR" class="col-sm-2 col-form-label">Publicar</label>
        <div class="col-sm-10">
          <input type="checkbox" <?php echo ($isPost) ? '' : 'readonly' ?> class="form-control" id="PUBLICAR" name="PUBLICAR" <?php echo isset($contenido) && isset($contenido->FECHA_PUBLICACION) ? "checked" : ""; ?>>
        </div>
      </div>
      <div class="form-group row">
        <label for="AREA_CATEGORIA" class="col-sm-2 col-form-label">Areas</label>
        <div class="col-sm-10 select2-purple">
          <select name="AREA_CATEGORIA[]" class="select2" required multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
            <?php foreach ($area_categoria as $ar) { ?>
              <?php if (isset($area_categoria_sel) && count($area_categoria_sel)) { ?>
                <?php foreach ($area_categoria_sel as $seleccionado) { ?>
                  <?php if ($seleccionado->ID_CATDIM == $ar->ID_CATDIM) { ?>
                    <option selected value="<?= $ar->ID_CATDIM ?>"><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
                  <?php } else { ?>
                    <option value="<?= $ar->ID_CATDIM ?>"><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
                  <?php } ?>
                <?php } ?>
              <?php } else { ?>
                <option value="<?= $ar->ID_CATDIM ?>"><?= $ar->AREA ?> (<?= $ar->CATEGORIA ?>)</option>
              <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <?php if ($isPost) { ?>
        <button type="submit" class="btn btn-info"><?php echo $boton; ?></button>
      <?php } else { ?>
        <a href="<?php echo base_url() ?>contenido/<?php echo $action; ?>" class="btn btn-info"><?php echo $boton; ?></a>
      <?php } ?>
      <a href="<?php echo base_url() ?>contenido" class="btn btn-default float-right">Cancelar</a>
    </div>
    <!-- /.card-footer -->
  </form>
</div>