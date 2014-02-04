<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('explaboral/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "crear"); ?>'><?php echo Html::anchor('explaboral/create', 'Create'); ?></li>

</ul>

<table class="table table-hover">
    <thead>
        <tr>
            <th class="col-sm-3">Empresa</th>
            <th class="col-sm-2">Cargo</th>
            <th class="col-sm-1">Tiempo</th>
            <th class="col-sm-4">Actividad</th>
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
                    <form action="/explaboral/edit" method="post">
                        <input type="hidden" id="id" name='id'  value="<?php echo $laboral->id; ?>" />
                        <input type="submit" value="Editar" class="btn btn-warning btn-xs" />
                        <?php echo Html::anchor('explaboral/delete/' . $laboral->id, 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                    </form>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>