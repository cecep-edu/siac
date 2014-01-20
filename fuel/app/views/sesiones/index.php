<?php echo Form::open('usuarios/login'); ?>
	<?php echo Form::input('username', null, array('class' => 'form-control',
													'placeholder' => 'Usuario',
													'required' => true,
													'autofocus' => true)); ?>
	<?php echo Form::password('password', null, array('class' => 'form-control',
													  'placeholder' => 'Contraseña',
													  'required' => true)); ?>
	<label class="checkbox">
		<?php echo Form::checkbox('remember-me'); ?> Recuérdame
	</label>
	<?php echo Form::button('Conectar', null, array('type' => 'submit',
													'class' => 'btn btn-lg btn-primary btn-block')); ?>
<?php echo Form::close(); ?>

