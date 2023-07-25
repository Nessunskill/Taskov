<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package taskov
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
global $current_user;

$user_name = $current_user->display_name;
$user_identity  = intval($current_user->ID);
$user_avatar = get_avatar_url($current_user->ID,array('size', 42));
?>
<div id="page">
    <div class="page_inner">
        <header>
            <div class="wrap">
                <div class="head flex aic jcsb">
                    <div class="logo"><a href="<?php echo home_url(); ?>"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/logo.svg'></i></a></div>
                    <div class="main-head fz15 fw600 h-full hide_992">
                        <ul class="flex">
                            <li class="active"><a href="">Найти услугу</a></li>
                            <li><a href="">Найти задание</a></li>
                            <li><a href="">Блог</a></li>
                        </ul>
                    </div>
                    <?php if (is_user_logged_in()) { ?>
                        <div class="head-right flex aic hide_992">
                            <a href="<?php echo home_url(); ?>/dashboard/?ref=saved&mode=listing&identity=<?php echo $user_identity; ?>" class="head-button flex aic jcc posr"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/favorite-head.svg'></i><span></span></a>
                            <a href="<?php echo home_url(); ?>/dashboard/?ref=invoices&mode=listing&identity=<?php echo $user_identity; ?>" class="head-button flex aic jcc"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/cart-head.svg'></i></a>
                            <div class="user-head ml-20">
                                <a href="<?php echo home_url(); ?>/dashboard"><img style="height: 42px; width: 42px; border-radius: 100%;" src="<?php echo $user_avatar; ?>" alt="<?php echo $user_name; ?>"></a>
                            </div>
                        </div>
                    <?php } else {?>
                            <div class="main-head fz15 fw600 h-full hide_992">
                                <ul class="flex">
                                    <li><a href="<?php echo home_url(); ?>/sign-in">Вход / Регистрация</a></li>
                                </ul>
                            </div>
                    <?php } ?>

                    <div class="flex hide flex_992">
                        <div class="open-search-mobile  mr-15"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/search.svg'></i></div>
                        <div class="open-menu"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/menu.svg'></i></div>
                    </div>
                </div>
            </div>
        </header>
