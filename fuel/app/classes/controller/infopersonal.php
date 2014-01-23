<?php

class Controller_Infopersonal extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id();//user[1]: es el id del usuario registrado.
        $flag=\Model_Informacion_Personal::query()->where('usuario_id','=',$usuario[1])->count();
        $data["flag"] =$flag;//return true or false; true=>si tiene registros , false lo contrario.
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Infopersonal &raquo; Index';
        $this->template->content = View::forge('infopersonal/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id();//user[1]: es el id del usuario registrado.
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Infopersonal &raquo; Create';
        $this->template->content = View::forge('infopersonal/create', $data);
        
       

        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->repopulate();
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            $personal = new Model_Informacion_Personal();
            $personal->nombre = $fields['nombre'];
            $personal->apellido = $fields['apellido'];
            $personal->identificador = $fields['identificador'];
            $personal->tipo_identificador = $fields['tipo_identificador'];
            $personal->pais_id = 2;//$fields['pais_id']
            $personal->ciudad_residencia_id = 2;//$fields['ciudad_residencia_id'];
            $personal->direccion = $fields['direccion'];
            $personal->telefono = $fields['telefono'];
            $personal->correo = $fields['correo'];
            $personal->conadis = $fields['conadis'];
            $personal->ruta_foto = $fields['ruta_foto'];
            $personal->usuario_id=$usuario[1];

            if ($personal->save()) {
                \Response::redirect('infopersonal/index');
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit() {
        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Infopersonal &raquo; Edit';
        $this->template->content = View::forge('infopersonal/edit', $data);
        //$id solo cuando recibes
        $user = \Auth::instance()->get_user_id();//user[1]: es el id del usuario registrado.
     
        $personal = \Model_Informacion_Personal::query()->where('usuario_id','=',$user[1])->get_one();

        //$personal = \Model_Informacion_Personal::find(1);


        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->populate($personal);
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            //$post = new Model_Persona;
            $personal->nombre = $fields['nombre'];
            $personal->apellido = $fields['apellido'];
            $personal->identificador = $fields['identificador'];
            $personal->tipo_identificador = $fields['tipo_identificador'];
            $personal->pais_id = $fields['pais_id'];
            $personal->ciudad_residencia_id = $fields['ciudad_residencia_id'];
            $personal->direccion = $fields['direccion'];
            $personal->telefono = $fields['telefono'];
            $personal->correo = $fields['correo'];
            $personal->conadis = $fields['conadis'];
            $personal->ruta_foto = $fields['ruta_foto'];

            if ($personal->save()) {
                \Response::redirect('infopersonal/index');
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }

        $this->template->set('content', $form->build(), false);
    }

    public function action_view() {
        $data["subnav"] = array('view' => 'active');
        $this->template->title = 'Infopersonal &raquo; View';
        $this->template->content = View::forge('infopersonal/view', $data);
    }

}
