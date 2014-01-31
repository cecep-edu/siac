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

                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('histcapacitacion/index');
            }
        } else {
            // $this->template->messages = $fieldset->validation()->error();
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {

        $this->template->title = 'Histcapacitacion &raquo; Editr';

        $capacitacion = Model_Histcapacitacion::find($id);

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
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $capacitacion->nom_evento = $fields['nom_evento'];
            $capacitacion->id_institucion = $fields['id_institucion'];
            $capacitacion->anio = $fields['anio'];
            $capacitacion->id_tpcapacitacion = $fields['id_tpcapacitacion'];
            $capacitacion->duracion = $fields['duracion'];
            $capacitacion->id_tpcertificado = $fields['id_tpcertificado'];

            if ($capacitacion->save()) {
                \Response::redirect('histcapacitacion/index');
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {
        $capacitacion = Model_Histcapacitacion::find($id);
        try{
             $capacitacion->delete();
        }  catch (\Oil\Exception $e){
            echo $e->getMessage();
        }
       
        //\Session::set_flash('siac-message', array('sucess' => 'Capacitación eliminado con éxito.'));
        \Response::redirect('histcapacitacion/index');
    }

}
