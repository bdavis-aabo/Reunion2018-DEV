<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * The Template for displaying all single events
 *
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
get_header('mec'); ?>

    <?php if(!is_front_page()): get_template_part('page/page-navigation'); endif; ?>

    <?php do_action('mec_before_main_content'); ?>

        <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_single_page_html_class', 'mec-container'); ?>">
            <?php while(have_posts()): the_post(); ?>

                <?php $MEC = MEC::instance(); echo $MEC->single(); ?>

            <?php endwhile; // end of the loop. ?>
            <?php //comments_template(); ?>
        </section>

    <?php do_action('mec_after_main_content'); ?>

<?php get_footer('mec');
