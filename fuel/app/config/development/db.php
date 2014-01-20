<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'type'        => 'mysqli',
		'connection'  => array(
			'hostname'   => 'localhost',
			'username'   => 'root',
<<<<<<< HEAD
			'password'   => 'root',		),
=======
			'password'   => 'root',
			'database'   => 'siac_devel',
			'persistent' => false,
		),
		'identifier'   => '`',
		'table_prefix' => '',
		'charset'      => 'utf8',
		'collation'    => false,
		'enable_cache' => true,
		'profiling'    => true,
		'readonly'     => false,
>>>>>>> 8805fe9b5174c051a480669fcc11e88658e49c88
	),
);
