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
		'title'  => esc_html__( 'Standard Fields', 'your-prefix' ),
		'type'   => 'comment',
		'fields' => array(
			array(
				'name'              => esc_html__( 'Text', 'your-prefix' ),
				'label_description' => esc_html__( 'Some description', 'your-prefix' ),
				'id'                => "{$prefix}text",
				'desc'              => esc_html__( 'Text description', 'your-prefix' ),
				'type'              => 'text',
				'std'               => esc_html__( 'Default text value', 'your-prefix' ),
				'clone'             => true,
			),
			array(
				'name' => esc_html__( 'Checkbox', 'your-prefix' ),
				'id'   => "{$prefix}checkbox",
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name'    => esc_html__( 'Radio', 'your-prefix' ),
				'id'      => "{$prefix}radio",
				'type'    => 'radio',
				'options' => array(
					'value1' => esc_html__( 'Label1', 'your-prefix' ),
					'value2' => esc_html__( 'Label2', 'your-prefix' ),
				),
			),
			array(
				'name'        => esc_html__( 'Select', 'your-prefix' ),
				'id'          => "{$prefix}select",
				'type'        => 'select',
				'options'     => array(
					'value1' => esc_html__( 'Label1', 'your-prefix' ),
					'value2' => esc_html__( 'Label2', 'your-prefix' ),
				),
				'multiple'    => false,
				'std'         => 'value2',
				'placeholder' => esc_html__( 'Select an Item', 'your-prefix' ),
			),
			array(
				'name' => esc_html__( 'Textarea', 'your-prefix' ),
				'desc' => esc_html__( 'Textarea description', 'your-prefix' ),
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
	$prefix = 'your_prefix_';

	$comment_id = 1;
	$fields     = [ 'text', 'checkbox', 'radio', 'select', 'textarea' ];
	foreach ( $fields as $field ) {
		echo '<h1>Field: ', $field, '</h1>';
		echo '<p><code>rwmb_meta()</code></p>';
		$value = rwmb_meta( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		var_dump( $value );
		echo '<p><code>rwmb_get_value()</code></p>';
		$value = rwmb_get_value( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		var_dump( $value );
		echo '<p><code>rwmb_the_value()</code></p>';
		rwmb_the_value( $prefix . $field, [ 'object_type' => 'comment' ], $comment_id );
		echo '<br><br><hr><br>';
	}
	echo 'Done';
	die;
} );
