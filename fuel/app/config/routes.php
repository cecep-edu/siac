<?php
return array(

	// crud de usuarios
	'usuarios' => array(
		array('GET', new Route('usuarios/index')),
		array('POST', new Route('usuarios/crear')),
	),
	'usuarios/nuevo' => array(array('GET', new Route('usuarios/nuevo'))),
	'usuarios/(?P<id>:num)' => array(
		array('GET', new Route('usuarios/mostrar')),
		// mirar como hacer para funcionar esto
		//array('PUT', new Route('usuarios/actualizar')),
		// mirar como hacer funcionar esto
		//array('DELETE', new Route('usuarios/borrar')),
	),
	'usuarios/(?P<id>:num)/eliminar' => array(array('GET', new route('usuarios/borrar'))),
	'usuarios/(?P<id>:num)/editar' => array(array('GET', new Route('usuarios/editar'))),
	'usuarios/(?P<id>:num)/actualizar' => array(array('POST', new Route('usuarios/actualizar'))),
    
//        'usuarios/(?P<username:string)/perfil' => 'informacion_perfonal/mostrar'

	// sesiones
	'usuarios/login' => array(
		array('GET', new Route('sesiones/index')),
		array('POST', new Route('sesiones/login')),
	),
	// mirar como hacer para que esto funcione
	//'usuarios/logout' => array(array('POST', new Route('sesiones/logout'))),
	'usuarios/logout' => array(array('GET', new Route('sesiones/logout'))),

	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route	
);
