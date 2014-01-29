<ul class="nav nav-pills">
    <li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('instrucciones/index', 'Listado'); ?></li>
    <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('instrucciones/create', 'Crear'); ?></li>
</ul>


<p>Editar</p>


<?php
//echo Form::open();
//echo Form::select('country', 'none', array(
//    'none' => 'None',
//    'europe' => array(
//        'uk' => 'United Kingdom',
//        'nl' => 'Netherlands'
//     ),
//    'us' => 'United States'
//));
//echo Form::close();
//
?>


<?php echo Form::open(); ?>
<div class="actions">
    <?php
    echo Form::submit();
    //echo Html::anchor('/instruccciones/index/', 'Example');
    //echo Html::anchor('instrucciones/edit/' . $instrucciones->id, 'Editar', array('class' => 'btn btn-default'));
    ?>
</div>

<?php echo Form::close(); ?>