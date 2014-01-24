<h1>Editar: <?php echo $usuario->username; ?></h1>

<?php echo Form::open('usuarios/' . $usuario->id . '/actualizar'); ?>
<?php
echo Form::input('username', $usuario->username, array('class' => 'form-control',
    'required' => true,
    'autofocus' => true));
?>
<?php
echo Form::input('email', $usuario->email, array('class' => 'form-control',
    'type' => 'email',
    'required' => true));
?>
<?php echo Form::button('Actualizar', null, array('type' => 'submit',
    'class' => 'btn btn-lg btn-primary btn-block'));
?>
<?php echo Form::close(); ?>

