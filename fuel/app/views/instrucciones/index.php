<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('instrucciones/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('instrucciones/create', 'Crear'); ?></li>
<!--	<li class='<?php //echo Arr::get($subnav, "edit" );  ?>'><?php //echo Html::anchor('instrucciones/edit','Edit'); ?></li>
    <li class='<?php //echo Arr::get($subnav, "view" );  ?>'><?php //echo Html::anchor('instrucciones/view','View'); ?></li>-->

</ul>
<p>Instrucciones</p>

<div class="Instrucciones">
    <table class="table table-striped">    
        <thead>
            <tr>
                <th><small><h5> Nivel Instrucción </h5></small></th>
                <th><small><h5> Nombre de la Institución </h5></small></th>
                <th><small><h5> Especializacion </h5></small></th>
                <th><small><h5> Titulo </h5></small></th>
                <th><small><h5> Registro SENESCYT </h5></small></th>                                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instrucciones as $instruccion) : ?>
                <tr>
                    <td><?php echo $instruccion->conf_niveles->nombre; ?></td>
                    <td><?php echo $instruccion->conf_instituciones->nombre; ?></td>
                    <td><?php echo $instruccion->conf_especializaciones->nombre; ?></td>
                    <td><?php echo $instruccion->conf_titulos->nombres; ?></td>
                    <td><?php echo $instruccion->registro_oficial; ?></td>
                    <td>
                        <?php echo Html::anchor('instrucciones/edit/' . $instruccion->id, 'Editar', array('class' => 'btn btn-primary btn-sm')); ?>
                        <?php echo Html::anchor('instrucciones/delete/' . $instruccion->id, 'Eliminar', array('class' => 'btn btn-default btn-sm', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>  
        </tbody>
    </table>
   <p></p>

</div>