<?php

namespace Fuel\Migrations;

class Add_id_tpempresa_to_conf_instituciones
{
	public function up()
	{
		\DBUtil::add_fields('conf_instituciones', array(
			'id_tpempresa' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('conf_instituciones', array(
			'id_tpempresa'

		));
	}
}