<?php
/**
 * Entry point for the ATG single page theme.
 *
 * @author Marc Zdon
 * @package ATG
 * @since ATG 1.0
 */
?>
<?php get_header(); ?>
<?php
	/** 
	 * atg_landing hook
	 * This handles rendering the view the users sees when landing on this page.
	 * It contains a parallax scrolling window with multiple rotating images.
	 */
	do_action( 'atg_landing' );
?>
<?php
	/**
	 * atg_menu hook
	 * This handles rendering the main menu and masonry category filtering options.
	 */
	 do_action( 'atg_menu' );
?>
<?php
	/** 
	 * atg_masonry hook
	 * This handles rendering the masonry grid.  
	 * This grid displays posts as featured images that when clicked on will pop out into a lightbox image viewer.
	 */
	do_action( 'atg_masonry' );
?>
<?php
	/** 
	 * atg_testimonial hook
	 * This handles rendering the client testimonials.
	 */
	do_action( 'atg_testimonial' );
?>
<?php
	/** 
	 * atg_visual_highlight hook
	 * This handles rendering a visual highlight carousel of images.
	 */
	do_action( 'atg_visual_highlight' );
?>
<?php
	/** 
	 * atg_case_study hook
	 * This handles rendering a highlighted project.
	 * It includes an image or images and a snippet of background information.
	 */
	do_action( 'atg_case_study' );
?>
<?php
	/** 
	 * atg_quote hook
	 * This handles rendering a large inspirational quote.
	 */
	do_action( 'atg_quote' );
?>
<?php
	/** 
	 * atg_contact hook
	 * This handles rendering a contact information area.
	 */
	do_action( 'atg_contact' );
?>
<?php
	/**
	 * The footer will handle rendering social links and disclaimer.
	 */
	get_footer(); 
?>