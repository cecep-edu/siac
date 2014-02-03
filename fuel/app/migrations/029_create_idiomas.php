<?php

namespace Fuel\Migrations;

class Create_idiomas
{
	public function up()
	{
		\DBUtil::create_table('idiomas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'id_nivelescrito' => array('constraint' => 11, 'type' => 'int'),
			'id_niveloral' => array('constraint' => 11, 'type' => 'int'),
			'nombre_certificado' => array('constraint' => 255, 'type' => 'varchar'),
			'id_institucion' => array('constraint' => 11, 'type' => 'int'),
			'id_personal' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('idiomas');
	}
}