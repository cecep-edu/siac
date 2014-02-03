<?php

namespace Fuel\Migrations;

class Rename_field_empresa_to_id_empresa_in_explaborals
{
	public function up()
	{
		\DBUtil::modify_fields('explaborals', array(
			'empresa' => array('name' => 'id_empresa', 'type' => 'text')
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('explaborals', array(
			'id_empresa' => array('name' => 'empresa', 'type' => 'int')
		));
	}
}