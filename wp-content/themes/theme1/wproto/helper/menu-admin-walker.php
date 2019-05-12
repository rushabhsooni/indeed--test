<?php
/**
 * Admin nav menu custom fields walker
 **/
class wplab_unicum_admin_nav_menu_walker extends Walker_Nav_Menu  {

	function start_lvl( &$output, $depth = 0, $args = array() ) {	
		
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_id = 0 ) {
		global $_wp_nav_menu_max_depth;
	   
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
	
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
	
		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = isset( $original_object->post_title ) ? $original_object->post_title : '';
		}
	
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);
	
		$title = $item->title;
	
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)', 'wplab-unicum' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)', 'wplab-unicum'), $item->title );
		}
	
		$title = empty( $item->label ) ? $title : $item->label;
	
	?>
	<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
		<dl class="menu-item-bar">
			<dt class="menu-item-handle">
				<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<a href="<?php
									echo wp_nonce_url( add_query_arg( array(
													'action' => 'move-up-menu-item',
													'menu-item' => $item_id,
												),
												remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
											),
											'move-menu_item'
									);
									?>" class="item-move-up"><abbr>&#8593;</abbr></a>
									|
									<a href="<?php
										echo wp_nonce_url( add_query_arg( array(
												'action' => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
										);
									?>" class="item-move-down"><abbr>&#8595;</abbr></a>
								</span>
								<a class="item-edit" id="edit-<?php echo $item_id; ?>" href="<?php
									echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
								?>"><?php esc_html_e( 'Edit Menu Item', 'wplab-unicum' ); ?></a>
						</span>
					</dt>
				</dl>
	
				<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
					<?php if( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo $item_id; ?>">
								<?php esc_html_e( 'URL', 'wplab-unicum' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-thin">
						<label for="edit-menu-item-title-<?php echo $item_id; ?>">
							<?php esc_html_e( 'Navigation Label', 'wplab-unicum' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="description description-thin">
						<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
							<?php esc_html_e( 'Title Attribute', 'wplab-unicum' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo $item_id; ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new window/tab', 'wplab-unicum' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
							<?php esc_html_e( 'CSS Classes (optional)', 'wplab-unicum' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'wplab-unicum' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo $item_id; ?>">
							<?php esc_html_e( 'Description', 'wplab-unicum' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'wplab-unicum'); ?></span>
						</label>
					</p>        
					<?php
						/* New fields insertion starts here */
					?>      
					<div style="clear: both"></div>

					<p class="field-custom description description-wide" style="margin-bottom: 4px;">
						<strong><?php esc_html_e( 'Properties', 'wplab-unicum' ); ?>:</strong>
					</p>
					<p class="field-custom description description-wide">
						<label><?php esc_html_e( 'Sub-menu elements will appear at', 'wplab-unicum' ); ?>
						<select style="width: 100%" name="menu_item_submenu_position[<?php echo $item_id; ?>]">
							<option value="right"><?php esc_html_e( 'Right', 'wplab-unicum' ); ?></option>
							<option <?php echo $item->submenu_position == 'left' ? 'selected="selected"' : ''; ?> value="left"><?php esc_html_e( 'Left', 'wplab-unicum' ); ?></option>
						</select>
						</label>
					</p>
					<p class="field-custom description description-wide">
						<label>
							<input <?php echo $item->dont_display_as_link ? 'checked="checked"' : ''; ?> type="checkbox" name="menu_item_dont_display_as_link[<?php echo $item_id; ?>]" value="1" /> <?php esc_html_e( 'Do not display as link', 'wplab-unicum' ); ?>
						</label>
						<br />
						<label>
							<input <?php echo $item->one_page_link ? 'checked="checked"' : ''; ?> type="checkbox" name="menu_item_one_page_link[<?php echo $item_id; ?>]" value="1" /> <?php esc_html_e( '&laquo;One-page&raquo; external menu element', 'wplab-unicum' ); ?>
						</label>
					</p>
					<p class="field-custom description description-wide" style="margin-bottom: 4px;">
						<strong><?php esc_html_e( 'Hide this menu item at', 'wplab-unicum' ); ?>:</strong>
					</p>
					<p class="field-custom description description-wide">
						<label>
							<input <?php echo $item->hide_desktop ? 'checked="checked"' : ''; ?> type="checkbox" name="menu_item_hide_desktop[<?php echo $item_id; ?>]" value="1" /> <?php esc_html_e( 'Desktops', 'wplab-unicum' ); ?>
						</label><br />
						<label>
							<input <?php echo $item->hide_tablet ? 'checked="checked"' : ''; ?> type="checkbox" name="menu_item_hide_tablet[<?php echo $item_id; ?>]" value="1" /> <?php esc_html_e( 'Tablets', 'wplab-unicum' ); ?>
						</label><br />
						<label>
							<input <?php echo $item->hide_phone ? 'checked="checked"' : ''; ?> type="checkbox" name="menu_item_hide_phone[<?php echo $item_id; ?>]" value="1" /> <?php esc_html_e( 'Phones', 'wplab-unicum' ); ?>
						</label>
					</p>
					<div style="clear: both"></div>
					<?php
						/* New fields insertion ends here */
					?>
					<div class="menu-item-actions description-wide submitbox">
						<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s', 'wplab-unicum'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
						<?php endif; ?>
						<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
						echo wp_nonce_url( add_query_arg( array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) ) ),
							'delete-menu_item_' . $item_id
						); ?>"><?php esc_html_e('Remove', 'wplab-unicum'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) ); ?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_html_e('Cancel', 'wplab-unicum'); ?></a>
					</div>
	
					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
	    
				$output .= ob_get_clean();

		}
}
