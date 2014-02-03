<?php

class Controller_Titulos extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Titulos &raquo; Index';
		$this->template->content = View::forge('titulos/index', $data);
	}
        
        public function action_gettitulos()
        {
            $param=Input::param('query');
            $titulos= Model_Conf_Titulo::query()->select('id','nombres')->where('nombres','like', $param . "%")->get();
            $data=array();
            foreach($titulos as $titulo):                
                $data[]=array('id'=>$titulo->id,'name'=>$titulo->nombres);                
            endforeach;
            $content_type=array('Content-type'=>'aplication/json');
            return new \Response(json_encode($data),'200',$content_type);
        }

}
