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
<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<style>.frhd__post-block-main.frhd__post-grid-2 {max-width: <?php echo esc_attr( $frhd_block_max_width ); ?>px !important;}.frhd__post-grid-2 .frhd__post-block-wrap {flex-basis: calc(100% / <?php echo esc_html( $frhd_post_column . ' - ' . $posts_col_gap . 'px' ); ?>);}.frhd__post-grid-2.frhd__post-block-main{row-gap: <?php echo esc_attr( $posts_row_gap ); ?>px;}.frhd__post-grid-2 .frhd__post-title a{color: <?php echo esc_attr( $post_title_color ); ?>;}.frhd__post-grid-2 .frhd__post-block-wrap{background-color: <?php echo esc_attr( $post_body_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta{color: <?php echo esc_attr( $posts_meta_color ); ?>;}.frhd__post-grid-2 .frhd__post-meta svg{fill: <?php echo esc_attr( $posts_meta_icon_color ); ?>}.frhd__post-grid-2 .frhd__post-excerpt p{color: <?php echo esc_attr( $post_desc_color ); ?>;}.frhd__post-grid-2 .frhd__reading-time{color: <?php echo esc_attr( $post_reading_time_color ); ?>;}.frhd__post-grid-2 .frhd__reading-time svg{fill: <?php echo esc_attr( $post_reading_time_icon_color ); ?>;}.frhd__post-grid-2 .frhd__paginate .page-numbers{color: <?php echo esc_attr( $post_pagination_num_color ); ?>;background: <?php echo esc_attr( $post_pagination_bg_color ); ?>;}.frhd__post-grid-2 .frhd__paginate .page-numbers.current{color: <?php echo esc_attr( $post_pagi_active_num_color ); ?>;background: <?php echo esc_attr( $post_pagi_active_bg_color ); ?>;}.frhd__post-grid-2 .frhd__date-wrap{background: <?php echo esc_attr( $post_date_bg_color ); ?> !important;}.frhd__post-grid-2 .frhd__date-wrap:before{border-left: 10px solid <?php echo esc_attr( $post_date_bg_color ); ?> !important;}</style>
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

						$frhd_img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
						echo '<img src="' . esc_url( $frhd_img_url ) . '">';
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
