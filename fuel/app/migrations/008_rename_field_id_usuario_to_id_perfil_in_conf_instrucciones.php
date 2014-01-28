<?php

namespace Fuel\Migrations;

class Rename_field_id_usuario_to_id_perfil_in_conf_instrucciones
{
	public function up()
	{
		\DBUtil::modify_fields('conf_instrucciones', array(
			'id_usuario' => array('name' => 'id_perfil', 'type' => 'int', 'constraint' => 11)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('conf_instrucciones', array(
			'id_perfil' => array('name' => 'id_usuario', 'type' => 'int', 'constraint' => 11)
		));
	}
}