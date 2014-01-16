<?php

namespace Fuel\Migrations;

class Create_informacion_personals
{
	public function up()
	{
		\DBUtil::create_table('informacion_personals', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'apellido' => array('constraint' => 255, 'type' => 'varchar'),
			'identificador' => array('constraint' => 255, 'type' => 'varchar'),
			'tipo_identificador' => array('constraint' => 255, 'type' => 'varchar'),
			'pais_id' => array('constraint' => 11, 'type' => 'int'),
			'ciudad_residencia_id' => array('constraint' => 11, 'type' => 'int'),
			'direccion' => array('type' => 'text'),
			'telefono' => array('constraint' => 255, 'type' => 'varchar'),
			'correo' => array('constraint' => 255, 'type' => 'varchar'),
			'conadis' => array('constraint' => 255, 'type' => 'varchar'),
			'ruta_foto' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('informacion_personals');
	}
}