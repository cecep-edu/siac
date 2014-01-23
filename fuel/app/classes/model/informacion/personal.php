<?php

class Model_Informacion_Personal extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'usuario_id' => array(
            'data_type' => 'string',
            'label' => ' Usuario',
            'form' => array(
                'type' => 'hidden',
                'class' => 'form-control',
                'placeholder' => "Escriba su nombre"
            )
        ),
        'nombre' => array(
            'data_type' => 'string',
            'label' => ' Nombre',
            'validation' => array('required','max_length' => array(50), 'min_length' => array(2)),
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Escriba su nombre"
            )
        ),
        'apellido' => array(
            'data_type' => 'string',
            'label' => 'Apellido',
             'validation' => array('required','max_length' => array(50), 'min_length' => array(2)),
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Escriba su apellido"
            )
        ),
        'identificador' => array(
            'data_type' => 'string',
            'label' => 'ID',
            'validation' => array('required','max_length' => array(15), 'min_length' => array(5)),
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Ejemplo: 0705206687"
            )
        ),
        'tipo_identificador' => array(
            'data_type' => 'string',
            'label' => 'Tipo de Documento',
            'form' => array('type' => 'select',
                'class' => 'form-control',
                'placeholder' => "Seleccione el tipo de documento",
                'options' => array(1 => 'Cédula', 2 => 'Pasaporte')
            ),
        ),
        'pais_id' => array(
            'data_type' => 'int',
            'label' => 'País',
            'form' => array('type' => 'select', 'class' => 'form-control',
                'placeholder' => "Seleccione su País",
            )
        ),
        'ciudad_residencia_id' => array(
            'data_type' => 'int',
            'label' => 'Ciudad de Residencia',
            'form' => array('type' => 'select', 'class' => 'form-control',
                'placeholder' => "Seleccione su Ciudad"
            )
        ),
        'direccion' => array(
            'data_type' => 'string',
            'label' => 'Dirección',
            'validation' => array('required', 'max_length' => array(200), 'min_length' => array(2)),
            'form' => array('type' => 'textarea', 'class' => 'form-control',
                'placeholder' => "Escriba su dirección"
            )
        ),
        'telefono' => array(
            'data_type' => 'string',
            'label' => 'Teléfono',
             'validation' => array('required','max_length' => array(15), 'min_length' => array(5)),
            'form' => array('type' => 'text', 'class' => 'form-control',
                'placeholder' => "Escriba  su teléfono"
            )
        ),
        'correo' => array(
            'data_type' => 'string',
            'label' => 'Correo',
            'validation' => array('required', 'valid_email','max_length' => array(80), 'min_length' => array(5)),
            'form' => array('type' => 'email', 'class' => 'form-control',
                'placeholder' => "Escriba su correo"
            )
        ),
        'conadis' => array(
            'data_type' => 'string',
            'label' => 'Conadis',
             'validation' => array('required','max_length' => array(15), 'min_length' => array(5)),
            'form' => array('type' => 'text', 'class' => 'form-control',
                'placeholder' => "N° de carnet"
            )
        ),
        'ruta_foto' => array(
            'data_type' => 'string',
            'label' => 'Seleccione la foto',
            'form' => array(
                'type' => 'text', 'class' => 'form-control')
        ),
        'created_at' => array(
            'data_type' => 'Date',
            'form' => array('type' => 'hidden', 'class' => 'form-control'
            )
        ),
        'updated_at' => array(
            'data_type' => 'Date',
            'form' => array('type' => 'hidden', 'class' => 'form-control'
            )
        ),
    );
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    protected static $_table_name = 'informacion_personals';
    protected static $_belongs_to = array(
        'usuarios' => array(
            'model_to' => 'Model_Usuario',
            'key_from' => 'usuario_id',
            'key_to' => 'id',
        ),
    );

}
