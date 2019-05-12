<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */
$title_styles = $text_styles = array();
$css_styles = '';
/**
 * Custom Styles
 **/
$css_styles .= wplab_unicum_utils::get_styles( array(
	'top_margin' 			=> isset( $atts['margin_top'] ) && $atts['margin_top'] <> '' ? $atts['margin_top'] : '',
	'right_margin' 		=> isset( $atts['margin_right'] ) && $atts['margin_right'] <> '' ? $atts['margin_right'] : '',
	'bottom_margin' 	=> isset( $atts['margin_bottom'] ) && $atts['margin_bottom'] <> '' ? $atts['margin_bottom'] : '',
	'left_margin' 		=> isset( $atts['margin_left'] ) && $atts['margin_left'] <> '' ? $atts['margin_left'] : '',
	'top_padding' 		=> isset( $atts['padding_top'] ) && $atts['padding_top'] <> '' ? $atts['padding_top'] : '',
	'right_padding' 	=> isset( $atts['padding_right'] ) && $atts['padding_right'] <> '' ? $atts['padding_right'] : '',
	'bottom_padding' 	=> isset( $atts['padding_bottom'] ) && $atts['padding_bottom'] <> '' ? $atts['padding_bottom'] : '',
	'left_padding' 		=> isset( $atts['padding_left'] ) && $atts['padding_left'] <> '' ? $atts['padding_left'] : '',
), '');

if( isset( $atts['name_text_color'] ) && $atts['name_text_color'] <> '' ) {
	$title_styles[] = 'color: ' . esc_attr( $atts['name_text_color'] ) . ';';
}

if( isset( $atts['free_text_color'] ) && $atts['free_text_color'] <> '' ) {
	$text_styles[] = 'color: ' . esc_attr( $atts['free_text_color'] ) . ';';
}

$allowed_tags = wp_kses_allowed_html( 'post' );
$uniqid = uniqid();
?>

<?php if( isset( $atts['items'] ) && count( $atts['items'] ) > 0 ): ?>
<div id="shortcode-team-members-id-<?php echo $uniqid; ?>" class="shortcode-team-members" style="<?php echo esc_attr( $css_styles ); ?>">

	<!--
		Photos and content
	-->
	<div class="items">
	
		<?php foreach( $atts['items'] as $k=>$team_member ): ?>
		<div class="item" data-bg="<?php echo esc_attr( $team_member['background_photo']['data']['icon'] ); ?>">
		
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 wow fadeInDown">
		
						<?php if( $team_member['position'] <> '' ): ?>
						<!--
							Position title
						-->
						<div class="position"><?php echo wp_kses( $team_member['position'], $allowed_tags ); ?></div>
						<?php endif; ?>
						
						<?php if( $team_member['name'] <> '' ): ?>
						<!--
							Team mamber name
						-->
						<h2 class="h1 member-title"><?php echo wp_kses( $team_member['name'], $allowed_tags ); ?></h2>
						<?php endif; ?>
						
						<?php if( $team_member['free_text'] <> '' ): ?>
						<!--
							Description
						-->
						<div class="member-text">
							<?php echo apply_filters( 'the_content', $team_member['free_text'] ); ?>
						</div>
						<?php endif; ?>
						
						<div class="links">
							<?php if( $team_member['send_message_button_text'] <> '' ): ?>
							<!--
								Send message button
							-->
							<a href="mailto:<?php echo antispambot( $team_member['email'] ); ?>" class="button green"><?php echo wp_kses( $team_member['send_message_button_text'], $allowed_tags ); ?></a>
							<?php endif; ?> 
							
							<!--
								Social icons
							-->
							<div class="social-icons">
								<?php if( isset( $team_member['linkedin_url'] ) && $team_member['linkedin_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['linkedin_url'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>
								<?php if( $team_member['youtube_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['youtube_url'] ); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
								<?php if( $team_member['vimeo_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['vimeo_url'] ); ?>" target="_blank"><i class="fa fa-vimeo"></i></a><?php endif; ?>
								<?php if( $team_member['facebook_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['facebook_url'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
								<?php if( $team_member['twitter_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['twitter_url'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
								<?php if( $team_member['google_plus_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['google_plus_url'] ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
								<?php if( $team_member['pinterest_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['pinterest_url'] ); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a><?php endif; ?>
								<?php if( $team_member['instagram_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['instagram_url'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
								<?php if( $team_member['flickr_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['flickr_url'] ); ?>" target="_blank"><i class="fa fa-flickr"></i></a><?php endif; ?>
								<?php if( $team_member['behance_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['behance_url'] ); ?>" target="_blank"><i class="fa fa-behance"></i></a><?php endif; ?>
								<?php if( $team_member['google_play_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['google_play_url'] ); ?>" target="_blank"><i class="fa fa-google"></i></a><?php endif; ?>
								<?php if( $team_member['app_store_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['app_store_url'] ); ?>" target="_blank"><i class="fa fa-apple"></i></a><?php endif; ?>
								<?php if( $team_member['windows_marketplace_url'] <> '' ): ?><a href="<?php echo esc_attr( $team_member['windows_marketplace_url'] ); ?>" target="_blank"><i class="fa fa-windows"></i></a><?php endif; ?>
							</div>
						</div>
			
					</div>
				</div>
			</div>
		
		</div>
		<?php endforeach; ?>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			
				<!--
					Pagination
				-->
				<div class="team-pagination">
					<?php foreach( $atts['items'] as $k=>$team_member ): ?>
					<a href="javascript:;" class="current">
						<span class="overlay"></span>
						<?php echo wplab_unicum_media::image( $team_member['avatar_photo']['data']['icon'], 170, 170, true, true, 'full' ); ?>
					</a>
					<?php endforeach; ?>
				</div>
			
			</div>
		</div>
	</div>
	
	<?php if( !empty( $title_styles ) ): ?>
	<style>
		#shortcode-team-members-id-<?php echo $uniqid; ?> .member-title {
			<?php echo implode( ' ', $title_styles ); ?>
		}
	</style>
	<?php endif; ?>
	
	<?php if( !empty( $text_styles ) ): ?>
	<style>
		#shortcode-team-members-id-<?php echo $uniqid; ?> .member-text {
			<?php echo implode( ' ', $text_styles ); ?>
		}
	</style>
	<?php endif; ?>

</div>
<?php endif; 