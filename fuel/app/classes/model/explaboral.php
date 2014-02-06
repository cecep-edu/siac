<?php

class Model_Explaboral extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_empresa' => array(
            'data_type' => 'int',
            'label' => ' Empresa',
            'validation' => array('required'),
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
                'placeholder' => "Nombre de la empresa"
            )
        ),
        'cargo' => array(
            'data_type' => 'string',
            'label' => ' Cargo',
            'validation' => array('required'),
            'form' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Nombre del cargo"
            )
        ),
        'tiempo' => array(
            'data_type' => 'decimal',
            'label' => ' Tiempo',
            'validation' => array('required'),
            'form' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => "Tiempo que laboró"
            )
        ),
        'actividad' => array(
            'data_type' => 'string',
            'label' => ' Actividad',
            'validation' => array('required', 'validatexto' => array(10)),
            'form' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'rows' => 6,
                'cols' => 50,
                'placeholder' => "Actividades realizadas"
            )
        ),
        'id_personal' => array(
            'data_type' => 'string',
            'form' => array(
                'type' => 'hidden',
                'class' => 'form-control',
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
    protected static $_table_name = 'explaborals';
    protected static $_belongs_to = array(
        'informacion_personal' => array(
            'model_to' => 'Model_Informacion_Personal',
            'key_from' => 'id_personal',
            'key_to' => 'id',
        ),
        'empresa' => array(
            'model_to' => 'Model_Conf_Institucion',
            'key_from' => 'id_empresa',
            'key_to' => 'id',
        ),
    );

}
