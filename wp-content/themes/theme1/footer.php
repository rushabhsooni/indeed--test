		</div><!-- End of content wrapper -->
		
		<!--
			Footer
		-->
		<footer id="footer">
		
			<?php
				/**
				 * Display footer widgets
				 * this function located at /wproto/helper/front.php
				 **/
				wplab_unicum_front::footer_widgets();
			?>

			<?php
				/**
				 * Display bottom bar
				 * this function located at /wproto/helper/front.php
				 **/
				wplab_unicum_front::bottom_bar();
			?>
		
		</footer>
	
	</div><!-- End of primary wrapper -->
	
	<?php
		/**
		 * Information for developers, DB queries count, page loading speed
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_unicum_front::dev_info();
	?>
	
	<?php wp_footer(); ?>
</body>
</html>