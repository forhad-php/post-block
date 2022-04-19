<?php
/**
 * Post Group.
 * Rest of the code wrapped with a condition is this block load or not.
 */
wp_register_style(
	'post-group-editor',
	plugins_url( 'post-group-editor.css', __FILE__ ),
	array( 'wp-edit-blocks' ),
	POST_BLOCK_VERSION
);
wp_register_style(
	'post-group-css',
	plugins_url( 'post-group.css', __FILE__ ),
	array(),
	POST_BLOCK_VERSION
);

/**
 * Register Block Type : Category Post.
 */
$frhdpg_args = array(
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
	$frhdpg_args
);
