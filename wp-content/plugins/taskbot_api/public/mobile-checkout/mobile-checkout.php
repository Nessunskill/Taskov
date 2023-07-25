<?php
/**
 * Template Name: Mobile Checkout Page
 *
 * This file will include all global settings which will be used in all over the plugin,
 * It have gatter and setter methods
 *
 * @link              https://codecanyon.net/user/amentotech/portfolio
 * @since             1.0.0
 * @package           Taskbot APP
 *
 */
$checkout_url   = wc_get_checkout_url();
 if(isset($_GET['post_id'])){ 
	global $wpdb,$woocommerce; 
	$post_id				= !empty($_GET['post_id']) ? intval($_GET['post_id']) : 0;
	$mobile_checkout_data	= get_post_meta( $post_id, 'mobile_checkout_data',true );
	$checkout_data			= !empty($mobile_checkout_data) ? $mobile_checkout_data : array();


	$payment_type			= !empty($checkout_data['cart_data']['payment_type']) ? $checkout_data['cart_data']['payment_type'] : '';

	if( !empty($payment_type) && $payment_type === 'tasks' ){
		$user_id			= !empty($checkout_data['buyer_id']) ? intval($checkout_data['buyer_id']) : 0;
	} else if( !empty($payment_type) && $payment_type === 'wallet' ){
		$user_id			= !empty($checkout_data['cart_data']['user_id']) ? intval($checkout_data['cart_data']['user_id']) : 0;
	} else if( !empty($payment_type) && $payment_type === 'projects' ){
		$user_id			= !empty($checkout_data['buyer_id']) ? intval($checkout_data['buyer_id']) : 0;
	}
	
	$user	= !empty($user_id) ? get_userdata($user_id) : array();

    if ($user) {
        if (!is_user_logged_in()) {
            wp_set_current_user($user_id, $user->user_login);
            wp_set_auth_cookie($user_id);
            $url = $_SERVER['REQUEST_URI'];
			wp_redirect( $url );
        }
    } else{
		esc_html_e('You must be login to view checkout page.','taskbot_api'); 
		return;
	}

	if( !empty($payment_type) && $payment_type === 'tasks' ){
		$product_id		= !empty($checkout_data['product_id']) ? intval($checkout_data['product_id']) : 0 ;
		$subtasks		= !empty($checkout_data['cart_data']['subtasks']) ? ($checkout_data['cart_data']['subtasks']) : array() ;
		$woocommerce->cart->empty_cart();
		WC()->cart->add_to_cart($product_id, 1, null, null, $checkout_data);

		if( !empty($subtasks) ){
			foreach($subtasks as $subtasks_id){
				WC()->cart->add_to_cart( $subtasks_id, 1 );
			}
		}

	} else if( !empty($payment_type) && $payment_type === 'projects' ){
		$product_id		= !empty($checkout_data['hiring_product_id']) ? intval($checkout_data['hiring_product_id']) : 0 ;
		$woocommerce->cart->empty_cart();
		WC()->cart->add_to_cart($product_id, 1, null, null, $checkout_data);

	} else if( !empty($payment_type) && $payment_type === 'wallet' ){
		$product_id		= !empty($checkout_data['wallet_id']) ? intval($checkout_data['wallet_id']) : 0 ;
		$woocommerce->cart->empty_cart();
		WC()->cart->add_to_cart($product_id, 1, null, null, $checkout_data);
	}
	
?>
<!doctype html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<title><?php esc_html_e('Mobile Checkout Template','taskbot-api');?></title>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class('tb-mobile-checkout-body'); ?>>
	<?php echo $image_url	= TASKBOT_API_URL.'/public/images/loader.png';?>
		<div class="preloader-outer">
			<div class="sv-preloader_holder">
				<div class="sv-loader"> 
					<img class="fa-spin" src="<?php echo esc_url($image_url);?>" alt="<?php esc_attr_e('Loading...','taskbot-api');?>">
				</div>
			</div>
		</div>
		<div style="display:none;">
			<form name="checkout" id="mobile_checkout" method="post" class="woocommerce-checkout" action="<?php echo esc_url( $checkout_url );?>?platform=mobile" enctype="multipart/form-data">
			</form>
		</div>               
		<script type="text/javascript"> setTimeout(function(){document.getElementById("mobile_checkout").submit();}, 500);</script>
	</body>
</html>
<?php } ?>