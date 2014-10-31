<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Videos\Controller\Videos' => 'Videos\Controller\VideosController',
            
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'videos' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/videos[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Videos\Controller\Videos',
                         'action'     => 'index',
                     ),
                 ),
             ),
         		
  
         ),
     ),
		'view_manager' => array (
				'template_map' => array (
						'layout/newvideos'  => __DIR__ . '/../view/layout/menu.phtml',
				),
				'template_path_stack' => array (
						'videos' => __DIR__ . '/../view' 
				)
				 
		),
		
 );
?>