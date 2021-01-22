<?php
/**
 * Template Name: Listing Template
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<?php
get_header();
?>
<div class="entry-content" style="background-color:burlywood">
<?php
do_shortcode( '[listing]' );
?>
</div>

<?php
get_footer();
