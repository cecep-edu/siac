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

        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);

        $fieldset = Fieldset::forge()->add_model('Model_Explaboral')->repopulate();
        $fieldset->field('id_empresa')->set_options($instituciones);
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $laboral = new Model_Explaboral();
            $laboral->id_empresa = $fields['id_empresa'];
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

        $laboral = Model_Explaboral::find(\Input::post($id));
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Explaboral')->populate($laboral);
        $fieldset->field('id_empresa')->set_options($instituciones);
        $form = $fieldset->form();
        $fieldset->add('id', 'id', array('type' => 'hidden', 'value' => \Input::post('id')));
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $laboral = Model_Explaboral::find($fields['id']);
            $laboral->id_empresa = $fields['id_empresa'];
            $laboral->cargo = $fields['cargo'];
            $laboral->tiempo = $fields['tiempo'];
            $laboral->actividad = $fields['actividad'];

            if ($laboral->save()) {
                \Response::redirect('explaboral/index');
            }else{
                 \Session::set_flash('siac-message', array('warning' => 'Los cambios no se han guardado.'));
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
            
        }


        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {
        $laboral = Model_Explaboral::find(Security::xss_clean($id));
        $laboral->delete();
        \Session::set_flash('siac-message', array('sucess' => 'Experiencia laboral eliminado con éxito.'));

        \Response::redirect('/explaboral');
    }

}
