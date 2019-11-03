<?php

	if (get_option( 'bcAGGT_gate_background_image' )!=0 OR get_option( 'bcAGGT_gate_background_image' )!=''){
		$background_image = ' style="background-image: url('.bcAGGT_get_image(get_option( 'bcAGGT_gate_background_image' )).');"';
	}else{
		$background_image = "";
	}

	if (get_option( 'bcAGGT_gate_logo' )!=0){
		$logo_image = '<img src="'.bcAGGT_get_image(get_option( 'bcAGGT_gate_logo' )).'" class="bcAGGT_gate_logo" alt="'.get_bloginfo('name').'" /> <br />';
	}else{
		$logo_image = "";
	}

?>

<div id="bcAGGT_container"<?php echo $background_image; ?>>
	<div class="bcAGGT_message_box_wrapper">
        <div class="bcAGGT_message_box">
           <div id="postbox">
				<form id="new_post" name="new_post" method="post">

				<?php echo $logo_image; ?>
				<?php if($bcAGGT_error_message!=""){ ?>
	
					<div class="bcAGGT_error_message">
						<?php echo $bcAGGT_error_message; ?>
					</div>
				<?php } ?>
			
				<div class="bcAGGT_age_message">	
					<?php echo get_option('bcAGGT_gate_message'); ?>
				</div>
				<div class="bcAGGT_age_form">
					
					
					<div class="bcAGGT_form_field">
						<label for="bcAGGT_day"><?php _e("DD",'betagate'); ?></label>
						<input type="text" id="bcAGGT_day" value="" tabindex="1" size="2" name="bcAGGT_day" />
					</div>
					<div class="bcAGGT_form_field">
						<label for="bcAGGT_month"><?php _e("MM",'betagate'); ?></label>
						<input type="text" id="bcAGGT_month" value="" tabindex="1" size="2" name="bcAGGT_month" />
					</div>	
					<div class="bcAGGT_form_field">	
						<label for="bcAGGT_year"><?php _e("YYYY",'betagate'); ?></label>
						<input type="text" id="bcAGGT_year" value="" tabindex="1" size="4" name="bcAGGT_year" />
					</div>
				</div>
				<?php if(get_option('bcAGGT_gate_cookienotice')==1){ ?>
				<div class="bcAGGT_age_cookies">	
					<input type="checkbox" id="bcAGGT_cookies" value="1" name="bcAGGT_cookies" />
					<label for="bcAGGT_cookies"><?php _e("I agree with the use of cookies.",'betagate'); ?></label>
				</div>
				<?php } ?>
				<?php wp_nonce_field( 'wps-frontend-post' ); ?>
				</div>
				<input type="submit" value="<?php _e("Continue",'betagate'); ?>" tabindex="6" id="bcAGGT_submit" name="submit" />

				</form>
			</div>
        </div>
	</div>
</div>

