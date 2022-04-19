<?php
/**
 * Post Trisec.
 * Rest of the code wrapped with a condition is this block load or not.
 */
wp_register_style(
	'post-trisec-editor',
	plugins_url( 'post-trisec-editor.css', __FILE__ ),
	array( 'wp-edit-blocks' ),
	POST_BLOCK_VERSION
);

wp_register_style(
	'post-trisec-css',
	plugins_url( 'post-trisec.css', __FILE__ ),
	array(),
	POST_BLOCK_VERSION
);

/**
 * Register Block Type : Trisec Post.
 */
$frhdts_args = array(
	'api_version'     => 2,
	'style'           => 'post-trisec-css',
	'editor_style'    => 'post-trisec-editor',
	'editor_script'   => 'post-block-esnext',
	'attributes'      => array(
		'triPostSet'          => array(
			'type'    => 'string',
			'default' => '3',
		),
		'triCategories'       => array(
			'type'    => 'array',
			'default' => null,
		),
		'triIsFeaturedCenter' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'isReversePostSetCol' => array(
			'type'    => 'boolean',
			'default' => false,
		),
		'isTriCustomHeight'   => array(
			'type'    => 'boolean',
			'default' => true,
		),
		'triCustomHeight'     => array(
			'type'    => 'string',
			'default' => '570px',
		),
		'triColGap'           => array(
			'type'    => 'string',
			'default' => '15',
		),
		'triRowGap'           => array(
			'type'    => 'string',
			'default' => '15',
		),
		'triRoundedCorner'    => array(
			'type'    => 'string',
			'default' => '5',
		),
		'triExcerptSize'      => array(
			'type'    => 'string',
			'default' => '30',
		),
		'triFeatThumbSize'    => array(
			'type'    => 'string',
			'default' => 'medium_large',
		),
		'triAsdThumbSize'     => array(
			'type'    => 'string',
			'default' => 'medium',
		),
	),
	'render_callback' => 'frhd_render_block_trisec',
);

register_block_type(
	'trisec-post-view/post-trisec',
	$frhdts_args
);
