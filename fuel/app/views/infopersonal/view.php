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
                        <img src="/uploads/<?php echo $personal->ruta_foto?>" alt="" height="300" width="190" class="img-rounded">
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
                        <td><?php echo $personal->nombre.' '.$personal->apellido; ?></td>
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
            <table class="table table-striped">
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
            <table class="table table-striped">
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
                   <span class="badge pull-right">4</span>
               <strong>CAPACITACION ESPECIFICA</strong></a></li>
            </ul>
            <table class="table table-striped">
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
   
 

    <hr>

    <footer>
     
    </footer>

</div><!--/.fluid-container-->
