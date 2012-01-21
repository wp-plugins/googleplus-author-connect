<?php  
/* 
Plugin Name: GooglePlus Author Connect
Plugin URI: http://googleplus-one.co.uk 
Description: Plugin for displaying Author's Google +1 Profile Picture in Google Search Results
Author: GooglePlus-One.Co.Uk
Version: 1.0 
Author URI: http://googleplus-one.co.uk
*/  
?>
<?php
global $gp_connect_me_url;
global $gp_connect_me_align;

if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'gp_connect_me_settings');
  add_action( 'admin_init', 'register_gp_connect_me_settings' ); 
}
$gp_connect_me_url = get_option('gp_connect_me_url');
$gp_connect_me_align = get_option('gp_connect_me_align');
	
if( isset($_POST['gp_connect_me_url'])) {
				update_option('gp_connect_me_url',$_POST['gp_connect_me_url']);
				update_option('gp_connect_me_align',$_POST['gp_connect_me_align']);
}
if(!$gp_connect_me) {
				$gp_connect_me_url='';
				$gp_connect_me_align='right';
				add_option('gp_connect_me_url',$gp_connect_me_url);
				add_option('gp_connect_me_align',$gp_connect_me_align);						
}

add_action('admin_notices', 'gp_connect_me_warning');
add_action( 'get_footer', 'show_gp_connect_me' );

function show_gp_connect_me(){		
$gp_connect_me_url = get_option('gp_connect_me_url');
$gp_connect_me_align = get_option('gp_connect_me_align');
?>
<div style="position:fixed;top:55%;<?php echo $gp_connect_me_align;?>:5px;z-index:999999;"><a target="_blank" rel="author" href="<?php echo $gp_connect_me_url; ?>"><img src="wp-content/plugins/googleplus-author-connect/gplus.png" width="64" height="64"></a></div>
<?php
}

function gp_connect_me_wrong_settings(){
$gp_connect_me_url = get_option('gp_connect_me_url');	
		if ( substr($gp_connect_me_url, 0, 4) != "http" && $gp_connect_me_url != ""){
			echo '<div class="updated fade"><p><strong>GooglePlus Author Connect plugin is not properly configured.</strong>The <a href="options-general.php?page=index.php">GooglePlusOne Profile URL</a> must begin with http.</p></div>';
			}
		}
add_action('admin_notices', 'gp_connect_me_wrong_settings');

function gp_connect_me_warning() {
$gp_connect_me_url = get_option('gp_connect_me_url');	
		if ( !$gp_connect_me_url ) {
			echo '<div class="updated fade"><p><strong>GooglePlus Author Connect plugin is not configured yet.</strong>You must <a href=" options-general.php?page=index.php">enter your GooglePlusOne Profile URL</a> for it to work.</p></div>';
			}
}

function gp_connect_me_settings() {
    add_options_page('GooglePlus Author Connect', 'GooglePlus Author Connect', 9, basename(__FILE__), 'gp_connect_me_settings_page');
}

function gp_connect_me_settings_page() {  
	settings_fields('gp-connect-me-group');
	$gp_connect_me_url = get_option('gp_connect_me_url');
	$gp_connect_me_align = get_option('gp_connect_me_align');
	
?>
	<div class="wrap">
	<h2>GooglePlus Author Connect</h2>

	<form  method="post" action="">
	<input type="hidden" name="page" value="index.php">
	<div id="poststuff" class="metabox-holder has-right-sidebar"> 

	<div style="float:left;width:60%;">
	<h2>Settings</h2> 

	<div class="postbox">
	<h3 style="cursor:pointer;"><span>GooglePlus Author Connect Options</span></h3>
	<div>
	<table class="form-table">


	<tr valign="top" class="alternate"> 
			<th scope="row" style="width:20%;"><label for="gp_connect_me_url" style="font-weight:bold;">Your GooglePlus Profile URL</label></th> 
		<td>
		<input autocomplete="off" type="text" name="gp_connect_me_url" value="<?php echo $gp_connect_me_url; ?>" class="regular-text code" /> <br />(example : https://profiles.google.com/u/0/114669336642325477883 )<br />
		</td>
	</tr>

	<tr valign="top" class="alternate">
	<th scope="row"><label for="gp_connect_me_align">Alignment</label></th>
	<td><select name="gp_connect_me_align">
	<option value="left" <?php if ($gp_connect_me_align == "left"){ echo "selected";}?> >Left</option>
	<option value="right" <?php if ($gp_connect_me_align == "right"){ echo "selected";}?> >Right</option>
	</select></td>
	</tr>
	
	</table>
	</div>
	</div>

	<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>

	</div>
	</form>

	   <div id="side-info-column" class="inner-sidebar"> 
				<div class="postbox"> 
				  <h3 class="handle"><span>GooglePlus Author Connect </span></h3>
				  <div class="inside">
	                <ul>
	                <li><a href="http://googleplus-one.co.uk/" target="_blank">Plugin Homepage</a></li>
	                <li><a href="http://googleplus-one.co.uk/" target="_blank">GooglePlus-One.co.uk Website</a></li>
	                <li><a href="http://googleplus-one.co.uk/" target="_blank">Support for this plugin</a></li>
	                </ul> 
	              </div> 
				</div> 
	     </div>

	</div>


	</div>
<?php
}

function register_gp_connect_me_settings() {
  register_setting( 'gp-connect-me-group', 'gp_connect_me_url' );
  register_setting( 'gp-connect-me-group', 'gp_connect_me_align' );
}
?>