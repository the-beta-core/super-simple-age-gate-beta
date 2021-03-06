<?php 
/* ---------------------------------------- */
/* adding the stylesheet to WP-admin */

function bcAGGT_css_admin() {
	wp_enqueue_style('beta-gate-admin', plugin_dir_url( __DIR__ ).'css/admin.css');
}
add_action('admin_enqueue_scripts', 'bcAGGT_css_admin');


function bcAGGT_css_frontend() {
    //if (get_option('bcAGGT_gate_active')==1){
        if(get_option('bcAGGT_gate_theme')=='classic_dark'){
            wp_enqueue_style( 'beta-gate', plugin_dir_url( __DIR__ ).'css/style-classicdark.css');
        }elseif(get_option('bcAGGT_gate_theme')=='rum'){
            wp_enqueue_style( 'beta-gate', plugin_dir_url( __DIR__ ).'css/style-rum.css');
        }else{
            wp_enqueue_style( 'beta-gate', plugin_dir_url( __DIR__ ).'css/style.css');
        }
    //}
}
add_action('init', 'bcAGGT_css_frontend', 100);


function bcAGGT_css_custom(){
if(get_option('bcAGGT_gate_css')!=''){
echo '<style type="text/css">
';
echo esc_html(get_option('bcAGGT_gate_css'),'betagate');
echo '
</style>';
}	
}
add_action('wp_head', 'bcAGGT_css_custom', 100);


/* ---------------------------------------- */
/* the WP-admin page with the settings */

function bcAGGT_function_for_sub(){
	
	// this is the page itself that you will find under the wp-admin
	// settings > Offline button
	include plugin_dir_path( __DIR__ ).'template/wp-admin-form.php';
	
}


/* ---------------------------------------- */
/* Add form data to the database after	    */
/* sanitising the input.	                */ 

function bcAGGT_settings_register() {
	
	// this corresponds to some information added at the top of the form
	$setting_name = 'bcAGGT_agegatesettings';
	
	// sanitize settings
    $args_html = array(
            'type' => 'string', 
            'sanitize_callback' => 'wp_kses_post',
            'default' => NULL,
            );	
	
    $args_int = 'intval';
	
    $args_text = array(
            'type' => 'string', 
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
            );
	
	// adding the information to the database as options
    register_setting( $setting_name, 'bcAGGT_gate_active', $args_int ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_age', $args_int ); // radio
    register_setting( $setting_name, 'bcAGGT_gate_gtype', $args_int ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_theme', $args_text ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_logo', $args_text ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_message', $args_html ); // radio
    register_setting( $setting_name, 'bcAGGT_gate_message_footer', $args_html ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_background_image', $args_text ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_css', $args_html ); // radio
	register_setting( $setting_name, 'bcAGGT_gate_cookienotice', $args_int ); // radio
    register_setting( $setting_name, 'bcAGGT_gate_cookietime', $args_int ); // radio
    register_setting( $setting_name, 'bcAGGT_page_cookie', $args_int ); // radio
    register_setting( $setting_name, 'bcAGGT_page_privacy', $args_int ); // radio
    register_setting( $setting_name, 'bcAGGT_page_disclaimer', $args_int ); // radio
	
    
        
        
}

add_action( 'admin_init', 'bcAGGT_settings_register' );


/* ---------------------------------------- */
/* ---------------------------------------- */
/* input forms and functions                */



/* ---------------------------------------- */
/* This one is a check button for the wpadm */

function bcAGGT_check_input($arg, $label=''){
	if ($arg['selected']==''){
		$arg['selected']=0;
	}
?>
<div class="bcAGGT_check_wrapper">
	<label>
		<input type="checkbox" 
			   name="bcAGGT_<?php echo $arg['name']; ?>" 
			   value="<?php echo $arg['val']; ?>"
			   <?php 
				if($arg['selected']==$arg['val']){ echo "checked"; } ?> />
		<span></span>
		<?php if ($label!=''){ echo "<label>".__($label,'betagate')."</label>"; } ?>
	</label>
</div>
<?php
}


/* ---------------------------------------- */
/* This one is a select dropdown            */

function bcAGGT_select_box($arg){

?>
<div class="bcAGGT_select_wrapper">
	<select name="bcAGGT_<?php echo $arg['name']; ?>">
		<?php // making a list of the options
		foreach($arg['options'] as $name => $value){
			if($value['op_value']==$arg['selected']){$checkme=' selected';}else{$checkme='';}
			?><option value="<?php echo $value['op_value']; ?>"<?php echo $checkme; ?>><?php echo $value['op_name']; ?></option><?php
		} ?>
	</select>
</div>
<?php
}


/* ---------------------------------------- */
/* This one is an input field               */

function bcAGGT_input_field($arg){
?>
<div class="bcAGGT_input_wrapper">
	<input type="text"
		   name="bcAGGT_<?php echo $arg['name']; ?>"
		   value="<?php echo $arg['selected']; ?>"
		   class="regular-text"
		   />
</div>
<?php	
}


/* ---------------------------------------- */
/* This one is a textarea field             */

function bcAGGT_textarea_field($arg){
?>
<div class="bcAGGT_textarea_wrapper">
	<textarea name="bcAGGT_<?php echo $arg['name']; ?>" 
			  class="large-text code"
			  rows="10"
			  cols="50"><?php echo $arg['selected']; ?></textarea>
</div>
<?php	
}

// the more complex image select field
add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );


/* ---------------------------------------- */
/* This one is an image select field        */

function bcAGGT_imageselect_field($arg){
	
	$imgid =(isset( $arg[ 'selected' ] )) ? $arg[ 'selected' ] : "";
	$img    = wp_get_attachment_image_src($imgid, 'thumbnail');

	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		var $ = jQuery;
		if ($('.<?php echo 'bcAGGT_'.$arg['name']; ?>').length > 0) {
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				$('.<?php echo 'bcAGGT_'.$arg['name']; ?>').on('click', function(e) {
					e.preventDefault();
					var button = $(this);
					var id = button.prev();
					wp.media.editor.send.attachment = function(props, attachment) {
						id.val(attachment.id);
					};
					wp.media.editor.open(button);
					return false;
				});
			}
		}
	});
	</script>
	<div class="bcAGGT_select_wrapper">
	<?php 
	if($img != "") { ?>
	<div class="bcAGGT_thumbnail">
		<img src="<?= $img[0]; ?>" width="80px" />
		<p><?php _e('The currently selected image.','betagate'); ?></p>
	</div>
	<p><?php _e('Select a new image or paste a image ID to replace the one above:','betagate'); ?></p>

	<?php }else{ ?>
	<p><?php _e('Select an image or paste an image ID:','betagate'); ?></p>	
	<?php }	?>
	<input type="text" 
		   value="<?php echo $arg['selected']; ?>" 
		   class="regular-text process_custom_images" 
		   id="process_custom_images" 
		   name="<?php echo 'bcAGGT_'.$arg['name']; ?>" 
		   max="" 
		   min="1" 
		   step="1" />
	<button class="<?php echo 'bcAGGT_'.$arg['name']; ?> button"><?php _e('Media library','betagate'); ?></button>
	</div>
	<?php
}

?>