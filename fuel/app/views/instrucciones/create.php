<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('instrucciones/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('instrucciones/create','Create');?></li>
	<li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('instrucciones/edit','Edit');?></li>
	<li class='<?php echo Arr::get($subnav, "view" ); ?>'><?php echo Html::anchor('instrucciones/view','View');?></li>

</ul>
<p>Crear</p>

<?php echo Form::Open(); ?>

<div class="actions">
    <?php echo Form::submit(); ?>
</div>

<?php echo Form::close(); ?>