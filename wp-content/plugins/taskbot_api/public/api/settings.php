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
if (!class_exists('TaskbotApiSettings')) {

    class TaskbotApiSettings extends WP_REST_Controller
    {
        public function register_routes()
        {
            $version     = TASKBOT_API_KEY;
            $namespace     = 'api/v' . $version;
            $base         = 'settings';

            // get settings
            register_rest_route(
                $namespace,
                '/' . $base . '/get_settings',
                array(
                    array(
                        'methods'     => WP_REST_Server::READABLE,
                        'callback'     => array(&$this, 'get_theme_settings'),
                        'args'         => array(),
                        'permission_callback' => '__return_true',
                    ),
                )
            );

            register_rest_route(
                $namespace,
                '/' . $base . '/get_options',
                array(
                    array(
                        'methods'     => WP_REST_Server::READABLE,
                        'callback'     => array(&$this, 'get_terms_options'),
                        'args'         => array(),
                        'permission_callback' => '__return_true',
                    ),
                )
            );
        }

        /**
         * Get taskbot settings
         *
         * @param WP_REST_Request $request Full data about the request.
         * @return WP_Error|WP_REST_Request
         */
        public function get_theme_settings($request)
        {
            global $taskbot_settings;
            $fields     = array(
                'hide_product_cat', 'min_search_price', 'application_access', 'hide_product_cat', 'buyer_project_dispute_issues', 'seller_project_dispute_issues',
                'max_search_price', 'user_account_approve', 'identity_verification', 'package_option', 'disable_range_slider', 'enable_zipcode',
                'user_update_option', 'identity_verification', 'user_account_approve', 'switch_user', 'remove_account_reasons', 'buyer_dispute_issues',
                'seller_dispute_issues', 'project_status', 'proposal_status', 'admin_commision', 'hide_registration', 'hide_role',
            );
            $settings   = array();
            foreach ($fields as $field) {
                $settings[$field]   = isset($taskbot_settings[$field]) ? $taskbot_settings[$field] : '';
                if (!empty($field) && ($field === 'remove_account_reasons' || $field === 'buyer_dispute_issues' || $field === 'buyer_project_dispute_issues' || $field === 'seller_project_dispute_issues' || $field === 'seller_dispute_issues') && !empty($settings[$field])) {
                    $remove_value   = array();
                    foreach ($settings[$field] as $val) {
                        $key =  !empty($val) ? sanitize_title($val) : '';
                        $remove_value[] = array('key' => $key, 'val' => $val);
                    }
                    $settings[$field]   = $remove_value;
                }
            }
            $settings['price_format'] = taskbot_get_current_currency();
            $settings['location_type'] = taskbot_project_location_type();
            $settings['payment_mode'] = array();
            if(function_exists('taskbot_payment_mode')){
                $settings['payment_mode'] = taskbot_payment_mode('title');
            }

            $no_of_freelancers  = !empty($taskbot_settings['no_of_freelancers']) ? $taskbot_settings['no_of_freelancers'] : array();
            $list_freelancers   = array();
            if (!empty($no_of_freelancers) && $no_of_freelancers > 0) {
                for ($x = 1; $x <= $no_of_freelancers; $x++) {
                    $list_freelancers[$x]   = sprintf(_n('%s freelancer', '%s freelancers', $x, 'taskbot-api'), $x);
                }
            }
            $settings['num_of_freelancers'] = $list_freelancers;


            return new WP_REST_Response($settings, 200);
        }

        /**
         * Get Search type
         *
         * @param WP_REST_Request $request Full data about the request.
         * @return WP_Error|WP_REST_Request
         */
        public function get_terms_options($request)
        {
            $type   = !empty($request['type']) ?  $request['type'] : '';
            $list   = array();
            if (!empty($type) && $type === 'list_search') {

                if (function_exists('taskbot_search_list_type')) {
                    $list    = taskbot_search_list_type();
                }
            } else if (!empty($type) && $type === 'taxonomy') {
                $taxonomy       = !empty($request['taxonomy_name']) ?  $request['taxonomy_name'] : '';
                $parent_cat     = !empty($request['parent_cat']) ?  $request['parent_cat'] : '';
                if (!empty($taxonomy)) {

                    $args    = array(
                        'taxonomy' => $taxonomy,
                    );

                    if (!empty($parent_cat)) {
                        $args['parent']  = $parent_cat;
                    }

                    $terms   = get_terms($args);
                    if (!empty($terms)) {
                        foreach ($terms as $term) {
                            if (!empty($taxonomy) && $taxonomy === 'product_cat') {
                                $thumbnail_id   = get_term_meta($term->term_id, 'thumbnail_id', true);
                                $thumbnail_id   = !empty($thumbnail_id) ? intval($thumbnail_id) : 0;
                                $image          = !empty($thumbnail_id) ? wp_get_attachment_url($thumbnail_id) : '';
                                if (empty($image) && function_exists('taskbot_add_http_protcol')) {
                                    $image  = taskbot_add_http_protcol(TASKBOT_DIRECTORY_URI . 'public/images/cat-placeholder.jpg');
                                }
                                $term->image    = $image;
                            }
                            $list[] = $term;
                        }
                    }
                }
            } elseif (!empty($type) && $type === 'country') {
                if (class_exists('WooCommerce')) {
                    $countries_obj  = new WC_Countries();
                    $countries      = $countries_obj->get_allowed_countries('countries');
                    if (!empty($countries)) {
                        foreach ($countries as $key => $value) {
                            $list[$key]        = $value;
                        }
                    }
                }
            } elseif (!empty($type) && $type === 'privacy_settigs') {
                if (function_exists('taskbot_get_account_settings')) {
                    $list   = taskbot_get_account_settings();
                }
            }

            return new WP_REST_Response($list, 200);
        }
    }
    add_action('rest_api_init', function () {
        $controller = new TaskbotApiSettings;
        $controller->register_routes();
    });
}
