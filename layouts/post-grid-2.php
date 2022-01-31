<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package Post Blcok
 */

?>

<style>.frhd__post-block-main.frhd__post-grid-2 {max-width: <?php echo esc_attr( $frhd_block_max_width ); ?>px !important;}.frhd__post-grid-2 .frhd__post-block-wrap {flex-basis: calc(100% / <?php echo esc_html( $frhd_post_column . ' - ' . $posts_col_gap . 'px' ); ?>);}.frhd__post-grid-2.frhd__post-block-main{row-gap: <?php echo esc_attr( $posts_row_gap ); ?>px;}.frhd__post-grid-2 .frhd__post-title a{color: <?php echo esc_attr( $post_title_color ); ?>;}.frhd__post-grid-2 .frhd__post-block-wrap{background-color: <?php echo esc_attr( $post_body_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta, .frhd__post-meta a{color: <?php echo esc_attr( $posts_meta_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta svg{fill: <?php echo esc_attr( $posts_meta_icon_color ); ?>}.frhd__post-grid-2 .frhd__post-excerpt p{color: <?php echo esc_attr( $post_desc_color ); ?>;}.frhd__post-grid-2 .frhd__reading-time{color: <?php echo esc_attr( $post_reading_time_color ); ?>;}.frhd__post-grid-2 .frhd__reading-time svg{fill: <?php echo esc_attr( $post_reading_time_icon_color ); ?>;}.frhd__post-grid-2 .frhd__paginate .page-numbers{color: <?php echo esc_attr( $post_pagination_num_color ); ?>;background: <?php echo esc_attr( $post_pagination_bg_color ); ?>;}.frhd__post-grid-2 .frhd__paginate .page-numbers.current{color: <?php echo esc_attr( $post_pagi_active_num_color ); ?>;background: <?php echo esc_attr( $post_pagi_active_bg_color ); ?>;}.frhd__post-grid-2 .frhd__date-wrap{background: <?php echo esc_attr( $post_date_bg_color ); ?> !important;}.frhd__post-grid-2 .frhd__date-wrap:before{border-left: 10px solid <?php echo esc_attr( $post_date_bg_color ); ?> !important;}</style>
<div class="frhd__post-block-main frhd__post-grid-2">
	<?php
	while ( $frhd_post_query->have_posts() ) {

		$frhd_post_query->the_post();

		?>
		<article class="frhd__post-block-wrap">
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

					if ( $post_taxonomy_show ) {

						$frhd_category_name = get_the_category( get_the_ID() );
						if ( $frhd_category_name ) {

							echo '<div class="frhd__date-wrap"><time>' . esc_html( get_the_date( 'd' ) ) . '</time><br><time>' . esc_html( get_the_date( 'M' ) ) . '</time></div>';
						}
					}
					?>
				</div>
			</div>

			<div class="frhd__article-body">
			<div class="frhd__post-meta">
					<?php
					if ( $post_date_show ) {

						echo '<time class="frhd__post-date"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>';
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

				if ( $post_excerpt_show ) {

					echo '<div class="frhd__cat-wrap">Added to: ' . get_the_category_list( ', ' ) . '</div>';
				}

				if ( $post_author_show ) {

					echo '<div class="frhd__post-author"><img src="' . esc_url( get_avatar_url( get_the_ID() ) ) . '" width="20" height="20">By <strong>' . esc_html( get_the_author() ) . '</strong></div>';
				}
				?>
			</div>
		</article>
		<?php

	}
	wp_reset_postdata();

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
