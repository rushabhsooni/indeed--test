<?php
	/**
	 * Media helper
	 **/
	class wplab_unicum_media {
		
		/**
		 * Generate an image with necessary width, height and retina copy
		 * @param Image URL
		 * @param Image Width
		 * @param Image Height
		 * @param Image Crop
		 * @param Add HD image for retina.js
		 * @param Fallback thumbnail name
		 * @param Thumb id
		 **/
		public static function image( $url, $width, $height = null, $crop = true, $hd = true, $fallback_size = '', $thumb_id = 0 ) {
			require_once get_template_directory() . '/library/aq_resizer/aq_resizer.php';	
			
			$hd_image_url = '';
			$hd_atts = 'data-no-retina';
			
			if ( filter_var( $url, FILTER_VALIDATE_URL ) === FALSE ) {
				$url = 'http:' . $url;
			}
			
			$image_url = aq_resize( $url, $width, $height, $crop );
			
			if( $hd ) {
				$hd_width = $width * 2;
				$hd_height = $height != null ? $height * 2 : null;
				$hd_image_url = aq_resize( $url, $hd_width, $hd_height, $crop );
				if( $hd_image_url ) {
					$hd_atts = 'data-at2x="' . esc_attr( $hd_image_url ) . '"';
				}
			}
			
			if( $image_url ) {
				return '<img class="wproto-wp-image" alt="" src="' . esc_attr( $image_url ) . '" ' . image_hwstring( $width, $height ) . ' ' . $hd_atts . ' />';
			} elseif( $fallback_size <> '' ) {		
				$_url = wp_get_attachment_url( $thumb_id );
				return '<img class="wproto-wp-image" alt="" src="' . esc_attr( $_url ) . '" />';
			} else {
				return '';
			}
		}
		
		/**
		 * Get YouTube Video ID From URL
		 * @param string
		 **/
		public static function getYouTubeVideoId( $url ) {
	    $video_id = false;
	    $url = parse_url($url);
	    if ( strcasecmp($url['host'], 'youtu.be') === 0) {
        #### (dontcare)://youtu.be/<video id>
        $video_id = substr($url['path'], 1);
	    }
	    elseif ( strcasecmp($url['host'], 'www.youtube.com') === 0) {
        if (isset($url['query'])) {
          parse_str($url['query'], $url['query']);
          if (isset($url['query']['v'])) {
            #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
            $video_id = $url['query']['v'];
          }
        }
        if ($video_id == false) {
          $url['path'] = explode('/', substr($url['path'], 1));
          if (in_array($url['path'][0], array('e', 'embed', 'v'))) {
            #### (dontcare)://www.youtube.com/(whitelist)/<video id>
            $video_id = $url['path'][1];
          }
        }
	    }
    	return $video_id;
		}
		
	}