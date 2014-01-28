<?php

class Controller_Usuarios extends Controller_Template {

    // Esta función se ejecuta antes que cualquier otra
    // en este controlador
    public function before() {
        parent::before();
        
        if (!Auth::check()) {
            \Session::set_flash('siac-message', array('danger' => 'Debes estar conectado para acceder a esa área.'));
            \Response::redirect('/usuarios/login');
        }
    }

    public function action_index() {
        $data["usuarios"] = Model_Usuario::find('all');
        $this->template->title = 'Usuarios &raquo; Index';
        $this->template->content = View::forge('usuarios/index', $data);
    }

    public function action_nuevo() {
        $this->template->title = 'Usuarios &raquo; Nuevo';
        $this->template->content = View::forge('usuarios/nuevo');
    }

    public function action_crear() {
        \Package::load('email');
        $result = \Model_Usuario::crear(
                        \Input::post('username'), \Input::post('password'), \Input::post('email')
        );
           

        if ($result) {
            
            $usuario=  Model_Usuario::find_by_email(\Input::post('email'));
            $email = \Email::forge();
  
            $email->from('siac@iaen.edu.ec', 'SIAC');
            $email->to(\Input::post('email'), \Input::post('username'));
            $email->subject('Link de activación de su perfil.');
            $cadena='Hola '. \Input::post('username').', '.PHP_EOL;            
            $cadena=$cadena.'Usted esta recibiendo esta notificación porque ha solicitado registrar '.PHP_EOL;
            $cadena=$cadena.'su acceso al sistema SIAC. '.PHP_EOL;
            $cadena=$cadena.PHP_EOL;
            $encode= Crypt::encode($usuario->id, 'siac');
            $cadena=$cadena.'http://siac.final.com/activacion/?q='.$encode;
           
            $email->body($cadena);
            $email->send();
            // informar al usuario de que el usuario se ha creado
        } else {
            // informar al usuario de que el usuario no se ha creado
            \Session::set_flash('siac-message', array('danger' => 'No se pudo crear el usuario.'));
        }

        \Response::redirect('/usuarios');
    }

    public function action_mostrar() {
        $data["usuario"] = Model_Usuario::find($this->param('id'));
        $this->template->title = 'Mostrar &raquo; Usuario';
        $this->template->content = View::forge('usuarios/mostrar', $data);
    }

    public function action_editar() {
        $data["usuario"] = Model_Usuario::find($this->param('id'));

        $this->template->title = 'Editar &raquo; Usuario';
        $this->template->content = View::forge('usuarios/editar', $data);
    }

    public function action_actualizar() {
        $usuario = \Model\Auth_User::find($this->param('id'));

        $usuario->username = \Input::post('username');
        $usuario->email = \Input::post('email');
        $usuario->save();

        // Informar al usuario de que la actualización fué correcta
        \Session::set_flash('siac-message', array('success' => 'Usuario actualizado con éxito.'));

        \Response::redirect('/usuarios/' . $this->param('id'));
    }

    public function action_borrar() {
        $usuario = \Model\Auth_User::find($this->param('id'));
        $usuario->delete();

        // informar al usuario de que la eliminación de usuario fué correcta
        \Session::set_flash('siac-message', array('sucess' => 'Usuario eliminado con éxito.'));

        \Response::redirect('/usuarios');
    }

}
