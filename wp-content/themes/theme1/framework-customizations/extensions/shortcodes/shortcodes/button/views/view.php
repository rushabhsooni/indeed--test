<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var $atts
 */
$css_classes = $atttibutes = $button_style = array();

if( isset( $atts['color'] ) && in_array( $atts['color'], array('apple', 'android') ) ) {
	$css_classes[] = 'buy-button';
} else {
	$css_classes[] = 'button';
}

/**
 * Custom CSS Classes
 **/
if( isset( $atts['size'] ) && $atts['size'] <> '' ) {
	$css_classes[] = esc_attr( $atts['size'] );
}

if( isset( $atts['color'] ) && $atts['color'] <> '' ) {
	$css_classes[] = esc_attr( $atts['color'] );
}

if( isset( $atts['custom_classes'] ) && $atts['custom_classes'] <> '' ) {
	$css_classes[] = esc_attr( $atts['custom_classes'] );
}

/**
 * Animations
 **/
if( isset( $atts['animation']['enabled'] ) && filter_var( $atts['animation']['enabled'], FILTER_VALIDATE_BOOLEAN ) ) {
	$css_classes[] = 'wow';
	$css_classes[] = $atts['animation']['true']['effect'];
	$atttibutes[] = 'data-wow-delay="' . esc_attr( $atts['animation']['true']['animation_delay'] ) . '"';
}

/**
 * Link href
 **/
if( isset( $atts['link'] ) && $atts['link'] <> '' ) {
	$atttibutes[] = 'href="' . esc_attr( $atts['link'] ) . '"';
}

/**
 * Custom ID
 **/
if( isset( $atts['button_id'] ) && $atts['button_id'] <> '' ) {
	$atttibutes[] = 'id="' . esc_attr( $atts['button_id'] ) . '"';
}

/**
 * Custom target
 **/
if( isset( $atts['target'] ) && $atts['target'] <> '' ) {
	$atttibutes[] = 'target="' . esc_attr( $atts['target'] ) . '"';
}

/**
 * Build a header
 **/
$label = isset( $atts['label'] ) ? esc_attr( $atts['label'] ) : $atts['label'];
$css_classes = implode( ' ', $css_classes );
$atttibutes = implode( ' ', $atttibutes );
$button_style = implode( ' ', $button_style );
echo "<a {$atttibutes} class=\"{$css_classes}\"  style=\"{$button_style}\">{$label}</a>";