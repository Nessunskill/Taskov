<?php
/**
 * APP API to get settings
 *
 * This file will include all global settings which will be used in all over the plugin,
 * It have gatter and setter methods
 *
 * @link              https://codecanyon.net/user/amentotech/portfolio
 * @since             1.0.0
 * @package           Taskbot APP
 *
 */
if (!class_exists('TaskbotApiSellers')) {

    class TaskbotApiSellers extends WP_REST_Controller{
        public function register_routes() {
            $version 	= TASKBOT_API_KEY;
            $namespace 	= 'api/v' . $version;
            $base 		= 'sellers';

            // get sellers
			register_rest_route($namespace, '/' . $base . '/get_sellers',
                array(
                    array(
                        'methods' 	=> WP_REST_Server::READABLE,
                        'callback' 	=> array(&$this, 'get_sellers'),
                        'args' 		=> array(),
                        'permission_callback' => '__return_true',
                    ),
                )
            );
        }

        /**
         * Get sellers
         *
         * @param WP_REST_Request $request Full data about the request.
         * @return WP_Error|WP_REST_Request
         */
        public function get_sellers($request) {
            $type               = !empty($request['type']) ?  $request['type'] : '';
            $limit			    = !empty($request['show_posts']) ? intval($request['show_posts']) : 20;
			$page_number	    = !empty($request['page_number']) ? intval($request['page_number']) : 1;
			$profile_id		    = !empty($request['profile_id']) ? ($request['profile_id']) : 0;
            $task_limit			= !empty($request['task_limit']) ? intval($request['task_limit']) : 10;
			$task_page_number	= !empty($request['task_page_number']) ? intval($request['task_page_number']) : 1;

			$offset 		= ($page_number - 1) * $limit;
            $sellers        = array();
            $seller_data    = array();
            if( !empty($type) && $type === 'single' && !empty($profile_id)){
                $query_args = array(
                    'post__in'              => array($profile_id),
                    'post_type'             => 'sellers',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1                   
                );
                $seller_data = new WP_Query($query_args);
            }elseif( !empty($type) && $type === 'saved' && !empty($profile_id)){
                $saved_sellers		= get_post_meta($profile_id, '_saved_sellers', true);
	            $saved_items		= !empty($saved_sellers) ? $saved_sellers : array(0);
                $query_args = array(
                    'post__in'              => $saved_items,
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                    'post_type'             => 'sellers',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1                   
                );
                $seller_data = new WP_Query($query_args);
            } elseif( !empty($type) && $type === 'verified'){
                $query_args = array(
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                    'post_type'             => 'sellers',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1,
                    'meta_key'              => 'tb_total_rating',
                    'orderby'               => 'meta_value_num',
                    'meta_queries'          => array(
                                                    'key'       => '_is_verified',
                                                    'value'     => 'yes',
                                                    'compare'   => '='
                                                ),
                   
                );
                $seller_data = new WP_Query($query_args);
            } elseif( !empty($type) && $type === 'search'){
                $tax_query_args     = $query_args = $meta_query_args = array();
                $search_keyword     = !empty($request['keyword']) ? esc_html($request['keyword']) : '';
                $seller_type        = !empty($request['seller_type']) ? $request['seller_type'] : array();
                $english_level      = !empty($request['english_level']) ? $request['english_level'] : array();
                $hourly_rate_start  = !empty( $request['min_price'] ) ? intval($request['min_price']) : 0;
                $hourly_rate_end    = !empty( $request['max_price'] ) ? intval($request['max_price']) : 0;
                $seller_location    = !empty($request['location']) ? esc_html($request['location']) : '';

                /* Seller type */
                if ( is_array($seller_type) && !empty($seller_type) ) {
                    $tax_query_args[] = array(
                        'taxonomy' => 'tb_seller_type',
                        'field'    => 'slug',
                        'terms'    => $seller_type,
                        'operator' => 'IN',
                    );
                }

                /* English Level */
                if ( is_array($english_level) && !empty($english_level) ) {
                    $tax_query_args[] = array(
                        'taxonomy' => 'tb_english_level',
                        'field'    => 'slug',
                        'terms'    => $english_level,
                        'operator' => 'IN',
                    );
                }

                /* Location */
                if ( !empty($seller_location) ) {
                    $meta_query_args[] = array(
                        'key'       => 'country',
                        'value'     => $seller_location,
                        'compare'   => '=',
                    );
                }

                /* Hourly Rate */
                if ( !empty($hourly_rate_start) && !empty($hourly_rate_end) ) {
                    $meta_query_args[] = array(
                        'key'         => 'tb_hourly_rate',
                        'value'       => array($hourly_rate_start, $hourly_rate_end),
                        'compare'     => 'BETWEEN',
                        'type'        => 'NUMERIC'
                    );
                }

                $query_args = array(
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                    'post_type'             => 'sellers',
                    'post_status'           => 'publish',
                    'ignore_sticky_posts'   => 1
                );

                // if keyword field is set in search then append its args in $query_args
                if (!empty($search_keyword)){

                    $filtered_args['keyword'] = array(
                        's' => $search_keyword,
                    );

                    $query_args = array_merge($query_args,$filtered_args['keyword']);
                }

                //Meta Query
                if (!empty($meta_query_args)) {
                    $query_relation           = array('relation' => 'AND',);
                    $meta_query_args          = array_merge($query_relation, $meta_query_args);
                    $query_args['meta_query'] = $meta_query_args;
                }

                /* Taxonomy Query */
                if (!empty($tax_query_args)) {
                    $query_relation           = array('relation' => 'AND',);
                    $tax_query_args           = array_merge($query_relation, $tax_query_args);
                    $query_args['tax_query']  = $tax_query_args;
                }
                $seller_data = new WP_Query(apply_filters('taskbot_freelancer_search_filter', $query_args));
            }
            
            if ( !empty($type)){
                if(!empty($seller_data) && $seller_data->have_posts()) {
                    while ($seller_data->have_posts()) {
                        $seller_data->the_post();
                        $list       = array();
                        $seller_id  = get_the_ID();
                        $user_id    = get_post_field( 'post_author', $seller_id );
                        if( function_exists('taskbot_seller_details') ){
                            $detail_type    = !empty($type) && $type === 'single' ? 'login' : '';
                            $list           = taskbot_seller_details($seller_id, $user_id,$detail_type);
                        }
                        $args = array(
                            'author'                =>  $user_id, 
                            'numberposts'           =>  $task_limit,
                            'post_type'             => 'product',
                            'post_status'           => 'publish',
                            'orderby'               => 'ID',
                            'tax_query'             => array(
                                array(
                                    'taxonomy' => 'product_type',
                                    'field'    => 'slug',
                                    'terms'    => 'tasks',
                                )
                            )
                        );
                        $tasks          = get_posts( $args );
                        $tasks_array    = array();
                        if( !empty($tasks) ){
                            foreach($tasks as $task ){
                                $task_data  = array();
                                if( function_exists('taskbot_task_details') ){
                                    $task_data   = taskbot_task_details($task->ID,$request);
                                }
                                $tasks_array[]    = $task_data;
                            }
                        }
                        $list['tasks']  = $tasks_array; 
                        
                        $sellers[]  = $list;
                    }
                }
            }
            return new WP_REST_Response($sellers, 200);
        }
        

    }
    add_action('rest_api_init', function () {
        $controller = new TaskbotApiSellers;
        $controller->register_routes();
    });
    
    
}