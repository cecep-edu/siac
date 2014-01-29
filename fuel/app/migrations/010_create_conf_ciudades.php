<?php

namespace Fuel\Migrations;

class Create_conf_ciudades
{
	public function up()
	{
		\DBUtil::create_table('conf_ciudades', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'ciudad' => array('constraint' => 255, 'type' => 'varchar'),
			'id_pais' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('conf_ciudades');
	}
}