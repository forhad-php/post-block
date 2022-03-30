<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Provide Grid-3 public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package Post Blcok
 */

$posts_row_gap                = isset( $attributes['rowGap'] ) ? $attributes['rowGap'] : '15';
$rounded_corner_size          = isset( $attributes['roundedCornerSize'] ) ? $attributes['roundedCornerSize'] : '5';
$post_taxonomy_color          = isset( $attributes['taxonomyColor'] ) ? $attributes['taxonomyColor'] : '#000000';
$post_pagination_bg_color     = isset( $attributes['paginationBGColor'] ) ? $attributes['paginationBGColor'] : '#d32f2f';
$post_excerpt_show            = isset( $attributes['hasPostExcerpt'] ) ? $attributes['hasPostExcerpt'] : true;
$reading_time_show            = isset( $attributes['hasReadTime'] ) ? $attributes['hasReadTime'] : true;
$post_reading_time_color      = isset( $attributes['readingTimeColor'] ) ? $attributes['readingTimeColor'] : '#ef5350';
$post_reading_time_icon_color = isset( $attributes['readingTimeIconColor'] ) ? $attributes['readingTimeIconColor'] : '#d32f2f';
$post_body_color              = isset( $attributes['postBodyColor'] ) ? $attributes['postBodyColor'] : '#f5f5f5';
$post_read_more_custom_txt    = isset( $attributes['readMoreBtnText'] ) ? $attributes['readMoreBtnText'] : 'Read More!';
$post_btn_hover_txt_color     = isset( $attributes['hoverBtnTextColor'] ) ? $attributes['hoverBtnTextColor'] : '#ffffff';
?>
<style>#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?>{max-width: <?php echo esc_attr( $frhd_block_max_width ); ?> !important;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-block-article {border-radius:<?php echo esc_attr( $rounded_corner_size ); ?>px;background-color: <?php echo esc_attr( $post_body_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__featured-image img{border-top-left-radius: <?php echo esc_attr( $rounded_corner_size ); ?>px;border-top-right-radius: <?php echo esc_attr( $rounded_corner_size ); ?>px;<?php echo esc_html( $post_thumb_equal_size_render ); ?>}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-grid-3.frhd__post-block-container{grid-template-columns: repeat(<?php echo esc_attr( $frhd_post_column ); ?>, 1fr);row-gap: <?php echo esc_attr( $posts_row_gap ); ?>px;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-title a{font-size: <?php echo esc_attr( $post_title_font_size ); ?>;font-weight: <?php echo esc_attr( $post_title_font_weight ); ?>;line-height: <?php echo esc_attr( $post_title_line_height ); ?>;letter-spacing: <?php echo esc_attr( $post_title_letter_spacing ); ?>;text-transform: <?php echo esc_attr( $post_title_text_transform ); ?>;color: <?php echo esc_attr( $post_title_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__cat-name a{color: <?php echo esc_attr( $post_taxonomy_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-meta, #frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-meta a{font-size: <?php echo esc_attr( $post_meta_font_size ); ?>;font-weight: <?php echo esc_attr( $post_meta_font_weight ); ?>;line-height: <?php echo esc_attr( $post_meta_line_height ); ?>;letter-spacing: <?php echo esc_attr( $post_meta_letter_spacing ); ?>;text-transform: <?php echo esc_attr( $post_meta_text_transform ); ?>;color: <?php echo esc_attr( $posts_meta_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-meta svg{height: <?php echo esc_attr( $post_meta_icon_size ); ?>;width: <?php echo esc_attr( $post_meta_icon_size ); ?>;fill: <?php echo esc_attr( $posts_meta_icon_color ); ?>}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-excerpt p{font-size: <?php echo esc_attr( $post_desc_font_size ); ?>;color: <?php echo esc_attr( $post_desc_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-btn a{font-size: <?php echo esc_attr( $post_btn_font_size ); ?>;font-weight: <?php echo esc_attr( $post_btn_font_weight ); ?>;text-transform: <?php echo esc_attr( $post_btn_text_transform ); ?>;color: <?php echo esc_attr( $post_btn_txt_color ); ?>;background: <?php echo esc_attr( $post_btn_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> #frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-btn:hover a{color: <?php echo esc_attr( $post_btn_hover_txt_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-btn:hover a{background-color: <?php echo esc_attr( $post_btn_hover_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__reading-time{font-size: <?php echo esc_attr( $post_meta_font_size ); ?>;color: <?php echo esc_attr( $post_reading_time_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__reading-time svg{height: <?php echo esc_attr( $post_meta_icon_size ); ?>;width: <?php echo esc_attr( $post_meta_icon_size ); ?>;fill: <?php echo esc_attr( $post_reading_time_icon_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .page-numbers{color: <?php echo esc_attr( $post_pagination_num_color ); ?>;background: <?php echo esc_attr( $post_pagination_bg_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .page-numbers.current{color: <?php echo esc_attr( $post_pagi_active_num_color ); ?>;background: <?php echo esc_attr( $post_pagi_active_bg_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__paginate {text-align: <?php echo esc_attr( $post_pagination_align ); ?>;}</style>
<div id="frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?>" class="frhd__post-block-wrapper">
	<div class="frhd__post-block-container frhd__post-grid-3">
		<?php
		while ( $frhd_post_query->have_posts() ) {

			$frhd_post_query->the_post();

			?>
			<article class="frhd__post-block-article">
				<div class="frhd__article-head">
					<div class="frhd__featured-image">
						<?php
						if ( $post_thumb_show ) {

							$frhd_thumb_id = get_post_thumbnail_id( get_the_ID() );

							if ( $frhd_thumb_id ) {

								$frhd_thumb_attach = wp_get_attachment_image_src( $frhd_thumb_id, $post_thumb_size );
								$frhd_thumb_alt    = get_post_meta( $frhd_thumb_id, '_wp_attachment_image_alt', true );
								if ( empty( $frhd_thumb_alt ) ) {

									$frhd_thumb_alt = get_the_title();
								}

								echo '<img width="' . esc_attr( $frhd_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_thumb_attach[2] ) . '" src="' . esc_url( $frhd_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">';
							}
						}

						if ( $post_love_react ) {

							echo '<div class="frhd__user-react" data-id="' . get_the_ID() . '">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
							</div>';
						}
						?>
					</div>
				</div>

				<div class="frhd__article-body">
					<?php
					if ( $post_title_show ) {

						echo '<div class="frhd__post-title">
							<h2><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h2>
						</div>';
					}
					?>
					<div class="frhd__post-meta">
						<?php
						echo 'Posted on ' . esc_html( get_the_date() );
						echo ' by ';
						echo '<strong>';
						echo esc_url( the_author_posts_link() );
						echo '</strong>';
						if ( $post_taxonomy_show ) {

							$frhd_category_name = get_the_category( get_the_ID() );
							if ( $frhd_category_name ) {

								echo '<div class="frhd__cat-wrap">&nbsp;in&nbsp;' . get_the_category_list( ',&nbsp;' ) . '</div>';
							}
						}
						?>
					</div>
					<?php
					if ( $post_excerpt_show ) {

						$frhd_excerpt_trimed = wp_trim_words( get_the_excerpt(), $posts_excerpt_word_count, '...' );
						echo '<div class="frhd__post-excerpt">
									<p>' . esc_html( $frhd_excerpt_trimed ) . '</p>
								</div>';
					}
					?>
					<div class="frhd__post-btn">
					<?php
					if ( $post_btn_show ) {

						echo '<a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $post_read_more_custom_txt ) . '</a>';
					}
					?>
					</div>
				</div>
			</article>
			<?php

		}
		wp_reset_postdata();
		?>
	</div>
	<?php
	// Pagination.
	if ( $post_pagination ) {

		$frhd_big = 999999999; // Need an unlikely integer.
		echo '<div class="frhd__paginate">';
		$frhd_arg = array(
			'base'      => str_replace( $frhd_big, '%#%', esc_url( get_pagenum_link( $frhd_big ) ) ),
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $frhd_post_query->max_num_pages,
			'prev_text' => __( '«' ),
			'next_text' => __( '»' ),
		);
		echo wp_kses_post( paginate_links( $frhd_arg ) );
		echo '</div>'; // frhd_paginate.
	}
	?>
</div>
