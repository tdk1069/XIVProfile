<?php
/*
Plugin Name: XIVDBProfile
Description: Pull Info from XIVDB for Sidebar Widget
*/
// Register and load the widget
function wpb_load_widget() {
	register_widget( 'XIVDBProfile' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget 
class XIVDBProfile extends WP_Widget {

function __construct() {
parent::__construct(

// Base ID of your widget
'XIVDBProfile', 

// Widget name will appear in UI
__("XIVDBProfile", 'wpb_widget_domain'), 

// Widget description
array( 'description' => __( 'Retrieve and cache XIVDB Character Info - v1.2 by Brax of Moogle', 'wpb_widget_domain' ), ) 
);
}


public function widget( $args, $instance ) {

echo $args['before_widget'];
if ( isset( $instance[ 'id' ] ) ) {
$id = $instance[ 'id' ];
} else {
$id = "6318718";
}
if ( isset( $instance[ 'cache_timeout' ] ) ) {
$cache_timeout = $instance[ 'cache_timeout' ];
} else {
$cache_timeout = 30;
}
//
//
if ((!file_exists(plugin_dir_path(__FILE__).'cache/'.$id) || (time()-filemtime(plugin_dir_path(__FILE__).'cache/'.$id) > ($cache_timeout * 60)))) {
	$ch = curl_init("http://api.xivdb.com/character/".$id);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	curl_close($ch);
	$obj = json_decode($json);

	$ch = curl_init($obj->data->portrait);
	$fp = fopen(plugin_dir_path(__FILE__).'cache/'.$id.'.jpg', 'wb');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$fh = fopen(plugin_dir_path(__FILE__).'cache/'.$id,'w');
	fwrite($fh,$json);
	fclose($fh);
} else {
	$fh = fopen(plugin_dir_path(__FILE__).'cache/'.$id,'r');
	$json = fread($fh,filesize(plugin_dir_path(__FILE__).'cache/'.$id));
	fclose($fh);
	$obj = json_decode($json);
}
	


?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<style>
.BH1 {
   font-size: 20px;
   line-height: 15px;
   font-weight:300;
   height:20px;
   font-family: 'Open Sans',sans-serif,Helvetica,Arial,Verdana;
   color: #f9ed7a;
   background:rgba(0,0,0,0.5);
   text-align:center;
   }
div.jobs {
   position: relative;
   top: 187px;
   width: 100%;
   padding: 0px;
   margin: 0px;
   color: #f9ed7a;
   font-family: 'Open Sans',sans-serif,Helvetica,Arial,Verdana;
   font-size: 15px;
   line-height: 15px;
   background:rgba(0,0,0,0.5);
   text-align:center;
}
}
</style>
<?php
echo __("<div style='width:220px;height:300px;'>", 'wpb_widget_domain' );//220x300
echo __("<div style='height:300px;background-image: url(".plugin_dir_url(__FILE__).'cache/'.$id.'.jpg'.");background-size: 100% 100%;'>", 'wpb_widget_domain' );
echo __("<h1 class='BH1'>".$obj->name, 'wpb_widget_domain' );;//." [".$obj->data->server."]</h1>", 'wpb_widget_domain' );
echo __("<div class='jobs'>", 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/gladiator.png' title=''>".$obj->data->classjobs->{1}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/darkknight.png' title=''>".$obj->data->classjobs->{32}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/marauder.png' title=''>".$obj->data->classjobs->{3}->level, 'wpb_widget_domain' );

   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/conjurer.png' title=''>".$obj->data->classjobs->{6}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/astrologian.png' title=''>".$obj->data->classjobs->{33}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/scholar.png' title=''>".$obj->data->classjobs->{26}->level, 'wpb_widget_domain' );

   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/arcanist.png' title=''>".$obj->data->classjobs->{26}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/archer.png' title=''>".$obj->data->classjobs->{5}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/lancer.png' title=''>".$obj->data->classjobs->{4}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/machinist.png' title=''>".$obj->data->classjobs->{31}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/pugilist.png' title=''>".$obj->data->classjobs->{2}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/redmage.png' title=''>".$obj->data->classjobs->{35}->level, 'wpb_widget_domain' );

   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/rogue.png' title=''>".$obj->data->classjobs->{29}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/samurai.png' title=''>".$obj->data->classjobs->{34}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/thaumaturge.png' title=''>".$obj->data->classjobs->{7}->level, 'wpb_widget_domain' );
echo __("<br/>", 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/carpenter.png' title=''>".$obj->data->classjobs->{8}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/blacksmith.png' title=''>".$obj->data->classjobs->{9}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/armorer.png' title=''>".$obj->data->classjobs->{10}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/goldsmith.png' title=''>".$obj->data->classjobs->{11}->level, 'wpb_widget_domain' );
echo __("<br/>", 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/leatherworker.png' title=''>".$obj->data->classjobs->{12}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/weaver.png' title=''>".$obj->data->classjobs->{13}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/alchemist.png' title=''>".$obj->data->classjobs->{14}->level, 'wpb_widget_domain' );
   echo __("<img heigh=18 width=18 src='".plugin_dir_url(__FILE__)."img/culinarian.png' title=''>".$obj->data->classjobs->{15}->level, 'wpb_widget_domain' );

echo __("</div>", 'wpb_widget_domain' );
echo __("</div>", 'wpb_widget_domain' );
echo __("</div>", 'wpb_widget_domain' );
//
//
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'id' ] ) ) {
$id = $instance[ 'id' ];
}
else {
$id = __( 'Char ID', 'wpb_widget_domain' );
}
if ( isset( $instance[ 'cache_timeout' ] ) ) {
$cache_timeout = $instance[ 'cache_timeout' ];
}
else {
$cache_timeout = __( '30', 'wpb_widget_domain' );
}
// Widget admin form
?>
<div class="nav-menu-widget-form-controls">
<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'Char ID:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" type="text" value="<?php echo esc_attr( $id ); ?>" />
<label for="<?php echo $this->get_field_id( 'cache_timeout' ); ?>"><?php _e( 'Cache Timeout:' ); ?></label> 
<!--
<select class="widefat" id="<?php echo $this->get_field_id( 'cache_timeout' ); ?>" name="<?php echo $this->get_field_name( 'cache_timeout' ); ?>"/>
	<option value="15" <?php selected( $instance['cache_timeout'], '15'); ?>>15 Minutes</option>
	<option value="30" <?php selected( $instance['cache_timeout'], '30'); ?>>30 Minutes</option>
	<option value="45" <?php selected( $instance['cache_timeout'], '45'); ?>>45 Minutes</option>
	<option value="60" <?php selected( $instance['cache_timeout'], '60'); ?>>60 Minutes</option>
</select>
-->
<input class="widefat" id="<?php echo $this->get_field_id( 'cache_timeout' ); ?>" name="<?php echo $this->get_field_name( 'cache_timeout' ); ?>" type="number" value="<?php echo esc_attr( $cache_timeout ); ?>" step="15"/>
</div>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['id'] = ( ! empty( $new_instance['id'] ) ) ? strip_tags( $new_instance['id'] ) : '';
$instance['cache_timeout'] = ( ! empty( $new_instance['cache_timeout'] ) ) ? strip_tags( $new_instance['cache_timeout'] ) : '';
return $instance;
}
} // Class wpb_widget ends here

?>
