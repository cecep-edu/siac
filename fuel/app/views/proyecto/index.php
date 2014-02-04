<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('proyecto/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('proyecto/create', 'Create'); ?></li>

</ul>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-sm-2">Denominación del Proyecto</th>
            <th class="col-sm-2">Ámbito</th>
            <th class="col-sm-3">Entidad de realización</th>
            <th class="col-sm-1">Año</th>
            <th class="col-sm-1">Tiempo de Duración</th>
            <th class="col-sm-2">Opciones</th>
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
                <td>
                    <form action="/proyecto/edit" method="post">
                        <input type="hidden" id="id" name='id'  value="<?php echo $proyecto->id; ?>" />
                        <input type="submit" value="Editar" class="btn btn-warning btn-xs" />
                        <?php echo Html::anchor('proyecto/delete/' . $proyecto->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                    </form>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>