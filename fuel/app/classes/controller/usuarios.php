<?php

class Controller_Usuarios extends Controller_Template
{

	// Esta función se ejecuta antes que cualquier otra
	// en este controlador
	public function before()
	{
		parent::before();

		// Si no está logeado...
		if (!Auth::check())
		{
			\Response::redirect('/usuarios/login');
		}

	}

	public function action_index()
	{
		$data["usuarios"] = Model_Usuario::find('all');
		$this->template->title = 'Usuarios &raquo; Index';
		$this->template->content = View::forge('usuarios/index', $data);
	}

	public function action_nuevo()
	{
		$this->template->title = 'Usuarios &raquo; Nuevo';
		$this->template->content = View::forge('usuarios/nuevo');
	}

	public function action_crear()
	{
		\Auth::create_user(
			\Input::post('username'),
			\Input::post('password'),
			\Input::post('email')
		);

		// informar al usuario de que el usuario se ha creado
		\Session::set_flash('siac-message', array('success' => 'Usuario creado con éxito.'));

		\Response::redirect('/usuarios');
	}

	public function action_mostrar()
	{
		$data["usuario"] = Model_Usuario::find($this->param('id'));
		$this->template->title = 'Mostrar &raquo; Usuario';
		$this->template->content = View::forge('usuarios/mostrar', $data);
	}

	public function action_editar()
	{
		$data["usuario"] = Model_Usuario::find($this->param('id'));

		$this->template->title = 'Editar &raquo; Usuario';
		$this->template->content = View::forge('usuarios/editar', $data);
	}

	public function action_actualizar()
	{
		$usuario = \Model\Auth_User::find($this->param('id'));

		$usuario->username = \Input::post('username');
		$usuario->email = \Input::post('email');
		$usuario->save();

		// Informar al usuario de que la actualización fué correcta
		\Session::set_flash('siac-message', array('success' => 'Usuario actualizado con éxito.'));

		\Response::redirect('/usuarios/'.$this->param('id'));
	}

	public function action_borrar()
	{
		$usuario = \Model\Auth_User::find($this->param('id'));
		$usuario->delete();

	    // informar al usuario de que la eliminación de usuario fué correcta
	    \Session::set_flash('siac-message', array('sucess' => 'Usuario eliminado con éxito.'));

		\Response::redirect('/usuarios');
	}
}
