<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reportes y monitoreo</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tutorial</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Seleccione un curso</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="PUBLICAR" class="col-sm-1 col-form-label">Curso</label>
                                    <div class="col-sm-11 select2-purple">
                                        <select id="selectCurso" data-placeholder="Seleccione un curso" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <option value="">Seleccione un curso</option>
                                            <?php foreach ($cursos as $curso) { ?>
                                                <option value="<?= $curso->ID_CURSO ?>"><?= $curso->TITULO ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Alumnos inscritos</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <?php
                                        $cont = 1;
                                        $sum_prom = 0;
                                        $cont_inic = 0;
                                        $cont_prog = 0;
                                        $cont_fina = 0;
                                        if (isset($estudiantes)) { ?>
                                            <!--<pre><?php print_r($estudiantes); ?></pre>-->
                                            <table id="tableReport" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Estudiante</th>
                                                        <th>Avance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($estudiantes as $estudiante) { ?>
                                                        <tr>
                                                            <td><?= $cont++ ?></td>
                                                            <td><?= $estudiante->NOMBRE ?> <?= $estudiante->APELLIDO_PAT ?> <?= $estudiante->APELLIDO_MAT ?></td>
                                                            <td>
                                                                <?php
                                                                $porcentaje = 0;
                                                                if ($estudiante->NUM_ACTIVIDAD > 0) {
                                                                    $porcentaje = round(100 * $estudiante->CANT_FIN_ACT / $estudiante->NUM_ACTIVIDAD, 2);
                                                                }
                                                                $color = 'bg-danger';
                                                                if ($porcentaje >= 100) {
                                                                    $color = 'bg-success';
                                                                    $cont_fina++;
                                                                } else if ($porcentaje > 0 && $porcentaje < 100) {
                                                                    $color = 'bg-primary';
                                                                    $cont_prog++;
                                                                } else {
                                                                    $cont_inic++;
                                                                }
                                                                $sum_prom = $sum_prom + $porcentaje;
                                                                ?>
                                                                <div class="progress progress-xs">
                                                                    <div class="progress-bar <?= $color ?>" style="width: <?= $porcentaje ?>%"></div>
                                                                </div>
                                                                <span class="badge <?= $color ?>"><?= $porcentaje ?>%</span>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-md-6">
                                <!-- DONUT CHART -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Estadisticas</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php if (isset($estudiantes)) { ?>
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <b>Nro. Total Estudiantes:</b> <?= count($estudiantes) ?>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <b>Promedio Gral. Avance:</b> <?= round($sum_prom / count($estudiantes), 2) ?>%
                                                </div>
                                            </div>
                                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 561px;" width="504" height="224" class="chartjs-render-monitor"></canvas>
                                        <?php } ?>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
    let idCurso = <?= $idCurso ?>;
    let datoTotal = [<?= $cont_fina ?>, <?= $cont_prog ?>, <?= $cont_inic ?>];
</script>