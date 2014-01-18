<?php
return array(
	'login' => array(
		array('GET', new Route('sesiones/index')),
		array('POST', new Route('sesiones/login')),
	),
	'logout' => array('sesiones/logout', 'name' => 'logout'),
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
);
