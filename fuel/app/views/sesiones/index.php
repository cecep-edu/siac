<div class="container">
    <div class="row">
        <div style="width: 500px" class="center span4 well" >

            <fieldset>
                <legend>Inicie sesión</legend>
                <?php echo Form::open('usuarios/login', array('class' => 'form-horizontal', 'style' => 'width:200px')); ?>
                <?php
                echo Form::input('username', null, array('class' => 'form-control',
                    'placeholder' => 'Usuario',
                    'required' => true,
                    'autofocus' => true));
                ?>
                <?php
                echo Form::password('password', null, array('class' => 'form-control',
                    'placeholder' => 'Contraseña',
                    'required' => true));
                ?>
                <label class="checkbox">
                    <?php echo Form::checkbox('remember-me'); ?> Recuérdame
                </label>
                <?php
                echo Form::button('Conectar', null, array('type' => 'submit',
                    'class' => 'btn btn-lg btn-primary btn-block'));
                ?>
                <?php echo Form::close(); ?>
            </fieldset>

        </div>
    </div>
    <div class="row ">
        <div style="width: 500px" class="center span4 well" >
            <fieldset>
                <legend>Registrate Aquí</legend>

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
                echo Form::button('Registrase', null, array('type' => 'submit',
                    'class' => 'btn btn-lg btn-primary btn-block'));
                ?>
                <?php echo Form::close(); ?>
            </fieldset>
        </div>
    </div>
</div>