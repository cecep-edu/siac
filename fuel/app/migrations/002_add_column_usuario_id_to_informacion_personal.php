<?php

namespace Fuel\Migrations;

class Add_column_usuario_id_to_informacion_personal
{
	public function up()
	{
		\DBUtil::add_fields('informacion_personals', array(
			'usuario_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('informacion_personals', array(
			'usuario_id'

		));
	}
}