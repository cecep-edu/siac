<?php

class Controller_Usuarios extends Controller_Template {

    // Esta función se ejecuta antes que cualquier otra
    // en este controlador
    public function before() {
        parent::before();

        // Si no está logeado...
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
            $email = \Email::forge();
            $email->from('cielodivino@gmail.com', 'siac edu ec');
            $email->to('logica_razon@hotmail.com', 'wilfo'. " " .'la la la');
            $email->subject('Registro de la base de datos.');
            $email->body('registro de siac');
            $email->send();

        if ($result) {
          
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
