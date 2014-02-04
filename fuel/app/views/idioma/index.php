<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('idioma/index', 'Index'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('idioma/create', 'Create'); ?></li>

</ul>
<?php
$niveles = array('1' => 'Básico','2'=>'Intermedio','3'=>'Avanzado');
?>
<table class="table table-hover">
    <thead>
        <tr>
            <th  class="col-sm-1">Idioma</th>
            <th class="col-sm-1">Nivel Escrito</th>
            <th  class="col-sm-1">Nivel Oral</th>
            <th  class="col-sm-2">Certificado de Suficiencia</th>
            <th class="col-sm-2">Institución</th>
            <th class="col-sm-3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($idiomas as $idioma): ?>
            <tr>
                <td><?php echo $idioma->lenguaje->nombre; ?></td>
                <td><?php echo $niveles[$idioma->id_nivelescrito]; ?></td>
                <td><?php echo $niveles[$idioma->id_niveloral]; ?></td>
                <td><?php echo $idioma->nombre_certificado; ?></td>
                <td><?php echo $idioma->institucion->nombre; ?></td>
                <td>
                    
                    <form action="/idioma/edit" method="post">
                        <input type="hidden" id="id" name='id'  value="<?php echo $idioma->id; ?>" />
                        <input type="submit" value="Editar" class="btn btn-warning btn-xs" />
                         <?php echo Html::anchor('/idioma/delete/'.$idioma->id , 'Eliminar', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estas seguro?')")); ?>
                    </form>
                   
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>