<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Datos de usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="<?php echo ($isPost)?'post':'get' ?>" action="<?php echo base_url(); ?>usuarios/<?php echo $action; ?>" >
                <div class="card-body">
                  <div class="form-group row">
                    <label for="ID_ROL" class="col-sm-2 col-form-label">Nombre completo</label>
                    <div class="col-sm-10">
                      <input type="text" readonly class="form-control" value="<?php echo isset($persona)?$persona->NOMBRE." ".$persona->APELLIDO_PAT." ".$persona->APELLIDO_MAT:""; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="ID_ROL" class="col-sm-2 col-form-label">Rol</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="ID_ROL" name="ID_ROL" <?php echo ($isPost)?'':'readonly' ?> reqired>
                        <option value="1" <?php echo (isset($usuario) && $usuario->ID_ROL==1)?"selected":""; ?>>Administrador</option>
                        <option value="2" <?php echo (isset($usuario) && $usuario->ID_ROL==2)?"selected":""; ?>>Tutor</option>
                        <option value="3" <?php echo (isset($usuario) && $usuario->ID_ROL==3)?"selected":""; ?>>Especialista</option>
                      </select>

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="PASSWORD" class="col-sm-2 col-form-label">Contraseña</label>
                    <div class="col-sm-10">
                      <input type="password" <?php echo ($isPost)?'':'readonly' ?> class="form-control" id="PASSWORD" name="PASSWORD" value="<?php echo isset($usuario)?$usuario->PASSWORD:""; ?>" reqired placeholder="Contraseña">
                    </div>
                  </div>
                  <input type="hidden" name="ID_PERSONA" value="<?php echo isset($persona)?$persona->ID_PERSONA:""; ?>" >
                  <input type="hidden" name="USERNAME" value="<?php echo isset($persona)?$persona->CORREO:""; ?>" >
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info"><?php echo $boton; ?></button>
                  <a href="<?php echo base_url() ?>personas" class="btn btn-default float-right">Cancelar</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>