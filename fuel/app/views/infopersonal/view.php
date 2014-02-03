<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "edit"); ?>'><?php echo Html::anchor('infopersonal/edit', 'Edit'); ?></li>
    <li class='<?php echo Arr::get($subnav, "view"); ?>'><?php echo Html::anchor('infopersonal/view', 'View'); ?></li>

</ul>

<div class="container">
    <div class="row">

        <div class="span3 pull-right">
            <p><a class="btn w101" href="#"><i class="icon-print"></i>Imprimir</a> <a class="btn w101" href="#"><i class="icon-download-alt"></i>Descargar</a></p>
        </div>
    </div>
    <hr>

    <div class="row ">
        <div class="span4">
            <div class="pull-left">
                <div class="well" style="height: 350px;width:200px">
                    <a href="#" class="thumbnail">
                        <img src="/uploads/<?php echo $personal->ruta_foto ?>" alt="" height="300" width="190" class="img-rounded">
                    </a>
                </div>
            </div>

        </div>
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">1</span><strong>DATOS PERSONALES</strong></a></li>
            </ul>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td>NOMBRES Y APELLIDOS:</td>
                        <td><?php echo $personal->nombre . ' ' . $personal->apellido; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>CÉDULA DE CIUDADANÍA</td>
                        <td><?php echo $personal->identificador; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>NACIONALIDAD</td>
                        <td colspan="3">Ecuador</td>

                    </tr>
                    <tr>
                        <td>CIUDAD</td>
                        <td>QUITO</td>
                        <td>PROVINCIA</td>
                        <td>PICHINCHA</td>

                    </tr>
                    <tr>
                        <td>DIRECCIÓN</td>
                        <td colspan="3"><?php echo $personal->direccion; ?></td>   
                    </tr>
                    <tr>
                        <td>TELÉFONO FIJO :</td>
                        <td><?php echo $personal->telefono; ?></td>
                        <td>CELULAR :</td>
                        <td>campo no exite en la base</td>
                    </tr>
                    <tr>
                        <td>CORREO ELECTRÓNICO</td>
                        <td colspan="3"><?php echo $personal->correo; ?></td>   
                    </tr>
                    <tr>
                        <td>N° CARNET DE CONADIS</td>
                        <td colspan="3"><?php echo $personal->conadis; ?></td>   
                    </tr>

                </tbody>
            </table>



        </div>
    </div>

    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">2</span>
                        <strong> INSTRUCCIONES</strong></a></li>
            </ul>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>NIVEL DE INTRUCCION</td>
                        <td>NOMBRE DE LA INSTITUCION</td>
                        <td>ESPECIALIZACION</td>
                        <td>TITULO</td>
                        <td>REGISTRO DEL SENECYT</td>
                    </tr>

                </tbody>
            </table>



        </div>
    </div>
    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">3</span>
                        <strong> EXPERIENCIA LABORAL</strong>
                    </a>
                </li>
            </ul>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-1">TIEMPO DE LABORA</th>
                        <th class="col-sm-2">ORGANIZACIÓN/EMPRESA</th>
                        <th class="col-sm-3">DENOMINACIÓN DEL PUESTO</th>
                        <th class="col-sm-4">RESPONSABILIDADES/ACTIVIDADES/FUNCIONES</th>

                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($laborales as $laboral): ?>
                        <tr>
                            <td><?php echo $laboral->tiempo ?></td>
                            <td><?php echo $laboral->empresa->nombre ?></td>
                            <td><?php echo $laboral->cargo ?></td>
                            <td><?php echo $laboral->actividad ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>



        </div>
    </div>
    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">4</span>
                        <strong>CAPACITACION ESPECIFICA</strong></a></li>
            </ul>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-3">NOMBRE DEL EVENTO</th>
                        <th class="col-sm-3">INSTITUCIÓN QUIÉN LO DICTÓ</th>
                        <th class="col-sm-1"> AÑO</th>
                        <th class="col-sm-1">TIPO:(Curso,Seminario,Taller,Congreso,Encuentros,otros)</th>
                        <th class="col-sm-1">DURACIÓN EN HORAS</th>
                        <th class="col-sm-2">CERTIFICADO:Aprobación/Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($capacitaciones as $capacitacion): ?>
                        <tr>
                            <td><?php echo $capacitacion->nom_evento; ?></td>
                            <td><?php echo $capacitacion->institucion->nombre; ?></td>
                            <td><?php echo $capacitacion->anio; ?></td>
                            <td><?php echo $capacitacion->tpcapacitacion->nom_capa; ?></td>
                            <td><?php echo $capacitacion->duracion; ?></td>
                            <td><?php echo $capacitacion->certificado->nombre; ?></td>      
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>



        </div>
    </div>


    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">5</span>
                        <strong>IDIOMAS</strong></a></li>
            </ul>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-2">IDIOMA</th>
                        <th class="col-sm-3">NIVEL ESCRITO</th>
                        <th class="col-sm-3"> NIVEL ORAL</th>
                        <th class="col-sm-2">CERTIFICADO DE SUFICIENCIA</th>
                        <th class="col-sm-3">INSTITUCIÓN QUE LE OTORGÓ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $niveles = array('1' => 'Básico', '2' => 'Intermedio', '3' => 'Avanzado');
                    foreach ($idiomas as $idioma):
                        ?>
                        <tr>
                            <td><?php echo $idioma->lenguaje->nombre; ?></td>
                            <td><?php echo $niveles[$idioma->id_nivelescrito]; ?></td>
                            <td><?php echo $niveles[$idioma->id_niveloral]; ?></td>
                            <td><?php echo $idioma->nombre_certificado; ?></td>
                            <td><?php echo $idioma->institucion->nombre; ?></td>

                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>



        </div>
    </div>

    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">6</span>
                        <strong>PUBLICACIONES</strong></a></li>
            </ul>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-2">TIPO DE PRODUCCIONES</th>
                        <th class="col-sm-3">TITULO</th>
                        <th class="col-sm-3"> EDITORIAL</th>
                        <th class="col-sm-2">ISBN</th>
                        <th class="col-sm-3">OBSERVACIÓN</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($publicaciones as $publicacion): ?>
                        <tr>
                            <td><?php echo $publicacion->tproduccion->nombre; ?></td>
                            <td><?php echo $publicacion->titulo; ?></td>
                            <td><?php echo $publicacion->editorial->nombre; ?></td>
                            <td><?php echo $publicacion->isbn; ?></td>
                            <td><?php echo $publicacion->observacion; ?></td>

                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>



        </div>
    </div>

    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">7</span>
                        <strong>PROYECTOS DE INVESTIGACIÓN</strong></a></li>
            </ul>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-3">DENOMINACIÓN DEL PROYECTO</th>
                        <th class="col-sm-3">ÁMBITO</th>
                        <th class="col-sm-3"> ENTIDAD DE RELACIÓN</th>
                        <th class="col-sm-1">AÑO</th>
                        <th class="col-sm-1">TIEMPO DE DURACIÓN</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($proyectos as $proyecto): ?>
                        <tr>
                            <td><?php echo $proyecto->nombre; ?></td>
                            <td><?php echo $proyecto->ambito->nombre; ?></td> 
                            <td><?php echo $proyecto->institucion->nombre; ?></td>
                            <td><?php echo $proyecto->anio; ?></td>
                            <td><?php echo $proyecto->duracion; ?></td>
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="pull-left">
            <p></p>
            <p></p>

            <ul class="nav nav-list">
                <li class="active"><a href="#">
                        <span class="badge pull-right">8</span>
                        <strong>DIRECCIÓN DE TESIS DE MAESTRÍA</strong></a></li>
            </ul>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="col-sm-3">TÍTULO</th>
                        <th class="col-sm-3">ÁMBITO</th>
                        <th class="col-sm-3">INSTITUCIÓN DE EDUCACIÓN SUPERIOR</th>
                        <th class="col-sm-1">AÑO</th>
                    </tr>
                </thead>
                <tbody>
<?php foreach ($tesis as $tes): ?>
                        <tr>
                            <td><?php echo $tes->titulo; ?></td>
                            <td><?php echo $tes->ambito->nombre; ?></td>
                            <td><?php echo $tes->institucion->nombre; ?></td>
                            <td><?php echo $tes->anio; ?></td>
                        </tr>
<?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>



    <hr>

    <footer>

    </footer>

</div><!--/.fluid-container-->
