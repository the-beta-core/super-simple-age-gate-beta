<div class="wrap">
		
    <h1>Age Gate</h1>

    <form method="post" action="options.php">
        <?php settings_fields( 'bcAGGT_agegatesettings' ); ?>
        <?php do_settings_sections( 'bcAGGT_agegatesettings' ); ?>
        <table class="bcAGGT_forms form-table">
			
	            <tr valign="top">
                <th scope="row">
                    <?php _e("Activate Age Gate", 'betagate'); ?>
                </th>
                 <td>
					 

                    <?php 
                    $check_vars = array( 'name'=>'gate_active',
                                         'val'=>'1',
                                         'selected'=>get_option('bcAGGT_gate_active')
                                       );

                    bcAGGT_check_input($check_vars,"Activate the Age Gate."); ?>
		
			
                </td>
            </tr> 
            <tr valign="top">
                <th scope="row">
                    <?php _e("Minimum age", 'betagate'); ?>
                </th>
                 <td>
			<?php 
				for ($i = 5; $i <= 110; $i++) {
					$age_array[$i]['op_name'] = $i.__(" Years", 'betagate');
					$age_array[$i]['op_value'] = $i;
				}
					
				if (get_option('bcAGGT_gate_age')==0){
					$selected_age = 18;
				}else{
					$selected_age = get_option('bcAGGT_gate_age');
				}			 
				$select_vars = array( 'name'=>'gate_age',
									 'options'=> $age_array,
									 'selected'=>$selected_age
								   );

				bcAGGT_select_box($select_vars); ?>
					<p><?php _e("This is the minimum age that the user has to have to be able to view the content on your website.",'betagate'); ?></p>
                </td>
            </tr> 
        <table class="bcAGGT_forms form-table">
			
	            <tr valign="top">
                <th scope="row">
                    <?php _e("Cookie notification", 'betagate'); ?>
                </th>
                 <td>
					 

                    <?php 
                    $check_vars = array( 'name'=>'gate_cookienotice',
                                         'val'=>'1',
                                         'selected'=>get_option('bcAGGT_gate_cookienotice')
                                       );

                    bcAGGT_check_input($check_vars,"If you want people to agree with placing cookies on beforehand."); ?>
		
			
                </td>
            </tr> 
            </tr> 
    		    <tr valign="top">
                <th scope="row">
                    <?php _e("Cookie Time", 'betagate'); ?>
                </th>
                 <td>
                <?php 
				$select_vars = array( 'name'=>'gate_cookietime',
									 'options'=>array(
													array('op_name'=>'1 day', 'op_value'=>'24'),
													array('op_name'=>'3 days', 'op_value'=>'72'),
                                                    array('op_name'=>'1 week', 'op_value'=>'168'),
                                                    array('op_name'=>'2 weeks', 'op_value'=>'336'),
                                                    array('op_name'=>'1 month', 'op_value'=>'744'),
                                                    array('op_name'=>'3 months', 'op_value'=>'2232'),
                                                    array('op_name'=>'1 year', 'op_value'=>'8928')
													),
									 'selected'=>get_option('bcAGGT_gate_cookietime')
								   );

				bcAGGT_select_box($select_vars); ?>
                </td>
            </tr> 
		</table>
		<br />
		<h2><?php _e('Styling','betagate'); ?></h2>
		<table class="bcAGGT_forms form-table">
              <tr valign="top">
                <th scope="row">
                    <?php _e("Select theme", 'betagate'); ?>
                </th>
                <td>
				<?php 
				$select_vars = array( 'name'=>'gate_theme',
									 'options'=>array(
													array('op_name'=>'Classic Light', 'op_value'=>'0'),
													array('op_name'=>'Classic Dark', 'op_value'=>'classic_dark')
													),
									 'selected'=>get_option('bcAGGT_gate_theme')
								   );

				bcAGGT_select_box($select_vars); ?>
					<p><?php _e("Select the theme you'd like to display on the frontpage.",'betagate'); ?></p>
                </td>
            </tr> 
             <tr valign="top">
                <th scope="row">
                    <?php _e("Logo", 'betagate'); ?>
                </th>
                 <td>
				<?php 
				$input_vars = array( 'name'=>'gate_logo',
									 'selected'=>get_option('bcAGGT_gate_logo')
								   );

				bcAGGT_imageselect_field($input_vars); ?>
                </td>
            </tr>  
             <tr valign="top">
                <th scope="row">
                    <?php _e("The message people see", 'betagate'); ?>
                </th>
                 <td>
					 <p><?php _e('Write a message for the people that visit your site when gate mode is enabled. You can use HTML in this field but no javascript. If you like to return to the original message, just empty this field and save.','betagate'); ?></p><br />
				<?php 
					 
				if (get_option('bcAGGT_gate_message')==""){
					$get_a_message = sprintf( __( 'Are you over %s years old? Confirm this with your birth-date below.', 'betagate' ), $selected_age );
				}else{
					$get_a_message = get_option('bcAGGT_gate_message');
				}
					 
				$textarea_vars = array( 'name'=>'gate_message',
									 'selected'=>$get_a_message
								   );

				bcAGGT_textarea_field($textarea_vars); ?>
				 </td>
            </tr>  
            <tr valign="top">
                <th scope="row">
                    <?php _e("The footer message", 'betagate'); ?>
                </th>
                 <td>
					 <p><?php _e('Add some disclaimer or quirky footer line','betagate'); ?></p><br />
				<?php 
					 
				if (get_option('bcAGGT_gate_message_footer')==""){
					$get_a_message = sprintf( __( 'Add a disclaimer here.', 'betagate' ), $selected_age );
				}else{
					$get_a_message = get_option('bcAGGT_gate_message_footer');
				}
					 
				$textarea_vars = array( 'name'=>'gate_message_footer',
									 'selected'=>$get_a_message
								   );

				bcAGGT_textarea_field($textarea_vars); ?>
				 </td>
            </tr>
		    <tr valign="top">
                <th scope="row">
                    <?php _e("Background image", 'betagate'); ?>
                </th>
                 <td>
				<?php 
				$input_vars = array( 'name'=>'gate_background_image',
									 'selected'=>get_option('bcAGGT_gate_background_image')
								   );
					 
							bcAGGT_imageselect_field($input_vars); ?>
                </td>
            </tr> 
             <tr valign="top">
                <th scope="row">
                    <?php _e("Some custom CSS", 'betagate'); ?>
                </th>
                 <td>
					 <p><?php _e('If you like to change some things on the homepage, use this CSS box to do so. You will not lose changes when this plugin is updated.','betagate'); ?></p><br />
				<?php 
				if(get_option('bcAGGT_gate_css')==''){
                    $custom_css_content = "";
                }else{
                    $custom_css_content = get_option('bcAGGT_gate_css');   
                }
					 
				$textarea_vars = array( 'name'=>'gate_css',
									 'selected'=>$custom_css_content 
								   );

				bcAGGT_textarea_field($textarea_vars); ?>
				 </td>
            </tr>  
		</table>	
		<br />
		<h2><?php _e('Whitelisted pages','betagate'); ?></h2>
        <p><?php _e('Unhide some of the pages like the cookies page or the privacy policy page.','betagate'); ?></p>
        <?php
        
        $args = array(
                'post_type' => 'page'
        );	
        $query = new WP_Query( $args );
        $count = 0;
        $select_vars_list[$count]['op_name'] = __('None','betagate');
        $select_vars_list[$count]['op_value'] = 0;
        $count++;
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {

            $query->the_post();
            // now $query->post is WP_Post Object, use:
            // $query->post->ID, $query->post->post_title, etc.
            $select_vars_list[$count]['op_name'] = $query->post->post_title;
            $select_vars_list[$count]['op_value'] = $query->post->ID;
            $count++;
            }
        }
        ?>
		<table class="bcSOFF_forms form-table">
		    <tr valign="top">
                <th scope="row">
                    <?php _e("Disclaimer", 'betagate'); ?>
                </th>
                 <td>
				<?php 
                $select_vars = array( 'name'=>'page_disclaimer',
                                     'options'=> $select_vars_list,
									 'selected'=>get_option('bcAGGT_page_disclaimer')
								   );
				bcAGGT_select_box($select_vars); ?>
                </td>
            </tr> 
    		    <tr valign="top">
                <th scope="row">
                    <?php _e("Privacy Policy", 'betagate'); ?>
                </th>
                 <td>
				<?php 
                $select_vars = array( 'name'=>'page_privacy',
                                     'options'=> $select_vars_list,
									 'selected'=>get_option('bcAGGT_page_privacy')
								   );
				bcAGGT_select_box($select_vars); ?>                     
                </td>
            </tr> 
            <tr valign="top">
                <th scope="row">
                    <?php _e("Cookie policy", 'betagate'); ?>
                </th>
                 <td>

				<?php 
                $select_vars = array( 'name'=>'page_cookie',
                                     'options'=> $select_vars_list,
									 'selected'=>get_option('bcAGGT_page_cookie')
								   );
				bcAGGT_select_box($select_vars); ?>
                </td>

            </tr> 
        </table>
		<br />
		<h2><?php _e('Support Beta','betagate'); ?></h2>
		<table class="bcSOFF_forms form-table">
		    <tr valign="top">
                <th scope="row">
                    <?php _e("Show this plugin some love", 'betagate'); ?>
                </th>
                 <td>
					<a href="https://wordpress.org/plugins/super-simple-age-gate-beta/" target="_blank"><?php _e('Write a review and rate this plugin.','betagate'); ?></a>
                </td>
            </tr> 
        </table>
        <?php submit_button(); ?>
        </form>
			
</div>
<?php 

/* ------------------------ */
/* THE FOOTER.              */

$bcALG_my_plugins = array(
                array(
                    'slug'=>'super-simple-site-offline-beta',
                    'name'=>'Super Simple Site Offline',
                    'content'=>'Site offline plugins are made awesome again with this piece of code. While most site offline plugins are bulky, intrusive and annoying this one is as light as a feather and has no paid options. The nav item is neatly tucked away within the settings menu so it feels like it is part of WordPress.' ),
                array(
                    'slug'=>'simple-analytics-tag-beta',
                    'name'=>'Simple Analytics Tag',
                    'content'=>'Simple Analytics Tag helps you get up and running quick. This plugin has a non-intrusive interface and fits very well within the Wordpress Settings menu. Just paste in the ID from Google Tagmanager or Google Analytics and you are good to go.' ),
                array(
                    'slug'=>'super-simple-age-gate-beta',
                    'name'=>'Super Simple Age Gate',
                    'content'=>"Do you have to filter out younger visitors? With this super simple age gate you'll fix those age restrictions quickly. Ment for webshops and other types of websites that has to have a curtain where people below your set age can't peek behind.." ),
                array(
                    'slug'=>'super-simple-schema-markup-beta',
                    'name'=>'Super Simple Schema Markup',
                    'content'=>'Grab those rich snippets with this Schema plugin that adds Json-LD schema to your Wordpress website. And if you want custom schema per page that is possible as well.' )/*,
                array(
                    'slug'=>'the-janitor-beta',
                    'name'=>'The Janitor',
                    'content'=>'Helping you maintain that time-consuming website and in the maintime cleaning up and branding your WP-admin panel.' )*/
            
            );

// get the slug of this plugin
$get_slug = explode('/', plugin_basename( __FILE__ ));
?>
<div class="bcALG_footer">
    <h2>Making Wordpress more awesome <span>with useful plugins like these...</span></h2>
    
    <ul class="bcALG_plugins">
        <?php foreach($bcALG_my_plugins as $bc_id => $bc_value){ 
            if($get_slug[0] != $bc_value['slug']){
        ?>
            <li>
                <img src="https://ps.w.org/<?php echo $bc_value['slug']; ?>/assets/icon-256x256.jpg" title="<?php echo $bc_value['name']; ?> by Beta" />
                <h3><a href="https://wordpress.org/plugins/super-simple-site-offline-beta/" target="_blank"><?php echo $bc_value['name']; ?></a></h3>
                <p><?php echo $bc_value['content']; ?></p>
                <a href="https://wordpress.org/plugins/<?php echo $bc_value['slug']; ?>/" class="button" target="_blank"><?php _e('Plugin'); ?></a>
                <a href="<?php bloginfo('wpurl'); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=<?php echo $bc_value['slug']; ?>&TB_iframe=false" class="button button-primary" target="_blank"><?php _e('Plugin details'); echo $get_slug[0]; ?></a>
            </li>
    
        <?php }} ?>
    </ul>

    <div class="bcALG_mailinglist">
        <form>
            <h2>Are you running Wordpress inefficient? <span>Betacore is developing plugins to fix that!</span></h2>
            <p>Get an email when new plugins arrive! The only thing you'll have to do is subscribe to the mailing list now!</p>
            <ul class="bcALG_mailingform">
                <li>
                    <label for="">Name</label>
                    <input type="text" value="" name="" id="" />
                </li>
                <li>
                    <label for="">Email adress</label>
                    <input type="text" value="" name="" id="" />
                </li>
                <li>
                    <input type="submit" value="Join!" name="" id="" />
                </li>
            </ul>
        </form>
    </div>
    <a href="https://beta-media.com/super-simple-site-gate-wordpress-plugin/"><img src="<?php echo plugin_dir_url( __DIR__ ); ?>img/betalogo-b.png" /></a>
    <p class="bcALG_url"><span>By:</span> <a href="https://www.betacore.tech" target="_blank">www.betacore.tech</a></p>
</div>
