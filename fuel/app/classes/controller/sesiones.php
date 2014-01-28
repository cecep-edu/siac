<?php

class Controller_Sesiones extends Controller_Template
{

    public function action_index()
    {
        // comprobar si ya está logeado
        if (\Auth::check())
        {
            // si, así que redirect a la página anterior o a la home
            \Session::set_flash('siac-message', array('danger' => 'Ya estabas conectado al sistema.'));
            \Response::redirect_back();
        }
        else
        {
            $this->template->title = 'Sesiones &raquo; Index';
            $this->template->content = View::forge('sesiones/index');
        }
    }

    public function action_login()
    {
        
       
      
        // comprobar si ya está logeado
        if (\Auth::check())
        {
            // si, así que redirect a la página anterior o a la home
            \Session::set_flash('siac-message', array('danger' => 'Ya estabas conectado al sistema.'));
            \Response::redirect_back();
        }

        // checkear las credenciales
        if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
        {
            // quiere el usuario ser recordado?
            if (\Input::param('remember', false))
            {
                // crear la cookie para recordarle
                \Auth::remember_me();
            }
            else
            {
                // borrar la cookie de recordarle si está presente
                \Auth::dont_remember_me();
            }

            // el usuario ya está logeado, redirigirle a la home
            \Session::set_flash('siac-message', array('success' => 'Has conectado al sistema con éxito.'));
            \Response::redirect('/');
        }
        else
        {
            // login fallido, mostrar un mensaje de error
            \Session::set_flash('siac-message', array('danger' => 'Usuario o contraseña incorrectos.'));
            \Response::redirect('usuarios/login');
        }
    }

    public function action_logout()
    {
        // borrar la cookie del remember me
        \Auth::dont_remember_me();

        // logout
        \Auth::logout();

        // informar al usuario de que el logout tuvo éxito
        \Session::set_flash('siac-message', array('success' => 'Desconectado del sistema con éxito.'));

        // redirect a la home
        \Response::redirect('/');
    }
    
   
}
