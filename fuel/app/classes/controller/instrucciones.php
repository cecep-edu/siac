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

        $id_auth = Auth::get_user_id();
        $perfil = Model_Informacion_Personal::find_by_usuario_id($id_auth[1]);

        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Instruccione &raquo; Create';
        $this->template->content = View::forge('instrucciones/create', $data);

        $niveles = Model_Conf_Nivel::find('all');
        $niveles = \Fuel\Core\Arr::assoc_to_keyval($niveles, 'id', 'nombre');

        //Se crea objetos para el autocompletado o seleccion de datos        
        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion');        
        $fieldset->field('id_perfil')->set_value($perfil->id);
        $fieldset->field('id_nivel')->set_options($niveles);
        

        $form = $fieldset->form();
        
        $fieldset->add_after('institucion','Institucion',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba el nombre de la institución educativa",), array(),'id_nivel');
        $fieldset->add_after('especializacion','Especializacion',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba la especialización",), array(), 'institucion');
        $fieldset->add_after('titulo','Titulo',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba el título obtenido",), array(), 'especializacion');
        
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
                \Response::redirect('infopersonal/index');
            } else {
                $this->template->messages = "No se ha n podido guardar los datos. Intente nuevamente";
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
              \Session::set_flash('siac-message', array('warning' => $fieldset->validation()->error()));
        }
        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {

        $id_auth = Auth::get_user_id();
        $perfil = Model_Informacion_Personal::find_by_usuario_id($id_auth[1]);

        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Instrucciones &raquo; Edit';
        $instruccion = \Model_Conf_Instruccion::find($id);
        
        $institucion = $instruccion->conf_instituciones;
        $especializacion=$instruccion->conf_especializaciones;
        $titulo=$instruccion->conf_titulos;
      
        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion')->populate($instruccion);
        $form = $fieldset->form();
        $form->add('aceptar', '', array('type' => 'submit', 'value' => 'Guardar', 'class' => 'btn medium primary'));
        $form->add('cancelar', '', array('type' => 'submit', 'value' => 'Cancelar', 'class' => 'btn medium primary', 'action' => '/infopersonal/index'));
        
        $fieldset->add_after('institucion','Institucion',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba el nombre de la institución educativa",), array(),'id_nivel');
        $fieldset->add_after('especializacion','Especializacion',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba la especialización",), array(), 'institucion');
        $fieldset->add_after('titulo','Titulo',array('type'=>'text','class'=>'form-control','autocomplete'=>'off','placeholder'=>"Escriba el título obtenido",), array(), 'especializacion');
        
        $niveles = Model_Conf_Nivel::find('all');
        $niveles = \Fuel\Core\Arr::assoc_to_keyval($niveles, 'id', 'nombre');
        $fieldset->field('id_nivel')->set_options($niveles);
        
        $fieldset->field('institucion')->set_value($institucion->nombre);
        $fieldset->field('especializacion')->set_value($especializacion->nombre);
        $fieldset->field('titulo')->set_value($titulo->nombres);
        
        
        //Guarda el nuevo registro si los datos pasan la validación
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $instruccion->id_perfil = $perfil->id;
            $instruccion->id_nivel = $fields['id_nivel'];
            $instruccion->id_institucion = $fields['id_institucion'];
            $instruccion->id_especializacion = $fields['id_especializacion'];
            $instruccion->id_titulo = $fields['id_titulo'];
            $instruccion->registro_oficial = $fields['registro_oficial'];

            if ($instruccion->save()) {
                \Response::redirect('infopersonal/');
            } else {
                $this->template->messages = "No se ha n podido guardar los datos. Intente nuevamente";
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }
        $this->template->set('content', $form->build(), false);
    }

    public function action_delete($id = null) {

        $instruccion = \Model_Conf_Instruccion::find($id);
        $instruccion->delete();
        // Informar al usuario de que la eliminación de usuario fué correcta
        \Session::set_flash('siac-message', array('sucess' => 'Usuario eliminado con éxito.'));
        \Response::redirect('/instrucciones/index');
        
    }

    public function action_view() {
        $data["subnav"] = array('view' => 'active');
        $this->template->title = 'Instrucciones &raquo; View';
        $this->template->content = View::forge('instrucciones/view', $data);
    }

}
