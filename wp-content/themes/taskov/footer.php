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
