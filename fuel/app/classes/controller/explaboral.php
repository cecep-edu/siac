<?php

class Controller_Explaboral extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Explaboral &raquo; Index';

        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $laborales = $personal->laboral;
        $data['laborales'] = $laborales;
        $this->template->content = View::forge('explaboral/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Explaboral &raquo; Create';
        $this->template->content = View::forge('explaboral/create', $data);

        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);

        $fieldset = Fieldset::forge()->add_model('Model_Explaboral')->repopulate();
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $laboral = new Model_Explaboral();
            $laboral->empresa = $fields['empresa'];
            $laboral->cargo = $fields['cargo'];
            $laboral->tiempo = $fields['tiempo'];
            $laboral->actividad = $fields['actividad'];
            $laboral->id_personal = $personal->id;

            if ($laboral->save()) {

                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('explaboral/index');
            }
        } else {
            // $this->template->messages = $fieldset->validation()->error();
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Explaboral &raquo; Edit';

        $laboral = Model_Explaboral::find($id);

        $fieldset = Fieldset::forge()->add_model('Model_Explaboral')->populate($laboral);
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $laboral->empresa = $fields['empresa'];
            $laboral->cargo = $fields['cargo'];
            $laboral->tiempo = $fields['tiempo'];
            $laboral->actividad = $fields['actividad'];

            if ($laboral->save()) {
                \Response::redirect('explaboral/index');
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }


        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id=null) {
//        $data["subnav"] = array('view' => 'active');
//        $this->template->title = 'Explaboral &raquo; View';
//        $this->template->content = View::forge('explaboral/view', $data);
        $laboral = Model_Explaboral::find($id);
        $laboral->delete();
        \Session::set_flash('siac-message', array('sucess' => 'Experiencia laboral eliminado con éxito.'));

        \Response::redirect('/explaboral');
    }

}
