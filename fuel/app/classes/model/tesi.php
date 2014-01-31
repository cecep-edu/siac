<?php

class Model_Tesi extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_personal' => array(
            'form' => array(
                'type' => 'hidden',
            )
        ),
        'id_ambito' => array(
            'data_type' => 'int',
            'label' => 'Ámbito',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'id_institucion' => array(
            'data_type' => 'int',
            'label' => 'Institución',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'titulo' => array(
            'data_type' => 'string',
            'label' => ' Título',
            'validation' => array('required', 'max_length' => array(350), 'min_length' => array(2)),
            'form' => array('type' => 'textarea',
                'class' => 'form-control',
                'rows' => 5,
                'cols' => 40,
            )
        ),
        'anio' => array(
            'data_type' => 'string',
            'label' => ' Año',
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "año: 2014,etc"
            )
        ),
        'created_at' => array(
            'form' => array(
                'type' => 'hidden',
            )
        ),
        'updated_at' => array(
            'form' => array(
                'type' => 'hidden',
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
    protected static $_table_name = 'tesis';
    protected static $_belongs_to = array(
        'informacion_personal' => array(
            'model_to' => 'Model_Informacion_Personal',
            'key_from' => 'id_personal',
            'key_to' => 'id',
        ),
        'institucion' => array(
            'model_to' => 'Model_Conf_Institucion',
            'key_from' => 'id_institucion',
            'key_to' => 'id',
        ),
        'ambito' => array(
            'model_to' => 'Model_Ambito',
            'key_from' => 'id_ambito',
            'key_to' => 'id',
        ),
    );

}
