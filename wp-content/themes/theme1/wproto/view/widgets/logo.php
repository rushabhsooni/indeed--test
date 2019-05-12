<?php echo $data['args']['before_widget']; ?>

<?php if ( isset( $data['instance']['logo_url'] ) && $data['instance']['logo_url'] <> '' ) : ?>

	<?php
		$img = $data['instance']['logo_url'];
		$img_2x = $data['instance']['logo_2x_url'] <> '' ? 'data-at2x="' . esc_attr( $data['instance']['logo_2x_url'] ) . '"' : 'data-no-retina';
		$width = isset( $data['instance']['logo_width'] ) && is_numeric( $data['instance']['logo_width'] ) ? $data['instance']['logo_width'] : '';
	?>

<a href="<?php echo home_url(); ?>" class="footer-logo"><img src="<?php echo esc_attr( $img ); ?>" <?php echo $img_2x; ?> alt="" width="<?php echo esc_attr( $width ); ?>" /></a>
<?php endif; ?>

<?php if ( isset( $data['instance']['description'] ) && $data['instance']['description'] <> '' ) : ?>
	<div>
		<?php echo wp_kses_post( $data['instance']['description'] ); ?>
	</div>
<?php endif; ?>

<?php echo $data['args']['after_widget'];