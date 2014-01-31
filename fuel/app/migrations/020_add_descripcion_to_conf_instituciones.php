<?php

namespace Fuel\Migrations;

class Add_descripcion_to_conf_instituciones
{
	public function up()
	{
		\DBUtil::add_fields('conf_instituciones', array(
			'descripcion' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('conf_instituciones', array(
			'descripcion'

		));
	}
}