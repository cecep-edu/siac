<?php

class Controller_Instrucciones extends Controller_Template {

    public function action_index() {
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Instrucciones &raquo; Index';
        $data["instruccion"] = Model_Conf_Instruccion::find('all');
        $this->template->content = View::forge('instrucciones/index', $data);
    }

    public function action_create() {
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Instruccione &raquo; Create';
        $this->template->content = View::forge('instrucciones/create', $data);

        //se crea lo forma de ingreso de una nueva instrucción
        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion');
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn medium primary'));

        //Guarda el nuevo registro si los datos pasan la validación
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $instruccion = new Model_Conf_Instruccion();
            $instruccion->id_usuario = $fields['id_usuario'];
            $instruccion->id_nivel = $fields['id_nivel'];
            $instruccion->id_institucion = $fields['id_nivel'];
            $instruccion->id_especializacion = $fields['id_especializacion'];
            $instruccion->id_titulo = $fields['id_titulo'];
            $instruccion->registro_oficial = $fields['registro_oficial'];

            if ($instruccion->save()) {
                \Response::redirect('instrucciones/index');
            } else {
                $this->template->messages = "No se ha n podido guardar los datos. Intente nuevamente";
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit($id = null) {
        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Instrucciones &raquo; Edit';
        $this->template->content = View::forge('instrucciones/edit', $data);

        $instruccion = \Model_Conf_Instruccion::find($id);

        $fieldset = Fieldset::forge()->add_model('Model_Conf_Instruccion')->populate($instruccion);
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Guardar', 'class' => 'btn medium primary'));

        //Guarda el nuevo registro si los datos pasan la validación
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            $instruccion->id_usuario = $fields['id_usuario'];
            $instruccion->id_nivel = $fields['id_nivel'];
            $instruccion->id_institucion = $fields['id_nivel'];
            $instruccion->id_especializacion = $fields['id_especializacion'];
            $instruccion->id_titulo = $fields['id_titulo'];
            $instruccion->registro_oficial = $fields['registro_oficial'];

            if ($instruccion->save()) {
                \Response::redirect('instrucciones/index');
            } else {
                $this->template->messages = "No se ha n podido guardar los datos. Intente nuevamente";
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }



        $this->template->set('content', $form->build(), false);
    }
        
    public function action_delete($id=null) {
        
        $instruccion = \Model_Conf_Instruccion::find($id);
        $instruccion->delete();
        
        // informar al usuario de que la eliminación de usuario fué correcta
	\Session::set_flash('siac-message', array('sucess' => 'Usuario eliminado con éxito.'));
        \Response::redirect('instrucciones/');
        
    }
    
    
    
    
    public function action_view() {
        $data["subnav"] = array('view' => 'active');
        $this->template->title = 'Instrucciones &raquo; View';
        $this->template->content = View::forge('instrucciones/view', $data);
    }

}
