<?php
	global $wplab_unicum_core;

	switch( $data['instance']['query_type'] ) {
		default:
		case('recent'):
		
			$posts = $wplab_unicum_core->model('post')->get( array(
				'type' 			=> 'all',
				'limit' 		=> $data['instance']['count'],
				'order' 		=> 'date',
				'sort' 			=> 'DESC',
				'post_type' => 'post'
			));
			
		break;
		case('most_commented'):
		
			$posts = $wplab_unicum_core->model('post')->get( array(
				'type' 			=> 'all',
				'limit' 		=> $data['instance']['count'],
				'order' 		=> 'comment_count',
				'sort' 			=> 'DESC',
				'post_type' => 'post'
			));

		break;
		case('random'):
		
			$posts = $wplab_unicum_core->model('post')->get( array(
				'type' 			=> 'all',
				'limit' 		=> $data['instance']['count'],
				'order' 		=> 'rand',
				'sort' 			=> 'DESC',
				'post_type' => 'post'
			));

		break;
	}

?>

<?php echo $data['args']['before_widget']; ?>

<!-- widget title -->
<?php if ( isset( $data['title'] ) && $data['title'] <> '' ) : ?>

	<?php echo $data['args']['before_title']; ?>
	
		<?php echo apply_filters( 'widget_title', $data['title'] ); ?>
		
	<?php echo $data['args']['after_title']; ?>
	
<?php endif; ?>

<!-- widget content -->

<?php if( $posts->have_posts() ): ?>
<ul>
	<?php while( $posts->have_posts() ): $posts->the_post(); $post_format = get_post_format( get_the_ID() ); $post_format = $post_format <> '' ? $post_format : 'post'; ?>
	<li class="format-<?php echo esc_attr( $post_format ); ?>">
		<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
		<a href="<?php the_permalink(); ?>" class="time"><?php the_time( get_option('date_format') ); ?></a>
	</li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
<?php endif; ?>

<?php echo $data['args']['after_widget']; 