<?php

class Controller_Instituciones extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Instituciones &raquo; Index';
		$this->template->content = View::forge('instituciones/index', $data);
	}
        
        
        public function action_getinstituciones()
        {
            $param=Input::param('query');
            $instituciones=  Model_Conf_Institucion::query()->select('id','nombre')->where('nombre','like', $param . "%")->get();
            $data=array();
            foreach($instituciones as $instituto):
                $data[]=array('id'=>$instituto->id,'name'=>$instituto->nombre);                
            endforeach;
            $content_type=array('Content-type'=>'aplication/json');
            return new \Response(json_encode($data),'200',$content_type);
        }
        
      
}
