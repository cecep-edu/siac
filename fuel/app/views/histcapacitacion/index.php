<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('histcapacitacion/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('histcapacitacion/create','Create');?></li>
	
</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Evento</th>
            <th>Institución</th>
            <th>Año</th>
            <th>Tipo</th>
            <th>Duración</th>
            <th>Certificado</th>
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
                  
                    <?php echo Html::anchor('histcapacitacion/edit/' . $capacitacion->id , 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
                    <?php echo Html::anchor('histcapacitacion/delete/' . $capacitacion->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>