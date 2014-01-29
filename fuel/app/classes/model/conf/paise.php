<?php

class Model_Conf_Paise extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nom_pais',
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
	protected static $_table_name = 'conf_paises';
        
        protected static $_has_many = array(
            'conf_ciudades'=>array(
                'key_from'=>'id',
                'model_to'=>'Model_Conf_Ciudade',
                'key_to'=>'id_pais',
                'cascade_save'=>false,
                'cascade_detele'=>false,
            ),
        );

}
