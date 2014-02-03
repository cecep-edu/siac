<?php

namespace Fuel\Migrations;

class Create_proyectos
{
	public function up()
	{
		\DBUtil::create_table('proyectos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_personal' => array('constraint' => 11, 'type' => 'int'),
			'id_ambito' => array('constraint' => 11, 'type' => 'int'),
			'id_institucion' => array('constraint' => 11, 'type' => 'int'),
			'nombre' => array('type' => 'text'),
			'anio' => array('constraint' => 11, 'type' => 'int'),
			'duracion' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('proyectos');
	}
}