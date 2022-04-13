<?php
/**
 * Plugin Name: Post Block
 * Plugin URI: https://www.wpqode.com/post-block/
 * Description: A beautiful post layouts block to showcase your posts in grid and list layout with multiple templates availability.
 * Author: WPQode
 * Author URI: https://www.wpqode.com
 * Version: 5.0.1
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
define( 'POST_BLOCK_VERSION', '5.0.1' );

/**
 * Get Block Posts Attributes.
 *
 * @param Mixed $attributes Get attributes from block settings.
 * @return HTML
 */
function frhd_render_block_core( $attributes ) {

	// Get attributes value from editor page.
	$frhd_block_id              = isset( $attributes['id'] ) ? $attributes['id'] : '0';
	$frhd_post_layout           = isset( $attributes['postLayout'] ) ? $attributes['postLayout'] : 'grid1';
	$frhd_block_max_width       = isset( $attributes['maxWidth'] ) ? $attributes['maxWidth'] : '1140px';
	$frhd_post_column           = isset( $attributes['postCol'] ) ? $attributes['postCol'] : '3';
	$post_title_color           = isset( $attributes['postTitleColor'] ) ? $attributes['postTitleColor'] : '#371f0e';
	$posts_meta_color           = isset( $attributes['postMetaColor'] ) ? $attributes['postMetaColor'] : '#424242';
	$posts_meta_icon_color      = isset( $attributes['postMetaIconColor'] ) ? $attributes['postMetaIconColor'] : '#424242';
	$post_taxonomy_bg_color     = isset( $attributes['taxonomyBGcolor'] ) ? $attributes['taxonomyBGcolor'] : '#ffc107';
	$post_desc_color            = isset( $attributes['postDescColor'] ) ? $attributes['postDescColor'] : '#4b4f58';
	$post_btn_txt_color         = isset( $attributes['postBtnTextColor'] ) ? $attributes['postBtnTextColor'] : '#ffffff';
	$post_btn_color             = isset( $attributes['postBtnColor'] ) ? $attributes['postBtnColor'] : '#d32f2f';
	$post_btn_hover_color       = isset( $attributes['hoverBtnColor'] ) ? $attributes['hoverBtnColor'] : '#ef5350';
	$post_pagination_num_color  = isset( $attributes['paginationNumColor'] ) ? $attributes['paginationNumColor'] : '#ffffff';
	$post_pagi_active_num_color = isset( $attributes['pagiActiveNumColor'] ) ? $attributes['pagiActiveNumColor'] : '#ffffff';
	$post_pagi_active_bg_color  = isset( $attributes['pagiActiveBGColor'] ) ? $attributes['pagiActiveBGColor'] : '#c1c1c1';
	$posts_per_page             = isset( $attributes['postsPerPage'] ) ? $attributes['postsPerPage'] : '6';
	$post_categories            = isset( $attributes['theCategories'] ) ? $attributes['theCategories'] : 'random';
	$post_query                 = isset( $attributes['postQuery'] ) ? $attributes['postQuery'] : '';
	$post_order                 = isset( $attributes['postOrder'] ) ? $attributes['postOrder'] : 'DESC';
	$post_thumb_size            = isset( $attributes['postThumbSize'] ) ? $attributes['postThumbSize'] : 'medium';
	$posts_col_gap              = isset( $attributes['colGap'] ) ? $attributes['colGap'] : '15';
	$posts_excerpt_word_count   = isset( $attributes['excerptWordCount'] ) ? $attributes['excerptWordCount'] : '19';
	$post_pagination_align      = isset( $attributes['paginationAlign'] ) ? $attributes['paginationAlign'] : 'left';
	$post_thumb_show            = isset( $attributes['hasPostThumb'] ) ? $attributes['hasPostThumb'] : true;
	$post_title_show            = isset( $attributes['hasPostTitle'] ) ? $attributes['hasPostTitle'] : true;
	$post_author_show           = isset( $attributes['hasPostAuthor'] ) ? $attributes['hasPostAuthor'] : true;
	$post_date_show             = isset( $attributes['hasPostDate'] ) ? $attributes['hasPostDate'] : true;
	$post_comment_show          = isset( $attributes['hasPostComment'] ) ? $attributes['hasPostComment'] : false;
	$post_taxonomy_show         = isset( $attributes['hasPostTaxonomy'] ) ? $attributes['hasPostTaxonomy'] : true;
	$post_btn_show              = isset( $attributes['hasPostbtn'] ) ? $attributes['hasPostbtn'] : true;
	$post_pagination            = isset( $attributes['hasPostPagin'] ) ? $attributes['hasPostPagin'] : true;
	$post_view_count            = isset( $attributes['hasViewCount'] ) ? $attributes['hasViewCount'] : true;
	$post_love_react            = isset( $attributes['hasLoveReact'] ) ? $attributes['hasLoveReact'] : false;
	$post_title_font_size       = isset( $attributes['titleFontSize'] ) ? $attributes['titleFontSize'] : '22px';
	$post_title_font_weight     = isset( $attributes['titleFontWeight'] ) ? $attributes['titleFontWeight'] : 'bold';
	$post_title_line_height     = isset( $attributes['titleLineHeight'] ) ? $attributes['titleLineHeight'] : '28px';
	$post_title_letter_spacing  = isset( $attributes['titleLetterSpacing'] ) ? $attributes['titleLetterSpacing'] : '0px';
	$post_title_text_transform  = isset( $attributes['titleTextTransform'] ) ? $attributes['titleTextTransform'] : 'inherit';
	$post_meta_font_size        = isset( $attributes['metaFontSize'] ) ? $attributes['metaFontSize'] : '16px';
	$post_meta_font_weight      = isset( $attributes['metaFontWeight'] ) ? $attributes['metaFontWeight'] : 'normal';
	$post_meta_line_height      = isset( $attributes['metaLineHeight'] ) ? $attributes['metaLineHeight'] : '16px';
	$post_meta_letter_spacing   = isset( $attributes['metaLetterSpacing'] ) ? $attributes['metaLetterSpacing'] : '0px';
	$post_meta_text_transform   = isset( $attributes['metaTextTransform'] ) ? $attributes['metaTextTransform'] : 'inherit';
	$post_meta_icon_size        = isset( $attributes['metaIconSize'] ) ? $attributes['metaIconSize'] : '15px';
	$post_desc_font_size        = isset( $attributes['descFontSize'] ) ? $attributes['descFontSize'] : '19px';
	$post_btn_font_size         = isset( $attributes['buttonFontSize'] ) ? $attributes['buttonFontSize'] : '16px';
	$post_btn_font_weight       = isset( $attributes['buttonFontWeight'] ) ? $attributes['buttonFontWeight'] : 'normal';
	$post_btn_text_transform    = isset( $attributes['buttonTextTransform'] ) ? $attributes['buttonTextTransform'] : 'inherit';
	$post_thumb_equal_show      = isset( $attributes['hasEqualHeight'] ) ? $attributes['hasEqualHeight'] : false;
	$post_thumb_equal_size      = isset( $attributes['equalHeightSize'] ) ? $attributes['equalHeightSize'] : '200px';

	$post_thumb_equal_size_render = '';
	if ( $post_thumb_equal_show ) {

		$post_thumb_equal_size_render = 'max-height:' . $post_thumb_equal_size . ';';
	}

	// Protect against arbitrary paged values.
	// $frhd_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
	if ( is_front_page() ) {

		$frhd_paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	} else {

		$frhd_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}

	$args = array(
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish',
		'post_type'      => 'post',
		'cat'            => $post_categories,
		'order'          => $post_order,
		'orderby'        => 'date',
		'paged'          => $frhd_paged,
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

			case 'grid3':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-3.php';
				wp_enqueue_style( 'post-grid-3' );
				break;

			case 'grid4':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-4.php';
				wp_enqueue_style( 'post-grid-4' );
				break;

			case 'grid5':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-5.php';
				wp_enqueue_style( 'post-grid-5' );
				break;

			case 'grid6':
				require plugin_dir_path( __FILE__ ) . 'layouts/post-grid-6.php';
				wp_enqueue_style( 'post-grid-6' );
				break;
		}

		// Pagination.
		if ( $post_pagination ) {

			$frhd_big        = 999999999; // Need an unlikely integer.
			$frhd_page_limit = max( 1, $frhd_post_query->max_num_pages );
			// $frhd_page_limit = min( 2, $frhd_post_query->max_num_pages ); // 2 = page limit.
			$frhd_page_limit = isset( $frhd_page_limit ) ? $frhd_page_limit : $posts_per_page;

			echo '<div class="frhd__paginate">';
			$frhd_arg = array(
				'base'      => str_replace( $frhd_big, '%#%', esc_url( get_pagenum_link( $frhd_big ) ) ),
				'format'    => '?paged=%#%',
				'current'   => $frhd_paged,
				'total'     => $frhd_page_limit,
				'prev_next' => true,
				'prev_text' => __( '«' ),
				'next_text' => __( '»' ),
			);
			echo wp_kses_post( paginate_links( $frhd_arg ) );
			echo '</div>'; // frhd__paginate.
			echo '</div>'; // frhd__post-block-wrapper.
		}

		return ob_get_clean(); // Turn off ouput buffer and print output.

	} else {

		return '<p>No posts found!</p>';
	}

}

/**
 * Get Block Posts Attributes.
 *
 * @param Mixed $attributes Get attributes from block settings.
 * @return HTML
 */
function frhd_render_block_catpost( $attributes ) {

	ob_start(); // Turn on output buffering.

	require plugin_dir_path( __FILE__ ) . 'layouts/post-group-1.php';

	return ob_get_clean(); // Turn off ouput buffer and print output.

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
		true
	);

	wp_register_style(
		'post-block-editor',
		plugins_url( 'src/editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/editor.css' )
	);

	wp_register_style(
		'post-block-css',
		plugins_url( 'src/style.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/style.css' )
	);

	wp_register_script(
		'post-block-js',
		plugins_url( 'src/script.js', __FILE__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/script.js' ),
		true
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

	/**
	 * Post Block End here.
	 * Also Post Group Start from here.
	 * Rest of the code wraped with a condition.
	 */
	wp_register_style(
		'post-group-editor',
		plugins_url( 'src/block-post-cat/post-group-editor.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/block-post-cat/post-group-editor.css' )
	);
	wp_register_style(
		'post-group-css',
		plugins_url( 'src/block-post-cat/post-group.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'src/block-post-cat/post-group.css' )
	);

	/**
	 * Register Block Type : Category Post.
	 */
	$rbtcp_args = array(
		'api_version'     => 2,
		'style'           => 'post-group-css',
		'editor_style'    => 'post-group-editor',
		'editor_script'   => 'post-block-esnext',
		'attributes'      => array(
			'groupImage'       => array(
				'type'    => 'string',
				'default' => 'https://via.placeholder.com/300',
			),
			'groupImageObj'    => array(
				'type' => 'object',
			),
			'groupImageSize'   => array(
				'type'    => 'string',
				'default' => 'full',
			),
			'isEqualHeight'    => array(
				'type'    => 'boolean',
				'default' => false,
			),
			'groupImageHeight' => array(
				'type'    => 'string',
				'default' => '300px',
			),
			'theCategories'    => array(
				'type'    => 'array',
				'default' => null,
			),
			'groupTitle'       => array(
				'type'    => 'string',
				'default' => 'Group Title',
			),
			'postsPerPage'     => array(
				'type'    => 'string',
				'default' => '5',
			),
			'titleWordCount'   => array(
				'type'    => 'string',
				'default' => '3',
			),
		),
		'render_callback' => 'frhd_render_block_catpost',
	);

	register_block_type(
		'category-post-view/post-group',
		$rbtcp_args
	);
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

	wp_register_style( 'post-grid-3', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-3.css', array( 'post-block-css' ), POST_BLOCK_VERSION );

	wp_register_style( 'post-grid-4', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-4.css', array( 'post-block-css' ), POST_BLOCK_VERSION );

	wp_register_style( 'post-grid-5', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-5.css', array( 'post-block-css' ), POST_BLOCK_VERSION );

	wp_register_style( 'post-grid-6', plugin_dir_url( __FILE__ ) . 'layouts/assets/post-grid-6.css', array( 'post-block-css' ), POST_BLOCK_VERSION );
}
add_action( 'wp_enqueue_scripts', 'frhd_enqueue_layout_scripts' );
