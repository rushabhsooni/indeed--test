<?php

	// If Unyson Framework plugin is active
	if( wplab_unicum_utils::is_unyson() && function_exists('fw_ext_sidebars_get_current_position') ) {
		
		$current_position = fw_ext_sidebars_get_current_position();
		
		if ( $current_position !== 'full' ) {
			
			if( $current_position === 'left' ) {
				?>
				
				<aside id="sidebar" class="col-md-3">
					<?php echo fw_ext_sidebars_show( 'blue' ); ?>
				</aside>
				
				<?php
			} else if ( $current_position === 'right' ) {
				?>
				
				<aside id="sidebar" class="col-md-3 col-md-offset-1">
					<?php echo fw_ext_sidebars_show( 'blue' ); ?>
				</aside>
				
				<?php
			}
			
		}
	
	// If Unyson Framework is not active, just show a right sidebar
	} else {
		
		?>
		<aside id="sidebar" class="col-md-3 col-md-offset-1">
			<?php dynamic_sidebar( 'sidebar-right' ); ?>
		</aside>
		<?php
		
	}