<?php

namespace Fuel\Tasks;

class Usuario
{

	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r usuario
	 *
	 * @return string
	 */
	public function run($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning DEFAULT task [Usuario:Run]";
		echo "\n-------------------------------------------\n\n";

		/***************************
		 Put in TASK DETAILS HERE
		 **************************/
	}



	/**
	 * This method gets ran when a valid method name is not used in the command.
	 *
	 * Usage (from command line):
	 *
	 * php oil r usuario:crear "arguments"
	 *
	 * @return string
	 */
	public function crear($args = NULL)
	{
		echo "\n===========================================";
		echo "\nRunning task [Usuario:Crear]";
		echo "\n-------------------------------------------\n\n";

		$params = explode(" ", $args);

		if (count($params) < 3)
		{
			echo "El comando correcto es:\noil r usuario:crear \"usuario contraseña email\"\n";
			die();
		}

		\Auth::create_user(
			$params[0],
			$params[1],
			$params[2]
		);

		echo "Usuario $params[0] creado\n";
	}

}
/* End of file tasks/usuario.php */
