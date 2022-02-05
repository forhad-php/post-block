<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Provide Grid-2 public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package Post Blcok
 */

$posts_row_gap       = isset( $attributes['rowGap'] ) ? $attributes['rowGap'] : '30';
$rounded_corner_size = isset( $attributes['roundedCornerSize'] ) ? $attributes['roundedCornerSize'] : '5';
$post_body_color     = isset( $attributes['postBodyColor'] ) ? $attributes['postBodyColor'] : '#f5f5f5';

// Only for POST-GRID-2 layout.
$post_date_bg_color           = isset( $attributes['postDateBGColor'] ) ? $attributes['postDateBGColor'] : '#ffc107';
$taxonomy_pre_color           = isset( $attributes['taxonomyPrecolor'] ) ? $attributes['taxonomyPrecolor'] : '#497898';
$post_author_color            = isset( $attributes['postAuthorColor'] ) ? $attributes['postAuthorColor'] : '#497898';
$post_taxonomy_color          = isset( $attributes['taxonomyColor'] ) ? $attributes['taxonomyColor'] : '#ec398b';
$post_cat_font_size           = isset( $attributes['catFontSize'] ) ? $attributes['catFontSize'] : '20px';
$post_auth_font_size          = isset( $attributes['authFontSize'] ) ? $attributes['authFontSize'] : '20px';
$post_pagination_bg_color     = isset( $attributes['paginationBGColor'] ) ? $attributes['paginationBGColor'] : '#497898';
$post_excerpt_show            = isset( $attributes['hasPostExcerpt'] ) ? $attributes['hasPostExcerpt'] : true;
$reading_time_show            = isset( $attributes['hasReadTime'] ) ? $attributes['hasReadTime'] : true;
$post_reading_time_color      = isset( $attributes['readingTimeColor'] ) ? $attributes['readingTimeColor'] : '#ef5350';
$post_reading_time_icon_color = isset( $attributes['readingTimeIconColor'] ) ? $attributes['readingTimeIconColor'] : '#d32f2f';
?>
<style>#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?>{max-width: <?php echo esc_attr( $frhd_block_max_width ); ?> !important;}.frhd__post-grid-2 .frhd__post-block-article {flex-basis: calc(100% / <?php echo esc_html( $frhd_post_column . ' - ' . $posts_col_gap . 'px' ); ?>);border-radius:<?php echo esc_attr( $rounded_corner_size ); ?>px;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__featured-image img {border-top-left-radius: <?php echo esc_attr( $rounded_corner_size ); ?>px;border-top-right-radius: <?php echo esc_attr( $rounded_corner_size ); ?>px;}.frhd__post-grid-2.frhd__post-block-container{row-gap: <?php echo esc_attr( $posts_row_gap ); ?>px;}.frhd__post-grid-2 .frhd__post-title a{font-size: <?php echo esc_attr( $post_title_font_size ); ?>;color: <?php echo esc_attr( $post_title_color ); ?>;}.frhd__post-grid-2 .frhd__post-block-article{background-color: <?php echo esc_attr( $post_body_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta, .frhd__post-meta a{font-size: <?php echo esc_attr( $post_meta_font_size ); ?>;color: <?php echo esc_attr( $posts_meta_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta svg{height: <?php echo esc_attr( $post_meta_icon_size ); ?>;width: <?php echo esc_attr( $post_meta_icon_size ); ?>;fill: <?php echo esc_attr( $posts_meta_icon_color ); ?>}.frhd__post-grid-2 .frhd__post-excerpt p{font-size: <?php echo esc_attr( $post_desc_font_size ); ?>;color: <?php echo esc_attr( $post_desc_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__cat-wrap a{color: <?php echo esc_attr( $post_taxonomy_color ); ?>}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-grid-2 .frhd__cat-wrap{font-size: <?php echo esc_attr( $post_cat_font_size ); ?>;color: <?php echo esc_attr( $taxonomy_pre_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .page-numbers{color: <?php echo esc_attr( $post_pagination_num_color ); ?>;background: <?php echo esc_attr( $post_pagination_bg_color ); ?>;}.frhd__post-grid-2 .frhd__paginate .page-numbers.current{color: <?php echo esc_attr( $post_pagi_active_num_color ); ?>;background: <?php echo esc_attr( $post_pagi_active_bg_color ); ?>;}.frhd__post-grid-2 .frhd__date-wrap{background: <?php echo esc_attr( $post_date_bg_color ); ?> !important;}.frhd__post-grid-2 .frhd__date-wrap:before{border-left: 10px solid <?php echo esc_attr( $post_date_bg_color ); ?> !important;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-grid-2 .frhd__post-author,#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__post-grid-2 .frhd__post-author a {font-size: <?php echo esc_attr( $post_auth_font_size ); ?>;color: <?php echo esc_attr( $post_author_color ); ?>;}#frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?> .frhd__paginate {text-align: <?php echo esc_attr( $post_pagination_align ); ?>;}</style>
<div id="frhd__block-id-<?php echo esc_attr( $frhd_block_id ); ?>" class="frhd__post-block-wrapper">
	<div class="frhd__post-block-container frhd__post-grid-2">
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

						if ( $post_date_show ) {

							echo '<div class="frhd__date-wrap"><time>' . esc_html( get_the_date( 'd' ) ) . '</time><br><time>' . esc_html( get_the_date( 'M' ) ) . '</time></div>';
						}
						?>
					</div>
				</div>

				<div class="frhd__article-body">
				<div class="frhd__post-meta">
						<?php
						if ( $reading_time_show ) {

							// Reading Time.
							$frhd_post_data     = get_post( get_the_ID() );
							$frhd_content_count = str_word_count( wp_strip_all_tags( $frhd_post_data->post_content ) );
							$frhd_reading_time  = ceil( $frhd_content_count / 200 );
							echo '<span class="frhd__reading-time"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path>
									</svg>' . esc_html( $frhd_reading_time ) . ' Min Read</span>';
						}
						if ( $post_comment_show ) {

							echo '<span class="frhd__post-comment"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"></path></svg>' . esc_html( get_comments_number() ) . '</span>';
						}
						if ( $post_view_count ) {

							$get_post_view_count   = get_post_meta( get_the_ID(), 'post_views_count', true );
							$post_view_total_count = empty( $get_post_view_count ) ? 0 : $get_post_view_count;
							echo '<span class="frhd__post-view"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path></svg>' . esc_html( $post_view_total_count ) . '</span>';
						}
						?>
					</div>
					<?php
					if ( $post_title_show ) {

						echo '<div class="frhd__post-title">
							<h2><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h2>
						</div>';
					}

					if ( $post_excerpt_show ) {

						$frhd_excerpt_trimed = wp_trim_words( get_the_excerpt(), $posts_excerpt_word_count, '...' );
						echo '<div class="frhd__post-excerpt">
									<p>' . esc_html( $frhd_excerpt_trimed ) . '</p>
								</div>';
					}

					if ( $post_taxonomy_show ) {

						$frhd_category_name = get_the_category( get_the_ID() );
						if ( $frhd_category_name ) {

							echo '<div class="frhd__cat-wrap">Added to: ' . get_the_category_list( ', ' ) . '</div>';
						}
					}

					if ( $post_author_show ) {

						echo '<div class="frhd__post-author"><img src="' . esc_url( get_avatar_url( get_the_ID() ) ) . '" width="20" height="20">By <strong>';
						echo esc_url( the_author_posts_link() );
						echo '</strong></div>';
					}
					?>
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
