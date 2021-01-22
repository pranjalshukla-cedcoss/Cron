<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>
<div class="entry-content" style="background-color:burlywood">

<?php
/* Start the Loop */
$args      = array(
	'post_type'   => 'product_key',
	'post_status' => 'publish',
);
$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) :

	$the_query->the_post();
	echo '<center><h1><a href="';
	the_permalink();
	echo '">';
	echo the_title();
	echo '</a></h1></center>';
	echo '';
	the_content();

	if ( '' != get_post_meta( get_the_ID(), 'price', true ) ) {
		echo '<center><h4>Price: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'price', true ) ) . '</center>';
	}
	if ( '' != get_post_meta( get_the_ID(), 'sku', true ) ) {
		echo '<center><h4>Sku: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'sku', true ) ) . '</center>';
	}
	if ( '' != get_post_meta( get_the_ID(), 'review', true ) ) {
		echo '<center><h4>Review: </h4>' . esc_attr( get_post_meta( get_the_ID(), 'review', true ) ) . '</center>';
	}


endwhile; // End of the loop.

?>
</div>
<?php

get_footer();
