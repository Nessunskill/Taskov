<?php
/**
 * Takbot API Settings
 *
 * @package     Taskbot
 * @subpackage  Taskbot/admin/Theme_Settings
 * @author      Amentotech <info@amentotech.com>
 * @link        http://amentotech.com/
 * @version     1.0
 * @since       1.0
*/
if( !function_exists('taskbot_settings_includesfiles') ){
    add_action( 'taskbot_settings_files', 'taskbot_settings_includesfiles');
    function taskbot_settings_includesfiles(){
        $scan = glob(TASKBOT_API_DIRECTORY."/admin/api-settings/settings/*");
        foreach ( $scan as $path ) {
            include $path;
        }
    }
}