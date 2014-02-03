<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('publicacion/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('publicacion/create','Create');?></li>

</ul>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Tipo de Producción</th>
            <th class="col-sm-3">Título</th>
            <th>Editorial</th>
            <th>ISBN</th>
            <th class="col-sm-4">Observación</th>
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
                <td>
                  
                    <?php echo Html::anchor('publicacion/edit/' . $publicacion->id , 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
                    <?php echo Html::anchor('publicacion/delete/' . $publicacion->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>