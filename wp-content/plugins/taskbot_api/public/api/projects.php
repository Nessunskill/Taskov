<?php

/**
 * APP API to get Projects
 *
 * This file will include all global settings which will be used in all over the plugin,
 * It have gatter and setter methods
 *
 * @link              https://codecanyon.net/user/amentotech/portfolio
 * @since             1.0.0
 * @package           Taskbot APP
 *
 */
if (!class_exists('TaskbotApiProjects')) {

    class TaskbotApiProjects extends WP_REST_Controller
    {
        public function register_routes()
        {
            $version     = TASKBOT_API_KEY;
            $namespace     = 'api/v' . $version;
            $base         = 'projects';

            // get projects
            register_rest_route(
                $namespace,
                '/' . $base . '/get_projects',
                array(
                    array(
                        'methods'     => WP_REST_Server::READABLE,
                        'callback'     => array(&$this, 'get_projects'),
                        'args'         => array(),
                        'permission_callback' => '__return_true',
                    ),
                )
            );
        }
        /**
         * Get all projects
         *
         * @param WP_REST_Request $request Full data about the request.
         * @return WP_Error|WP_REST_Request
         */
        public function get_projects($request)
        {
            global $taskbot_settings;
            $type           = !empty($request['type']) ?  $request['type'] : '';
            $user_id        = !empty($request['user_id']) ?  $request['user_id'] : '';
            $limit            = !empty($request['show_posts']) ? intval($request['show_posts']) : 10;
            $page_number    = !empty($request['page_number']) ? intval($request['page_number']) : 1;
            $count_post     = 0;
            $project_list   = array();
            $query_args     = array();
            $tax_queries    = array();
            $project_data   = array();

            $product_type_tax_args[] = array(
                'taxonomy' => 'product_type',
                'field'    => 'slug',
                'terms'    => 'projects',
            );

            $tax_queries = array_merge($tax_queries, $product_type_tax_args);

            if (!empty($type) && $type === 'single') {
                $project_id        = !empty($request['project_id']) ? array($request['project_id']) : 0;
                $query_args     = array(
                    'post__in'              => $project_id,
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                    'post_type'             => 'product',
                    'tax_query'             => $tax_queries,
                    'post_status'           => 'any',
                    'ignore_sticky_posts'   => 1,
                );

                $project_data = new WP_Query($query_args);
            } elseif (!empty($type) && $type === 'saved') {
                $profile_id            = !empty($request['profile_id']) ? intval($request['profile_id']) : 0;
                $saved_projects        = get_post_meta($profile_id, '_saved_projects', true);
                $saved_items        = !empty($saved_projects) ? $saved_projects : array(0);
                $query_args = array(
                    'post__in'              => $saved_items,
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                    'post_type'             => 'product',
                    'post_status'           => 'any',
                    'orderby'               => 'date',
					'order'                 => 'DESC',
                    'ignore_sticky_posts'   => true,
                );
                $project_data = new WP_Query($query_args);
            } else if (!empty($type) && $type === 'search') {
                $meta_queries           = array();
                $query_args             = array();
                $user_meta_queries      = array();
                $user_ids               = array();
                $min_price_meta_args     = array();
                $sorting                = !empty($request['sort_by']) ? esc_attr($request['sort_by']) : 'date_desc';
                if (!empty($sorting)) {
                    $filtered_args = array();
                    // filter latest product
                    if ($sorting == 'date_desc') {
                        $filtered_args['sort_by'] = array(
                            'orderby'     => 'date',
                            'order'     => 'DESC',
                        );
                    } elseif ($sorting == 'price_desc') {
                        $filtered_args['sort_by'] = array(
                            'orderby'     => 'meta_value_num',
                            'meta_key'     => 'min_price',
                            'order'     => 'desc',
                        );
                    } elseif ($sorting == 'price_asc') {
                        $filtered_args['sort_by'] = array(
                            'orderby'     => 'meta_value_num',
                            'meta_key'     => 'min_price',
                            'order'     => 'asc',
                        );
                    } elseif ($sorting == 'views_desc') {
                        $filtered_args['sort_by'] = array(
                            'orderby'     => 'meta_value_num',
                            'meta_key'     => 'taskbot_project_views',
                            'order'     => 'desc',
                        );
                    }

                    $query_args = array_merge($query_args, $filtered_args['sort_by']);
                } else {
                    $filtered_args['sort_by'] = array(
                        'orderby'     => 'meta_value',
                        'meta_key'     => '_featured_task',
                        'order'     => 'DESC',
                    );
                    $query_args = array_merge($query_args, $filtered_args['sort_by']);
                }
                $skills             = !empty($request['skills']) ? $request['skills'] : array();
                $expertise_level    = !empty($request['expertise_level']) ? $request['expertise_level'] : array();
                $languages          = !empty($request['languages']) ? $request['languages'] : array();
                $project_type       = !empty($request['project_type']) ? $request['project_type'] : '';
                // check and store filter variable data
                $keyword            = !empty($request['keyword']) ? sanitize_text_field($request['keyword']) : "";
                $location           = !empty($request['location']) ? sanitize_text_field($request['location']) : "";
                $category           = !empty($request['category']) ? sanitize_text_field($request['category']) : array();
                $min_product_price  = !empty($request['min_price']) ? (int)$request['min_price'] : 0;
                $max_product_price  = !empty($request['max_price']) ? (int)$request['max_price'] : 0;

                // if keyword field is set in search then append its args in $query_args
                if (!empty($keyword)) {
                    $filtered_args['keyword'] = array('s' => $keyword,);
                    $query_args = array_merge($query_args, $filtered_args['keyword']);
                }

                // if min price field is set in search then append it in meta query
                if (!empty($min_product_price)) {
                    $min_price_meta_args[] = array(
                        'key'       => 'min_price',
                        'value'     => $min_product_price,
                        'compare'   => '>=',
                        'type'      => 'NUMERIC',
                    );

                    // store basic taxonomy in $tax_queries array
                    $meta_queries = array_merge($meta_queries, $min_price_meta_args);
                }

                // if max price field is set in search then append it in meta query
                if (!empty($max_product_price)) {

                    if (count($meta_queries) == 1) {
                        $query_relation = array('relation' => 'AND',);
                        $meta_queries = array_merge($query_relation, $meta_queries);
                    }

                    $max_price_meta_args[] = array(
                        'key'       => 'max_price',
                        'value'     => $max_product_price,
                        'compare'   => '<=',
                        'type'      => 'NUMERIC',
                    );
                    $meta_queries = array_merge($meta_queries, $max_price_meta_args);
                }

                if (!empty($category) && $category != -1) {
                    // check and get parent category info
                    $tax_queries[] = array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => esc_attr($category),
                    );
                }
                if (!empty($expertise_level[0]) && is_array($expertise_level)) {
                    $query_relation = array('relation' => 'OR',);
                    $type_args      = array();
                    foreach ($expertise_level as $key => $type) {
                        $type_args[] = array(
                            'taxonomy' => 'expertise_level',
                            'field'    => 'slug',
                            'terms'    => esc_attr($type),
                        );
                    }
                    $tax_queries[] = array_merge($query_relation, $type_args);
                }
                // if location field is set in search then append it in meta query
                if (!empty($location)) {

                    if (count($meta_queries) == 1) {
                        $query_relation = array('relation' => 'AND',);
                        $meta_queries = array_merge($query_relation, $meta_queries);
                    }

                    $product_country_meta_args[] = array(
                        'key'       => '_country',
                        'value'     => $location,
                        'compare'   => '=',
                        'type'      => 'CHAR',
                    );

                    $meta_queries = array_merge($meta_queries, $product_country_meta_args);
                }
                if (!empty($languages[0]) && is_array($languages)) {
                    $query_relation = array('relation' => 'OR',);
                    $lang_args      = array();

                    foreach ($languages as $key => $lang) {
                        $lang_args[] = array(
                            'taxonomy' => 'languages',
                            'field'    => 'slug',
                            'terms'    => esc_attr($lang),
                        );
                    }

                    $tax_queries[] = array_merge($query_relation, $lang_args);
                }

                if (!empty($skills[0]) && is_array($skills)) {
                    $query_relation = array('relation' => 'OR',);
                    $type_args      = array();
                    foreach ($skills as $key => $type) {
                        $type_args[] = array(
                            'taxonomy' => 'skills',
                            'field'    => 'slug',
                            'terms'    => esc_attr($type),
                        );
                    }
                    $tax_queries[] = array_merge($query_relation, $type_args);
                }
                // prepared query args
                $taskbot_args = array(
                    'post_type'         => 'product',
                    'post_status'       => 'publish',
                    'posts_per_page'        => $limit,
                    'paged'                 => $page_number,
                );
                if (!empty($tax_queries)) {
                    $taskbot_args['tax_query']   = $tax_queries;
                }

                if (!empty($meta_queries)) {
                    $taskbot_args['meta_query']   = $meta_queries;
                }
                $taskbot_args                 = array_merge($taskbot_args, $query_args);
                $project_data                 = new WP_Query(apply_filters('taskbot_project_listings_args', $taskbot_args));
            }

            if (!empty($type) && $project_data->have_posts()) {
                $count_post = $project_data->found_posts;
                while ($project_data->have_posts()) {
                    $project_data->the_post();
                    $list                   = array();
                    $post_id                = get_the_ID();
                    if (function_exists('taskbotProjectDetails')) {
                        $list   = taskbotProjectDetails($post_id, 'proposals');

                        $list['proposal_id']        = '';
                        $list['porposal_edit']      = false;
                        /* if current user already submitted proposla on this project */
                        if (!empty($user_id)) {
                            $proposal_args = array(
                                'post_type'         => 'proposals',
                                'post_status'       => 'any',
                                'posts_per_page'    => -1,
                                'author'            => $user_id,
                                'meta_query'        => array(
                                    array(
                                        'key'       => 'project_id',
                                        'value'     => intval($post_id),
                                        'compare'   => '=',
                                        'type'      => 'NUMERIC'
                                    )
                                )
                            );

                            $proposals                  = get_posts($proposal_args);
                            $taskbot_user_proposal      = !empty($proposals) && is_array($proposals) ? count($proposals) : 0;
                            if (!empty($taskbot_user_proposal)) {
                                $list['proposal_id']        = $proposals[0]->ID;
                                $list['porposal_edit']      = true;
                            }
                        }
                    }
                    $project_list[]            = $list;
                }
            }
            $json                       = array();
            $json['projects']           = $project_list;

            $json['count_totals']       = !empty($count_post) ? intval($count_post) : 0;
            return new WP_REST_Response($json, 200);
        }
    }
    add_action('rest_api_init', function () {
        $controller = new TaskbotApiProjects;
        $controller->register_routes();
    });
}
