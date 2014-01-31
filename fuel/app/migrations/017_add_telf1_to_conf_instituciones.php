<?php

namespace Fuel\Migrations;

class Add_telf1_to_conf_instituciones
{
	public function up()
	{
		\DBUtil::add_fields('conf_instituciones', array(
			'telf1' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('conf_instituciones', array(
			'telf1'

		));
	}
}