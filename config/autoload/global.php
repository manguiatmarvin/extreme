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
												'label' => 'Categories',
												'route' => 'videos',
												'action' => 'video-categories',
												'resource' => 'video-categories',
												'show_in_menu' => true
										),
										array (
												'label' => 'Top Rated',
												'route' => 'videos',
												'action' => 'top-rated-videos',
												'resource' => 'top-rated-videos',
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
												'action' => 'most-viewed-images',
												'resource' => 'most-viewed-images',
												'show_in_menu' => true
										),
										
								)
						),
						
				
						) 
				
		) 
);
