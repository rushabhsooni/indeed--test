<?php
/**
 * Slides model
 **/
class wplab_unicum_slider extends wplab_unicum_database {    
	
	/**
	 * Get Revolution Slider slideshows
	 **/
	function get_sliders() {
		
		$table = $this->tables['revslider_sliders'];

		return $this->wpdb->get_results(
			"SELECT *
				FROM $table
				WHERE 1"
		);
		
	}
              
}