<?php

class Controller_Infopersonal extends Controller_Template {

    public function action_index() {
        $usuario = \Auth::instance()->get_user_id(); //user[1]: es el id del usuario registrado.
        $flag = \Model_Informacion_Personal::query()->where('usuario_id', '=', $usuario[1])->count();
        $data["flag"] = $flag; //return true or false; true=>si tiene registros , false lo contrario.
        $data["subnav"] = array('index' => 'active');
        $this->template->title = 'Infopersonal &raquo; Index';
        $this->template->content = View::forge('infopersonal/index', $data);
    }

    public function action_create() {
        $usuario = \Auth::instance()->get_user_id(); //user[1]: es el id del usuario registrado.
        $data["subnav"] = array('create' => 'active');
        $this->template->title = 'Infopersonal &raquo; Create';

        $view=View::forge('infopersonal/create', $data);
        $config = array(
            'path' => DOCROOT . 'uploads/',
            'ext_whitelist' => array('gif', 'jpg','jpeg', 'png'),
            'max_size' => 500 * 1024,
        );
        $path = $_SERVER['DOCUMENT_ROOT'];


        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->repopulate();
        $fieldset->set_config('form_attributes', array('enctype' => 'multipart/form-data'));
        $form = $fieldset->form();
        $fieldset->add_after('pais', 'Pais', array('type'=>'text','class'=>'form-control'), array(), 'tipo_identificador');
        $fieldset->add_before('ciudad', 'Ciudad', array('type'=>'text','class'=>'form-control'), array(), 'direccion');
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));
        

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();
            Upload::process($config);
            if (Upload::is_valid()) {
                $result = Upload::get_files();

                $personal = new Model_Informacion_Personal();
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
                $img_nombre = $fields['identificador'] . '.' . $result[0]['extension'];
                $personal->ruta_foto = $img_nombre;
                $personal->usuario_id = $usuario[1];
                Upload::save();

                File::rename($path . '/uploads/' . $result[0]['name'], $path . '/uploads/' . $img_nombre);
                if ($personal->save()) {
                    \Response::redirect('infopersonal/index');
                }
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }

        //$view->set('content', $form->build(), false);
        $this->template->set('content', $form->build(), false);
        //$this->template->content =$view;
    }

    public function action_edit() {
        $user = \Auth::instance()->get_user_id(); //user[1]: es el id del usuario registrado.

        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Infopersonal &raquo; Edit';
    
        //$view=View::forge('infopersonal/edit', $data);

        $config = array(
            'path' => DOCROOT . 'uploads/',
            'ext_whitelist' => array('gif', 'jpg','jpeg', 'png'),
            'max_size' => 500 * 1024,
        );
        $path = $_SERVER['DOCUMENT_ROOT'];

        $personal = \Model_Informacion_Personal::query()->where('usuario_id', '=', $user[1])->get_one();
        $pais=$personal->conf_paises;
        $ciudad=$personal->conf_ciudades;
        $nom=$ciudad->ciudad.' - '.$ciudad->conf_paises->nom_pais;
        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->populate($personal);
        $fieldset->add('legend')->set_template('<legend>Perfil Profesional</legend>');
        $fieldset->add_after('pais', 'País', array('type'=>'text','value'=>$pais->nom_pais,'class'=>'form-control'), array(), 'tipo_identificador');
        $fieldset->add_before('ciudad', 'Ciudad', array('type'=>'text','value'=>$nom,'class'=>'form-control'), array(), 'direccion');
        $form = $fieldset->form();
        
        
        $fieldset->set_config('form_attributes', array('enctype' => 'multipart/form-data'));
        
         $form->add('foto_perfil','Foto',array('type'=>'image','src'=> '/uploads/'.$personal->ruta_foto));
        
         // $fieldset->add('pais_id','país',array('type'=>'text','class'=>"form-control")); 
          //$fieldset->field('pais_id')->set_type('text');
          //$form->add('search','',array('type'=>'text','class'=>"form-control" ));
        
       
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));
       
        
        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            Upload::process($config);

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

            if (Upload::is_valid()) {
                $result = Upload::get_files();
                $img_nombre = $fields['identificador'] . '.' . $result[0]['extension'];
                $personal->ruta_foto = $img_nombre;
                Upload::save();
                File::rename($path . '/uploads/' . $result[0]['name'], $path . '/uploads/' . $img_nombre);
            }

            if ($personal->save()) {
                \Response::redirect('infopersonal/index');
            }
        } else {
            $this->template->messages = $fieldset->validation()->error();
        }
        
        $this->template->content = View::forge('infopersonal/edit', $data);
        $this->template->set('content', $form->build(), false);
         //$this->template->content=$view;
    }

    public function action_view() {
        $user = \Auth::instance()->get_user_id(); //user[1]
        $personal = \Model_Informacion_Personal::query()->where('usuario_id', '=', $user[1])->get_one();
        $data["subnav"] = array('view' => 'active');
        $data['personal']=$personal;
        $this->template->title = 'Infopersonal &raquo; View';
        $this->template->content = View::forge('infopersonal/view', $data);
    }

}
