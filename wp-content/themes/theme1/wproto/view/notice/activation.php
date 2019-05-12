<?php $allowed_tags = wp_kses_allowed_html( 'post' ); ?>
<div id="wproto-first-activation-notice" class="updated">

	<?php $theme_name = wp_get_theme(); ?>

	<h3><?php esc_html_e('Dear customer!', 'wplab-unicum'); ?></h3>
	<p><?php printf( wp_kses( __( 'Thank you for purchasing and activating <strong>&laquo;%s&raquo;</strong> theme!', 'wplab-unicum' ), $allowed_tags ), $theme_name ); ?></p>
	
	<p><?php printf( wp_kses( __('If you liked our theme, please <a target="_blank" href="%s">rate it with 5 stars</a>, it will help us to make regular updates and support this theme as long as it will be in demand.', 'wplab-unicum'), $allowed_tags ), 'http://themeforest.net/downloads' ); ?></p>
	
	<p><?php esc_html_e('If you are not satisfied with our product, please do not rush to put a bad rating, contact us about your wishes. We can not guarantee that all of them will be implemented, but the most interesting and popular ideas will be added necessarily!', 'wplab-unicum'); ?></p>
	
	<p><?php esc_html_e('Theme rating is related to further theme development and support directly, please encourage our work!', 'wplab-unicum'); ?></p>
	
	<p><?php echo wp_kses( __('Thank you, and Good luck. Best regards, <strong>WPlab</strong> team.', 'wplab-unicum'), $allowed_tags ); ?></p>
	
	<p><strong><?php echo wp_kses( __( '<a href="#" id="wproto-hide-activation-notice">Hide this message</a>', 'wplab-unicum' ), $allowed_tags ); ?> <img width="16" height="16" style="display: none;" id="wproto-dismiss-activation-loader" src="<?php echo get_template_directory_uri(); ?>/images/admin/ajax-loader.gif" alt="" /></strong></p>
</div>