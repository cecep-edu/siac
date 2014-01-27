<h1>Crear Usuario</h1>
<a href="/usuarios" role="button" class="btn btn-info btn-xs">Volver</a>
<fieldset>
    <legend>Ingrese con su cuenta y clave</legend>
    <?php echo Form::open('usuarios', array('class' => 'form-horizontal')); ?>
    <?php
    echo Form::input('username', null, array('class' => 'form-control',
        'required' => true,
        'placeholder' => 'Usuario',
        'autofocus' => true));
    ?>
    <?php
    echo Form::input('email', null, array('class' => 'form-control',
        'type' => 'email',
        'placeholder' => 'Email',
        'required' => true));
    ?>
    <?php
    echo Form::password('password', null, array('class' => 'form-control',
        'placeholder' => 'Contraseña',
        'required' => true));
    ?>														   
    <?php
    echo Form::button('Crear', null, array('type' => 'submit',
        'class' => 'btn btn-lg btn-primary btn-block'));
    ?>
    <?php echo Form::close(); ?>

</fieldset>
