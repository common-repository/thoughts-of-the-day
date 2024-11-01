<?php /*
Plugin Name: Thoughts Of The Day
Plugin URI:  http://www.powerfaq.com/thoughts-of-the-day/
Description: Plugin is to show daily thought, can add thoughts in each line for each day and will show the each line according to day. 
Author: Mejar Singh
Author URI: http://www.powerfaq.com
Version: 1.1
*/
function thought_install() {
    global $wpdb;
	add_option('thought_text', 'Thought Of The Day text');
}
$blogurl = get_option('siteurl');

function thought_config_menu() {
		add_menu_page("Thought Of The Day", "Thought Of The Day", 8, "thoughtdss", "thoughtdss", get_option('siteurl') . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/thought.png');
}

register_activation_hook(__FILE__,'thought_install');

add_action('admin_menu', 'thought_config_menu');
add_shortcode('THOUGHTSOFTHEDAY', 'thought_day');  /* [THOUGHT_OF_THE_DAY] */

function thought_day() {
$thought = get_option('thought_text');
$exp = array_filter(explode("\n", $thought));
$cDay = date('j');
?>
<div style="width:100%;float:left;"><div style=" background: #D88740;padding:7px 5px 1px 13px;height: 32px; color:#E4F57A; width:30%; float:left;">THOUGHTS OF THE DAY</div><div style="background: #FAC591; padding:7px 5px 1px 13px;height: 32px; margin:0; float:left;width:60%"><?php  echo($exp[$cDay]); ?></div> </div>
<?php  }

function thoughtdss() {   
	if (isset($_POST['options'])) {
	     update_option('thought_text', $_POST['thought_text']);
	}
	if (isset($_POST['options'])) {
	echo "<div class=\"alert\">options updated</div>";
	}
?>
<div id="thought_options" class="thought_box">
    <form name="thought_options" method="post" action="<?php bloginfo('wpurl') ?>/wp-admin/admin.php?page=thoughtdss">

<fieldset><legend><h3>Thoughts:</h3></legend>
     <textarea name="thought_text" id="thought_text" cols="180" rows="10"><?php echo get_option('thought_text'); ?></textarea> </fieldset>
	 <fieldset><legend><h3>Heading:</h3></legend>
		 <input type="text" style="width:500px;" name="satsang_date" id="satsang_date" value="<?php if(get_option('thought_title')=="" ) { echo "Thought Of The Day"; } else { echo get_option('thought_title'); } ?>" /> 
		 </fieldset>
	<fieldset><legend><h3>How To Use</h3></legend>
	<strong> use shortcode: [THOUGHTSOFTHEDAY] <br/> Function: </strong><p>&lt;?php echo do_shortcode( '[THOUGHTSOFTHEDAY]' ) ?&gt;</p></fieldset>
		 <input type="submit" name="options" value="Save" class="button-primary action" />
 </form>
</div>
<?php } ?>