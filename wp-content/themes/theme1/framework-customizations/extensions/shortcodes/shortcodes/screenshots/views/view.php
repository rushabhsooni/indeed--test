<?php if (!defined('FW')) die('Forbidden');

/**
 * @var $atts The shortcode attributes
 */

?>
<?php if( isset( $atts['images'] ) && count( $atts['images'] ) > 0 ): ?>

<!-- Screenshots main container -->
<div class="screenshots-carousel swiper-container">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <?php foreach( $atts['images'] as $k=>$image ): ?>
    <div class="swiper-slide">
    	<img src="<?php echo esc_attr( $image['url'] ); ?>" alt="" />
    </div>
    <?php endforeach; ?>
	</div>
	<div class="iphone-mask"></div>
</div>
<?php endif; 