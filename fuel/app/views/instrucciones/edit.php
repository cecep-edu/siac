<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('instrucciones/index', 'Listado'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('instrucciones/create', 'Crear'); ?></li>
</ul>


<p>Editar</p>


<?php echo Form::open(); ?>
<div class="actions">
    <?php
    echo Form::submit();
    ?>
</div>

<?php echo Form::close(); ?>