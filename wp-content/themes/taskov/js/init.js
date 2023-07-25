$(document).ready(function ($) {
    $(document).on('click', '.js_open_popup', function (e) {
        e.preventDefault();
        const id = $(this).attr('href');
        $(id).addClass('active');
    });
    $('[data-svg]').not('loaded').each(function () {
        var $i = $(this).addClass('loaded');

        $.get($i.data('svg'), function (data) {
            var $svg = $(data).find('svg');

            $svg.attr('class', $i.attr('class'));
            $i.replaceWith($svg);
        }, 'xml');
    });
    $('#reviews-home').slick({
        arrows: false,
        dots: true,
        fade: true,
        infinite: true,
        autoplay: true,
        nextArrow: '<span class="slick-next"><i class="fas fa-chevron-circle-right"></i></span>',
        prevArrow: '<span class="slick-prev"><i class="fas fa-chevron-circle-left"></i></span>',
        autoplaySpeed: 3000,
        speed: 500,
        adaptiveHeight: false,
        variableWidth: false,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.popular-tags-text').slick({
        arrows: false,
        dots: false,
        fade: false,
        infinite: true,
        autoplay: true,
        nextArrow: '<span class="slick-next"><i class="fas fa-chevron-circle-right"></i></span>',
        prevArrow: '<span class="slick-prev"><i class="fas fa-chevron-circle-left"></i></span>',
        autoplaySpeed: 0,
        speed: 8000,
        cssEase: 'linear',
        adaptiveHeight: false,
        variableWidth: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    $('.open-menu').click(function () {
        $(this).toggleClass('active');
        $('header').toggleClass('bg-white');
        $('.mobile-panel-bg').toggle(0);
        $('.mobile-panel').toggle(0);
    });
    $('.mobile-panel-bg').click(function () {
        $('.open-menu').removeClass('active');
        $('header').removeClass('bg-white');
        $('.mobile-panel-bg').hide(0);
        $('.mobile-panel').hide(0);
    });
    $('.open-sort').click(function () {
        $(this).toggleClass('active');
        $('.filter-hide-bg-2').toggle(0);
        $('.sort-hide-box').toggle(0);
        $('.filter-hide-box').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-hide-bg').hide(0);
        $('.open-filter').removeClass('active');
        $('.catalog-search').toggleClass('active-mobile-fon');
    });
    $('.open-filter').click(function () {
        $(this).toggleClass('active');
        $('.filter-hide-bg').toggle(0);
        $('.filter-hide-box').toggle(0);
        $('.filter-hide-menu').hide(0);
        $('.sort-hide-box').hide(0);
        $('.filter-hide-bg-2').hide(0);
        $('.open-sort').removeClass('active');
        $('.filter-box-row').removeClass('active');
        $('.filter-hide-menu').hide(0);
    });
    $('.open-catalog-menu').click(function () {
        $('.filter-box-row').addClass('active');
        $('.filter-hide-menu').show(0);
    });
    $('.filter-hide-bg').click(function () {
        $('.filter-hide-bg').hide(0);
        $('.filter-hide-bg-2').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-hide-box').hide(0);
        $('.sort-hide-box').hide(0);
        $('.open-filter').removeClass('active');
        $('.open-sort').removeClass('active');
        $('.catalog-search').removeClass('active-mobile-fon');
        $('.filter-hide-bg-2').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-box-row').removeClass('active');
        $('.filter-hide-menu ul').removeClass('hide-li');
        $('.filter-hide-menu li ul').hide(0);
    });
    $('.filter-hide-bg-2').click(function () {
        $('.filter-hide-bg').hide(0);
        $('.filter-hide-bg-2').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-hide-box').hide(0);
        $('.sort-hide-box').hide(0);
        $('.open-filter').removeClass('active');
        $('.open-sort').removeClass('active');
        $('.catalog-search').removeClass('active-mobile-fon');
        $('.filter-hide-bg-2').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-box-row').removeClass('active');
        $('.filter-hide-menu ul').removeClass('hide-li');
        $('.filter-hide-menu li ul').hide(0);
    });
    $('.close-box').click(function () {
        $(this).parent().parent().hide(0);
        $('.filter-hide-bg').hide(0);
        $('.open-filter').removeClass('active');
        $('.open-sort').removeClass('active');
        $('.catalog-search').removeClass('active-mobile-fon');
        $('.filter-hide-bg-2').hide(0);
        $('.filter-hide-menu').hide(0);
        $('.filter-box-row').removeClass('active');
        $('.filter-hide-menu ul').removeClass('hide-li');
        $('.filter-hide-menu li ul').hide(0);
    });
    $('.show-additional-work').click(function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.additional-work').toggle('');
    });
    $('.delete-a').click(function (e) {
        e.preventDefault();
        $(this).parent().remove('');
    });
    $('.filter-hide-menu a').click(function (e) {
        e.preventDefault();
    });
    $('.filter-hide-menu li li a').click(function (e) {
        e.preventDefault();
    });
    if ($(window).width() < 992) {
        $('a.a-lvl-1').on('click', function (e) {
            e.preventDefault();
            $(this).parent().parent().addClass('hide-li');
            $(this).parent().find('ul').show(0);
            $('.back-memu-lvl-1').hide(0);
            $('.back-memu-lvl-2').show(0);
        });
        $('.back-memu-lvl-1').click(function () {
            $('.filter-box-row').removeClass('active');
            $('.filter-hide-menu').hide(0);
        });
        $('.back-memu-lvl-2').click(function () {
            $('.filter-hide-menu ul').removeClass('hide-li');
            $('.filter-hide-menu li ul').hide(0);
            $('.back-memu-lvl-1').show(0);
            $('.back-memu-lvl-2').hide(0);
        });
    }
    $('.service-tab-nav').delegate('li:not(.current)', 'click', function () {
        $(this).addClass('current').siblings().removeClass('current').parents('.service-tab').find('div.service-tab-box').hide().eq($(this).index()).fadeIn(200);
    });
    $('.tab-nav').delegate('li:not(.current)', 'click', function () {
        $(this).addClass('current').siblings().removeClass('current').parents('#tab').find('div.tab-box').hide().eq($(this).index()).fadeIn(200);
    });
    $('.compound-nav').delegate('li:not(.current)', 'click', function () {
        $(this).addClass('current').siblings().removeClass('current').parents('.compound-tab').find('div.compound-box').hide().eq($(this).index()).fadeIn(200);
    });
    $('.service-right-tab--nav').delegate('li:not(.current)', 'click', function () {
        $(this).addClass('current').siblings().removeClass('current').parents('.service-right-tab').find('div.service-right-tab--box').hide().eq($(this).index()).fadeIn(200);
    });

    $('.open-box').click(function () {
        //$(this).parent().parent().find('.text').hide('');
        //$(this).parent().find('.text').show('');
        $(this).parent().siblings().find('.text').hide('');
        $(this).parent().find('.text').toggle('');
    });
    $(document).mouseup(function (e) {
        var div = $(".filter-hide-menu > ul");
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            $('.filter-box-row').removeClass('active');
            $('.filter-hide-menu').hide(0);
        }
    });
    var div2 = $(".open-catalog-menu span");
    $(".checkbox-category input[type=radio]").click(function () {
        $('.filter-box-row').removeClass('active');
            $('.filter-hide-menu').hide(0);
        var radioVal2 = $(this).val();
        div2.html(radioVal2);
    });

    // Флаг включённости слайдера slick
    var slickSliderActive = false;

    // Включение или выключение слайдера (в зависимости от ширины)
    function checkSlider() {

        // Если вьюпорт уже чем 768 
        if ($(window).width() < 768 - getScroll()) {

            // Если флаг включённости опущен, то включим и поднимем флаг
            if (slickSliderActive == false) {
                $('#service-photo--main').slick({
                    arrows: false,
                    dots: true,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 3000,
                    speed: 500,
                    adaptiveHeight: true,
                    variableWidth: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                });
                slickSliderActive = true;
            }

        }
        // Иначе (вьюпорт НЕ уже чем 768)
        else {

            // Если флаг включённости поднят, выключаем и опускаем флаг
            if (slickSliderActive == true) {
                $('#service-photo--main').slick('unslick');
                slickSliderActive = false;
            }

        }
    };

    // По готовности DOM...
    checkSlider();

    // По любому изменению размера вьюпорта...
    $(window).on('resize', checkSlider);

    function getScroll() {
        var div = document.createElement('div');
        div.style.overflowY = 'scroll';
        div.style.width = '50px';
        div.style.height = '50px';
        div.style.visibility = 'hidden';
        document.body.appendChild(div);
        var scrollWidth = div.offsetWidth - div.clientWidth;
        document.body.removeChild(div);
        return scrollWidth;
    }
});
