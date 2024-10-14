<?php
/**
 * Test basic fields.
 *
 * @package    Meta Box
 * @subpackage MB Comment Meta
 */

add_filter( 'rwmb_meta_boxes', function ( $meta_boxes ) {
	$prefix = 'your_prefix_';

	$meta_boxes[] = array(
		'title'  => esc_html__( 'Standard Fields', 'mb-comment-meta' ),
		'type'   => 'comment',
		'fields' => array(
			array(
				'name'              => esc_html__( 'Text', 'mb-comment-meta' ),
				'label_description' => esc_html__( 'Some description', 'mb-comment-meta' ),
				'id'                => "{$prefix}text",
				'desc'              => esc_html__( 'Text description', 'mb-comment-meta' ),
				'type'              => 'text',
				'std'               => esc_html__( 'Default text value', 'mb-comment-meta' ),
				'clone'             => true,
			),
			array(
				'name' => esc_html__( 'Checkbox', 'mb-comment-meta' ),
				'id'   => "{$prefix}checkbox",
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name'    => esc_html__( 'Radio', 'mb-comment-meta' ),
				'id'      => "{$prefix}radio",
				'type'    => 'radio',
				'options' => array(
					'value1' => esc_html__( 'Label1', 'mb-comment-meta' ),
					'value2' => esc_html__( 'Label2', 'mb-comment-meta' ),
				),
			),
			array(
				'name'        => esc_html__( 'Select', 'mb-comment-meta' ),
				'id'          => "{$prefix}select",
				'type'        => 'select',
				'options'     => array(
					'value1' => esc_html__( 'Label1', 'mb-comment-meta' ),
					'value2' => esc_html__( 'Label2', 'mb-comment-meta' ),
				),
				'multiple'    => false,
				'std'         => 'value2',
				'placeholder' => esc_html__( 'Select an Item', 'mb-comment-meta' ),
			),
			array(
				'name' => esc_html__( 'Textarea', 'mb-comment-meta' ),
				'desc' => esc_html__( 'Textarea description', 'mb-comment-meta' ),
				'id'   => "{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		),
	);

	return $meta_boxes;
} );

add_action( 'wp_head', function () {
	if ( ! isset( $_GET['debug'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return;
	}
	$prefix = 'your_prefix_';

	$comment_id = 1;
	$fields     = [ 'text', 'checkbox', 'radio', 'select', 'textarea' ];
	foreach ( $fields as $field ) {
		echo '<h1>Field: ', esc_html( $field ), '</h1>';
		echo '<p><code>rwmb_meta()</code></p>';
		$value = rwmb_meta( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		var_dump( $value ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_dump
		echo '<p><code>rwmb_get_value()</code></p>';
		$value = rwmb_get_value( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		var_dump( $value ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_dump
		echo '<p><code>rwmb_the_value()</code></p>';
		rwmb_the_value( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		echo '<br><br><hr><br>';
	}
	echo 'Done';
	die;
} );
