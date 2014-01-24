<?php

class Model_Conf_Instruccion extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'id_usuario',
		'id_nivel',
		'id_institucion',
		'id_especializacion',
		'id_titulo',
		'registro_oficial',
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
	protected static $_table_name = 'conf_instrucciones';
        
        protected static $be_longs = array(
            'informacion_personals'=>array(
                'key_from'=>'id_usuario',
                'model_to'=>'Model_Informacion_Personal',
                'key_to'=>'id',                
            )
        );
        
        
        
        
        
        
}
