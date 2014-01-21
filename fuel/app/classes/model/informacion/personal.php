<?php

class Model_Informacion_Personal extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'apellido',
		'identificador',
		'tipo_identificador',
		'pais_id',
		'ciudad_residencia_id',
		'direccion',
		'telefono',
		'correo',
		'conadis',
		'ruta_foto',
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
	protected static $_table_name = 'informacion_personals';

	protected static $_belongs_to = array(
		'usuarios' => array(
			'model_to' => 'Usuario',
			'key_from' => 'usuario_id',
			'key_to'   => 'id',
		),
	);

}
