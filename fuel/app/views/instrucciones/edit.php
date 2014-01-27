<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('instrucciones/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('instrucciones/create','Create');?></li>
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
//?>


<?php// echo Form::open(); ?>
<div class="actions">
    <?php //echo Form::submit(); ?>
</div>

<?php //echo Form::close(); ?>