<?php
/**
 * Interface Theme Options
 *
 * Contains all the function related to theme options.
 *
 * @package Theme Horse
 * @subpackage Interface
 * @since Interface 1.0
 */

/****************************************************************************************/

add_action( 'admin_enqueue_scripts', 'interface_jquery_javascript_file_cookie' );
/**
 * Register jquery cookie javascript file.
 *
 * jquery cookie used for remembering admin tabs, and potential future features... so let's register it early
 *
 * @uses wp_register_script
 */
function interface_jquery_javascript_file_cookie() {
   wp_register_script( 'jquery-cookie', ADMIN_JS_URL . '/jquery.cookie.min.js', array( 'jquery' ) );
   wp_enqueue_style('thickbox');

    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}

/****************************************************************************************/

add_action( 'admin_print_scripts-appearance_page_theme_options', 'interface_admin_scripts' );
/**
 * Enqueuing some scripts.
 *
 * @uses wp_enqueue_script to register javascripts.
 * @uses wp_enqueue_script to add javascripts to WordPress generated pages.
 */
function interface_admin_scripts() {
   wp_enqueue_script( 'interface_admin', ADMIN_JS_URL . '/admin.js', array( 'jquery', 'jquery-ui-tabs', 'jquery-cookie', 'jquery-ui-sortable', 'jquery-ui-draggable' ) );
   wp_enqueue_script( 'interface_toggle_effect', ADMIN_JS_URL . '/toggle-effect.js' );
   wp_enqueue_script( 'interface_image_upload', ADMIN_JS_URL . '/add-image-script.js', array( 'jquery','media-upload', 'thickbox' ) );
}

/****************************************************************************************/

add_action( 'admin_print_styles-appearance_page_theme_options', 'interface_admin_styles' );
/**
 * Enqueuing some styles.
 *
 * @uses wp_enqueue_style to register stylesheets.
 * @uses wp_enqueue_style to add styles.
 */
function interface_admin_styles() {
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style( 'interface_admin_style', ADMIN_CSS_URL. '/admin.css' );
}

/****************************************************************************************/

add_action( 'admin_print_styles-appearance_page_theme_options', 'interface_social_script', 100);
/**
 * Facebook, twitter script hooked at head
 * 
 * @useage for Facebook, Twitter and Print Script 
 * @Use add_action to display the Script on header
 */
function interface_social_script() { ?>
<!-- Facebook script -->


<div id="fb-root"></div>
<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=284802028306078";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> 

<!-- Twitter script --> 
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 

<!-- Print Script --> 
<script src="http://cdn.printfriendly.com/printfriendly.js" type="text/javascript"></script>
<?php     
}

/****************************************************************************************/

add_action( 'admin_menu', 'interface_options_menu' );
/**
 * Create sub-menu page.
 *
 * @uses add_theme_page to add sub-menu under the Appearance top level menu.
 */
function interface_options_menu() {
    
	add_theme_page( 
		__( 'Theme Options', 'interface' ),           // Name of the page
		__( 'Theme Options', 'interface' ),           // Label in menu (Inside apperance)
		'edit_theme_options',                         // Capability 
		'theme_options',                              // Menu slug, which is used to define uniquely the page
		'interface_theme_options_add_theme_page'      // Function used to rendrs the options page
	);

}

/****************************************************************************************/

add_action( 'admin_init', 'interface_register_settings' );
	/**
		* Register options and function call back of validation
		*
		* this three options interface_theme_options', 'interface_theme_options', 'interface_theme_options_validate'
		* first parameter interface_theme_options  =>    To set all field eg:- social link, design options etc.
		* second parameter interface_theme_options =>	 Option value to sanitize and save. array values etc. can be called global 
		* third parameter interface_theme_options  => 	 Call back function
		* @uses register_setting
	*/
function interface_register_settings() {
   register_setting( 'interface_theme_options', 'interface_theme_options', 'interface_theme_options_validate' );
 
}

/****************************************************************************************/
/**
 * Render the options page
 */
function interface_theme_options_add_theme_page() {
?>

<div id="themehorse" class="wrap">
  <form method="post" action="options.php">
    <?php
			/**
			* should match with the register_settings first parameter of line no 117
			*/
				settings_fields( 'interface_theme_options' ); 
				global $interface_theme_default;
				$options = $interface_theme_default;             
			?>
    <?php if( isset( $_GET [ 'settings-updated' ] ) && 'true' == $_GET[ 'settings-updated' ] ): ?>
    <div class="updated" id="message">
      <p><strong>
        <?php _e( 'Settings saved.', 'interface' );?>
        </strong></p>
    </div>
    <?php endif; ?>
    <div id="interface_tabs">
      <ul id="main-navigation" class="tab-navigation">
        <li><a href="#designoptions">
          <?php _e( 'Design Options', 'interface' );?>
          </a></li>
        <li><a href="#featuredpostslider">
          <?php _e( 'Slider Options', 'interface' );?>
          </a></li>
      </ul>
      <!-- #Responsive Layout -->
      <div id="designoptions">   
        <div class="option-container">
          <h3 class="option-toggle"><a href="#">
            <?php _e( 'Fav Icon Options', 'interface' ); ?>
            </a></h3>
          <div class="option-content inside">
            <table class="form-table">
              <tbody>
                <tr>
                  <th scope="row"><label for="disable_favicon">
                      <?php _e( 'Disable Favicon', 'interface' ); ?>
                    </label></th>
                  <input type='hidden' value='0' name='interface_theme_options[disable_favicon]'>
                  <td><input type="checkbox" id="disable_favicon" name="interface_theme_options[disable_favicon]" value="1" <?php checked( '1', $options['disable_favicon'] ); ?> />
                    <?php _e('Check to disable', 'interface'); ?></td>
                </tr>
                <tr>
                  <th scope="row"><label for="fav_icon_url">
                      <?php _e( 'Fav Icon URL', 'interface' ); ?>
                    </label></th>
                  <td><input class="upload" size="65" type="text" id="fav_icon_url" name="interface_theme_options[favicon]" value="<?php echo esc_url( $options [ 'favicon' ] ); ?>" />
                    <input class="upload-button button" name="image-add" type="button" value="<?php esc_attr_e( 'Change Fav Icon', 'interface' ); ?>" /></td>
                </tr>
                <tr>
                  <th scope="row"><?php _e( 'Preview', 'interface' ); ?></th>
                  <td><?php
										       echo '<img src="'.esc_url( $options[ 'favicon' ] ).'" alt="'.__( 'favicon', 'interface' ).'" />';
										   ?></td>
                </tr>
              </tbody>
            </table>
            <p class="submit">
              <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save All Changes', 'interface' ); ?>" />
            </p>
          </div>
          <!-- .option-content --> 
        </div>
        <!-- .option-container -->
      </div>
      <!-- Option for Featured Post Slier -->
      <div id="featuredpostslider"> 
        <!-- Option for More Slider Options -->
        <div class="option-container">
          <h3 class="option-toggle"><a href="#">
            <?php _e( 'Slider Options', 'interface' ); ?>
            </a></h3>
          <div class="option-content inside">
            <table class="form-table">
              <tr>
                <th scope="row"><?php _e( 'Number of Slides', 'interface' ); ?></th>
                <td><input type="text" name="interface_theme_options[slider_quantity]" value="<?php echo intval( $options[ 'slider_quantity' ] ); ?>" size="2" /></td>
              </tr>
              <tr>
                <th> <label for="interface_cycle_style">
                    <?php _e( 'Transition Effect:', 'interface' ); ?>
                  </label>
                </th>
                <td><select id="interface_cycle_style" name="interface_theme_options[transition_effect]">
                    <?php 
												$transition_effects = array();
												$transition_effects = array( 	'fade',
																						'wipe',
																						'scrollUp',
																						'scrollDown',
																						'scrollLeft',
																						'scrollRight',
																						'blindX',
																						'blindY',
																						'blindZ',
																						'cover',
																						'shuffle'
																			);
										foreach( $transition_effects as $effect ) {
											?>
                    <option value="<?php echo $effect; ?>" <?php selected( $effect, $options['transition_effect']); ?>><?php printf( __( '%s', 'interface' ), $effect ); ?></option>
                    <?php 
										}
											?>
                  </select></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Transition Delay', 'interface' ); ?></th>
                <td><input type="text" name="interface_theme_options[transition_delay]" value="<?php echo $options[ 'transition_delay' ]; ?>" size="2" />
                  <span class="description">
                  <?php _e( 'second(s)', 'interface' ); ?>
                  </span></td>
              </tr>
              <tr>
                <th scope="row"><?php _e( 'Transition Length', 'interface' ); ?></th>
                <td><input type="text" name="interface_theme_options[transition_duration]" value="<?php echo $options[ 'transition_duration' ]; ?>" size="2" />
                  <span class="description">
                  <?php _e( 'second(s)', 'interface' ); ?>
                  </span></td>
              </tr>
            </table>
            <p class="submit">
              <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save All Changes', 'interface' ); ?>" />
            </p>
          </div>
          <!-- .option-content --> 
        </div>
        <!-- .option-container -->
        
        <div class="option-container">
          <h3 class="option-toggle"><a href="#">
            <?php _e( 'Landing Slider Options', 'interface' ); ?>
            </a></h3>
          <div class="option-content inside">
            <table class="form-table">
              <tbody class="sortable">
                <?php for ( $i = 1; $i <= $options[ 'slider_quantity' ]; $i++ ): ?>
                <tr>
                  <th scope="row"><label class="handle">
                      <?php _e( 'Landing Slider #', 'interface' ); ?>
                      <span class="count"><?php echo absint( $i ); ?></span></label></th>
                  <td><input type="text" name="interface_theme_options[featured_post_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'featured_post_slider', $options ) && array_key_exists( $i, $options[ 'featured_post_slider' ] ) ) echo $options[ 'featured_post_slider' ][ $i ]; ?>" />
                    <button class="button upload-button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank">
                    <?php _e( 'Click Here To Edit', 'interface' ); ?>
                    </button></td>
                </tr>
                <?php endfor; ?>
              </tbody>
            </table>
            <p>
              <strong>Select the images you want to include in this slider.  To select an image, upload one, or click 'show' under the media gallery tab and click the 'insert into post' button in the pop up.  The save your changes when you're done.</strong>
            </p>
            <p class="submit">
              <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save All Changes', 'interface' ); ?>" />
            </p>
          </div>
          <!-- .option-content --> 
        </div>
        <!-- .option-container --> 
		
		<div class="option-container">
          <h3 class="option-toggle"><a href="#">
            <?php _e( 'Visual Highlight Slider Options', 'interface' ); ?>
            </a></h3>
          <div class="option-content inside">
            <table class="form-table">
              <tbody class="sortable">
                <?php for ( $i = 1; $i <= $options[ 'slider_quantity' ]; $i++ ): ?>
                <tr>
                  <th scope="row"><label class="handle">
                      <?php _e( 'Highlight Slider #', 'interface' ); ?>
                      <span class="count"><?php echo absint( $i ); ?></span></label></th>
                  <td><input type="text" name="interface_theme_options[highlight_slider][<?php echo absint( $i ); ?>]" value="<?php if( array_key_exists( 'highlight_slider', $options ) && array_key_exists( $i, $options[ 'highlight_slider' ] ) ) echo $options[ 'highlight_slider' ][ $i ]; ?>" />
                    <button class="button upload-button" title="<?php esc_attr_e('Click Here To Edit'); ?>" target="_blank">
                    <?php _e( 'Click Here To Edit', 'interface' ); ?>
                    </button></td>
                </tr>
                <?php endfor; ?>
              </tbody>
            </table>
            <p>
              <strong>Select the images you want to include in this slider.  To select an image, upload one, or click 'show' under the media gallery tab and click the 'insert into post' button in the pop up.  The save your changes when you're done.</strong>
            </p>
            <p class="submit">
              <input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save All Changes', 'interface' ); ?>" />
            </p>
          </div>
          <!-- .option-content --> 
        </div>
        <!-- .option-container --> 
      </div>
    </div>
    <!-- #interface_tabs -->
  </form>
</div>
<!-- .wrap -->
<?php
}

/****************************************************************************************/

/**
 * Validate all theme options values
 * 
 * @uses esc_url_raw, absint, esc_textarea, sanitize_text_field, interface_invalidate_caches
 */
function interface_theme_options_validate( $options ) { //validate individual options before saving. using register_setting 3rd parameter interface_theme_options_validate
	global $interface_theme_default, $interface_default;
	$validated_input_values = $interface_theme_default;
	$input = array();
	$input = $options;
        
	if ( isset( $input[ 'favicon' ] ) ) {
		$validated_input_values[ 'favicon' ] = esc_url_raw( $input[ 'favicon' ] );
	}

	if ( isset( $input['disable_favicon'] ) ) {
		$validated_input_values[ 'disable_favicon' ] = $input[ 'disable_favicon' ];
	}

	if ( isset( $input[ 'slider_quantity' ] ) ) {
		$validated_input_values[ 'slider_quantity' ] = absint( $input[ 'slider_quantity' ] ) ? $input [ 'slider_quantity' ] : 4;
	}

	if ( isset( $input[ 'featured_post_slider' ] ) ) {
		$validated_input_values[ 'featured_post_slider' ] = array();
	}   
	if( isset( $input[ 'slider_quantity' ] ) )
	for ( $i = 1; $i <= $input [ 'slider_quantity' ]; $i++ ) {
		if ( $input[ 'featured_post_slider' ][ $i ] ) {
			$validated_input_values[ 'featured_post_slider' ][ $i ] = esc_url_raw( $input[ 'featured_post_slider' ][ $i ] );
		} else {
      $validated_input_values[ 'featured_post_slider' ][ $i ] = '';
    }
		if( $input[ 'highlight_slider' ][ $i ] ) {
			$validated_input_values[ 'highlight_slider' ][ $i ] = esc_url_raw( $input[ 'highlight_slider' ][ $i ] );
		} else {
      $validated_input_values[ 'highlight_slider' ][ $i ] = '';
    }
	}  
	
   // data validation for transition effect
	if( isset( $input[ 'transition_effect' ] ) ) {
		$validated_input_values['transition_effect'] = wp_filter_nohtml_kses( $input['transition_effect'] );
	}

	// data validation for transition delay
	if ( isset( $input[ 'transition_delay' ] ) && is_numeric( $input[ 'transition_delay' ] ) ) {
		$validated_input_values[ 'transition_delay' ] = $input[ 'transition_delay' ];
	}

	// data validation for transition length
	if ( isset( $input[ 'transition_duration' ] ) && is_numeric( $input[ 'transition_duration' ] ) ) {
		$validated_input_values[ 'transition_duration' ] = $input[ 'transition_duration' ];
	}
	
	if( isset( $input[ 'slider_content' ] ) ) {
		$validated_input_values[ 'slider_content' ] = $input[ 'slider_content' ];
	}
    
   return $validated_input_values;
}
function interface_themeoption_invalidate_caches(){
	
	delete_transient( 'interface_socialnetworks' );  
	
}

?>