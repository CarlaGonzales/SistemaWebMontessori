<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Datos de persona</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="<?php echo ($isPost)?'post':'get' ?>" action="<?php echo base_url(); ?>personas/<?php echo $action; ?>" >
                <div class="card-body">
                  <div class="form-group row">
                    <label for="NOMBRE" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="NOMBRE" name="NOMBRE" value="<?php echo isset($persona)?$persona->NOMBRE:""; ?>" reqired placeholder="Nombre">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="APELLIDO_PAT" class="col-sm-2 col-form-label">Apellido paterno</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="APELLIDO_PAT" name="APELLIDO_PAT" value="<?php echo isset($persona)?$persona->APELLIDO_PAT:""; ?>" reqired placeholder="Apellido paterno">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="APELLIDO_MAT" class="col-sm-2 col-form-label">Apellido materno</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="APELLIDO_MAT" name="APELLIDO_MAT" value="<?php echo isset($persona)?$persona->APELLIDO_MAT:""; ?>" reqired placeholder="Apellido materno">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="FECHA_NAC" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="FECHA_NAC" name="FECHA_NAC" value="<?php echo isset($persona)?$persona->FECHA_NAC:""; ?>" reqired placeholder="AAAA-MM-DD">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="DIRECCION" class="col-sm-2 col-form-label">Direccion</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="DIRECCION" name="DIRECCION" value="<?php echo isset($persona)?$persona->DIRECCION:""; ?>" reqired placeholder="Direccion">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="CORREO" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="CORREO" name="CORREO" value="<?php echo isset($persona)?$persona->CORREO:""; ?>" reqired placeholder="Correo">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="CELULAR" class="col-sm-2 col-form-label">Celular</label>
                    <div class="col-sm-10">
                      <input type="text" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="CELULAR" name="CELULAR" value="<?php echo isset($persona)?$persona->CELULAR:""; ?>" reqired placeholder="Celular">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php $isDeleted = !(!$isPost && isset($usuario));?>
                  <?php if($isDeleted){ ?>
                    <button type="submit" class="btn btn-info"><?php echo $boton; ?></button>
                  <?php } ?>
                  <?php echo !$isDeleted?"<span class='badge bg-warning'>No se puede eliminar!!</span>":""  ?>
                  <a href="<?php echo base_url() ?>personas" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>