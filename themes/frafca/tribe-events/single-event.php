<?php

/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 * Template Name: single-event
 */

if (!defined('ABSPATH')) {
	die('-1');
}


$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<?php get_template_part('template-parts/hero_banner'); ?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<div class="single-event-header">

		<div class="tribe-events-schedule tribe-clearfix single-event-purple get-ticket-header-container">
			<?php the_title('<h1 class="tribe-events-single-event-title">', '</h1>'); ?>
			<?php echo tribe_events_event_schedule_details($event_id, '<i class="far fa-calendar-alt"></i>  ','&nbsp &nbsp', '<h2>', '</h2>'); ?>
		</div>

		<div class="get-ticket-header">
			<?php  
				$ticket = frafca_cfs('ticket');
				foreach($ticket as $ticket) :
						$getticket = $ticket['get_ticket'];
						$price = $ticket['ticket_price'];
						$description = $ticket['ticket_description'];
			?>

				<div class="rect-card purple get-ticket-header">
					<a class='default-btn yellow' href="<?php echo $getticket['url']; ?>" target="<?php echo $getticket['target']; ?>">
						<?php echo $getticket['text']; ?>
					</a>
					<p class="get-ticket-price"><?php echo $price;?></p>
					<p class="get-ticket-description"><?php echo $description;?></p>
				</div>

			<?php endforeach; ?>
		</div>
		
	
	</div>

	<!-- Event header -->
	<!-- <div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>> -->
		<!-- Navigation -->
		<!-- <nav class="tribe-events-nav-pagination" aria-label="<?php printf(esc_html__('%s Navigation', 'the-events-calendar'), $events_label_singular); ?>"> -->
			<!-- <ul class="tribe-events-sub-nav"> -->
				<!-- <li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link('<span>&laquo;</span> %title%') ?></li> -->
				<!-- <li class="tribe-events-nav-next"><?php tribe_the_next_event_link('%title% <span>&raquo;</span>') ?></li> -->
			<!-- </ul> -->
			<!-- .tribe-events-sub-nav -->
		<!-- </nav> -->
	<!-- </div> -->
	<!-- #tribe-events-header -->

	<div class="single-event-content-container">
			<?php while (have_posts()) :  the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<!-- Event featured image, but exclude link -->
						<?php echo tribe_event_featured_image($event_id, 'full', false); ?>

						<!-- Event content -->
						<?php do_action('tribe_events_single_event_before_the_content') ?>
				</div>
							<div class="tribe-events-single-event-description tribe-events-content test">
								<?php the_content(); ?>
							</div>
						<!-- .tribe-events-single-event-description -->
						<?php do_action('tribe_events_single_event_after_the_content') ?>

						<!-- Event meta -->
						<?php do_action('tribe_events_single_event_before_the_meta') ?>
						<?php tribe_get_template_part('modules/meta'); ?>
						<?php do_action('tribe_events_single_event_after_the_meta') ?>
			 <!-- #post-x -->
				<?php if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option('showComments', false)) comments_template() ?>
			<?php endwhile; ?>
	</div>

	<!-- #page-contact -->
	<!-- #tribe-events-footer -->

				<?php  
                    $ticket = frafca_cfs('ticket');
                    foreach($ticket as $ticket) :
                            $getticket = $ticket['get_ticket'];
                            $price = $ticket['ticket_price'];
							$description = $ticket['ticket_description'];
                ?>

                    <div class="rect-card white get-ticket-footer">
                        <a class='default-btn yellow' href="<?php echo $getticket['url']; ?>" target="<?php echo $getticket['target']; ?>">
                            <?php echo $getticket['text']; ?>
						</a>

						<div class="get-ticket-footer-desc">
							<p class="get-ticket-price"><?php echo $price;?></p>
							<p class="get-ticket-description"><?php echo $description;?></p>
						</div>
                        
 
                    </div>

                <?php endforeach; ?>
	

</div><!-- #tribe-events-content -->