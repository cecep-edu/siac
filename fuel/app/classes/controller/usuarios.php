<?php

class Controller_Usuarios extends Controller_Template
{

	public function action_index()
	{
		$this->template->title = 'Usuarios &raquo; Index';
		$this->template->content = View::forge('usuarios/index');
	}

	public function action_crear()
	{
		// TODO
		\Response::redirect('/usuarios');
	}

	public function action_nuevo()
	{
		$this->template->title = 'Usuarios &raquo; Nuevo';
		$this->template->content = View::forge('usuarios/nuevo');
	}

	public function action_mostrar()
	{
		$data["usuario_id"] = $this->param('id');
		$this->template->title = 'Mostrar &raquo; Usuario';
		$this->template->content = View::forge('usuarios/mostrar', $data);
	}
	
	public function action_actualizar()
	{
		// TODO
		\Response::redirect('/usuarios/'.$this->param('id'));
	}

	public function action_borrar()
	{
		// TODO
		\Response::redirect('/usuarios');
	}

	public function action_editar()
	{
		// TODO
		\Response::redirect('/usuarios/'.$this->param('id'));
	}
}
