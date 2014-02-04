<?php

class Model_Proyecto extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_personal' => array(
            'form' => array(
                'type' => 'hidden',
            )
        ),
        'nombre' => array(
            'data_type' => 'string',
            'label' => ' Denominación del Proyecto',
            'validation' => array('required'),
            'form' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'rows' => 3,
                'cols' => 40,
                'placeholder' => "Nombre del evento"
            )
        ),
        'id_ambito' => array(
            'data_type' => 'int',
            'label' => ' Ámbito',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'id_institucion' => array(
            'data_type' => 'int',
            'label' => ' Institución',
            'validation' => array('required'),
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'anio' => array(
            'data_type' => 'int',
            'label' => ' Año',
            'validation' => array('required'),
            'form' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Ejem.: 2014"
            )
        ),
        'duracion' => array(
            'data_type' => 'int',
            'label' => ' Duración ',
            'validation' => array('required'),
            'form' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => "2(años)"
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
    protected static $_table_name = 'proyectos';
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
