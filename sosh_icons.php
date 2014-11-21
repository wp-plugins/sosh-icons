<?php 
/*
Plugin Name: webZunder Sharing Icons
Plugin URI: http://www.webzunder.com/
Description: Add social sharing Icons to your WordPress to get your blogposts better shared. 
Author URI: http://www.twentyzen.com
Author: twentyZen
Version: 1.0.2.2
License: GPL v2 or Later
Text Domain: sosh-icons
     
    webZunder Sharing Icons 
    Copyright (C) 2013-2014, twentyZen GmbH - contact@twentyZen.com

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
global $icon_version;
$icon_version='1.0.2.2';

load_plugin_textdomain('sosh-icons', false, basename( dirname( __FILE__ ) ) . '/languages' );
function soshicons_admin_styles()
 {
 if (isset($_GET['page']) && $_GET['page'] == 'soshicons_settings')
 {
  wp_register_style( 'fontawesome', plugin_dir_url(__FILE__).'/font-awesome/css/font-awesome.min.css','','', 'screen' );
  wp_enqueue_style('fontawesome');
  wp_register_style( 'sosh-icons', plugin_dir_url(__FILE__).'/sosh_icons.css','','', 'screen' );
  wp_enqueue_style('sosh-icons');
 }
 }
 add_action('admin_print_styles', 'soshicons_admin_styles');

/*enqueuing style/script in post*/  
function soshicons_post_styles() {
     
         wp_register_style( 'fontawesome', plugin_dir_url(__FILE__).'/font-awesome/css/font-awesome.min.css','','', 'screen' );
         wp_enqueue_style( 'fontawesome' );  
         wp_register_style( 'socialsharing', plugin_dir_url(__FILE__).'socialsharing.css','','', 'screen' );
         wp_enqueue_style( 'socialsharing' );
         wp_register_script('socialsharing', plugin_dir_url(__FILE__).'socialsharing.js',array(),'0.0.9',true);
         wp_enqueue_script('socialsharing');
     
 }
 
add_action( 'wp_enqueue_scripts', 'soshicons_post_styles' );

/*Menu Entry in Dashboard*/
add_action('admin_menu', 'soshicons_settings');

function soshicons_settings() {
    /*add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);*/                
    add_options_page('Social Sharing Icons', 'Sharing Icons', 'administrator', 'soshicons_settings', 'soshicons_display_settings');
}


/*Option Page*/
function soshicons_display_settings() {
  ?>
<div class="wrap">
<h2>Social Sharing Icons </h2>
<?php
            if(isset($_GET['tab'])) {
                $active_tab = $_GET['tab'];
            } else if ($active_tab == 'show_options') { 
                $active_tab = 'show_options';
            } else if ($active_tab == 'advanced_options') { 
                $active_tab = 'advanced_options';
            }else if ($active_tab == 'hint_options') { 
                $active_tab = 'hint_options';
            } else {
                $active_tab = 'general_options';
            }
        ?>
<h2 class="nav-tab-wrapper">
    <a href="?page=soshicons_settings&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Allgemein','sosh-icons');?></a>
    <a href="?page=soshicons_settings&tab=show_options" class="nav-tab <?php echo $active_tab == 'show_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Anzeigen','sosh-icons');?></a>
    <a href="?page=soshicons_settings&tab=advanced_options" class="nav-tab <?php echo $active_tab == 'advanced_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Erweitert','sosh-icons');?></a>
    <a href="?page=soshicons_settings&tab=hint_options" class="nav-tab <?php echo $active_tab == 'hint_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Tipp','sosh-icons');?></a>
</h2>
<form method="post" action="options.php">
    <ul>
    <?php 
        /*Allgmeine Einstellung*/
        /* settings_fields( $option_group )*/
        if($active_tab =='general_options'){
            settings_fields( 'soshicons_options' ); /*Output nonce, action, and option_page fields for a settings page*/
            do_settings_sections('soshicons_plugin');
            submit_button();
        }else if($active_tab =='show_options'){
        /*Anzeige Einstellung*/
            settings_fields( 'soshicons_show_options' ); /*Output nonce, action, and option_page fields for a settings page*/
            do_settings_sections('soshicons_show_plugin');
            submit_button();
        }else if($active_tab =='advanced_options'){
        /*Erweiterte Einstellung*/
            settings_fields( 'soshicons_advanced_options' ); /*Output nonce, action, and option_page fields for a settings page*/
            do_settings_sections('soshicons_advanced_plugin');
            submit_button();
        }else{?>
            <div class="hintpage">
    <img class="logo" src="<?php echo plugin_dir_url(__FILE__) ?>logo.png" />
    <p>
       <?php
        _e('Du willst deine Social Media Aktivitäten <b>besser kontrollieren und steuern können</b>? Dann probiere doch mal <b>das Plugin in Kombination 
        mit webZunder aus</b>. Ganz einfach <b>30 Tage unverbindlich testen </b> und das eigene Online Marketing anheizen.','sosh-icons');
        echo '<br><br>';
        $adurl="http://www.webzunder.com/de/?pk_campaign=iconplugin";
        $adlink=sprintf(__('Mehr Informationen dazu findest du auf <a href="%s"> www.webzunder.com</a> ','sosh-icons'),esc_url($adurl));
        echo $adlink;    
        echo '<br><br>';   
        _e('Probier auch mal unser <b>Open Graph Plugin</b>. Damit sehen deine Beiträge noch besser aus, wenn deine Leser diese teilen.','sosh-icons');
        echo '<br><br>';
        $plugurl="http://www.wordpress.org/plugins/webzunder";
        $pluglink=sprintf(__('Mehr Informationen dazu findest du auf der <a href="%s"> Seite im WordPress Repository</a> ','sosh-icons'),esc_url($plugurl));
        echo $pluglink; 
        ?>
    </p>
    <br>    
    <form class="layout_form cr_form cr_font" action="http://29405.seu.cleverreach.com/f/29405-82025/wcs/" method="post" target="_blank">
	    <p><b><?php _e('Du willst über Neuerungen rund um das Plugin informiert werden?</b><br>Dann trag dich einfach in unsere Mailingliste ein. (kein SPAM)','sosh-icons');?></p>
        <label for="text1829098" class="itemname">E-Mail</label> <input id="text1829098" name="email" value="" type="text"  />
        <button type="submit" class="cr_button"><?php _e('Anmelden','sosh-icons');?></button>
    </form>
    
</div>
       <?php }
    ?>
    </ul>
    

</form>
</div>
<?php
}

/* Registering option fields */
add_action('admin_init', 'soshicons_plugin_init');


function soshicons_plugin_init() {
    global $icon_version;
    
    register_setting( 'soshicons_options', 'soshicons_options', 'soshicons_options_validate' );
    
        
    add_settings_section('soshicons_plugin_main', __('Einstellung','sosh-icons'), 'soshicons_option_section_text', 'soshicons_plugin');
    
    add_settings_field('twt_setting', 'Twitter', 'twt_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('fb_setting', 'Facebook', 'fb_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('gplus_setting', 'Google+', 'gplus_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('xi_setting', 'Xing', 'xi_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('link_setting', 'LinkedIn', 'link_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('pin_setting', 'Pinterest', 'pin_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('tl_setting', 'Tumblr', 'tl_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('vk_setting', 'VK', 'vk_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('mail_setting', 'E-Mail', 'mail_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    add_settings_field('position_setting', 'Position', 'position_setting_check', 'soshicons_plugin', 'soshicons_plugin_main');
    
    
    register_setting( 'soshicons_show_options', 'soshicons_show_options', 'soshicons_showoptions_validate' );
    
    add_settings_section('soshicons_plugin_show', __('Anzeigen','sosh-icons'), 'soshicons_show_section_text', 'soshicons_show_plugin');
    
    add_settings_field('posts_show', __('Beiträge','sosh-icons'), 'posts_check', 'soshicons_show_plugin', 'soshicons_plugin_show');
    add_settings_field('pages_show',  __('Seiten','sosh-icons'), 'pages_check', 'soshicons_show_plugin', 'soshicons_plugin_show');
    add_settings_field('frontpage_show',  __('Startseite','sosh-icons'), 'frontpage_check', 'soshicons_show_plugin', 'soshicons_plugin_show');
    add_settings_field('archive_show',  __('Archiv','sosh-icons'), 'archives_check', 'soshicons_show_plugin', 'soshicons_plugin_show');
    
    
   
    register_setting( 'soshicons_advanced_options', 'soshicons_advanced_options', 'soshicons_advoptions_validate' );
    
    add_settings_section('soshicons_plugin_advanced', __('Erweiterung','sosh-icons'), 'soshicons_advanced_section_text', 'soshicons_advanced_plugin');
    
    add_settings_field('twt_related', __('Empfehlung','sosh-icons'), 'twt_related_check', 'soshicons_advanced_plugin', 'soshicons_plugin_advanced');
    add_settings_field('twt_via', 'Via', 'twt_via_check', 'soshicons_advanced_plugin', 'soshicons_plugin_advanced');
    add_settings_field('custom_css', 'Custom CSS', 'custom_css_check', 'soshicons_advanced_plugin', 'soshicons_plugin_advanced');
    
    if(!get_option('soshicons_options')){
        update_option( 'soshicons_options','');
    }
    if(!get_option('soshicons_version')){
        update_option( 'soshicons_version','0');
    }
    if (!get_option('soshicons_show_options') ) {
        update_option( 'soshicons_show_options','');
    }
    
    $version= get_option( 'soshicons_version' );
    
    if ( $version <=  $icon_version)  {
		update_option( 'soshicons_version', $icon_version );
	}

    $options=get_option('soshicons_options');
    //if new icons be integrated, the should be inserted into settarray, to avoid default displaying
    $settarray=array('twt_setting','fb_setting','gplus_setting','xi_setting','link_setting', 'pin_setting', 'tl_setting', 'vk_setting','mail_setting', 'position_setting');
    foreach($settarray as $setting){
        if(!array_key_exists ($setting , $options)){
            $options[$setting]='0';
            update_option( 'soshicons_options', $options);
        }
    }
    
    $shows=get_option('soshicons_show_options');
    $showarray=array('posts_show','pages_show','frontpage_show','archives_show');
    foreach($showarray as $setting){
        if(!array_key_exists ($setting , $shows)){
            $shows[$setting]='0';
            update_option( 'soshicons_show_options', $shows);
        }
    }

} 
/*section beschreibung*/
function soshicons_option_section_text(){
    echo '<p>'.__('Welche Icons sollen angezeigt werden?','sosh-icons').'</p>';
}

function soshicons_advanced_section_text(){
    echo '<p>'.__('erweiterte Einstellung für Twitter','sosh-icons').'</p>';
}
function soshicons_show_section_text(){
    echo '<p>'.__('Wo sollen die Icons angezeigt werden?','sosh-icons').'</p>';
}

/*allgemein*/
function twt_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-twitter fa-2x option"></i>';
   echo '<input type="checkbox" id="twt_setting" name="soshicons_options[twt_setting]" value="1"'. checked( "1", $options['twt_setting'], false ).' />';
    echo "</li>";
}
    
function fb_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-facebook fa-2x option"></i>';
   echo '<input type="checkbox" id="fb_setting" name="soshicons_options[fb_setting]" value="1"'. checked( "1", $options['fb_setting'], false ).' />';
    echo "</li>";
}
    
function gplus_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-google-plus fa-2x option"></i>';
   echo '<input type="checkbox" id="gplus_setting" name="soshicons_options[gplus_setting]" value="1"'. checked( "1", $options['gplus_setting'], false ).' />';
    echo "</li>";
}
    
function xi_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-xing fa-2x option"></i>';
   echo '<input type="checkbox" id="xi_setting" name="soshicons_options[xi_setting]" value="1"'. checked( "1", $options['xi_setting'], false ).' />';
    echo "</li>";
}
    
function link_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-linkedin fa-2x option"></i>';
   echo '<input type="checkbox" id="link_setting" name="soshicons_options[link_setting]" value="1"'. checked( "1", $options['link_setting'], false ).' />';
    echo "</li>";
}
    
function pin_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-pinterest fa-2x option"></i>';
   echo '<input type="checkbox" id="pin_setting" name="soshicons_options[pin_setting]" value="1"'. checked( "1", $options['pin_setting'], false ).' />';
    echo "</li>";
}
    
function tl_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-tumblr fa-2x option"></i>';
   echo '<input type="checkbox" id="tl_setting" name="soshicons_options[tl_setting]" value="1"'. checked( "1", $options['tl_setting'], false ).' />';
    echo "</li>";
}    

function vk_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-vk fa-2x option"></i>';
   echo '<input type="checkbox" id="vk_setting" name="soshicons_options[vk_setting]" value="1"'. checked( "1", $options['vk_setting'], false ).' />';
    echo "</li>";
}
    
function mail_setting_check(){
    $options=get_option('soshicons_options');
   echo '<li><i class="fa fa-envelope-o fa-2x option"></i>';
   echo '<input type="checkbox" id="mail_setting" name="soshicons_options[mail_setting]" value="1"'. checked( "1", $options['mail_setting'], false ).' />';
    echo "</li>";
}

function position_setting_check(){
    $options=get_option('soshicons_options');
    echo '<select name="soshicons_options[position_setting]">';
    echo '<option value="1"'.selected( $options['position_setting'], 1 ).'>'.__('Über dem Inhalt','sosh-icons').'</option>';
    echo '<option value="2"'.selected( $options['position_setting'], 2 ).'>'.__('Unter dem Inhalt','sosh-icons').'</option>';
    echo "</select>";
}
 
/*anzeige*/

function posts_check(){
   $showoptions=get_option('soshicons_show_options');
   echo '<input type="checkbox" id="posts_show" name="soshicons_show_options[posts_show]" value="1"'. checked( "1", $showoptions['posts_show'], false ).' />';
}

function pages_check(){
   $showoptions=get_option('soshicons_show_options');
   echo '<input type="checkbox" id="pages_show" name="soshicons_show_options[pages_show]" value="1"'. checked( "1", $showoptions['pages_show'], false ).' />';
}

function frontpage_check(){
   $showoptions=get_option('soshicons_show_options');
   echo '<input type="checkbox" id="frontpage_show" name="soshicons_show_options[frontpage_show]" value="1"'. checked( "1", $showoptions['frontpage_show'], false ).' />';
}

function archives_check(){
   $showoptions=get_option('soshicons_show_options');
   echo '<input type="checkbox" id="archives_show" name="soshicons_show_options[archives_show]" value="1"'. checked( "1", $showoptions['archives_show'], false ).' />';
}



/*Erweitert*/
function twt_related_check(){
    $advoptions=get_option('soshicons_advanced_options');
         echo '<input type="text" id="twt_related" name="soshicons_advanced_options[twt_related]" value="'.$advoptions['twt_related'].'" />';
         echo '<span class="description">'.__('Welcher Twitteraccount soll nach dem Teilen, deinem Leser empfohlen werden. Bitte ohne @ Zeichen. Hier ein <a href="https://dev.twitter.com/sites/default/files/images_documentation/share-related.png">Beispiel-Bild wie das dann aussieht</a>.','sosh-icons').'</span>';
    
}
 function twt_via_check(){
    $advoptions=get_option('soshicons_advanced_options');
    echo '<input type="text" id="twt_via" name="soshicons_advanced_options[twt_via]" value="'.$advoptions['twt_via'].'"/>';
    echo '<span class="description">'.__('Wie lautet dein Twitteraccount? Bitte ohne @ angeben.','sosh-icons').'</span>';
    
}
function custom_css_check(){
    $advoptions=get_option('soshicons_advanced_options');
    
    echo '<textarea id="custom_css" name="soshicons_advanced_options[custom_css]" cols="50" rows="10">'.esc_html($advoptions['custom_css']).'</textarea>';
    echo '<span class="description">'.__('Style hier die Buttons mit CSS.','sosh-icons').'</span>';
    
    
}
    
/*Allgemein Validierung*/
function soshicons_options_validate($input) {
$options = get_option('soshicons_options');

    
    if(isset($input['twt_setting'])&& $input['twt_setting']!=""){
        $options['twt_setting'] = $input['twt_setting'];
    }else{
        $options['twt_setting'] = "0";
    }
    
    if(isset($input['fb_setting'])&& $input['fb_setting']!=""){
        $options['fb_setting'] = $input['fb_setting'];
    }else{
        $options['fb_setting'] = "0";
    }
    
    if(isset($input['gplus_setting'])&& $input['gplus_setting']!=""){
        $options['gplus_setting'] = $input['gplus_setting'];
    }else{
        $options['gplus_setting'] = "0";
    }
    
    if(isset($input['xi_setting'])&& $input['xi_setting']!=""){
        $options['xi_setting'] = $input['xi_setting'];
    }else{
        $options['xi_setting'] = "0";
    }
    
    if(isset($input['link_setting'])&& $input['link_setting']!=""){
        $options['link_setting'] = $input['link_setting'];
    }else{
        $options['link_setting'] = "0";
    }
    
    if(isset($input['pin_setting'])&& $input['pin_setting']!=""){
        $options['pin_setting'] = $input['pin_setting'];
    }else{
        $options['pin_setting'] = "0";
    }
    
    
    if(isset($input['tl_setting'])&& $input['tl_setting']!=""){
        $options['tl_setting'] = $input['tl_setting'];
    }else{
        $options['tl_setting'] = "0";
    }
    
    
    if(isset($input['vk_setting'])&& $input['vk_setting']!=""){
        $options['vk_setting'] = $input['vk_setting'];
    }else{
        $options['vk_setting'] = "0";
    }
    
    if(isset($input['mail_setting'])&& $input['mail_setting']!=""){
        $options['mail_setting'] = $input['mail_setting'];
    }else{
        $options['mail_setting'] = "0";
    }
    
    if(isset($input['position_setting']) && $input['position_setting']!=""){
        $options['position_setting'] = $input['position_setting'];
    }else{
        $options['position_setting'] = "2";
    }
    
 
return $options;

}
/*Anzeigen Validierung*/
function soshicons_showoptions_validate($input) {
$showoptions = get_option('soshicons_show_options');
   
    if(isset($input['posts_show'])&& $input['posts_show']!=""){
        $showoptions['posts_show'] = $input['posts_show'];
    }else{
        $showoptions['posts_show'] = "0";
    }
    if(isset($input['pages_show'])&& $input['pages_show']!=""){
        $showoptions['pages_show'] = $input['pages_show'];
    }else{
        $showoptions['pages_show'] = "0";
    }
    if(isset($input['frontpage_show'])&& $input['frontpage_show']!=""){
        $showoptions['frontpage_show'] = $input['frontpage_show'];
    }else{
        $showoptions['frontpage_show'] = "0";
    }
    if(isset($input['archives_show'])&& $input['archives_show']!=""){
       $showoptions['archives_show'] = $input['archives_show'];
    }else{
        $showoptions['archives_show'] = "0";
    }
    
    return $showoptions;
}

/*Erweitert Validierung*/
function soshicons_advoptions_validate($input){
$options=get_option('soshicons_advanced_options');
if($input['twt_related']!=""){
        $options['twt_related'] = $input['twt_related'];
    }else{
        $options['twt_related'] = "";
    }
    
    if($input['twt_via']!=""){
        $options['twt_via'] = $input['twt_via'];
    }else{
        $options['twt_via'] = "";
    }
    if($input['custom_css']!=""){
        $options['custom_css'] = $input['custom_css'];
    }else{
        $options['custom_css'] = "";
    }
    
    
    return $options;
}

function soshicons_displayicons($content){
   
    $options = get_option('soshicons_options');
    $adv_options=get_option('soshicons_advanced_options');
    global $wp_query;
    $custom_fields = get_post_custom(get_query_var('p')); /* Post ID */
    $post=get_post($post_id);
    $title=$post->post_title;
    $url = get_permalink( $post_id );
    
    
    if(get_post_meta($post->ID, '_yoast_wpseo_metadesc', true)!=""){
                $desc=get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);
    }elseif(get_post_meta($post->ID, '_aioseop_description', true)!=""){
                $desc=get_post_meta($post->ID, '_aioseop_description', true);
    }elseif(get_post_meta(get_the_ID(), 'og:description', true)==""){
            if(get_option('wbZ_description')!=""){
                $desc=get_option('wbZ_description');   /* og:description defined in plugin*/
            
            }else{
                $post_object = get_post(get_the_ID());
                $cont= $post_object->post_content;
                $desc = substr( strip_tags( $cont ), 0, 160 );
                
                
            }
        }else{
            $desc= $custom_fields['og:description'][0]; /* og:title custom field filled by webZunder*/
            
       }
    
    if(get_post_meta(get_the_ID(), 'og:image', true)==""){
            if(get_option('wbZ_image')!=""){
                        $image=get_option('wbZ_image');  /* og:image defined in plugin*/
            }else{
              $image=wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID));
            }
        }else{
            $image = $custom_fields['og:image'][0];
        }
    
    
    
    
    $rel=$adv_options['twt_related'];
    $via=$adv_options['twt_via'];
    $btn=0;
    
    if($options['twt_setting'] != "0" ){
       $twitter='<a class="twitter" onclick="Share.twitter(\''.$url.'\',\''.$title.'\',\''.$rel.'\',\''.$via.'\')"><i class="fa fa-twitter fa-2x"></i></a>';
       $btn=1;
    }
    
    if($options['fb_setting'] != "0" ){
        $fb='<a class="fb" onclick="Share.facebook(\''.$url.'\',\''.$title.'\',\''.$image.'\',\''. esc_html($desc).'\')"><i class="fa fa-facebook fa-2x"></i></a>';
       $btn=1;
    }
    if($options['gplus_setting'] != "0" ){
        $gplus='<a class="googleplus" onclick="Share.googleplus(\''.$url.'\',\''.$title.'\')"> <i class="fa fa-google-plus fa-2x"></i></a>';
        $btn=1;
    }
    if($options['xi_setting'] != "0" ){
        $xing='<a class="xing" onclick="Share.xing(\''.$url.'\',\''.$title.'\')"> <i class="fa fa-xing fa-2x"></i></a>';
        $btn=1;
    }
    if($options['link_setting'] != "0" ){
        $linki='<a class="linkedin" onclick="Share.linkedin(\''.$url.'\',\''.$title.'\')"> <i class="fa fa-linkedin fa-2x"></i></a>';
        $btn=1;
    }
    if( $options['pin_setting'] != "0" ){
        $pin='<a class="pinterest" onclick="Share.pinterest(\''.$url.'\',\''.esc_html($desc).'\',\''.$image.'\')"> <i class="fa fa-pinterest fa-2x"></i></a>';
        $btn=1;
    }
    if( $options['tl_setting'] != "0"){
        $tumblr='<a class="tumblr" onclick="Share.tumblr(\''.$url.'\',\''.$title.'\',\''.esc_html($desc).'\')"> <i class="fa fa-tumblr fa-2x"></i></a>';
        $btn=1;
    }
    if( $options['vk_setting'] != "0"){
        $vk='<a class="vk" onclick="Share.vk(\''.$url.'\',\''.$title.'\',\''.$image.'\',\''. esc_html($desc).'\')"> <i class="fa fa-vk fa-2x"></i></a>';
        $btn=1;
    }
    if($options['mail_setting'] != "0" ){
        $mail='<a class="mail" onclick="Share.mail(\''.$url.'\',\''.esc_html($desc).'\',\''.$title.'\')"> <i class="fa fa-envelope-o fa-2x"></i></a>';
        $btn=1;
    }
    
    $show= get_option('soshicons_show_options');
	wp_reset_query();
        
    if ( (is_page()) && ($show['pages_show'] != 1) ) {
			
        return $content;
    }
    
    if ( (is_front_page()||is_home()) && ($show['frontpage_show'] != 1) ) {
			
        return $content;
    }
	if ( (is_archive()) && ($show['archives_show'] != 1) ) {
			
        return $content;
    }
    
    
    if ( (is_single()) && ($show['posts_show'] != 1) ) {
			
            return $content;
    }
    
	
	
  $new_content=$content;
   
  if($btn==1){
    $icons='<div class="buttons">';
    $icons.=$twitter;
    $icons.=$fb;
    $icons.=$gplus;
    $icons.=$xing;
    $icons.=$linki;
    $icons.=$pin;
    $icons.=$tumblr;
    $icons.=$vk;
    $icons.=$mail;
    $icons.='</diV>';
    
        if($options['position_setting']=="1"){
            $new_content=$icons.$content;
        }else{
            $new_content.=$icons;
        }
    }
  
        return $new_content;
 
}
add_filter('the_content', 'soshicons_displayicons',10);

add_action( 'wp_head', 'soshicons_custom_css' );
function soshicons_custom_css() {
$options=get_option('soshicons_advanced_options');

if($options['custom_css']!=""){
    $style=$options['custom_css'];
    $css  ='<style type="text/css">';
    $css .="$style";
    $css .='</style>';
    
}

echo $css;


}

?>