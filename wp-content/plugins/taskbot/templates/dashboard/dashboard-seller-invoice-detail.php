<?php

/**
 * Seller invoice detail
 *
 * @package     Taskbot
 * @subpackage  Taskbot/templates/dashboard
 * @author      Amentotech <info@amentotech.com>
 * @link        https://codecanyon.net/user/amentotech/portfolio
 * @version     1.0
 * @since       1.0
 */

global $taskbot_settings;
$identity   = !empty($args['identity']) ? $args['identity'] : "";
$order_id   = !empty($args['order_id']) ? $args['order_id'] : "";
$site_logo  = !empty($taskbot_settings['defaul_site_logo']['url']) ? $taskbot_settings['defaul_site_logo']['url'] : '';


/* if order Id empty */
if (empty($order_id)) {
    return;
}

if (!class_exists('WooCommerce')) {
    return;
}

$date_format    = get_option('date_format');
$gmt_time       = strtotime(current_time('mysql', 1));
$order          = wc_get_order($order_id);
$data_created   = $order->get_date_created();
$data_created   = date_i18n($date_format, strtotime($data_created));
$get_taxes      = $order->get_taxes();
if(function_exists('wmc_revert_price')){
    $get_subtotal =  wmc_revert_price($order->get_subtotal(),$order->get_currency());
} else {
    $get_subtotal   = $order->get_subtotal(); 
}

$order_details  = get_post_meta($order_id, 'order_details', true);
$order_details  = !empty($order_details) ? $order_details : array();

$billing_address      = $order->get_formatted_billing_address();
$from_billing_address = !empty($identity) ? taskbot_user_billing_address($identity) : '';
$order_meta           = get_post_meta($order_id, 'cus_woo_product_data', true);
$order_meta           = !empty($order_meta) ? $order_meta : array();

$payment_type   = get_post_meta($order_id, 'payment_type', true);
$payment_type   = !empty($payment_type) ? $payment_type : '';

$processing_fee = 0;

$processing_fee   = get_post_meta($order_id, 'admin_shares', true);
$processing_fee   = isset($processing_fee) ? $processing_fee : 0;
$get_total        = get_post_meta($order_id, 'seller_shares', true);
$get_total        = !empty($get_total) ? $get_total : 0;

if (!empty($payment_type) && $payment_type === 'tasks') {
    $task_title       = !empty($order_meta['task_id']) ? get_the_title($order_meta['task_id']) : '';
} else if (!empty($payment_type) && $payment_type === 'package') {
    $get_total      = $order->get_total();
    if(function_exists('wmc_revert_price')){
        $get_total  = wmc_revert_price($get_total,$order->get_currency());
    }
    $processing_fee = $order->get_total_tax();
    $task_title     = !empty($order_meta['product_name']) ? esc_html($order_meta['product_name']) : '';
    $from_billing_address   = !empty($taskbot_settings['invoice_billing_package']) ? $taskbot_settings['invoice_billing_package'] : '';
} else if( !empty($payment_type) && $payment_type === 'projects'){
    
    $project_id     = !empty($order_meta['project_id']) ? intval($order_meta['project_id']) : 0;
    $task_title     = !empty($project_id) ? get_the_title($project_id) : $order_meta['product_name'];
} else {
    $task_title     = apply_filters( 'taskbot_filter_invoice_title', $order_id );
}
$invoice_terms      = !empty($taskbot_settings['invoice_terms']) ? $taskbot_settings['invoice_terms'] : '';
$invoice_billing_to = !empty($taskbot_settings['invoice_billing_to']) ? $taskbot_settings['invoice_billing_to'] : '';
$billing_address    = !empty($invoice_billing_to) && !empty($taskbot_settings['invoice_billing_address']) ? $taskbot_settings['invoice_billing_address'] : $billing_address;
?>
<div class="tb-main-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="tb-invoicedetal">
                    <div class="tb-printable">
                        <div class="tb-invoicebill">
                        <?php if( !empty($site_logo) ){
                                if( !empty($args['option']) && $args['option'] === 'pdf'){
                                    $type = pathinfo($site_logo, PATHINFO_EXTENSION);
                                    $data = file_get_contents($site_logo);
                                    $base64_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    echo do_shortcode( '<figure><img src="'.($base64_logo).'" alt="'.esc_attr__('invoice detail','taskbot').'"></figure>' );
                                } else { ?>
                                    <figure>
                                        <img src="<?php echo esc_url($site_logo);?>" alt="<?php esc_attr_e('invoice detail','taskbot');?>">
                                    </figure>
                            <?php } } ?>
                            <?php if(!empty($order_id)){?>
                                <div class="tb-billno">
                                    <h3><?php esc_html_e('Invoice', 'taskbot'); ?></h3>
                                    <span># <?php echo intval($order_id); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if(!empty($task_title) || !empty($data_created)){?>
                            <div class="tb-tasksinfos">
                                <?php if(!empty($task_title)){?>
                                    <div class="tb-invoicetasks">
                                        <h5><?php esc_html_e('Task title', 'taskbot'); ?>:</h5>
                                        <h3><?php echo esc_html($task_title); ?></h3>
                                    </div>
                                <?php }?>
                                <?php if(!empty($data_created) || !empty($order_id)){?>
                                    
                                    <div class="tb-tasksdates">
                                        <?php 
                                            do_action( 'taskbot_task_order_status', $order_id );
                                        ?>
                                        <?php if(!empty($data_created)){?>
                                            <span> <em><?php esc_html_e('Issue date:', 'taskbot') ?>&nbsp;</em><?php echo esc_html($data_created); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php }?>
                            </div>
                        <?php }?>
                        <div class="tb-invoicefromto">
                            <?php if (!empty($from_billing_address)) { ?>
                                <div class="tb-fromreceiver">
                                    <h5><?php esc_html_e('From:', 'taskbot'); ?></h5>
                                    <span><?php echo do_shortcode(nl2br($from_billing_address)); ?></span>
                                </div>
                            <?php } ?>
                            <?php if (!empty($billing_address)) { ?>
                                <div class="tb-fromreceiver">
                                    <h5><?php esc_html_e('To:', 'taskbot'); ?></h5>
                                    <span><?php echo do_shortcode(nl2br($billing_address)); ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <table class="tb-table tb-invoice-table">
                            <thead>
                                <tr>
                                    <th> #</th>
                                    <th><?php esc_html_e('Description', 'taskbot'); ?></th>
                                    <?php do_action( 'taskbot_buyer_invoice_heading', $payment_type );?>
                                    <th><?php esc_html_e('Cost', 'taskbot'); ?></th>
                                    <th><?php esc_html_e('Amount', 'taskbot'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($payment_type) && $payment_type === 'tasks') {
                                    if (!empty($order_details['title']) && !empty($order_details['price'])) { ?>
                                        <tr>

                                            <td data-label="<?php esc_attr_e('#', 'taskbot'); ?>"><?php echo intval(1); ?></td>
                                            <td data-label="<?php esc_attr_e('Description', 'taskbot'); ?>"><?php echo esc_html($task_title . ' (' . $order_details['title'] . ')'); ?></td>
                                            <td data-label="<?php esc_attr_e('Cost', 'taskbot'); ?>"><?php taskbot_price_format($order_details['price']); ?></td>
                                            <td data-label="<?php esc_attr_e('Amount', 'taskbot'); ?>"><?php taskbot_price_format($order_details['price']); ?></td>
                                        </tr>
                                    <?php } ?>
                                    <?php if (!empty($order_details['subtasks'])) { ?>
                                        <tr>
                                        <td data-label="<?php esc_attr_e('#', 'taskbot'); ?>"><?php echo intval(2); ?></td>
                                        <td data-label="<?php esc_attr_e('Description', 'taskbot'); ?>">
                                            <?php esc_html_e('Add-on services:', 'taskbot'); ?>
                                            <ul class="tb-tablelist">
                                            <?php
                                            $sub_task_price   = '';
                                            $sub_task_total   = 0;
                                            foreach ($order_details['subtasks'] as $subtask) {
                                                $subtask_price  = !empty($subtask['price']) ? $subtask['price'] : 0;
                                                if(function_exists('wmc_revert_price')){
                                                    $subtask_price  = wmc_revert_price($subtask_price,$order->get_currency());
                                                }
                                                $sub_task_total = $sub_task_total + $subtask_price;
                                                $sub_task_price .= '<li>' . taskbot_price_format($subtask_price, 'return') . '</li>';
                                            ?>
                                                <li><?php echo esc_html($subtask['title']); ?></li>
                                            <?php
                                            }
                                            ?>
                                            </ul>
                                        </td>
                                        <td data-label="<?php esc_attr_e('Cost', 'taskbot'); ?>">
                                            <ul class="tb-tablelist tb-tablelistv2">
                                                <?php echo do_shortcode($sub_task_price); ?>
                                            </ul>
                                            <h6><?php taskbot_price_format($sub_task_total); ?></h6>
                                        </td>
                                        <td data-label="<?php esc_attr_e('Amount', 'taskbot'); ?>"><?php taskbot_price_format($sub_task_total); ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else if (!empty($payment_type) && $payment_type === 'package') { ?>
                                    <tr>
                                        <td data-label="<?php esc_attr_e('#', 'taskbot'); ?>"><?php echo intval(1); ?></td>
                                        <td data-label="<?php esc_attr_e('Description', 'taskbot'); ?>"><?php echo esc_html($task_title); ?></td>
                                        <td data-label="<?php esc_attr_e('Cost', 'taskbot'); ?>"><?php taskbot_price_format($order_meta['price']); ?></td>
                                        <td data-label="<?php esc_attr_e('Amount', 'taskbot'); ?>"><?php taskbot_price_format($order_meta['price']); ?></td>
                                    </tr>
                                <?php } else if( !empty($payment_type) && $payment_type === 'projects'){  ?>
                                    <tr>
                                        <td data-label="<?php esc_attr_e('#', 'taskbot');?>"><?php echo intval(1);?></td>
                                        <td data-label="<?php esc_attr_e('Description', 'taskbot');?>">
                                            <?php 
                                                $project_title  = $task_title;
                                                $project_type   = !empty($order_meta['project_type']) ? ($order_meta['project_type']) : '';
                                                if( !empty($project_type) && $project_type === 'fixed' && !empty($order_meta['milestone_id']) && !empty($order_meta['proposal_meta']['milestone'][$order_meta['milestone_id']]['title'])){
                                                    $project_title  = $order_meta['proposal_meta']['milestone'][$order_meta['milestone_id']]['title'];
                                                }
                                                echo esc_html($project_title);
                                            ?>
                                        </td>
                                        <td data-label="<?php esc_attr_e('Cost', 'taskbot');?>"><?php taskbot_price_format($order_meta['price']);?></td>
                                        <td data-label="<?php esc_attr_e('Amount', 'taskbot');?>"><?php taskbot_price_format($order_meta['price']);?></td>
                                    </tr>
                                <?php } else {
                                    do_action( 'taskbot_add_buyer_invoice_details', $order_meta,$order_id );
                                } ?>
                            </tbody>
                        </table>
                        <div class="tb-subtotal">
                            <ul class="tb-subtotalbill">
                                <li><?php esc_html_e('Subtotal', 'taskbot'); ?> : <h6><?php taskbot_price_format($get_subtotal); ?></h6> </li>
                                <?php if (!empty($payment_type) && $payment_type === 'package' && !empty($processing_fee)) { ?>
                                    <li><?php esc_html_e('Taxes & fees', 'taskbot'); ?>:<h6><?php taskbot_price_format($processing_fee); ?></h6>
                                </li>
                                <?php } else { ?>
                                    <li><?php esc_html_e('Admin commission', 'taskbot'); ?>: <h6>-<?php taskbot_price_format($processing_fee); ?></h6></li>
                                <?php } ?>
                            </ul>
                            <div class="tb-sumtotal">
                                <?php esc_html_e('Total', 'taskbot'); ?> : <h6><?php taskbot_price_format($get_total); ?></h6>
                            </div>
                        </div>
                        <?php if (!empty($invoice_terms)) { ?>
                            <div class="tb-anoverview">
                                <div class="tb-description">
                                    <?php echo do_shortcode($invoice_terms); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>