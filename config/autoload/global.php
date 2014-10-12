<?php
return array (
		'db' => array (
				'driver' => 'Pdo',
				'dsn' => 'mysql:dbname=edplayground;host=localhost', 
				'driver_options' => array (
						PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' 
				) 
		),
		'service_manager' => array (
				'factories' => array (
						'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory' 
				) 
		),
		'navigation' => array (
				'default' => array (
						
// 						array (
// 								'label' => 'Home',
// 								'route' => 'home',
// 								'class' => 'fa-dashboard', 
// 								'resource'=> 'home',
// 						),
						array (
								'label' => 'Videos',
								'route' => 'videos',
								'class' => 'fa-video-camera',
								'resource' => 'videos',
								'pages' => array (
										   array (
												'label' => 'Newest',
												'route' => 'videos',
												'action' => 'index',
												'resource' => 'newest-videos',
												'show_in_menu' => true 
										 ),
										array (
												'label' => 'Most Viewed',
												'route' => 'videos',
												'action' => 'mostviewed-videos',
												'resource' => 'mostviewed-videos',
												'show_in_menu' => true
										),
										array (
												'label' => 'Celebrities',
												'route' => 'videos',
												'action' => 'mostviewed-videos',
												'resource' => 'mostviewed-videos',
												'show_in_menu' => true
										),
										array (
												'label' => 'Asians',
												'route' => 'videos',
												'action' => 'mostviewed-videos',
												'resource' => 'mostviewed-videos',
												'show_in_menu' => true
										),
										array (
												'label' => 'Hardcore',
												'route' => 'videos',
												'action' => 'mostviewed-videos',
												'resource' => 'mostviewed-videos',
												'show_in_menu' => true
										),
										array (
												'label' => 'Scandals',
												'route' => 'videos',
												'action' => 'mostviewed-videos',
												'resource' => 'mostviewed-videos',
												'show_in_menu' => true
										),
										
								)
								 
						),
						
						array (
								'label' => 'Photos',
								'route' => 'images',
								'class' => ' fa-camera',
								'resource'=> 'images',
										'pages' => array (
										   array (
												'label' => 'Newest',
												'route' => 'images',
												'action' => 'index',
												'resource' => 'newest-images',
												'show_in_menu' => true 
										 ),
										array (
												'label' => 'Most Viewed',
												'route' => 'images',
												'action' => 'mostviewed-images',
												'resource' => 'mostviewed-images',
												'show_in_menu' => true
										),
										
								)
						),
						) 
				
		) 
);