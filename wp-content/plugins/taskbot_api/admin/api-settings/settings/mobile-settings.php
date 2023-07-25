<?php
/**
 * Footer Settings
 *
 * @throws error
 * @author Amentotech <theamentotech@gmail.com>
 * @return 
 */
Redux::setSection( 'taskbot_settings', array(
	'title'            => esc_html__( 'Taskbot Rest API', 'taskbot-api' ),
	'id'               => 'rest_api_settings',
	'subsection'       => false,
	'icon'			   => 'dashicons dashicons-rest-api',
	'fields'           => array(
		array(
			'id'    	=> 'tpl_mobile_checkout',
			'type'  	=> 'select',
			'title' 	=> esc_html__( 'Mobile checkout page', 'taskbot-api' ),
			'data'  	=> 'pages',
			'desc'      => esc_html__('Select page that selected mobile checkout template', 'taskbot-api'),
		)
	)
)
);