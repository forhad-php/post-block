<?php
/**
 * Plugin Name: Post Block
 * Plugin URI: https://www.forhad.net/post-block/
 * Description: A beautiful post layouts block to showcase your posts in grid and list layout with multiple templates availability.
 * Author: Forhad
 * Author URI: https://www.forhad.net
 * Version: 2.1.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Text Domain: post-block
 */

/**
 * Renders the post block on server.
 *
 * @param Array $attributes Get attribute from index.js.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'POST_BLOCK_VERSION', '2.1.0' );

/**
 * Get Block Posts Attributes.
 *
 * @param Mixed $attributes Get attributes from block settings.
 * @return HTML
 */
function frhd_render_block_core( $attributes ) {

	// Get attributes value from editor page.
	$frhd_block_id                = $attributes['id'] ? $attributes['id'] : '0';
	$frhd_post_layout             = $attributes['postLayout'] ? $attributes['postLayout'] : 'grid1';
	$frhd_block_max_width         = $attributes['maxWidth'] ? $attributes['maxWidth'] : '1140';
	$frhd_post_column             = $attributes['postCol'] ? $attributes['postCol'] : '3';
	$post_title_color             = $attributes['postTitleColor'] ? $attributes['postTitleColor'] : '#371f0e';
	$posts_meta_color             = $attributes['postMetaColor'] ? $attributes['postMetaColor'] : '#424242';
	$posts_meta_icon_color        = $attributes['postMetaIconColor'] ? $attributes['postMetaIconColor'] : '#424242';
	$post_body_color              = $attributes['postBodyColor'] ? $attributes['postBodyColor'] : '#f5f5f5';
	$post_taxonomy_color          = $attributes['taxonomyColor'] ? $attributes['taxonomyColor'] : '#000000';
	$post_taxonomy_bg_color       = $attributes['taxonomyBGcolor'] ? $attributes['taxonomyBGcolor'] : '#ffc107';
	$post_desc_color              = $attributes['postDescColor'] ? $attributes['postDescColor'] : '#4b4f58';
	$post_btn_txt_color           = $attributes['postBtnTextColor'] ? $attributes['postBtnTextColor'] : '#ffffff';
	$post_btn_color               = $attributes['postBtnColor'] ? $attributes['postBtnColor'] : '#d32f2f';
	$post_btn_hover_txt_color     = $attributes['hoverBtnTextColor'] ? $attributes['hoverBtnTextColor'] : '#ffffff';
	$post_btn_hover_color         = $attributes['hoverBtnColor'] ? $attributes['hoverBtnColor'] : '#ef5350';
	$post_reading_time_color      = $attributes['readingTimeColor'] ? $attributes['readingTimeColor'] : '#ef5350';
	$post_reading_time_icon_color = $attributes['readingTimeIconColor'] ? $attributes['readingTimeIconColor'] : '#d32f2f';
	$post_pagination_num_color    = $attributes['paginationNumColor'] ? $attributes['paginationNumColor'] : '#ffffff';
	$post_pagination_bg_color     = $attributes['paginationBGColor'] ? $attributes['paginationBGColor'] : '#d32f2f';
	$post_pagi_active_num_color   = $attributes['pagiActiveNumColor'] ? $attributes['pagiActiveNumColor'] : '#ffffff';
	$post_pagi_active_bg_color    = $attributes['pagiActiveBGColor'] ? $attributes['pagiActiveBGColor'] : '#c1c1c1';
	$posts_per_page               = $attributes['postsPerPage'] ? $attributes['postsPerPage'] : '6';
	$post_categories              = $attributes['theCategories'] ? $attributes['theCategories'] : 'random';
	$post_query                   = $attributes['postQuery'] ? $attributes['postQuery'] : '';
	$post_thumb_size              = $attributes['postThumbSize'] ? $attributes['postThumbSize'] : 'medium';
	$posts_col_gap                = $attributes['colGap'] ? $attributes['colGap'] : '15';
	$posts_excerpt_word_count     = $attributes['excerptWordCount'] ? $attributes['excerptWordCount'] : '19';
	$post_thumb_show              = isset( $attributes['hasPostThumb'] ) ? $attributes['hasPostThumb'] : true;
	$post_title_show              = isset( $attributes['hasPostTitle'] ) ? $attributes['hasPostTitle'] : true;
	$post_author_show             = isset( $attributes['hasPostAuthor'] ) ? $attributes['hasPostAuthor'] : true;
	$post_date_show               = isset( $attributes['hasPostDate'] ) ? $attributes['hasPostDate'] : true;
	$post_comment_show            = isset( $attributes['hasPostComment'] ) ? $attributes['hasPostComment'] : false;
	$post_taxonomy_show           = isset( $attributes['hasPostTaxonomy'] ) ? $attributes['hasPostTaxonomy'] : true;
	$post_excerpt_show            = isset( $attributes['hasPostExcerpt'] ) ? $attributes['hasPostExcerpt'] : true;
	$post_btn_show                = isset( $attributes['hasPostbtn'] ) ? $attributes['hasPostbtn'] : true;
	$reading_time_show            = isset( $attributes['hasReadTime'] ) ? $attributes['hasReadTime'] : true;
	$post_pagination              = isset( $attributes['hasPostPagin'] ) ? $attributes['hasPostPagin'] : true;
	$post_view_count              = isset( $attributes['hasViewCount'] ) ? $attributes['hasViewCount'] : true;
	$post_love_react              = isset( $attributes['hasLoveReact'] ) ? $attributes['hasLoveReact'] : false;

	// Protect against arbitrary paged values.
	$frhd_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	$args = array(
		'posts_per_page' => $posts_per_page,
		'post_type'      => 'post',
		'paged'          => $frhd_paged,
		'cat'            => $post_categories,
		'order'          => 'DESC',
	);

	if ( 'popular' == $post_query ) {

		$args['orderby']  = 'meta_value_num';
		$args['meta_key'] = 'post_views_count';
	}

	$frhd_post_query = new WP_Query( $args );

	if ( $frhd_post_query->have_posts() ) {

		ob_start(); // Turn on output buffering.

		switch ( $frhd_post_layout ) {

			case 'grid1':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-1.php';
				wp_enqueue_style( 'post-grid-1' );
				break;

			case 'grid2':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-2.php';
				wp_enqueue_style( 'post-grid-2' );
				break;
		}

		return ob_get_clean(); // Turn off ouput buffer and print output.

	} else {

		return '<p>No posts found!</p>';
	}

}

/**
 * Register Block and initial setupment.
 *
 * @return void
 */
function frhd_register_block() {

	// Automatically load dependencies and version.
	$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

	wp_register_script(
		'post-block-esnext',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' ),
		true,
	);

	wp_register_style(
		'post-block-editor',
		plugins_url( 'src/editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/editor.css' ),
	);

	wp_register_style(
		'post-block-css',
		plugins_url( 'src/style.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/style.css' ),
	);

	wp_register_script(
		'post-block-js',
		plugins_url( 'src/script.js', __FILE__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/script.js' ),
		true,
	);

	$rbt_args = array(
		'api_version'     => 2,
		'style'           => 'post-block-css',
		'editor_style'    => 'post-block-editor',
		'editor_script'   => 'post-block-esnext',
		'render_callback' => 'frhd_render_block_core',
	);

	$pb_plugin_settings = (array) get_option( 'pb-plugin-settings' );
	$pb_heart_react     = isset( $pb_plugin_settings['pb_heart_react'] ) ? $pb_plugin_settings['pb_heart_react'] : 0;
	if ( 1 == $pb_heart_react ) {

		$rbt_args['script'] = 'post-block-js';
	}

	register_block_type(
		'gutenberg-post-view/post-block',
		$rbt_args
	);

	// Starting session to post view counter.
	if ( ! session_id() ) {

		session_start();
	}
}
add_action( 'init', 'frhd_register_block' );

/**
 * Set post views count using post meta.
 *
 * @param Number $frhd_the_post_id The post ID.
 * @return void
 */
function frhd_set_post_views( $frhd_the_post_id ) {

	$frhd_key_count = 'post_views_count';
	$frhd_count     = get_post_meta( $frhd_the_post_id, $frhd_key_count, true );
	if ( '' === $frhd_count ) {

		$frhd_count = 0;
		delete_post_meta( $frhd_the_post_id, $frhd_key_count );
		add_post_meta( $frhd_the_post_id, $frhd_key_count, '0' );
	} else {

		$frhd_count++;
		update_post_meta( $frhd_the_post_id, $frhd_key_count, $frhd_count );
	}
}

/**
 * Execute post views count using post meta.
 *
 * @param Mix $content The content.
 * @return void
 */
function frhd_set_mod_views( $content ) {

	if ( is_single() ) {

		if ( ! isset( $_SESSION['hasVisited'] ) ) {

			frhd_set_post_views( get_the_ID() );

			$_SESSION['hasVisited'] = 'Visited!';
		}
	}
}
add_filter( 'wp_head', 'frhd_set_mod_views' );

/**
 * Calling The Admin Options.
 */
require_once plugin_dir_path( __FILE__ ) . 'post-block-admin-options.php';

/**
 * Enqueue styles for layout.
 */
function frhd_enqueue_layout_scripts() {

	wp_register_style( 'post-grid-1', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-1.css', array( 'post-block-css' ), POST_BLOCK_VERSION );

	wp_register_style( 'post-grid-2', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-2.css', array( 'post-block-css' ), POST_BLOCK_VERSION );
}
add_action( 'wp_enqueue_scripts', 'frhd_enqueue_layout_scripts' );
