<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('explaboral/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "crear"); ?>'><?php echo Html::anchor('explaboral/create', 'Create'); ?></li>
    
</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Empresa</th>
            <th>Cargo</th>
            <th>Tiempo</th>
            <th>Actividad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($laborales as $laboral): ?>
            <tr>
                <td><?php echo $laboral->empresa->nombre; ?></td>
                <td><?php echo $laboral->cargo; ?></td>
                <td><?php echo $laboral->tiempo; ?></td>
                <td><?php echo $laboral->actividad; ?></td>
                <td>
                  
                    <?php echo Html::anchor('explaboral/edit/' . $laboral->id , 'Editar', array('class' => 'btn btn-warning btn-xs')); ?>
                    <?php echo Html::anchor('explaboral/delete/' . $laboral->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>