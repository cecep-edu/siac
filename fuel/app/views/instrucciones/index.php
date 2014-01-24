<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('instrucciones/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('instrucciones/create','Crear');?></li>
<!--	<li class='<?php //echo Arr::get($subnav, "edit" ); ?>'><?php //echo Html::anchor('instrucciones/edit','Edit');?></li>
	<li class='<?php //echo Arr::get($subnav, "view" ); ?>'><?php //echo Html::anchor('instrucciones/view','View');?></li>-->

</ul>
<p>Index</p>

<div class="Instrucciones">

    <table>    
        <thead>
            <tr>
                <th><small><h5> Código </h5></small></th>
                <th><small><h5> id_Usuario </h5></small></th>
                <th><small><h5> id_nivel </h5></small></th>
                <th><small><h5> id_institución </h5></small></th>
                <th><small><h5> id_especializacion </h5></small></th>
                <th><small><h5> id_titulo </h5></small></th>
                <th><small><h5> registro_oficial </h5></small></th>
                                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($instruccion as $instrucciones) : ?>
                <tr>
                    
                    <td><?php echo $instrucciones['id']; ?></td>
                    <td><?php echo $instrucciones['id_usuario']; ?></td>
                    <td><?php echo $instrucciones['id_nivel']; ?></td>
                    <td><?php echo $instrucciones['id_institucion']; ?></td>
                    <td><?php echo $instrucciones['id_especializacion']; ?></td>
                    <td><?php echo $instrucciones['id_titulo']; ?></td>
                    <td><?php echo $instrucciones['registro_oficial']; ?></td>
                    
                    <td>
        		<?php echo Html::anchor('instrucciones/edit/'.$instrucciones->id, 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
                        <?php echo Html::anchor('instrucciones/delete/'.$instrucciones->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>

                    </td>
                </tr>
                <?php
            endforeach;
            ?>  
        </tbody>
    </table>

   
    <p></p>

</div>