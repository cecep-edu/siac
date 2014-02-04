<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('publicacion/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('publicacion/create','Create');?></li>

</ul>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-sm-2">Tipo de Producción</th>
            <th class="col-sm-2">Título</th>
            <th class="col-sm-2">Editorial</th>
            <th class="col-sm-1">ISBN</th>
            <th class="col-sm-3">Observación</th>
             <th class="col-sm-3">Opciones</th>
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
                   <form action="/publicacion/edit" method="post">
                        <input type="hidden" id="id" name='id'  value="<?php echo $publicacion->id; ?>" />
                        <input type="submit" value="Editar" class="btn btn-warning btn-xs" />
                         <?php echo Html::anchor('publicacion/delete/' . $publicacion->id, 'Eliminar',
                        array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                   </form>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>