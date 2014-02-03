<?php

namespace Fuel\Migrations;

class Add_celular_to_conf_instituciones
{
	public function up()
	{
		\DBUtil::add_fields('conf_instituciones', array(
			'celular' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('conf_instituciones', array(
			'celular'

		));
	}
}