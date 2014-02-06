<?php

class Controller_Histcapacitacion extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Histcapacitacion &raquo; Index';

        $data['capacitaciones'] = $personal->capacitacion;
        $this->template->content = View::forge('histcapacitacion/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $this->template->title = 'Histcapacitacion &raquo; Create';
        $tpcertificados = Model_Tipocertificado::find('all');
        $tpcapacitaciones = Model_Tpcapacitacion::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();

        $tpcertificados = \Arr::assoc_to_keyval($tpcertificados, 'id', 'nombre');
        $tpcapacitaciones = \Arr::assoc_to_keyval($tpcapacitaciones, 'id', 'nom_capa');
        $instituciones = Fuel\Core\Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Histcapacitacion')->repopulate();
        $fieldset->field('id_tpcertificado')->set_options($tpcertificados);
        $fieldset->field('id_tpcapacitacion')->set_options($tpcapacitaciones);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $capacitacion = new Model_Histcapacitacion();
            $capacitacion->nom_evento = $fields['nom_evento'];
            $capacitacion->id_institucion = $fields['id_institucion'];
            $capacitacion->id_personal = $personal->id;
            $capacitacion->anio = $fields['anio'];
            $capacitacion->id_tpcapacitacion = $fields['id_tpcapacitacion'];
            $capacitacion->duracion = $fields['duracion'];
            $capacitacion->id_tpcertificado = $fields['id_tpcertificado'];

            if ($capacitacion->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('histcapacitacion/index');
            }
        } else {
            \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {

        $this->template->title = 'Histcapacitacion &raquo; Editr';

        $capacitacion = Model_Histcapacitacion::find(\Input::post($id));

        $tpcertificados = Model_Tipocertificado::find('all');
        $tpcapacitaciones = Model_Tpcapacitacion::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->get();

        $tpcertificados = \Arr::assoc_to_keyval($tpcertificados, 'id', 'nombre');
        $tpcapacitaciones = \Arr::assoc_to_keyval($tpcapacitaciones, 'id', 'nom_capa');
        $instituciones = Fuel\Core\Arr::assoc_to_keyval($instituciones, 'id', 'nombre');



        $fieldset = Fieldset::forge()->add_model('Model_Histcapacitacion')->populate($capacitacion);
        $fieldset->field('id_tpcertificado')->set_options($tpcertificados);
        $fieldset->field('id_tpcapacitacion')->set_options($tpcapacitaciones);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $fieldset->add('id', 'id', array('type' => 'hidden', 'value' => \Input::post('id')));
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $capacitacion = Model_Histcapacitacion::find($fields['id']);

            $capacitacion->nom_evento = $fields['nom_evento'];
            $capacitacion->id_institucion = $fields['id_institucion'];
            $capacitacion->anio = $fields['anio'];
            $capacitacion->id_tpcapacitacion = $fields['id_tpcapacitacion'];
            $capacitacion->duracion = $fields['duracion'];
            $capacitacion->id_tpcertificado = $fields['id_tpcertificado'];

            if ($capacitacion->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('histcapacitacion/index');
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
        $capacitacion = Model_Histcapacitacion::find(Security::xss_clean($id));
        $capacitacion->delete();
        \Session::set_flash('siac-message', array('sucess' => 'Capacitación eliminado con éxito.'));
        \Response::redirect('histcapacitacion/index');
    }

}
