<?php

class Model_Conf_Ciudade extends \Orm\Model {

    protected static $_properties = array(
        'id',
        'ciudad',
        'id_pais',
        'created_at',
        'updated_at',
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
    protected static $_table_name = 'conf_ciudades';
    
    protected static $_belongs_to = array(
        'conf_paises' => array(
            'key_from' => 'id_pais',
            'model_to' => 'Model_Conf_Paise',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_detele' => false,
        ),
    );

}
