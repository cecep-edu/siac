<?php

class Controller_Tesis extends Controller_Template {

    public function action_index() {

        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Tesis &raquo; Index';
        $tesis = $personal->tesis;
        $data['tesis'] = $tesis;
        $this->template->content = View::forge('tesis/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Tesis &raquo; Create';

        $ambitos = Model_Ambito::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '=', 4)->get();

        $ambitos = \Arr::assoc_to_keyval($ambitos, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Tesi')->repopulate();
        $fieldset->field('id_ambito')->set_options($ambitos);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $tesis = new Model_Tesi();
            $tesis->id_personal = $personal->id;
            $tesis->id_ambito = $fields['id_ambito'];
            $tesis->id_institucion = $fields['id_institucion'];
            $tesis->titulo = $fields['titulo'];
            $tesis->anio = $fields['anio'];

            if ($tesis->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('tesis/index');
            } else {
                \Session::set_flash('siac-message', array('danger' => 'Los cambios no se han guardado.'));
            }
        } else {
            \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $this->template->title = 'Tésis &raquo; Edit';
        $tesis = Model_Tesi::find(\Input::post($id));
        $ambitos = Model_Ambito::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '!=', 3)->get();

        $ambitos = \Arr::assoc_to_keyval($ambitos, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Tesi')->populate($tesis);
        $fieldset->field('id_ambito')->set_options($ambitos);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $fieldset->add('id', 'id', array('type' => 'hidden', 'value' => \Input::post('id')));
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualziar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $tesis = Model_Tesi::find($fields['id']);
            $tesis->id_ambito = $fields['id_ambito'];
            $tesis->id_institucion = $fields['id_institucion'];
            $tesis->titulo = $fields['titulo'];
            $tesis->anio = $fields['anio'];

            if ($tesis->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('tesis/index');
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
        $tesis = Model_Tesi::find(Security::xss_clean($id));
        $tesis->delete($id);
        \Session::set_flash('siac-message', array('success' => 'Tesis eliminada con éxito.'));
        \Response::redirect('tesis/index');
    }

}
