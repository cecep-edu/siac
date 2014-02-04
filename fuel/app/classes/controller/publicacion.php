<?php

class Controller_Publicacion extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Publicacion &raquo; Index';
        $publicaciones = $personal->publicacion;
        $data['publicaciones'] = $publicaciones;
        $this->template->content = View::forge('publicacion/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);

        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Publicacion &raquo; Create';


        $tproducciones = Model_Tproduccion::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '=', 3)->get();


        $tproducciones = \Arr::assoc_to_keyval($tproducciones, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Publicacion')->repopulate();
        $fieldset->field('id_tproduccion')->set_options($tproducciones);
        $fieldset->field('id_editorial')->set_options($instituciones);

        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $publicacion = new Model_Publicacion();
            $publicacion->id_personal = $personal->id;
            $publicacion->id_tproduccion = $fields['id_tproduccion'];
            $publicacion->id_editorial = $fields['id_editorial'];
            $publicacion->titulo = $fields['titulo'];
            $publicacion->isbn = $fields['isbn'];
            $publicacion->observacion = $fields['observacion'];

            if ($publicacion->save()) {
                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('publicacion/index');
            }
        } else {
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $this->template->title = 'Publicación; Editar';
        $publicacion = Model_Publicacion::find(\Input::post($id));

        $tproducciones = Model_Tproduccion::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '=', 3)->get();

        $tproducciones = \Arr::assoc_to_keyval($tproducciones, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Publicacion')->populate($publicacion);
        $fieldset->field('id_tproduccion')->set_options($tproducciones);
        $fieldset->field('id_editorial')->set_options($instituciones);

        $form = $fieldset->form();
        $fieldset->add('id', 'id', array('type' => 'hidden', 'value' => \Input::post('id')));
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $publicacion = Model_Publicacion::find($fields['id']);
            $publicacion->id_tproduccion = $fields['id_tproduccion'];
            $publicacion->id_editorial = $fields['id_editorial'];
            $publicacion->titulo = $fields['titulo'];
            $publicacion->isbn = $fields['isbn'];
            $publicacion->observacion = $fields['observacion'];

            if ($publicacion->save()) {
                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('publicacion/index');
            }
        } else {
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {
        $publicacion = Model_Publicacion::find( Security::xss_clean($id));
        $publicacion->delete();
        \Session::set_flash('siac-message', array('sucess' => 'Publicación eliminada con éxito.'));
        \Response::redirect('publicacion/index');
    }

}
