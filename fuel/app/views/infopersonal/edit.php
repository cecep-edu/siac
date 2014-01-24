<?php echo Form::close();?>
<ul class="nav nav-pills">
	
        <li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('infopersonal/edit','Edit');?></li>
        <li class='<?php echo Arr::get($subnav, "view" ); ?>'><?php echo Html::anchor('infopersonal/view','Ver');?></li>
        
</ul>
<?php echo Form::open(); ?>

<div class="actions" style="height: 100px">
    <?php echo Form::submit(); ?>
</div>

