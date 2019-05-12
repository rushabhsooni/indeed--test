<?php
	global $wplab_unicum_core, $wplab_unicum_styles, $wplab_unicum_core;
	
	$fonts_array = unserialize( $wplab_unicum_core->controller->io->read( get_template_directory() . '/wproto/fonts.txt' ) );
	
	$fonts = array();

	if( isset( $fonts_array->items ) ) {
		foreach( $fonts_array->items as $font ) {
			$fonts[ $font->family ] = $font->family;
		}
	}	
	
	$saved_styles = get_option('wplab_unicum_theme_styles');
	
?>
<div class="wrap" id="wproto-settings-screen">
	<div id="icon-themes" class="icon32"><br /></div>
	
	<h2 class="nav-tab-wrapper wproto-nav-tab-wrapper">
		<a class="nav-tab nav-tab-active"><?php esc_html_e( 'Change theme Fonts and Colors', 'wplab-unicum'); ?></a>
	</h2>
	
	<form action="" id="wproto-customizer-form" method="post">
	
		<input type="hidden" name="wplab_unicum_action" value="customizer-save" />
	
		<?php if( isset( $_GET['updated'] ) && $_GET['updated'] ): ?>
		<div class="updated">
			<p><?php esc_html_e('Styles were updated', 'wplab-unicum'); ?></p>
		</div>
		<?php endif; ?>
		
		
		<?php foreach( $wplab_unicum_styles as $section_id=>$section ): ?>
		<!--
			SECTION
		-->
	
		<div class="wproto-settings-box">
			<h3 class="title"><?php echo strip_tags( $section['label'] ); ?></h3>
		
			<table class="form-table wproto-form-table">
				<?php foreach( $section['options'] as $option_id=>$option ): $uniqid = uniqid(); ?>
				<tr>
					<th>
						<label><?php echo strip_tags( $option['label'] ); ?>:</label>
					</th>
					<td>
					
						<?php if( $option['type'] == 'font_picker' ): ?>
						<div class="wproto-input wproto-font-picker-holder">
						
							<?php
								$font_size = $font_size_mobile = $line_height = $line_height_mobile = $font_style = $font_weight = $text_transform = $font_variant = $font_family = '';
								
								$font_size = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_size'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_size'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_size'];
								$font_size_mobile = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_size_mobile'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_size_mobile'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_size_mobile'];
								$line_height = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['line_height'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['line_height'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['line_height'];
								$line_height_mobile = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['line_height_mobile'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['line_height_mobile'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['line_height_mobile'];
								$font_style = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_style'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_style'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_style'];
								$font_weight = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_weight'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_weight'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_weight'];
								$text_transform = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['text_transform'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['text_transform'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['text_transform'];
								$font_variant = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_variant'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_variant'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_variant'];
								$font_family = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['font_family'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['font_family'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['font_family'];
							?>
						
							<dl class="half">
								<dt><?php esc_html_e('Font size', 'wplab-unicum'); ?>:</dt>
								<dd><input data-var="<?php echo esc_attr( $option_id ); ?>_font_size" min="0.1" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_size]" type="number" value="<?php echo esc_attr( $font_size ); ?>" step="0.1" />rem</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Font size (for mobile devices)', 'wplab-unicum'); ?>:</dt>
								<dd><input data-var="<?php echo esc_attr( $option_id ); ?>_font_size_mobile" min="0.1" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_size_mobile]" type="number" value="<?php echo esc_attr( $font_size_mobile ); ?>" step="0.1" />rem</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Line height', 'wplab-unicum'); ?>:</dt>
								<dd><input data-var="<?php echo esc_attr( $option_id ); ?>_line_height" class="wpl-line-height" min="1" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][line_height]" type="number" value="<?php echo esc_attr( $line_height ); ?>" />px</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Line height (for mobile devices)', 'wplab-unicum'); ?>:</dt>
								<dd><input data-var="<?php echo esc_attr( $option_id ); ?>_line_height_mobile" min="1" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][line_height_mobile]" type="number" value="<?php echo esc_attr( $line_height_mobile ); ?>" />px</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Font style', 'wplab-unicum'); ?>:</dt>
								<dd>
									
									<select data-var="<?php echo esc_attr( $option_id ); ?>_font_style" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_style]">
										<option <?php echo $font_style == 'normal' ? 'selected="selected"' : ''; ?> value="normal"><?php esc_html_e('Normal', 'wplab-unicum'); ?></option>
										<option <?php echo $font_style == 'italic' ? 'selected="selected"' : ''; ?> value="italic"><?php esc_html_e('Italic', 'wplab-unicum'); ?></option>
										<option <?php echo $font_style == 'oblique' ? 'selected="selected"' : ''; ?> value="oblique"><?php esc_html_e('Oblique', 'wplab-unicum'); ?></option>
									</select>
									
								</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Font weight', 'wplab-unicum'); ?>:</dt>
								<dd>
									
									<select data-var="<?php echo esc_attr( $option_id ); ?>_font_weight" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_weight]">
										<option <?php echo $font_weight == '100' ? 'selected="selected"' : ''; ?> value="100">100</option>
										<option <?php echo $font_weight == '200' ? 'selected="selected"' : ''; ?> value="200">200</option>
										<option <?php echo $font_weight == '300' ? 'selected="selected"' : ''; ?> value="300">300</option>
										<option <?php echo $font_weight == '400' ? 'selected="selected"' : ''; ?> value="400">400</option>
										<option <?php echo $font_weight == '500' ? 'selected="selected"' : ''; ?> value="500">500</option>
										<option <?php echo $font_weight == '600' ? 'selected="selected"' : ''; ?> value="600">600</option>
										<option <?php echo $font_weight == '700' ? 'selected="selected"' : ''; ?> value="700">700</option>
										<option <?php echo $font_weight == '800' ? 'selected="selected"' : ''; ?> value="800">800</option>
										<option <?php echo $font_weight == '900' ? 'selected="selected"' : ''; ?> value="900">900</option>
										<option <?php echo $font_weight == 'bold' ? 'selected="selected"' : ''; ?> value="bold"><?php esc_html_e('Bold', 'wplab-unicum'); ?></option>
										<option <?php echo $font_weight == 'bolder' ? 'selected="selected"' : ''; ?> value="bolder"><?php esc_html_e('Bolder', 'wplab-unicum'); ?></option>
										<option <?php echo $font_weight == 'lighter' ? 'selected="selected"' : ''; ?> value="lighter"><?php esc_html_e('Lighter', 'wplab-unicum'); ?></option>
										<option <?php echo $font_weight == 'normal' ? 'selected="selected"' : ''; ?> value="normal"><?php esc_html_e('Normal', 'wplab-unicum'); ?></option>
									</select>
									
								</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Text transform', 'wplab-unicum'); ?>:</dt>
								<dd>
									
									<select data-var="<?php echo esc_attr( $option_id ); ?>_text_transform" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][text_transform]">
										<option <?php echo $text_transform == 'capitalize' ? 'selected="selected"' : ''; ?> value="capitalize"><?php esc_html_e('Capitalize', 'wplab-unicum'); ?></option>
										<option <?php echo $text_transform == 'lowercase' ? 'selected="selected"' : ''; ?> value="lowercase"><?php esc_html_e('Lowercase', 'wplab-unicum'); ?></option>
										<option <?php echo $text_transform == 'uppercase' ? 'selected="selected"' : ''; ?> value="uppercase"><?php esc_html_e('Uppercase', 'wplab-unicum'); ?></option>
										<option <?php echo $text_transform == 'none' ? 'selected="selected"' : ''; ?> value="none"><?php esc_html_e('None', 'wplab-unicum'); ?></option>
									</select>
									
								</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Font variant', 'wplab-unicum'); ?>:</dt>
								<dd>
									
									<select data-var="<?php echo esc_attr( $option_id ); ?>_font_variant" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_variant]">
										<option <?php echo $font_variant == 'normal' ? 'selected="selected"' : ''; ?> value="normal"><?php esc_html_e('Normal', 'wplab-unicum'); ?></option>
										<option <?php echo $font_variant == 'small-caps' ? 'selected="selected"' : ''; ?> value="small-caps"><?php esc_html_e('Small Caps', 'wplab-unicum'); ?></option>
									</select>
									
								</dd>
							</dl>
							
							<dl class="full">
								<dt><?php esc_html_e('Font family', 'wplab-unicum'); ?>:</dt>
								<dd>
									
									<select data-var="<?php echo esc_attr( $option_id ); ?>_font_family" name="theme_styles[font_picker][<?php echo esc_attr( $option_id ); ?>][font_family]">
										<option <?php echo $font_family == '' ? 'selected="selected"' : ''; ?> value=""><?php esc_html_e('- Default Theme Font', 'wplab-unicum'); ?></option>
										<?php foreach( $fonts as $k=>$font ): ?>
										<option <?php echo $font_family == $k ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr( $k ); ?>"><?php echo $k; ?></option>
										<?php endforeach; ?>
									</select>
									
								</dd>
							</dl>
						</div>
						<?php elseif( $option['type'] == 'color_picker' ): ?>
						
						<div class="wproto-input color-picker">
						
							<?php
								$color = $default_color = '';
								$color = isset( $saved_styles[ $option['type'] ][ $option_id ] ) ? $saved_styles[ $option['type'] ][ $option_id ] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value'];
								$default_color = $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value'];
							?>
							<input data-var="<?php echo esc_attr( $option_id ); ?>" class="wproto-color-picker" name="theme_styles[color_picker][<?php echo esc_attr( $option_id ); ?>]" type="text" value="<?php echo esc_attr( $color ); ?>" data-default-color="<?php echo esc_attr( $default_color ); ?>">
						
						</div>
						
						<?php elseif( $option['type'] == 'bg_picker' ): ?>
						
						<div class="wproto-input wproto-background-picker">
						
							<?php
								$image = $repeat = $pos = $size = $fixed = '';
								$image = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['background_image'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['background_image'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['background_image'];
								$repeat = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['background_repeat'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['background_repeat'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['background_repeat'];
								$pos = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['background_position'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['background_position'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['background_position'];
								$size = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['background_size'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['background_size'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['background_size'];
								$fixed = is_array( $saved_styles ) && isset( $saved_styles[ $option['type'] ][ $option_id ]['background_fixed'] ) ? $saved_styles[ $option['type'] ][ $option_id ]['background_fixed'] : $wplab_unicum_styles[ $section_id ]['options'][ $option_id ]['value']['background_fixed'];
							?>
						
							<dl class="full">
								<dt><?php esc_html_e('Image source', 'wplab-unicum'); ?>:</dt>
								<dd>
									<input data-var="<?php echo esc_attr( $option_id ); ?>_background_image" class="wproto-image-picker-input" id="wproto-image-picker-<?php echo $uniqid; ?>" type="text" name="theme_styles[bg_picker][<?php echo esc_attr( $option_id ); ?>][background_image]" value="<?php echo $image; ?>" />
									<a href="javascript:;" class="button wproto-image-selector" data-url-input="#wproto-image-picker-<?php echo $uniqid; ?>"><?php esc_html_e( 'Upload', 'wplab-unicum' ); ?></a>
									<a href="javascript:;" class="button wproto-image-remover" data-url-input="#wproto-image-picker-<?php echo $uniqid; ?>"><?php esc_html_e( 'Remove', 'wplab-unicum' ); ?></a><br />
								</dd>
							</dl>
							
							<dl class="half left">
								<dt><?php esc_html_e('Background repeat', 'wplab-unicum'); ?>:</dt>
								<dd>
									<select data-var="<?php echo esc_attr( $option_id ); ?>_background_repeat" name="theme_styles[bg_picker][<?php echo esc_attr( $option_id ); ?>][background_repeat]">
										<option value="no-repeat"><?php esc_html_e('no repeat', 'wplab-unicum'); ?></option>
										<option <?php echo $repeat == 'repeat-x' ? 'selected="selected"' : ''; ?> value="repeat-x"><?php esc_html_e('repeat horizontal', 'wplab-unicum'); ?></option>
										<option <?php echo $repeat == 'repeat-y' ? 'selected="selected"' : ''; ?> value="repeat-y"><?php esc_html_e('repeat vertical', 'wplab-unicum'); ?></option>
										<option <?php echo $repeat == 'repeat' ? 'selected="selected"' : ''; ?> value="repeat"><?php esc_html_e('repeat all', 'wplab-unicum'); ?></option>
									</select>
								</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Background position', 'wplab-unicum'); ?>:</dt>
								<dd>
									<select data-var="<?php echo esc_attr( $option_id ); ?>_background_position" name="theme_styles[bg_picker][<?php echo esc_attr( $option_id ); ?>][background_position]">
										<option <?php echo $pos == 'left top' ? 'selected="selected"' : ''; ?> value="left top"><?php esc_html_e('left top', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'left center' ? 'selected="selected"' : ''; ?> value="left center"><?php esc_html_e('left center', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'left bottom' ? 'selected="selected"' : ''; ?> value="left bottom"><?php esc_html_e('left bottom', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'right top' ? 'selected="selected"' : ''; ?> value="right top"><?php esc_html_e('right top', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'right center' ? 'selected="selected"' : ''; ?> value="right center"><?php esc_html_e('right center', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'right bottom' ? 'selected="selected"' : ''; ?> value="right bottom"><?php esc_html_e('right bottom', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'center top' ? 'selected="selected"' : ''; ?> value="center top"><?php esc_html_e('center top', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'center center' ? 'selected="selected"' : ''; ?> value="center center"><?php esc_html_e('center center', 'wplab-unicum'); ?></option>
										<option <?php echo $pos == 'center bottom' ? 'selected="selected"' : ''; ?> value="center bottom"><?php esc_html_e('center bottom', 'wplab-unicum'); ?></option>
									</select>
								</dd>
							</dl>
							
							<dl class="half left">
								<dt><?php esc_html_e('Background size', 'wplab-unicum'); ?>:</dt>
								<dd>
									<select data-var="<?php echo esc_attr( $option_id ); ?>_background_size" name="theme_styles[bg_picker][<?php echo esc_attr( $option_id ); ?>][background_size]">
										<option <?php echo $size == '100% 100%' ? 'selected="selected"' : ''; ?> value="100% 100%"><?php esc_html_e('Normal', 'wplab-unicum'); ?></option>
										<option <?php echo $size == 'contain' ? 'selected="selected"' : ''; ?> value="contain"><?php esc_html_e('Contain', 'wplab-unicum'); ?></option>
										<option <?php echo $size == 'cover' ? 'selected="selected"' : ''; ?> value="cover"><?php esc_html_e('Cover', 'wplab-unicum'); ?></option>
									</select>
								</dd>
							</dl>
							
							<dl class="half">
								<dt><?php esc_html_e('Fixed background?', 'wplab-unicum'); ?>:</dt>
								<dd>
									<select data-var="<?php echo esc_attr( $option_id ); ?>_background_fixed" name="theme_styles[bg_picker][<?php echo esc_attr( $option_id ); ?>][background_fixed]">
										<option value=""><?php esc_html_e('No', 'wplab-unicum'); ?></option>
										<option <?php echo $fixed == 'yes' ? 'selected="selected"' : ''; ?> value="fixed"><?php esc_html_e('Yes', 'wplab-unicum'); ?></option>
									</select>
								</dd>
							</dl>
							
						</div>
						
						<?php endif; ?>
						
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<?php endforeach; ?>
		
		
		<!--
		
			Save button
			
		-->
		<div class="wproto-settings-box save-box">
			<input type="submit" name="wproto_reset_to_defaults" class="button alignleft" value="<?php esc_html_e( 'Reset to defaults', 'wplab-unicum' ); ?>" />
			<input type="submit" class="button button-primary" value="<?php esc_html_e( 'Save settings', 'wplab-unicum' ); ?>" />
		</div>
		
	</form>
	
</div>