<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

/**
 * Provide Trisec 1 public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @package Post Blcok
 */
$frhd_tri_block_id            = isset( $attributes['id'] ) ? $attributes['id'] : '0';
$frhd_tri_post_set            = isset( $attributes['triPostSet'] ) ? $attributes['triPostSet'] : '3';
$frhd_tri_cats                = isset( $attributes['triCategories'] ) ? $attributes['triCategories'] : 'random';
$frhd_tri_is_custom_height    = isset( $attributes['isTriCustomHeight'] ) ? $attributes['isTriCustomHeight'] : true;
$frhd_tri_is_reverse_post_col = isset( $attributes['isReversePostSetCol'] ) ? $attributes['isReversePostSetCol'] : false;
$frhd_tri_is_featured_center  = isset( $attributes['triIsFeaturedCenter'] ) ? $attributes['triIsFeaturedCenter'] : false;
$frhd_tri_custom_height       = isset( $attributes['triCustomHeight'] ) ? $attributes['triCustomHeight'] : '570px';
$frhd_tri_col_gap             = isset( $attributes['triColGap'] ) ? $attributes['triColGap'] : '15';
$frhd_tri_row_gap             = isset( $attributes['triRowGap'] ) ? $attributes['triRowGap'] : '15';
$frhd_tri_rounded_size        = isset( $attributes['triRoundedCorner'] ) ? $attributes['triRoundedCorner'] : '5';
$frhd_tri_excerpt_size        = isset( $attributes['triExcerptSize'] ) ? $attributes['triExcerptSize'] : '30';
$frhd_tri_feat_thumb_size     = isset( $attributes['triFeatThumbSize'] ) ? $attributes['triFeatThumbSize'] : 'medium_large';
$frhd_tri_asd_thumb_size      = isset( $attributes['triAsdThumbSize'] ) ? $attributes['triAsdThumbSize'] : 'medium';

$frhd_args_trisec = array(
	'post_type'      => 'post',
	'posts_per_page' => $frhd_tri_post_set,
	'cat'            => $frhd_tri_cats,
	'order'          => 'DESC',
);

$frhd_post_query = new WP_Query( $frhd_args_trisec );

if ( $frhd_post_query->have_posts() ) {

	$frhd_tri_aside_font_size      = ( '3' == $frhd_tri_post_set ) ? '24px' : '21px';
	$frhd_tri_custom_height_render = ( true !== $frhd_tri_is_custom_height ) ? 'max-content' : $frhd_tri_custom_height;
	$frhd_tri_is_reverse_post_col  = ( true !== $frhd_tri_is_reverse_post_col ) ? 'row' : 'row-reverse';
    $frhd_tri_is_featured_center   = $frhd_tri_is_featured_center ? '.frhd__trisec-wrapper .frhd__trisec-col:nth-child(1){order:2;}.frhd__trisec-wrapper .frhd__trisec-col:nth-child(2){order:1;}.frhd__trisec-wrapper .frhd__trisec-col:nth-child(3){order:3;}' : '';
	echo '<style>#frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . '.frhd__trisec-wrapper{max-height: ' . $frhd_tri_custom_height_render . ';column-gap: ' . $frhd_tri_col_gap . 'px;flex-direction:' . $frhd_tri_is_reverse_post_col . ';}#frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . ' .frhd__trisec-featured,.frhd__trisec-aside-top,.frhd__trisec-aside-bottom{border-radius: ' . $frhd_tri_rounded_size . 'px;}#frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . ' .frhd__trisec-aside{row-gap: ' . $frhd_tri_row_gap . 'px;}#frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . ' .frhd__trisec-aside .frhd__entry-title a{font-size: ' . $frhd_tri_aside_font_size . '}#frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . $frhd_tri_is_featured_center . '</style>';
	echo '<div id="frhd__block-id-' . esc_attr( $frhd_tri_block_id ) . '" class="frhd__trisec-wrapper">';

	while ( $frhd_post_query->have_posts() ) {

		$frhd_post_query->the_post();

		/**
		 * Thumbnail.
		 */
		$frhd_thumb_id = get_post_thumbnail_id( get_the_ID() );
		if ( $frhd_thumb_id ) {

			$frhd_featured_thumb_attach = wp_get_attachment_image_src( $frhd_thumb_id, $frhd_tri_feat_thumb_size );
			$frhd_aside_thumb_attach    = wp_get_attachment_image_src( $frhd_thumb_id, $frhd_tri_asd_thumb_size );
			$frhd_thumb_alt             = get_post_meta( $frhd_thumb_id, '_wp_attachment_image_alt', true );
			if ( empty( $frhd_thumb_alt ) ) {

				$frhd_thumb_alt = get_the_title();
			}
		}

		/**
		 * Get Category IDs.
		 */
		$frhd_category_name = get_the_category( get_the_ID() );

		if ( 0 == $frhd_post_query->current_post ) {

			$frhd_excerpt_trimed = wp_trim_words( get_the_excerpt(), $frhd_tri_excerpt_size, '...' );

			echo '<div class="frhd__trisec-col frhd__trisec-featured">';
			echo '<img class="frhd__tri-thumb" width="' . esc_attr( $frhd_featured_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_featured_thumb_attach[2] ) . '" src="' . esc_url( $frhd_featured_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">';
			echo '<div class="frhd__overlay-wrap">
                    <div class="frhd__overlay-inner">
                        <div class="frhd__categories">';
			foreach ( $frhd_category_name as $frhd_category ) {

				echo '<a href="' . esc_url( get_category_link( $frhd_category->cat_ID ) ) . '" rel="category">' . esc_html( $frhd_category->cat_name ) . '</a>';
			}
						echo '</div>
                        <h2 class="frhd__entry-title">
                            <a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
                        </h2>
                        <p>' . esc_html( $frhd_excerpt_trimed ) . '</p>
                        <time class="frhd__post-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>
                    </div>
                </div>
            </div>
            <div class="frhd__trisec-col frhd__trisec-aside">';

		} elseif ( 1 == $frhd_post_query->current_post ) {

			echo '<div class="frhd__trisec-aside-top">
                <img class="frhd__tri-thumb" width="' . esc_attr( $frhd_aside_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_aside_thumb_attach[2] ) . '" src="' . esc_url( $frhd_aside_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">
                <div class="frhd__overlay-wrap">
                    <div class="frhd__overlay-inner">
                        <div class="frhd__categories">
                            <a href="' . esc_url( get_category_link( $frhd_category_name[0]->cat_ID ) ) . '" rel="category">' . esc_html( $frhd_category_name[0]->cat_name ) . '</a>
                        </div>
                        <h2 class="frhd__entry-title">
                            <a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
                        </h2>
                        <time class="frhd__post-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>
                    </div>
                </div>
            </div>';

		} elseif ( 2 == $frhd_post_query->current_post ) {

			echo '<div class="frhd__trisec-aside-bottom">
                <img class="frhd__tri-thumb" width="' . esc_attr( $frhd_aside_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_aside_thumb_attach[2] ) . '" src="' . esc_url( $frhd_aside_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">
                <div class="frhd__overlay-wrap">
                    <div class="frhd__overlay-inner">
                        <div class="frhd__categories">
                            <a href="' . esc_url( get_category_link( $frhd_category_name[0]->cat_ID ) ) . '" rel="category">' . esc_html( $frhd_category_name[0]->cat_name ) . '</a>
                        </div>
                        <h2 class="frhd__entry-title">
                            <a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
                        </h2>
                        <time class="frhd__post-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>
                    </div>
                </div>
            </div>
        </div>';

		} elseif ( 3 == $frhd_post_query->current_post ) {

			echo '<div class="frhd__trisec-col frhd__trisec-aside">
                <div class="frhd__trisec-aside-top">
                    <img class="frhd__tri-thumb" width="' . esc_attr( $frhd_aside_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_aside_thumb_attach[2] ) . '" src="' . esc_url( $frhd_aside_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">
                    <div class="frhd__overlay-wrap">
                        <div class="frhd__overlay-inner">
                            <div class="frhd__categories">
                                <a href="' . esc_url( get_category_link( $frhd_category_name[0]->cat_ID ) ) . '" rel="category">' . esc_html( $frhd_category_name[0]->cat_name ) . '</a>
                            </div>
                            <h2 class="frhd__entry-title">
                                <a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
                            </h2>
                            <time class="frhd__post-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>
                        </div>
                    </div>
                </div>';

		} else {

			echo '<div class="frhd__trisec-aside-bottom">
                <img class="frhd__tri-thumb" width="' . esc_attr( $frhd_aside_thumb_attach[1] ) . '" height="' . esc_attr( $frhd_aside_thumb_attach[2] ) . '" src="' . esc_url( $frhd_aside_thumb_attach[0] ) . '" alt="' . esc_attr( $frhd_thumb_alt ) . '" loading="lazy">
                <div class="frhd__overlay-wrap">
                    <div class="frhd__overlay-inner">
                        <div class="frhd__categories">
                            <a href="' . esc_url( get_category_link( $frhd_category_name[0]->cat_ID ) ) . '" rel="category">' . esc_html( $frhd_category_name[0]->cat_name ) . '</a>
                        </div>
                        <h2 class="frhd__entry-title">
                            <a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>
                        </h2>
                        <time class="frhd__post-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg>' . esc_html( get_the_date() ) . '</time>
                    </div>
                </div>
            </div>
            </div>';
		}
	}

	wp_reset_postdata();

	echo '</div>'; // frhd__trisec-wrapper.

} else {

	return '<p>No posts found!</p>';
}
