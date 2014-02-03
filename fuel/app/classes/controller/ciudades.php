<?php

class Controller_Ciudades extends Controller_Template {

    public function before() {
        parent::before();

        if (!Auth::check()) {
            \Session::set_flash('siac-message', array('danger' => 'Debes estar conectado para acceder a esa área.'));
            \Response::redirect('/usuarios/login');
        }
    }

    public function action_index() {
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Ciudades &raquo; Index';
        $this->template->content = View::forge('ciudades/index', $data);
    }

    public function action_getciudades() {
        $param = \Input::param('query');        
        $ciudades = Model_Conf_Ciudade::query()->select('id', 'id_pais', 'ciudad')->where('ciudad', 'like', $param . '%')->get();                
        $data = array();
        foreach ($ciudades as $ciudad) {
            $nom = $ciudad->ciudad . ' - ' . $ciudad->conf_paises->nom_pais;
            $data[] = array('id' => $ciudad->id, 'name' => $nom);
        }        
        $content_type = array('Content-type' => 'application/json');
        return new \Response(json_encode($data), '200', $content_type);
    }

}
