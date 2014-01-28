<?php

class Controller_Registrar extends Controller_Template {

    public function action_index() {
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Registrar &raquo; Index';
        \Package::load('email');
        $result = \Model_Usuario::crear(
                        \Input::post('username'), \Input::post('password'), \Input::post('email')
        );


        if ($result) {

            $usuario = Model_Usuario::find_by_email(\Input::post('email'));
            $email = \Email::forge();

            $email->from('siac@iaen.edu.ec', 'SIAC');
            $email->to(\Input::post('email'), \Input::post('username'));
            $email->subject('Link de activación de su perfil.');
            $cadena = 'Hola ' . \Input::post('username') . ', ' . PHP_EOL;
            $cadena = $cadena . 'Usted esta recibiendo esta notificación porque ha solicitado registrar ' . PHP_EOL;
            $cadena = $cadena . 'su acceso al sistema SIAC. ' . PHP_EOL;
            $cadena = $cadena . PHP_EOL;
            $encode = Crypt::encode($usuario->id, 'siac');
            $cadena = $cadena . 'http://siac.final.com/activacion/?q=' . $encode;

            $email->body($cadena);
            $email->send();
            $data['msg']='Su cuenta ha sido creada.'."<br/>"
                    .'Por favor , ingrese a su correo para activar la cuenta.'."<br/>"
                    .'<a href="/usuarios/login">Click aquí.</a>';
            // informar al usuario de que el usuario se ha creado
        } else {
            // informar al usuario de que el usuario no se ha creado
            \Session::set_flash('siac-message', array('danger' => 'No se pudo crear el usuario.'));
        }

//        \Response::redirect('/usuarios');
        $this->template->content = View::forge('registrar/index', $data,false);
    }

}
