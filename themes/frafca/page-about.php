<?php

/**
 * The main template file.
 * 
 * @package FRAFCA_Theme
 * Template Name: page-about
 */

get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if (have_posts()) : ?>

            <?php if (is_home() && !is_front_page()) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php /* Start the Loop */ ?>


            <header id="about-page-banner" class="frafca-hero-image about-page-banner">

                <?php get_template_part('template-parts/hero_banner'); ?>

            </header><!-- #about-page-banner -->

            <div class="who-we-are-grid">
                <?php
                    $loop = frafca_cfs('who_we_are');
                    foreach ($loop as $content) :
                        $image = $content['who_we_are_image'];
                        $title = $content['who_we_are_title'];
                        $description = $content['who_we_are_description'];
                        ?>

                    <div class="about-content-image">
                        <?php echo '<img src=' . $image . '">'; ?>
                    </div>

                    <div class="about-content-info">
                        <h3><?php echo $title; ?></h3>
                        <br>
                        <p><?php echo $description; ?></p>
                    </div>

                <?php endforeach; ?>
            </div>

            <div class="location-history">
                <?php $description = frafca_cfs('location_history'); ?>
                <p><?php echo $description; ?></p>
            </div>

            <div class=>
            </div>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>