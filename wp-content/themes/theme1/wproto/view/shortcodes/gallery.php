<!--			
	POST GALLERY SHORTCODE VIEW
-->
<div class="post-gallery">
	<div class="owl-carousel">
		<?php foreach( $data['items'] as $item ): ?>
		<div class="item">
			<?php
				$image = wp_get_attachment_image_src( $item->ID, 'full' );
			?>
			<img src="<?php echo esc_attr( $image[0] ); ?>" alt="" />
		</div>
		<?php endforeach; ?>
	</div>
</div>