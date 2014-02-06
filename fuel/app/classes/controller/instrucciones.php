<?php

class Controller_Instrucciones extends Controller_Template {

    public function action_index() {

        $id_auth = Auth::get_user_id();
        $perfil = Model_Informacion_Personal::find_by_usuario_id($id_auth[1]);

        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Instrucciones &raquo; Index';

        $instrucciones = $perfil->instrucciones;

        if ($instrucciones === null) {
            \Response::redirect('/instrucciones/create');
        } else {
            $data["instrucciones"] = $instrucciones;
            $this->template->content = View::forge('instrucciones/index', $data);
        }
    }

    public function action_create() {
        //Se obtiene el id del usuario logueado
        $id_auth = Auth::get_user_id();
        $perfil = Model_Informacion_Personal::find_by_usuario_id($id_auth[1]);

        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Instrucciones &raquo; Create';
        $this->template->content = View::forge('instrucciones/create', $data);

        //Se cargan todos los niveles disponibles, se convierte en array y carga a la lista
        $niveles = Model_Conf_Nivel::find('all');
        $niveles = \Fuel\Core\Arr::assoc_to_keyval($niveles, 'id', 'nombre');

        //Se crea objetos para el autocompletado o seleccion de datos        
        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion');
        $fieldset->field('id_perfil')->set_value($perfil->id);
        $fieldset->field('id_nivel')->set_options($niveles);

        $form = $fieldset->form();

        //Se añaden cajas de texto para el autocompletado en la forma
        $fieldset->add_after('institucion', 'Institucion', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba el nombre de la institución educativa",), array(), 'id_nivel');
        $fieldset->add_after('especializacion', 'Especializacion', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba la especialización",), array(), 'institucion');
        $fieldset->add_after('titulo', 'Titulo', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba el título obtenido",), array(), 'especializacion');

        $form->add('crear', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary btn-sm active'));
        $form->add('cancelar', '', array('type' => 'button', 'value' => 'Cancelar', 'class' => 'btn btn-default btn-sm', 'onclick' => "location.href='http://siac.iaen/infopersonal/index'"));

        $instruccion = new Model_Conf_Instruccion();

        //Guarda el nuevo registro si los datos pasan la validación
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $instruccion = new Model_Conf_Instruccion();
            $instruccion->id_perfil = $perfil->id;
            $instruccion->id_nivel = $fields['id_nivel'];
            $instruccion->id_institucion = $fields['id_institucion'];
            $instruccion->id_especializacion = $fields['id_especializacion'];
            $instruccion->id_titulo = $fields['id_titulo'];
            $instruccion->registro_oficial = $fields['registro_oficial'];
            if ($instruccion->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('instrucciones/index');
            } else {
                \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
            }
        } else {
            \Session::set_flash('siac-message', array('danger' => $fieldset->validation()->show_errors()));
        }
        $this->template->set('content', $form->build(), false);
    }

    public function action_edit() {
        //Se obtiene el id del usuario logueado
        $id_auth = Auth::get_user_id();
        //Se consulta el perfil del usuario logueado
        $perfil = Model_Informacion_Personal::find_by_usuario_id($id_auth[1]);
        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Instrucciones &raquo; Edit';

        //Consulta la instruccion perteneciente al id que ingresa por _POST
        $instruccion = \Model_Conf_Instruccion::find(\Input::post('id'));

        //Crea y renderiza el formulario con los datos consultados (populate)
        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion')->populate($instruccion);
        $form = $fieldset->form();

        //Se añaden cajas de texto en la forma para guardar el id del registro, para el autocompletado y para las listas desplegables
        $form->add('id', '', array('type' => 'hidden', 'value' => \Input::post('id')));
        $fieldset->add_after('institucion', 'Institucion', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba el nombre de la institución educativa",), array(), 'id_nivel');
        $fieldset->add_after('especializacion', 'Especializacion', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba la especialización",), array(), 'institucion');
        $fieldset->add_after('titulo', 'Titulo', array('type' => 'text', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => "Escriba el título obtenido",), array(), 'especializacion');

        $form->add('submit', 'Aceptar', array('type' => 'submit', 'value' => 'Guardar', 'class' => 'btn medium primary'));
        $form->add('cancelar', '', array('type' => 'submit', 'value' => 'Cancelar', 'class' => 'btn medium primary', 'action' => '/infopersonal/index'));

        //Se cargan todos los niveles disponibles, se convierte en array y carga a la lista
        $niveles = Model_Conf_Nivel::find('all');
        $niveles = \Fuel\Core\Arr::assoc_to_keyval($niveles, 'id', 'nombre');
        $fieldset->field('id_nivel')->set_options($niveles);

        //Llena las cajas de texto con los nombres que llegan por _POST
        $fieldset->field('institucion')->set_value(\Input::post('institucion'));
        $fieldset->field('especializacion')->set_value(\Input::post('especializacion'));
        $fieldset->field('titulo')->set_value(\Input::post('titulo'));

        //Guarda el nuevo registro si los datos pasan la validación
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            //Carga los datos pertenecientes al id de la caja de texto oculta
            $institucion = Model_Conf_Instruccion::find($fields['id']);
            $instruccion->id_perfil = $perfil->id;
            $instruccion->id_nivel = $fields['id_nivel'];
            $instruccion->id_institucion = $fields['id_institucion'];
            $instruccion->id_especializacion = $fields['id_especializacion'];
            $instruccion->id_titulo = $fields['id_titulo'];
            $instruccion->registro_oficial = $fields['registro_oficial'];

            if ($instruccion->save()) {
                \Session::set_flash('siac-message', array('success' => 'Los cambios se han guardado.'));
                \Response::redirect('instrucciones/index');
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

        $instruccion = \Model_Conf_Instruccion::find($id);
        $instruccion->delete();
        // Informar al usuario de que la eliminación de usuario fué correcta
        \Session::set_flash('siac-message', array('success' => 'Instrucción ha sido eliminado con éxito.'));
        \Response::redirect('/instrucciones/index');
    }

    public function action_view() {
        $data["subnav"] = array('view' => 'active');
        $this->template->title = 'Instrucciones &raquo; View';
        $this->template->content = View::forge('instrucciones/view', $data);
    }

}
