<?php

namespace Fuel\Migrations;

class Create_publicacions
{
	public function up()
	{
		\DBUtil::create_table('publicacions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_personal' => array('constraint' => 11, 'type' => 'int'),
			'id_tproduccion' => array('constraint' => 11, 'type' => 'int'),
			'id_editorial' => array('constraint' => 11, 'type' => 'int'),
			'titulo' => array('constraint' => 255, 'type' => 'varchar'),
			'isbn' => array('constraint' => 255, 'type' => 'varchar'),
			'observacion' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('publicacions');
	}
}