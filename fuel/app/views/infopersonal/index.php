<ul class="nav nav-pills">
	<?php if($flag==false): ?>
        <li class='<?php echo Arr::get($subnav, "create" ); ?>'><?php echo Html::anchor('infopersonal/create','Create');?></li>
	<?php else: ?>
        <li class='<?php echo Arr::get($subnav, "edit" ); ?>'><?php echo Html::anchor('infopersonal/edit','Edit');?></li>
        <?php endif; ?>
</ul>
