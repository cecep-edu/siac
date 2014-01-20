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
		array('PUT', new Route('usuarios/actualizar')),
		array('DELETE', new Route('usuarios/borrar')),
	),
	'usuarios/(?P<id>:num)/editar' => array(array('GET', new Route('usuarios/editar'))),

	// sesiones
	'usuarios/login' => array(
		array('GET', new Route('sesiones/index')),
		array('POST', new Route('sesiones/login')),
	),
	'usuarios/logout' => array(array('POST', new Route('sesiones/logout'))),

	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route	
);
