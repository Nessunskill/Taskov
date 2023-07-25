<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package taskov
 */

?>


</div>
<div class="mobile-panel-bg fixed hide"></div>
<section class="mobile-panel bg-white fixed w-full z-60 hide">
    <div class="mobile-menu fz20 fw600 mb-20">
        <ul>
            <li class="block mb-30 current"><a href="" class="gray">Найти услугу</a></li>
            <li class="block mb-30"><a href="" class="gray">Найти задание</a></li>
            <li class="block mb-30"><a href="" class="gray">О нас</a></li>
            <li class="block mb-30"><a href="" class="gray">Блог</a></li>
        </ul>
    </div>
    <div class="mobile-button mb-50">
        <a href="" class="btn-white w-full mb-5">Войти</a>
        <a href="" class="btn w-full">Зарегистрироваться</a>
    </div>
    <dl class="mobile-social">
        <dt class="fz14 fw600 op-50 mb-15">Связаться с нами:</dt>
        <dd class="flex">
            <a href="" target="_blank" class="flex aic jcc mr-15 border-1"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/telegram-2.svg'></i></a>
            <a href="" target="_blank" class="flex aic jcc border-1"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/vk-2.svg'></i></a>
        </dd>
    </dl>
</section>
<?php wp_footer(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/li-scroller.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.li-scroller.1.0.js"></script>
<script>
    $(function () {
        $("ul#ticker02").liScroll({
            travelocity: 0.15
        });
    });
</script>

</body>
</html>
