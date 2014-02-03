<?php

class Model_Publicacion extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_personal' => array(
            'data_type' => 'int',
            'form' => array('type' => 'hidden', 'class' => 'form-control'
            )
        ),
        'id_tproduccion' => array(
            'data_type' => 'int',
            'label' => ' Tipo de Producción',
            'validation' => array('required'),
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
                'placeholder' => "Revista,Libro,etc."
            )
        ),
        'id_editorial' => array(
            'data_type' => 'int',
            'label' => ' Editorial',
            'validation' => array('required'),
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'titulo' => array(
            'data_type' => 'string',
            'label' => ' Título',
            'validation' => array('required', 'max_length' => array(250), 'min_length' => array(2)),
            'form' => array('type' => 'textarea',
                'class' => 'form-control',
                'rows' => 3,
                'cols' => 40,
                'placeholder' => "título de la obra"
            )
        ),
        'isbn' => array(
            'data_type' => 'string',
            'label' => ' Título',
            'validation' => array('required', 'max_length' => array(30), 'min_length' => array(2)),
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "isbn:085649856"
            )
        ),
        'observacion' => array(
            'data_type' => 'string',
            'label' => ' Observación',
            'validation' => array('required', 'max_length' => array(350), 'min_length' => array(2)),
            'form' => array('type' => 'textarea',
                'class' => 'form-control',
                'rows' => 4,
                'cols' => 40,
                'placeholder' => "Recibio premios , etc."
            )
        ),
        'created_at' => array(
            'data_type' => 'int',
            'form' => array('type' => 'hidden', 'class' => 'form-control'
            )
        ),
        'updated_at' => array(
            'data_type' => 'int',
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
    protected static $_table_name = 'publicacions';
    protected static $_belongs_to = array(
        'informacion_personal' => array(
            'model_to' => 'Model_Informacion_Personal',
            'key_from' => 'id_personal',
            'key_to' => 'id',
        ),
        'editorial' => array(
            'model_to' => 'Model_Conf_Institucion',
            'key_from' => 'id_editorial',
            'key_to' => 'id',
        ),
        'tproduccion' => array(
            'model_to' => 'Model_Tproduccion',
            'key_from' => 'id_tproduccion',
            'key_to' => 'id',
        ),
    );

}
