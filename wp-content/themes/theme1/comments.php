<?php
/**
 * The template for displaying Comments.
 */
$allowed_tags = wp_kses_allowed_html( 'post' );
?>

<?php
	global $wplab_unicum_core;
	if ( ! defined( 'ABSPATH' ) ) { exit; }
	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() || ( !comments_open() && 0 == get_comments_number() ) ) {
		return;
	}
?>

	<!--
		Comments block
	-->
	<div class="indent <?php echo get_option('show_avatars') ? 'with-avatars' : 'no-avatars'; ?>" id="comments">
	
		<h2 class="h1"><?php printf( wp_kses( _n( '1 Comment', 'Comments %1$s', get_comments_number(), 'wplab-unicum' ), $allowed_tags ), number_format_i18n( get_comments_number() ) ); ?></h2>

		<?php if ( have_comments() ) : ?>
	
			<ul class="comments-list">
				<?php
					wp_list_comments( array( 'callback' => 'wplab_unicum_comments_callback' ) );
				?>
			</ul><!-- .commentlist -->
	
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comments-nav">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'wplab-unicum' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'wplab-unicum' ) ); ?></div>
				<div class="clearfix"></div>
			</nav>
			<?php endif; // check for comment navigation ?>
	
		<?php endif; // have_comments() ?>
		
		<?php
			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$required_text = sprintf( ' ' . esc_html__('Required fields are marked %s', 'wplab-unicum'), '<span class="required">*</span>' );
	
			$comment_form_args = array(
				'fields'	=> apply_filters( 'comment_form_default_fields', array(
	
					'author' => '<div class="row"><div class="form-row col-md-6"><input class="input-icon-user" id="author" name="author" type="text" placeholder="' . esc_html__( 'Full Name&#42;', 'wplab-unicum' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
	
					'email' => '<div class="form-row col-md-6"><input id="email" class="input-icon-email" name="email" type="text" placeholder="' . esc_html__( 'Email Address&#42;', 'wplab-unicum' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
	
					'url' => ''
	
					)
				),
	
				'comment_field'	=> '<div class="row"><div class="form-row col-md-12"><textarea class="input-icon-comment" id="comment" placeholder="' . esc_html__( 'Type Here Your Message&#42;', 'wplab-unicum' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>',
	
				'comment_notes_after' => '',
	
				'must_log_in' => '<p>' .  sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'wplab-unicum' ), $allowed_tags ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	
				'logged_in_as' => '',
	
				'comment_notes_before' => '',
	
			);
		?>
		
		<?php comment_form( $comment_form_args ); ?>

	</div><!-- /comments-->

<?php
/**
	* Comments callback function
 **/
function wplab_unicum_comments_callback( $comment, $args, $depth) {
	global $wplab_unicum_core;
	$GLOBALS['comment'] = $comment;
    
	switch ( $comment->comment_type ) :
		case '':
	?>
		<li <?php comment_class(); ?> id="comment-content-<?php comment_ID(); ?>">
            
			<div class="comment-body">
			
				<div class="photo">
					<?php echo get_avatar( $comment, 70 ); ?>
				</div>
			
				<div class="comment-text">
				
					<header>
						<h6><?php $comment_author = get_userdata( $comment->user_id ); echo isset( $comment_author->display_name ) ? $comment_author->display_name : get_comment_author( get_comment_ID() ) ?></h6> 
						<div class="author">
							<span><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp')) . " " . esc_html__('ago', 'wplab-unicum'); ?></span>
						</div>
					</header>
					
					<?php comment_text(); ?>
					
				</div>
				
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment-content', 'reply_text' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), get_comment_ID(), get_the_ID() ); ?>
				
			</div>  

	<?php
		break;
			case 'pingback'  :
			case 'trackback' :
	?>
		<li class="post pingback">
			<div class="comment-data">
				<p><?php echo esc_html__( 'Pingback', 'wplab-unicum' ); ?>: <?php comment_author_link(); ?></p>
			</div>
	<?php
		break;
	endswitch;
}