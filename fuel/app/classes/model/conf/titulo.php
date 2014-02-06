<?php

class Model_Conf_Titulo extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nombres'=>array(
                    'data_type'=>'string',
                    'label'=>'Nombre:',
                    'validation'=>array('required'),
                ),
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
	protected static $_table_name = 'conf_titulos';
        

}
