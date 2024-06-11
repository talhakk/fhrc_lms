<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package freedome-house-lms
 */

?>
<div class="container">
<?php freedome_house_post_thumbnail(); ?>
	<div class="head">
		<h2>
			<?php echo the_title(); ?>
		</h2>
		
	</div>
	<div class="entry-content">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</div>