<?php

class Model_Conf_Instruccion extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'id_perfil' => array(
            'data_type' => 'int',
            'label' => 'ID Perfil:',
            'validation' => array('required'),
            'form' => array('type' => 'hidden'),
        ),
        'id_nivel' => array(
            'data_type' => 'int',
            'label' => 'Nivel de instrucción:',
            'validation' => array('required'),
            'form' => array('type' => 'select', 'class' => 'form-control'),
        ),
        'id_institucion' => array(
            'data_type' => 'int',
            'label' => 'Institución',
            'validation' => array('required'),
            'form' => array('type' => 'hidden'),
        ),
        'id_especializacion' => array(
            'data_type' => 'int',
            'label' => 'Especialización',
            'validation' => array('required'),
            'form' => array('type' => 'hidden'),
        ),
        'id_titulo' => array(
            'data_type' => 'int',
            'label' => 'Título',
            'validation' => array('required'),
            'form' => array('type' => 'hidden'),
        ),
        'registro_oficial' => array(
            'data_type' => 'int',
            'label' => 'Registro SENESCYT',
            'validation' => array('required', 'validatexto'=>array(8)),
            'form' => array('class' => 'form-control'),
        ),
        'created_at' => array(
            'form' => array('type' => 'hidden'),
        ),
        'updated_at' => array(
            'form' => array('type' => 'hidden'),
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
    protected static $_table_name = 'conf_instrucciones';
    protected static $_belongs_to = array(
        'informacion_personals' => array(
            'key_from' => 'id_perfil',
            'model_to' => 'Model_Informacion_Personal',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
        'conf_niveles' => array(
            'key_from' => 'id_nivel',
            'model_to' => 'Model_Conf_Nivel',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
        'conf_instituciones' => array(
            'key_from' => 'id_institucion',
            'model_to' => 'Model_Conf_Institucion',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
        'conf_especializaciones' => array(
            'key_from' => 'id_especializacion',
            'model_to' => 'Model_Conf_Especializacion',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
        'conf_titulos' => array(
            'key_from' => 'id_titulo',
            'model_to' => 'Model_Conf_Titulo',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
    );
    protected static $_has_one = array(
    );

   

}
