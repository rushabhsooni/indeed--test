<?php if (!defined('FW')) die('Forbidden');

global $wplab_unicum_core;

/**
 * @var $atts The shortcode attributes
 */
$address = isset( $atts['address'] ) && $atts['address'] <> '' ? $atts['address'] : '';
$address_icon_type = isset( $atts['address_icon_type']['address_icon'] ) ? esc_attr( $atts['address_icon_type']['address_icon'] ) : 'default';
$address_text_color = isset( $atts['address_icon_type']['address_text_color'] ) && $atts['address_icon_type']['address_text_color'] <> '' ? $atts['address_icon_type']['address_text_color'] : '#ffffff';
$address_svg_color = isset( $atts['address_icon_type']['address_svg_icon_color'] ) && $atts['address_icon_type']['address_svg_icon_color'] <> '' ? $atts['address_icon_type']['address_svg_icon_color'] : '#ffffff';

$phone = isset( $atts['phone'] ) && $atts['phone'] <> '' ? $atts['phone'] : '';
$phone_icon_type = isset( $atts['phone_icon_type']['phone_icon'] ) ? esc_attr( $atts['phone_icon_type']['phone_icon'] ) : 'default';
$phone_text_color = isset( $atts['phone_icon_type']['phone_text_color'] ) && $atts['phone_icon_type']['phone_text_color'] <> '' ? $atts['phone_icon_type']['phone_text_color'] : '#ffffff';
$phone_svg_color = isset( $atts['address_icon_type']['phone_svg_icon_color'] ) && $atts['address_icon_type']['phone_svg_icon_color'] <> '' ? $atts['address_icon_type']['phone_svg_icon_color'] : '#ffffff';

$email = isset( $atts['email'] ) && $atts['email'] <> '' ? $atts['email'] : '';
$email_icon_type = isset( $atts['email_icon_type']['email_icon'] ) ? esc_attr( $atts['email_icon_type']['email_icon'] ) : 'default';
$email_text_color = isset( $atts['email_icon_type']['email_text_color'] ) && $atts['email_icon_type']['email_text_color'] <> '' ? $atts['email_icon_type']['email_text_color'] : '#ffffff';
$email_svg_color = isset( $atts['address_icon_type']['email_svg_icon_color'] ) && $atts['address_icon_type']['email_svg_icon_color'] <> '' ? $atts['address_icon_type']['email_svg_icon_color'] : '#ffffff';

$uniqid = uniqid();
$allowed_tags = wp_kses_allowed_html( 'post' );
?>
<!--
	Contact information block
-->
<div id="address-shortcode-id-<?php echo $uniqid; ?>" class="contact-information">

	<?php if( $address <> '' ): ?>
	<!--
		Address
	-->
	<div class="item item-address <?php if( $address_icon_type == 'default' ): ?>address<?php endif; ?>">
	
		<?php if( $address_icon_type == 'fontawesome' ): ?>
		<i class="fa <?php echo esc_attr( $atts['address_icon_type']['fontawesome']['icon'] ); ?>"></i>
		<?php elseif( $address_icon_type == 'custom' ): ?>
			<img src="<?php echo esc_attr( $atts['address_icon_type']['custom']['custom_image']['url'] ); ?>" class="image-svg" alt="" />
		<?php endif; ?>
	
		<p><?php echo nl2br( wp_kses( $address, $allowed_tags ) ); ?></p>
	
	</div>
	<?php endif; ?>
	
	<?php if( $phone <> '' ): ?>
	<!--
		Phones and Fax
	-->
	<div class="item item-phones <?php if( $phone_icon_type == 'default' ): ?>phones<?php endif; ?>">
	
		<?php if( $phone_icon_type == 'fontawesome' ): ?>
		<i class="fa <?php echo esc_attr( $atts['phone_icon_type']['fontawesome']['icon'] ); ?>"></i>
		<?php elseif( $phone_icon_type == 'custom' ): ?>
			<img src="<?php echo esc_attr( $atts['phone_icon_type']['custom']['custom_image']['url'] ); ?>" class="image-svg" alt="" />
		<?php endif; ?>
	
		<p>
			<?php echo nl2br( wp_kses( $phone, $allowed_tags ) ); ?>
		</p>
	
	</div>
	<?php endif; ?>
	
	<?php if( $email <> '' ): ?>
	<!--
		Email
	-->
	<div class="item item-email <?php if( $email_icon_type == 'default' ): ?>email<?php endif; ?>">
	
		<?php if( $email_icon_type == 'fontawesome' ): ?>
		<i class="fa <?php echo esc_attr( $atts['email_icon_type']['fontawesome']['icon'] ); ?>"></i>
		<?php elseif( $email_icon_type == 'custom' ): ?>
			<img src="<?php echo esc_attr( $atts['email_icon_type']['custom']['custom_image']['url'] ); ?>" class="image-svg" alt="" />
		<?php endif; ?>
	
		<p>
			<?php echo wplab_unicum_utils::emailize( nl2br( wp_kses( $email, $allowed_tags ) ) ); ?>
		</p>
	
	</div>
	<?php endif; ?>

	<div id="contacts-style-div-<?php echo $uniqid; ?>"></div>

	<?php ob_start(); ?>
		#address-shortcode-id-<?php echo $uniqid; ?> .item-address {
			color: <?php echo $address_text_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-phones {
			color: <?php echo $phone_text_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-email {
			color: <?php echo $email_text_color; ?>
		}
		
		#address-shortcode-id-<?php echo $uniqid; ?> .item-address i.fa {
			color: <?php echo $address_svg_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-phones i.fa {
			color: <?php echo $phone_svg_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-email i.fa {
			color: <?php echo $email_svg_color; ?>
		}
		
		#address-shortcode-id-<?php echo $uniqid; ?> .item-address path {
			fill: <?php echo $address_svg_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-phones path {
			fill: <?php echo $phone_svg_color; ?>
		}
		#address-shortcode-id-<?php echo $uniqid; ?> .item-email path {
			fill: <?php echo $email_svg_color; ?>
		}
<?php
	$inline_css = ob_get_clean(); 
	echo '<script>var htmlDiv = document.getElementById("contacts-style-div-'.$uniqid.'"); htmlDiv.innerHTML = "<style>'.preg_replace('/[\n\r]/',"",$inline_css).'</style>";</script>';
?>
</div>