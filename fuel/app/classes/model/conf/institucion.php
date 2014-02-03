<?php

class Model_Conf_Institucion extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nombre'=>array(
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
        
	protected static $_table_name = 'conf_instituciones';
        
//        protected static $_belongs_to = array(
//            'conf_instrucciones'=>array(
//                'key_from'=>'id',
//                'model_to'=>'Model_Conf_Instruccion',
//                'key_to'=>'id_institucion',
//                'cascade_save'=>false,
//                'cascade_detele'=>false,
//            ),
//        );
}
