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
        $this->template->content = View::forge('infopersonal/create', $data);

        $config = array(
            'path' => DOCROOT . 'uploads/',
            'ext_whitelist' => array('gif', 'jpg', 'png'),
            'max_size' => 500 * 1024,
        );
        $path = $_SERVER['DOCUMENT_ROOT'];


        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->repopulate();
        $fieldset->set_config('form_attributes', array('enctype' => 'multipart/form-data'));
        $form = $fieldset->form();
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Crear', 'class' => 'btn btn-primary'));
        //$form->add('files', 'Files', array('type' => 'file'));

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
                $personal->pais_id = 2; //$fields['pais_id']
                $personal->ciudad_residencia_id = 2; //$fields['ciudad_residencia_id'];
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

        $this->template->set('content', $form->build(), false);
    }

    public function action_edit() {
        $user = \Auth::instance()->get_user_id(); //user[1]: es el id del usuario registrado.

        $data["subnav"] = array('edit' => 'active');
        $this->template->title = 'Infopersonal &raquo; Edit';
        $this->template->content = View::forge('infopersonal/edit', $data);
        
        $config = array(
            'path' => DOCROOT . 'uploads/',
            'ext_whitelist' => array('gif', 'jpg', 'png'),
            'max_size' => 500 * 1024,
        );
        $path = $_SERVER['DOCUMENT_ROOT'];

        $personal = \Model_Informacion_Personal::query()->where('usuario_id', '=', $user[1])->get_one();
        $fieldset = Fieldset::forge()->add_model('Model_Informacion_Personal')->populate($personal);
        $form = $fieldset->form();
        $fieldset->set_config('form_attributes', array('enctype' => 'multipart/form-data'));
        $form->add('submit', '', array('type' => 'submit', 'value' => 'Actualizar', 'class' => 'btn btn-primary'));

        if ($fieldset->validation()->run() == true) {
            $fields = $fieldset->validated();

            Upload::process($config);
            if (Upload::is_valid()) {
                $result = Upload::get_files();
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
                $img_nombre = $fields['identificador'] . '.' . $result[0]['extension'];
                $personal->ruta_foto = $fields['ruta_foto'];
                
                 Upload::save();

                File::rename($path . '/uploads/' . $result[0]['name'], $path . '/uploads/' . $img_nombre);
                
                if ($personal->save()) {
                    \Response::redirect('infopersonal/index');
                }
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
