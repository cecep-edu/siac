<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('histcapacitacion/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('histcapacitacion/create', 'Create'); ?></li>

</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-sm-2">Evento</th>
            <th class="col-sm-2">Institución</th>
            <th class="col-sm-1">Año</th>
            <th class="col-sm-1">Tipo</th>
            <th class="col-sm-1">Duración</th>
            <th class="col-sm-2">Certificado</th>
            <th class="col-sm-2">Opciones</th>
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
                <td>
                    <form action="/histcapacitacion/edit" method="post">
                        <input type="hidden" id="id" name='id'  value="<?php echo $capacitacion->id; ?>" />
                        <input type="submit" value="Editar" class="btn btn-warning btn-xs" />
                        <?php echo Html::anchor('histcapacitacion/delete/' . $capacitacion->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>