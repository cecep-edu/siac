<?php

class Model_Histcapacitacion extends \Orm\Model {

    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id',
        'id_personal' => array(
            'data_type' => 'int',
            'form' => array(
                'type' => 'hidden',
            )
        ),
        'nom_evento' => array(
            'data_type' => 'string',
            'label' => ' Evento',
            'validation' => array('required', 'validatexto' => array(10)),
            'form' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'rows' => 4,
                'cols' => 40,
                'placeholder' => "Nombre del evento"
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
        'id_tpcapacitacion' => array(
            'data_type' => 'int',
            'label' => 'Tipo de Documento',
            'form' => array(
                'type' => 'select',
                'class' => 'form-control'
            ),
        ),
        'duracion' => array(
            'data_type' => 'int',
            'label' => 'Duración',
            'validation' => array('required'),
            'form' => array('type' => 'text',
                'class' => 'form-control',
                'placeholder' => "4 (horas)"
            ),
        ),
        'id_tpcertificado' => array(
            'data_type' => 'int',
            'label' => 'Tipo de Certificado',
            'form' => array('type' => 'select',
                'class' => 'form-control'
            ),
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
    protected static $_table_name = 'histcapacitacions';
    protected static $_has_one = array(
    );
    protected static $_belongs_to = array(
        'informacion_personal' => array(
            'model_to' => 'Model_Informacion_Personal',
            'key_from' => 'id_personal',
            'key_to' => 'id',
        ),
        'certificado' => array(
            'key_from' => 'id_tpcertificado',
            'model_to' => 'Model_Tipocertificado',
            'key_to' => 'id',
        ),
        'tpcapacitacion' => array(
            'key_from' => 'id_tpcapacitacion',
            'model_to' => 'Model_Tpcapacitacion',
            'key_to' => 'id',
        ),
        'institucion' => array(
            'key_from' => 'id_institucion',
            'model_to' => 'Model_Conf_Institucion',
            'key_to' => 'id',
        ),
    );

}
