<?php
/**
 * APP API to get Tasks
 *
 * This file will include all global settings which will be used in all over the plugin,
 * It have gatter and setter methods
 *
 * @link              https://codecanyon.net/user/amentotech/portfolio
 * @since             1.0.0
 * @package           Taskbot APP
 *
 */
if (!class_exists('TaskbotApiTasks')) {

    class TaskbotApiTasks extends WP_REST_Controller{
        public function register_routes() {
            $version 	= TASKBOT_API_KEY;
            $namespace 	= 'api/v' . $version;
            $base 		= 'tasks';
           
        }


    }
    add_action('rest_api_init', function () {
        $controller = new TaskbotApiTasks;
        $controller->register_routes();
    });
    
}