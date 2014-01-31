<?php

class Controller_Proyecto extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Proyecto &raquo; Index';
        $proyectos = $personal->proyecto;
        $data['proyectos'] = $proyectos;
        $this->template->content = View::forge('proyecto/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Proyecto &raquo; Create';

        $ambitos = Model_Ambito::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '!=', 3)->get();

        $ambitos = \Arr::assoc_to_keyval($ambitos, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Proyecto')->repopulate();
        $fieldset->field('id_ambito')->set_options($ambitos);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $proyecto = new Model_Proyecto();
            $proyecto->id_personal = $personal->id;
            $proyecto->nombre = $fields['nombre'];
            $proyecto->id_ambito = $fields['id_ambito'];
            $proyecto->id_institucion = $fields['id_institucion'];
            $proyecto->anio = $fields['anio'];
            $proyecto->duracion = $fields['duracion'];

            if ($proyecto->save()) {
                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('proyecto/index');
            }
        } else {
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $usuario = \Auth::instance()->get_user_id();
        $personal = Model_Informacion_Personal::find_by_usuario_id($usuario[1]);

        $this->template->title = 'Proyecto &raquo; Edit';
        $proyecto = Model_Proyecto::find($id);
        $ambitos = Model_Ambito::find('all');
        $instituciones = Model_Conf_Institucion::query()->select('id', 'nombre', 'id_tpempresa')->where('id_tpempresa', '!=', 3)->get();

        $ambitos = \Arr::assoc_to_keyval($ambitos, 'id', 'nombre');
        $instituciones = Arr::assoc_to_keyval($instituciones, 'id', 'nombre');

        $fieldset = Fieldset::forge()->add_model('Model_Proyecto')->populate($proyecto);
        $fieldset->field('id_ambito')->set_options($ambitos);
        $fieldset->field('id_institucion')->set_options($instituciones);

        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualziar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $proyecto->nombre = $fields['nombre'];
            $proyecto->id_ambito = $fields['id_ambito'];
            $proyecto->id_institucion = $fields['id_institucion'];
            $proyecto->anio = $fields['anio'];
            $proyecto->duracion = $fields['duracion'];

            if ($proyecto->save()) {
                Session::set_flash('success', 'Se han guardado los cambios.');
                \Response::redirect('proyecto/index');
            }
        } else {
            Session::set_flash('error', 'Algunos campos faltan por rellenar.');
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {
        $proyecto = Model_Proyecto::find($id);
        $proyecto->delete();
        \Session::set_flash('siac-message', array('sucess' => 'Proyecto eliminado con éxito.'));
        \Response::redirect('proyecto/index');
    }

}
