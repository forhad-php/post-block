<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Provide Group-1 public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package Post Blcok
 */

$frhd_group_block_id      = isset( $attributes['id'] ) ? $attributes['id'] : '0';
$frhd_group_cat           = isset( $attributes['theCategories'] ) ? $attributes['theCategories'] : 'random';
$frhd_group_name          = isset( $attributes['groupTitle'] ) ? $attributes['groupTitle'] : 'Group Title';
$frhd_group_img_size      = isset( $attributes['groupImageSize'] ) ? $attributes['groupImageSize'] : 'full';
$frhd_group_image_obj     = isset( $attributes['groupImageObj'] ) ? $attributes['groupImageObj'] : '';
$frhd_group_image_url     = isset( $frhd_group_image_obj[ $frhd_group_img_size ]['url'] ) ? $frhd_group_image_obj[ $frhd_group_img_size ]['url'] : 'https://via.placeholder.com/300';
$frhd_group_img_width     = isset( $frhd_group_image_obj[ $frhd_group_img_size ]['width'] ) ? $frhd_group_image_obj[ $frhd_group_img_size ]['width'] : '';
$frhd_group_img_height    = isset( $frhd_group_image_obj[ $frhd_group_img_size ]['height'] ) ? $frhd_group_image_obj[ $frhd_group_img_size ]['height'] : '';
$frhd_gr_img_equal        = isset( $attributes['isEqualHeight'] ) ? $attributes['isEqualHeight'] : false;
$frhd_gr_img_equal_size   = isset( $attributes['groupImageHeight'] ) ? $attributes['groupImageHeight'] : '200px';
$frhd_group_total_post    = isset( $attributes['postsPerPage'] ) ? $attributes['postsPerPage'] : '5';
$frhd_group_title_word    = isset( $attributes['titleWordCount'] ) ? $attributes['titleWordCount'] : '3';
$frhd_gr_img_equal_render = '';
if ( $frhd_gr_img_equal ) {

	$frhd_gr_img_equal_render = '#frhd__block-id-' . $frhd_group_block_id . ' .frhd__post-group-image img{max-height: ' . $frhd_gr_img_equal_size . ';}';
}
?>
<style><?php echo esc_html( $frhd_gr_img_equal_render ); ?></style>
<div id="frhd__block-id-<?php echo esc_attr( $frhd_group_block_id ); ?>" class="frhd__post-group-wrapper">
	<div class="frhd__post-group-image">
		<img width="<?php echo esc_attr( $frhd_group_img_width ); ?>" height="<?php echo esc_attr( $frhd_group_img_height ); ?>" src="<?php echo esc_url( $frhd_group_image_url ); ?>" alt="<?php esc_html( $frhd_group_name ); ?>" loading="lazy">
	</div>
	<div class="frhd__post-group-name">
		<h3><?php echo esc_html( $frhd_group_name ); ?></h3>
	</div>
	<?php
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $frhd_group_total_post,
		'cat'            => $frhd_group_cat,
		'order'          => 'DESC',
	);

	$frhd_post_query = new WP_Query( $args );

	if ( $frhd_post_query->have_posts() ) {

		echo '<div class="frhd__post-list-wrap">';
		while ( $frhd_post_query->have_posts() ) {

			$frhd_post_query->the_post();

			$frhd_post_title_trimed = wp_trim_words( get_the_title(), $frhd_group_title_word, '...' );
			echo '<p><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $frhd_post_title_trimed ) . '</a></p>';
		}
		wp_reset_postdata();
		echo '</div>';

	} else {

		return '<p>No posts found!</p>';
	}
	?>
</div>
