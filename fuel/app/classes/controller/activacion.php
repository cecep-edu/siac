<?php

class Controller_Activacion extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
                $id= Crypt::decode(\Input::param('q'),'siac');
                $usuario=  Model_Usuario::find($id);
                if($usuario->estado)
                  $data['msg']="Este usuario ya ha sido activado."."<br/>"
                  .'<a href="/usuarios/login">Click aquí para ingresar al sistema.</a>';
                else{
                    $usuario->estado=true;
                    $usuario->save();
                    
                    $data['msg']='Su cuenta ha sido activada.'."<br/>"
                    .'Por favor , click en conectar para loguearse con su usuario y contraseña.'."<br/>"
                    .'<a href="/usuarios/login">Click aquí.</a>';
                }
                   

		$this->template->title = 'Activacion &raquo; Index';
		$this->template->content = View::forge('activacion/index', $data,false);
	}

}
