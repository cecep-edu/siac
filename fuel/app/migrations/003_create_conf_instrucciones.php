<?php

namespace Fuel\Migrations;

class Create_conf_instrucciones
{
	public function up()
	{
		\DBUtil::create_table('conf_instrucciones', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_usuario' => array('constraint' => 11, 'type' => 'int'),
			'id_nivel' => array('constraint' => 11, 'type' => 'int'),
			'id_institucion' => array('constraint' => 11, 'type' => 'int'),
			'id_especializacion' => array('constraint' => 11, 'type' => 'int'),
			'id_titulo' => array('constraint' => 11, 'type' => 'int'),
			'registro_oficial' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('conf_instrucciones');
	}
}