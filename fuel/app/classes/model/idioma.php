<?php

class Model_Idioma extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_nivelescrito' => array(
            'data_type' => 'int',
            'label' => ' Nivel Escrito',
            'validation' => array('required'),
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
                'options' => array(1 => 'Básico', 2 => 'Intermedio', 3 => 'Avanzado')
            )
        ),
        'id_niveloral' => array(
            'data_type' => 'int',
            'label' => ' Nivel Oral',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
                'options' => array(1 => 'Básico', 2 => 'Intermedio', 3 => 'Avanzado')
            )
        ),
        'id_lenguaje' => array(
            'data_type' => 'int',
            'label' => ' Idiomas',
            'validation' => array('required'),
            'form' => array(
                'type' => 'hidden',
            ),
        ),
        'nombre_certificado' => array(
            'data_type' => 'String',
            'label' => ' Certificado de Suficiencia',
            'validation' => array('required', 'validatexto' => array(10)),
            'form' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'cols' => 30,
                'rows' => 4
            )
        ),
        'id_institucion' => array(
            'data_type' => 'int',
            'label' => ' Institución',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control',
            )
        ),
        'id_personal' => array(
            'form' => array(
                'type' => 'hidden',
            )
        ),
        'created_at' => array(
            'form' => array(
                'type' => 'hidden',
            ),
        ),
        'updated_at' => array(
            'form' => array(
                'type' => 'hidden',
            ),
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
    protected static $_table_name = 'idiomas';
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
        'lenguaje' => array(
            'model_to' => 'Model_Lenguaje',
            'key_from' => 'id_lenguaje',
            'key_to' => 'id',
        ),
    );

}
