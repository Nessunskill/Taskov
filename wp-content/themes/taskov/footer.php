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

<?php
$phone_number = get_theme_mod('phone_number', '');
$email_address = get_theme_mod('email_address', '');
?>

<footer class="bg-black white mt-100">
    <div class="wrap">
        <div class="foot flex jcsb">
            <div class="foot-left">
                <div class="subscrabe mb-50">
                    <div class="fz18 fw600 mb-20">Хотите узнавать первыми про лучшие техники разделки камбалы?</div>
                    <form action="">
                        <div class="form-row flex mb-10">
                            <input type="email" placeholder="E-mail" class="input fxg">
                            <button class="button">Подписаться</button>
                        </div>
                        <div class="agreement fz12">
                            <input type="checkbox" id="agreement">
                            <label for="agreement">согласен на все кроме голодовки</label>
                        </div>
                    </form>
                </div>
                <div class="box-7998">
                    <div class="logo-footer mb-10"><a href="<?php echo home_url(); ?>"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/logo-footer.svg'></i></a></div>
                    <div class="copy fz12">(с) все права надежно защищены</div>
                </div>
            </div>
            <div class="foot-middle">
                <div class="name fz12 mb-20 op-50">О проекте</div>
                <div class="foot-menu fz12 mb-55">
                    <ul>
                        <li><a href="">О нас</a></li>
                        <li><a href="">Блог</a></li>
                        <li><a href="">Способы оплаты</a></li>
                        <li><a href="">Политика конфидециальности</a></li>
                        <li><a href="">Пользовательское соглашение</a></li>
                    </ul>
                </div>
                <div class="box-202 flex hide_992">
                    <a href="" class="mr-10"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/apple-2.svg'></i></a>
                    <a href=""><i data-svg='<?php echo get_template_directory_uri(); ?>/images/google-play-2.svg'></i></a>
                </div>
            </div>
            <div class="foot-right">
                <div class="name fz12 mb-20 op-50">Контакты</div>
                <div class="mb-15">
                    <?php if (!empty($email_address)) : ?>
                        <a class="fz12 fw600 no-under white" href="mailto:<?php echo esc_attr($email_address); ?>"><?php echo esc_html($email_address); ?></a>
                    <?php endif; ?>
                </div>
                <div class="mb-20">
                        <?php if (!empty($phone_number)) : ?>
                            <a class="fz12 fw600 no-under white" href="tel:<?php echo esc_html($phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
                        <?php endif; ?>
                </div>
                <div class="footer-social flex">
                    <a href="" target="_blank" class="mr-15"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/telegram.svg'></i></a>
                    <a href="" target="_blank"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/vk.svg'></i></a>
                </div>
            </div>
            <div class="hide show_992">
                <div class="box-202 flex mt-25">
                    <a href="" class="mr-10"><i data-svg='<?php echo get_template_directory_uri(); ?>/images/apple-2.svg'></i></a>
                    <a href=""><i data-svg='<?php echo get_template_directory_uri(); ?>/images/google-play-2.svg'></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
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
        <a href="<?php echo home_url(); ?>/sign-in" class="btn-white w-full mb-5">Войти</a>
        <a href="<?php echo home_url(); ?>/register" class="btn w-full">Зарегистрироваться</a>
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
