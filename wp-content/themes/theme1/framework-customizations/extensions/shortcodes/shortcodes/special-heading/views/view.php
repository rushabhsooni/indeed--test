<?php

// Prevent direct access
if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$allowed_tags = wp_kses_allowed_html( 'post' );

/**
 * @var $atts
 */

$css_classes = $atttibutes = $header_style = array();

/**
 * Custom CSS Classes
 **/
if( isset( $atts['custom_classes'] ) && $atts['custom_classes'] <> '' ) {
	$css_classes[] = esc_attr( $atts['custom_classes'] );
}

/**
 * Custom styles
 **/
if( isset( $atts['text_align'] ) && $atts['text_align'] <> '' ) {
	$header_style[] = 'text-align: ' . esc_attr( $atts['text_align'] ) . ';';
}

if( isset( $atts['text_transform'] ) && $atts['text_transform'] <> '' ) {
	$header_style[] = 'text-transform: ' . esc_attr( $atts['text_transform'] ) . ';';
}

if( isset( $atts['font_style'] ) && $atts['font_style'] <> '' ) {
	$header_style[] = 'font-style: ' . esc_attr( $atts['font_style'] ) . ';';
}

if( isset( $atts['font_variant'] ) && $atts['font_variant'] <> '' ) {
	$header_style[] = 'font-variant: ' . esc_attr( $atts['font_variant'] ) . ';';
}

if( isset( $atts['font_weight'] ) && $atts['font_weight'] <> '' ) {
	$header_style[] = 'font-weight: ' . esc_attr( $atts['font_weight'] ) . ';';
}

if( isset( $atts['header_color'] ) && $atts['header_color'] <> '' ) {
	$header_style[] = 'color: ' . esc_attr( $atts['header_color'] ) . ';';
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
 * Build a header
 **/
$css_classes = implode( ' ', $css_classes );
$atttibutes = implode( ' ', $atttibutes );
$header_style = implode( ' ', $header_style );
$heading = "<{$atts['heading']} class=\"{$css_classes}\" {$atttibutes} style=\"{$header_style}\">{$atts['title']}</{$atts['heading']}>";
echo wp_kses( $heading, $allowed_tags );