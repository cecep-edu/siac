<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

//namespace Auth\Model;

class Model_Usuario extends \Orm\Model
{
	

	protected static $_properties = array(
		'id',
		'username',
		'email',
	);

	protected static $_has_one = array(
		'informacion_personal' => array(
			'model_to' => 'Model_Informacion_Personal',
			'key_from' => 'id',
			'key_to' => 'usuario_id',
			'cascade_save' => true,
			'cascade_delete' => true,
		),
	);

	public static function crear($usuario, $password, $correo)
	{
		try{
                   
			\Auth::create_user(
				$usuario,
				$password,
				$correo
			);		
		}
		//Revisar manejo de excepciones en php
		catch(Exception $e){
			return false;
		}

		return true;
	}
	
}
