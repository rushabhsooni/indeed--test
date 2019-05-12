jQuery.noConflict()( function($){
	"use strict";

	var wprotoMedia;

	var wprotoThemeCore = {
	
		/**
			Constructor
		**/
		initialize: function() {

			this.build();
			this.events();

		},
		/**
			Build page elements
		**/
		build: function() {
			
			var self = this;
			
			/**
				Color picker
			**/
			$('.wproto-color-picker').each( function() {
				$(this).wpColorPicker();
			});	
			
		},
		/**
			Check for events
		**/
		events: function() {
			
			var self = this;
			
			$( document ).on( 'click', '.wproto-image-selector', function() {
		
				var targetImage = $(this).attr('data-src-target');
				var targetInput = $(this).attr('data-url-target');
				var targetInputURL = $(this).attr('data-url-input');
		
				wprotoMedia = wp.media.frames.wprotoMedia = wp.media({
					className: 'media-frame wproto-media-frame',
					frame: 'select',
					multiple: false,
					title: wprotoVars.strSelectImage,
					library: {
						type: 'image'
					},
					button: {
						text: wprotoVars.strSelect
					}
				});
		
				wprotoMedia.on('select', function(){
					var media_attachment = wprotoMedia.state().get('selection').first().toJSON();
			
					if( targetImage != '' ) {
						$( targetImage ).attr( 'src', media_attachment.url );
					}
					if( targetInput != '' ) {
						$( targetInput ).val( media_attachment.id );
					}
					if( targetInputURL ) {
						
						var url = media_attachment.url;
						url = url.replace( 'http://', '//' );
						url = url.replace( 'https://', '//' );
						
						$( targetInputURL ).val( url );
					}

				});
		
				wprotoMedia.open();
		
				return false;
			});
	
			$( document ).on( 'click', '.wproto-image-remover', function(){
		
				var targetImage = $(this).attr('data-src-target');
				var targetInput = $(this).attr('data-url-target');
				var defaultImage = $(this).attr('data-default-img');
				var targetInputURL = $(this).attr('data-url-input');
		
				$( targetImage ).attr( 'src', defaultImage );
				$( targetInput ).val( '0' );
				$( targetInputURL ).val('');
		
				return false;
			});
			
			/** save settings was clicked **/
			$('#wproto-customizer-form').bind( 'submit', function(){
				
				var form = $(this);
				
				self.saveThemeLess( form );
				
				return false;
			});
			
			/** reset settings was clicked **/
			$('#wproto-customizer-form input[name=wproto_reset_to_defaults]').bind( 'click', function() {
				$('#wproto-customizer-form').unbind( 'submit' );
				$(this).unbind( 'click' ).click();
				return false;
			});
			
			/**
				Hide installation message box
			**/
			$('#wproto-hide-activation-notice').click( function() {
		
				var loader = $('#wproto-dismiss-activation-loader');
		
				loader.show();
		
				$.post( ajaxurl, { 'action' : 'theme_hide_activation_notice' },
					function( response){
						loader.hide();
						$('#wproto-first-activation-notice').fadeOut(300, function() {
							$(this).remove()
						});
					}
				);
		
				return false;
			});
			
			/**
				Hide rate message box
			**/
			$('#wproto-hide-rate-notice').click( function() {
		
				$.post( ajaxurl, { 'action' : 'theme_hide_rate_notice' },
					function( response){
						$('#wproto-rate-notice').fadeOut(300, function() {
							$(this).remove()
						});
					}
				);
		
				return false;
			});
			
		},
		/**
			Compile LESS styles
		**/	
		saveThemeLess: function( form ) {
			
			var modalDialog = $( '<div title="' + wprotoVars.strPleaseWait + '">' + wprotoVars.strCompilingLess + '</div>' ).dialog({
				modal: true,
				width: 500,
				closeOnEscape: false,
				resizable: false,
				draggable: false,
				dialogClass: 'wproto-no-close'
			});
			
			var lessVars = form.serializeObject();		
			lessVars = lessVars.theme_styles;
			
			$.ajax({
				url: ajaxurl,
				type: "POST",
				data: {
					'action' : 'wproto_get_customizer_stylesheet'
				},
				beforeSend: function() {
					modalDialog.append( wprotoVars.strLoadingLessFile + '<br/>' );
				},
				success: function( file_content ) {
					modalDialog.append( wprotoVars.strLoadingLessFileSuccess + '<br/>' );
					modalDialog.append( wprotoVars.strCompilationLess + '<br/>' );
					
					var parser = less.Parser();
					
					var variable_less = "";
    			for (var type in lessVars ) {
    				
    				if( type == 'font_picker' ) {
							
							for (var item in lessVars[type] ) {
								
								for (var variable in lessVars[type][item] ) {
									
	    						if( $.isNumeric( lessVars[type][item][variable] ) ) {  
			    					if( lessVars[type][item][variable] % 1 === 0){
			    						variable_less += "@" + item + "_" + variable + ": " + parseInt(lessVars[type][item][variable]) + ";";
			   						} else {
			   							variable_less += "@" + item + "_" + variable + ": " + lessVars[type][item][variable] + ";";
			   						}
    							} else if( lessVars[type][item][variable] == '' ) {
			    					variable_less += "@" + item + "_" + variable + ": wprotoSystemNoValue;";
			    				} else {
			    					variable_less += "@" + item + "_" + variable + ": ~'" + lessVars[type][item][variable] + "';";
			    				}

								}
								
							}

    				} else if( type == 'bg_picker' ) {
    					
							for (var item in lessVars[type] ) {
								
								for (var variable in lessVars[type][item] ) {
									
	    						if( lessVars[type][item][variable] == '' ) {
			    					variable_less += "@" + item + "_" + variable + ": wprotoSystemNoValue;";
			    				} else {
			    					variable_less += "@" + item + "_" + variable + ": ~'" + lessVars[type][item][variable] + "';";
			    				}

								}
								
							}
    					
    				} else if( type == 'color_picker' ) {
    					
    					for (var variable in lessVars.color_picker ) {
    						variable_less += "@" + variable + ": " + lessVars[type][variable] + ";";
  						}
    					
    				} 

    			}
    			
    			console.log( variable_less );
    			
    			variable_less += "@path: '" + wprotoVars.themeLessPath + "';";
					
					parser.parse( variable_less + ' ' + file_content, function( error, result ){
						
    				if(error == null){
        			try {
        				var newCss = result.toCSS();
        				
        				modalDialog.append( wprotoVars.strCompilationLessSuccess + '<br/>' );

								$.ajax({
									url: ajaxurl,
									type: "POST",
									data: {
										'action' : 'wproto_save_customizer_stylesheet',
										'css' : newCss
									},
									beforeSend: function() {
										modalDialog.append( wprotoVars.strSavingLessIntoFile + '<br/>' );
									},
									success: function( res ) {
										
										if( res == 'error' ) {
											modalDialog.dialog( "option", "title", wprotoVars.strError );
											modalDialog.append( wprotoVars.strErrorCustomCSSFile + '<br/>' );
										} else {
											modalDialog.html( wprotoVars.strAllDone + '<br/>' );
											modalDialog.append( wprotoVars.strRefreshing + '<br/>' );
											modalDialog.dialog( "option", "title", wprotoVars.strSuccess );
											form.unbind('submit').submit();	
										}
										
									}
								});
        				
        			} catch( e ) {
        				console.log( e );
    						modalDialog.html( wprotoVars.strLessParseError + '<strong style="color: red">' + e.message + '</strong><br/>' );
    						modalDialog.dialog( "option", "title", wprotoVars.strError );
    						modalDialog.dialog( "option", "buttons", { "OK": function () { $( this ).dialog( "close" ); } } );
        			}
    				} else {			    					
  						modalDialog.html( wprotoVars.strLessParseError + '<strong style="color: red">' + error.message + '</strong><br/>' );
  						modalDialog.dialog( "option", "title", wprotoVars.strError );
  						modalDialog.dialog( "option", "buttons", { "OK": function () { $( this ).dialog( "close" ); } } );
    				}
					});
					
				}
			});
			
		}
		
	}
	
	wprotoThemeCore.initialize();
	
});