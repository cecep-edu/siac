<?php

class Controller_Especializaciones extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Especializaciones &raquo; Index';
		$this->template->content = View::forge('especializaciones/index', $data);
	}
        
        public function action_getespecializaciones()
        {
            $param=Input::param('query');
            $especializaciones= Model_Conf_Especializacion::query()->select('id','nombre')->where('nombre','like', $param . "%")->get();
            $data=array();
            foreach($especializaciones as $especializacion):                
                $data[]=array('id'=>$especializacion->id,'name'=>$especializacion->nombre);                
            endforeach;
            $content_type=array('Content-type'=>'aplication/json');
            return new \Response(json_encode($data),'200',$content_type);
        }
}
