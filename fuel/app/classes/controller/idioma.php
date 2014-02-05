<?php

class Controller_Idioma extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Idoma &raquo; Index';

        $idiomas = $personal->idioma;
        $data['niveles'] = array('1' => 'Básico', '2' => 'Intermedio', '3' => 'Avanzado');
        $data['idiomas'] = $idiomas;
        $this->template->content = View::forge('idioma/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);

        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Idoma &raquo; Create';

        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');
        $fieldset = Fieldset::forge()->add_model('Model_Idioma')->repopulate();
        $fieldset->field('id_institucion')->set_options($instituciones);
        $form = $fieldset->form();
        $fieldset->add_before('idioma', 'Idioma', array('type' => 'text', 'autocomplete' => 'off', 'class' => 'form-control'), array(), 'id_nivelescrito');
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $idioma = new Model_Idioma();
            $idioma->id_nivelescrito = $fields['id_nivelescrito'];
            $idioma->id_lenguaje = $fields['id_lenguaje'];
            $idioma->id_niveloral = $fields['id_niveloral'];
            $idioma->nombre_certificado = $fields['nombre_certificado'];
            $idioma->id_institucion = $fields['id_institucion'];
            $idioma->id_personal = $personal->id;
            if ($idioma->save()) {
                \Response::redirect('idioma/index');
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
            }
        } else {
            \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Idoma &raquo; Edit';

        $idioma = Model_Idioma::find(\Input::post($id));
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Idioma')->populate($idioma);

        $fieldset->field('id_institucion')->set_options($instituciones);
        $form = $fieldset->form();
        $fieldset->add('id', 'id', array('type' => 'hidden', 'value' => \Input::post('id')));

        $fieldset->add_before('idioma', 'Idioma', array('type' => 'text', 'value' => \Input::post('lenguaje'), 'autocomplete' => 'off', 'class' => 'form-control'), array(), 'id_nivelescrito');
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {

            $fields = $fieldset->validated();
            $idioma = Model_Idioma::find($fields['id']);
            $idioma->id_nivelescrito = $fields['id_nivelescrito'];
            $idioma->id_lenguaje = $fields['id_lenguaje'];
            $idioma->id_niveloral = $fields['id_niveloral'];
            $idioma->nombre_certificado = $fields['nombre_certificado'];
            $idioma->id_institucion = $fields['id_institucion'];
            if ($idioma->save()) {
                \Response::redirect('idioma/index');
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
            } else {
                \Session::set_flash('siac-message', array('danger' => 'Los cambios no se han guardado.'));
            }
        } else {
            $fieldset->repopulate();
            $fields = $fieldset->validated();
            if ($fields['submit'] != null) {
                \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
            }
        }
        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {
        $idioma = Model_Idioma::find(\Security::xss_clean($id));
        $idioma->delete();
        \Response::redirect('/idioma');
        \Session::set_flash('siac-message', array('success' => 'Idioma ha sido eliminado con éxito.'));
    }

    public function action_getIdiomas() {
        $param = Security::xss_clean(\Input::param('query')); //limpio el parámetro
        $lenguajes = Model_Lenguaje::query()->select('id', 'nombre')->where('nombre', 'like', $param . '%')->get();
        $data = array();
        foreach ($lenguajes as $lenguaje) {
            $data[] = array('id' => $lenguaje->id, 'name' => $lenguaje->nombre);
        }
        $content_type = array('Content-type' => 'application/json');
        return new \Response(json_encode($data), '200', $content_type);
    }

}
