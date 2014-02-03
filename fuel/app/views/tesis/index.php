<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('tesis/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('tesis/create', 'Create'); ?></li>

</ul>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-sm-2">Título</th>
            <th class="col-sm-2">Ámbito</th>
            <th class="col-sm-3">Inst. de Educación Superior</th>
            <th class="col-sm-1">Año</th>
            <th class="col-sm-3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tesis as $tes): ?>
            <tr>
                <td><?php echo $tes->titulo; ?></td>
                <td><?php echo $tes->ambito->nombre; ?></td>
                <td><?php echo $tes->institucion->nombre; ?></td>
                <td><?php echo $tes->anio; ?></td>
                <td>

                    <?php echo Html::anchor('tesis/edit/' . $tes->id, 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
                    <?php echo Html::anchor('tesis/delete/' . $tes->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>