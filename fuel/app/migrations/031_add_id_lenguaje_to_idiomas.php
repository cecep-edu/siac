<?php

namespace Fuel\Migrations;

class Add_id_lenguaje_to_idiomas
{
	public function up()
	{
		\DBUtil::add_fields('idiomas', array(
			'id_lenguaje' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('idiomas', array(
			'id_lenguaje'

		));
	}
}