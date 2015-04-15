<?php
/*
Plugin Name: TT Custom Post Type Creator
Plugin URI: http://www.technologiestoday.com.au/guide-to-use-tt-custom-post-type-creator-plugin-for-wordpress/
Description: Easy Cration of Custom Post Type and Taxonomies
Tags: custom post type, post, custom taxonomies, taxonomy
Author: Rashed Latif
Author URI: http://www.technologiestoday.com.au/rashed-latif
Donate link: http://www.technologiestoday.com.au/donate
Requires at least: 3.0.1
Tested up to: 4.1.1
Version: 1.0
Stable tag: 1.0 
License: GPL v2
*/


class TT_CPTC_Class{
    public function __construct(){
	        

	$this->tt_cptc_load_scripts_and_styles();
	
	$this->field_array = array();
	

	
        if (is_admin()){
            add_action( 'admin_menu', array($this,'tt_cptc_add_settings_menu') );
	    add_action( 'admin_init', array($this, 'tt_cptc_init_settings') );
	    $this->tt_cptc_get_submitted_data();
	    $this->tt_cptc_create_custom_posttype();
	    $this->tt_cptc_create_custom_taxonomy();
        }
    
    }
    public function tt_cptc_manage_posttype_menu_page_fn(){
	echo tt_cptc_display_posttype_manage_page();  
    }
    
    public function tt_cptc_manage_taxonomy_menu_page_fn(){
	echo tt_cptc_display_taxonomy_manage_page();  
    }
    
   
    public function tt_cptc_init_settings(){
	global $create_array;
	load_plugin_textdomain( 'tt_cptc_text_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	
	$this->field_array = tt_load_field_details();
	
	
	register_setting('tt_cptc_unique_counter', 'tt_cptc_unique_counter');/*Registering all settings*/
	if (get_option('tt_cptc_unique_counter')==false){
	    add_option('tt_cptc_unique_counter', '1');
	}
	$settings_array = array('tt_cptc_guide_options', 'tt_cptc_create_posttype_options', 'tt_cptc_create_taxonomy_options');
	foreach ($settings_array as $option){
	    register_setting($option, $option);/*Registering all settings*/
	}
	
	/*add_settings_section(          $id,                          $title,                                    $callback,                                 $page )*/
	/*Add Sections for Sub Menu 1 Page*/
	add_settings_section( 'tt_cptc_create_posttype_basic', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_basic_callback'), 'tt_cptc_create_posttype_settings_basic' );
	add_settings_section( 'tt_cptc_create_posttype_adlabel', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_adlabel_callback'), 'tt_cptc_create_posttype_settings_adlabel' );
	add_settings_section( 'tt_cptc_create_posttype_advanced', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_advanced_callback'), 'tt_cptc_create_posttype_settings_advanced' );
	
	/*Add Sections for Sub Menu 2 Page*/
	add_settings_section( 'tt_cptc_create_taxonomy_basic', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_basic_callback'), 'tt_cptc_create_taxonomy_settings_basic' );
	add_settings_section( 'tt_cptc_create_taxonomy_adlabel', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_adlabel_callback'), 'tt_cptc_create_taxonomy_settings_adlabel' );
	add_settings_section( 'tt_cptc_create_taxonomy_advanced', __('', 'tt_cptc_text_domain'), array($this, 'tt_cptc_create_advanced_callback'), 'tt_cptc_create_taxonomy_settings_advanced' );	
	/*Input Fields for Create_posttype Section 1
	 *<?php add_settings_field(  $id,      $title,                    $callback,        $page,       $section,            $args ); ?>
	 */
	
	foreach ($this->field_array as $field=>$key){
	    if($key['required']=='yes'){
		$key['title'] = $key['title'] . '<span style="color: #FF0000";>  *</span>';
		
	    }
	    add_settings_field($key['id'],$key['title'],array($this,$key['callback']),$key['page'],$key['section'],
			       array('name' => $key['id'],
				     'input_type' => $key['input_type'],
				     'place_holder' => $key['place_holder_text'],
				     'menu' => $key['menu'],
				     'multicheck' => $key['multicheck'],
				     'required' => $key['required']));	
	} 
    }
    
    public function tt_cptc_get_submitted_data(){
	global $edit_array, $object_type;
	
	$object_type = substr($_GET['page'], 20, strlen($_GET['page'])); // $object_type is the variable to decide whether its a posttype or taxonomy

	if (isset($_GET['sub']) && ( (($_GET['sub']=='anpt') or ($_GET['sub']=='upt')) or (($_GET['sub']=='antt') or ($_GET['sub']=='utt')) ) ){	//Add New or Update

	    if(isset($_GET['opid'])){

		$this->tt_cptc_update_option_values($_POST['tt_cptc_create_'.$object_type.'_options'], $_GET['opid']);
	    }
	    if(get_option('tt_cptc_unique_counter')==true && ($_GET['sub']=='anpt' or $_GET['sub']=='antt' ) ){

		$opid = get_option('tt_cptc_unique_counter');
		update_option('tt_cptc_unique_counter', ++$opid);
	    }
	}elseif (isset($_GET['sub'])&& ($_GET['sub']=='ept' or $_GET['sub']=='ett')){				//Edit

	    $opt = get_option('tt_cptc_create_'.$object_type.'_options');
	    $edit_array = $opt['tt_cptc_create_'.$object_type.'_option_'.$_GET['opid']];

	}elseif (isset($_GET['sub'])&& ($_GET['sub']=='dpt' or $_GET['sub']=='dtt' )){				//Delete 

	    $temp_array = get_option('tt_cptc_create_'.$object_type.'_options');    
	    if(sizeof($temp_array)== 1){
		delete_option('tt_cptc_create_'.$object_type.'_options');
	    }
	    else{
		unset( $temp_array['tt_cptc_create_'.$object_type.'_option_'.$_GET['opid']] );
		update_option( 'tt_cptc_create_'.$object_type.'_options', $temp_array );
	    }
	}
    }

    public function tt_cptc_update_option_values($option_data,$id){
	global $object_type, $create_array;
 
	if($this->tt_cptc_validate_input_fields($option_data, $id )){

	    $option_data['tt-cptc_'.$object_type.'_id'] = $id; 
	    if(get_option('tt_cptc_create_'.$object_type.'_options')==false){
		
		$new_option['tt_cptc_create_'.$object_type.'_option_'.$id] = $option_data;
		add_option('tt_cptc_create_'.$object_type.'_options', $new_option );
	    }else{
		$existing_option = get_option('tt_cptc_create_'.$object_type.'_options');
		
		$existing_option['tt_cptc_create_'.$object_type.'_option_'.$id] = $option_data;
		update_option('tt_cptc_create_'.$object_type.'_options', $existing_option);
	    }
	}else{

	}
    }
    
    public function tt_cptc_validate_input_fields($option_data, $id){
	
	global $error_msg, $object_type;
	$check_array = array();
	$array1 = array();
	$array2 = array();
	
	if ($object_type == 'posttype' ){$length = 20;} else {$length = 32;}

	$reserver_words = array('post', 'page', 'attachment', 'reviosion', 'nav_menu_item', 'action', 'order', 'theme');
	$used_words = array();
	
	
	if(get_option('tt_cptc_create_posttype_options')==true){
	    $array1  = get_option('tt_cptc_create_posttype_options');
	    foreach($array1 as $item){
		    array_push($used_words, $item['tt_cptc_txt_create_posttype_typename']);    
	    }
	}
	
	if(get_option('tt_cptc_create_taxonomy_options')==true){
	    $array2 = get_option('tt_cptc_create_taxonomy_options');
	    foreach($array2 as $item){
		    array_push($used_words, $item['tt_cptc_txt_create_taxonomy_typename']);    
	    }
	}

	$check_array = array_merge($array1, $array2);
	
	    //echo "<pre>";
	    //print_r($check_array);
	    //echo "</pre>";
	
	$error_msg = "";
	if(preg_match("/[A-Z]/", $option_data['tt_cptc_txt_create_'.$object_type.'_typename'])){	$error_msg .= __('Post Type Name Cannot Contain Capital Letters')."<br>";}
	if(strpos($option_data['tt_cptc_txt_create_'.$object_type.'_typename'], " ")){			$error_msg .= "Post Type Name Cannot Contain Spaces.<br>";}    
	if(strlen($option_data['tt_cptc_txt_create_'.$object_type.'_typename'])> $length){		$error_msg .= "Post Type Name Cannot be more than ".$length." characters. <br>";}
	if(in_array($option_data['tt_cptc_txt_create_'.$object_type.'_typename'], $reserver_words)){	$error_msg .= "'".$option_data['tt_cptc_txt_create_'.$object_type.'_typename']."' is a reserverd word and cannot be used.<br>";}
	if(in_array($option_data['tt_cptc_txt_create_'.$object_type.'_typename'], $used_words)  ){
	    
	    $edit_mode = false;
	    foreach($check_array as $item){
		if($item['tt-cptc_'.$object_type.'_id'] == $id){
		    if($item['tt_cptc_txt_create_'.$object_type.'_typename'] == $option_data['tt_cptc_txt_create_'.$object_type.'_typename']){
			$edit_mode = true;
		    }    
		}
	    }
	    if(!$edit_mode){
		$error_msg .= "'".$option_data['tt_cptc_txt_create_'.$object_type.'_typename']."' is already used and cannot be used.<br>";
	    }
	}
	if(strlen($error_msg)>0){
	    echo $error_msg;
	    return false;
	}else{
	    return true; 	    
	}
    }    
    
    public function tt_cptc_create_custom_posttype(){
	global $wp_rewrite;
	if(get_option('tt_cptc_create_posttype_options')==true){
	    $option_data = get_option('tt_cptc_create_posttype_options');
	    

	    
	    
	    foreach($option_data as $item){
		
		$post_type = $item['tt_cptc_txt_create_posttype_typename'];
		
		$labels = array(
			'name'               => (isset($item['tt_cptc_txt_create_posttype_plurallabel']) && $item['tt_cptc_txt_create_posttype_plurallabel']!='') ? _x( $item['tt_cptc_txt_create_posttype_plurallabel'], 'post type plural name', 'tt_cptc_text_domain' ) : null,
			'singular_name'      => (isset($item['tt_cptc_txt_create_posttype_singularlabel']) && $item['tt_cptc_txt_create_posttype_singularlabel']!='') ? _x( $item['tt_cptc_txt_create_posttype_singularlabel'], 'post type singular name', 'tt_cptc_text_domain' ) : null,
			'menu_name'          => (isset($item['tt_cptc_txt_create_posttype_menuname'])&& $item['tt_cptc_txt_create_posttype_menuname']!='') ? _x( $item['tt_cptc_txt_create_posttype_menuname'], 'admin menu', 'tt_cptc_text_domain' ) : _x( $item['tt_cptc_txt_create_posttype_plurallabel'], 'post type menu name', 'tt_cptc_text_domain' ),
			'name_admin_bar'     => (isset($item['tt_cptc_txt_create_posttype_singularlabel']) && $item['tt_cptc_txt_create_posttype_singularlabel']!='') ? _x( $item['tt_cptc_txt_create_posttype_singularlabel'], 'add new on admin bar', 'tt_cptc_text_domain' ) : null,
			'add_new'            => (isset($item['tt_cptc_txt_create_posttype_addnew']) && $item['tt_cptc_txt_create_posttype_addnew']!='') ? _x( $item['tt_cptc_txt_create_posttype_addnew'], 'Book', 'tt_cptc_text_domain' ) : _x('Add New','','tt_cptc_text_domain'),
			'add_new_item'       => (isset($item['tt_cptc_txt_create_posttype_addnewitem']) && $item['tt_cptc_txt_create_posttype_addnewitem']!='') ? __( $item['tt_cptc_txt_create_posttype_addnewitem'], 'tt_cptc_text_domain' ) : _x('Add New','','tt_cptc_text_domain'),
			'new_item'           => (isset($item['tt_cptc_txt_create_posttype_newitem']) && $item['tt_cptc_txt_create_posttype_newitem']!='') ? __( $item['tt_cptc_txt_create_posttype_newitem'], 'tt_cptc_text_domain' ) : _x('New '.$item['tt_cptc_txt_create_posttype_singularlabel'],'','tt_cptc_text_domain'),
			'edit_item'          => (isset($item['tt_cptc_txt_create_posttype_edititem'])&& $item['tt_cptc_txt_create_posttype_edititem']!='') ? __( $item['tt_cptc_txt_create_posttype_edititem'], 'tt_cptc_text_domain' ) : _x('Edit '.$item['tt_cptc_txt_create_posttype_singularlabel'],'','tt_cptc_text_domain'),
			'view_item'          => (isset($item['tt_cptc_txt_create_posttype_viewitem']) && $item['tt_cptc_txt_create_posttype_viewitem']!='') ? __( $item['tt_cptc_txt_create_posttype_viewitem'], 'tt_cptc_text_domain' ) : _x('View '.$item['tt_cptc_txt_create_posttype_singularlabel'],'','tt_cptc_text_domain'),
			'all_items'          => (isset($item['tt_cptc_txt_create_posttype_allitems']) && $item['tt_cptc_txt_create_posttype_allitems']!='') ? __( $item['tt_cptc_txt_create_posttype_allitems'], 'tt_cptc_text_domain' ) : _x('All '.$item['tt_cptc_txt_create_posttype_plurallabel'], 'All Post type items','tt_cptc_text_domain' ),
			'search_items'       => (isset($item['tt_cptc_txt_create_posttype_searchitem']) && $item['tt_cptc_txt_create_posttype_searchitem']!='') ? __( $item['tt_cptc_txt_create_posttype_searchitem'], 'tt_cptc_text_domain' ) : _x('Search '.$item['tt_cptc_txt_create_posttype_plurallabel'],'','tt_cptc_text_domain'),
			'parent_item_colon'  => (isset($item['tt_cptc_txt_create_posttype_parentitemcolon']) && $item['tt_cptc_txt_create_posttype_parentitemcolon']!='') ? __( $item['tt_cptc_txt_create_posttype_parentitemcolon'], 'tt_cptc_text_domain' ) : _x('Parent Page', '', 'tt_cptc_text_domain'),
			'not_found'          => (isset($item['tt_cptc_txt_create_posttype_notfound']) && $item['tt_cptc_txt_create_posttype_notfound'] !='') ? __( $item['tt_cptc_txt_create_posttype_notfound'], 'tt_cptc_text_domain' ) : _x('No '.$item['tt_cptc_txt_create_posttype_plurallabel'].' Found','','tt_cptc_text_domain'),
			'not_found_in_trash' => (isset($item['tt_cptc_txt_create_posttype_notfoundintrash']) && $item['tt_cptc_txt_create_posttype_notfoundintrash']!='') ? __( $item['tt_cptc_txt_create_posttype_notfoundintrash'], 'tt_cptc_text_domain' ) : _x('No '.$item['tt_cptc_txt_create_posttype_plurallabel'].' Found in Trash','','tt_cptc_text_domain')
		);
		
		$supports = array();
		if($item['tt_cptc_chk_create_posttype_support_title']=='on'){array_push($supports, 'title');}
		if($item['tt_cptc_chk_create_posttype_support_editor']=='on'){array_push($supports, 'editor');}
		if($item['tt_cptc_chk_create_posttype_support_author']=='on'){array_push($supports, 'author');}
		if($item['tt_cptc_chk_create_posttype_support_thumbnail']=='on'){array_push($supports, 'thumbnail');}
		if($item['tt_cptc_chk_create_posttype_support_excerpt']=='on'){array_push($supports, 'excerpt');}
		if($item['tt_cptc_chk_create_posttype_support_trackbacks']=='on'){array_push($supports, 'trackbacks');}
		if($item['tt_cptc_chk_create_posttype_support_custom_fields']=='on'){array_push($supports, 'custom-fields');}
		if($item['tt_cptc_chk_create_posttype_support_comments']=='on'){array_push($supports, 'comments');}
		if($item['tt_cptc_chk_create_posttype_support_revisions']=='on'){array_push($supports, 'revisions');}
		if($item['tt_cptc_chk_create_posttype_support_page_attributes']=='on'){array_push($supports, 'page-attributes');}
		if($item['tt_cptc_chk_create_posttype_support_post_formats']=='on'){array_push($supports, 'post-formats');}
		
		$taxonomies = array();
		if($item['tt_cptc_chk_create_posttype_taxonomy_post_tag']=='on'){array_push($taxonomies, 'post_tag');}
		if($item['tt_cptc_chk_create_posttype_taxonomy_category']=='on'){array_push($taxonomies, 'category');}
			
		$args = array(
			'label'		     => isset($item['tt_cptc_txt_create_posttype_plurallabel']) ? _x( $item['tt_cptc_txt_create_posttype_plurallabel'], 'post type plural name', 'tt_cptc_text_domain' ) : '',	
			'labels'             => $labels,
			'description'        => (isset($item['tt_cptc_txta_create_posttype_description']) && $item['tt_cptc_txta_create_posttype_description']!='') ? __( $item['tt_cptc_txta_create_posttype_description'], 'tt_cptc_text_domain' ) : '',   		
			'public'             => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_public']),
			'publicly_queryable' => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_publiclyqueryable']),
			'show_ui'            => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_showui']),
			'show_in_menu'       => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_showinmenu']),
			'show_in_nav_menus'  => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_showinnavmenu']),
			'show_in_admin_bar'  => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_showinadminbar']),
			'query_var'          => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_queryvar']),
			'rewrite'            => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_rewrite']),//array( 'slug' => 'book' ) //$post_type value,
			'capability_type'    => $item['tt_cptc_drp_create_posttype_capabilitytype'],
			'has_archive'        => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_hasarchive']),
			'hierarchical'       => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_hierarchical']),
			'exclude_from_search'=> $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_excludefromsearch']),
			'menu_position'      => (int)$item['tt_cptc_drp_create_posttype_menuposition'],
			'menu_icon'	     => isset($item['tt_cptc_txt_create_posttype_icon']) && $item['tt_cptc_txt_create_posttype_icon'] !='' ? esc_attr($item['tt_cptc_txt_create_posttype_icon']) : null,
			'supports'           => $supports,
			'taxonomies'	     => $taxonomies,
			'can_export'	     => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_posttype_canexport'])
			);
		register_post_type( $post_type, $args );
	    }
	    $wp_rewrite->flush_rules();
	}
    }
    
    
    public function tt_cptc_get_boolean_value($boolstr){
	if($boolstr == 'true'){return true;}
	else{return false;}
    }
    
    public function tt_cptc_get_objecttype(){
	$objecttype_array = array('tt_cptc_chk_create_taxonomy_object_type_post', 'tt_cptc_chk_create_taxonomy_object_type_page');
	if(get_option('tt_cptc_create_posttype_options')==true){
	    $option_data = get_option('tt_cptc_create_posttype_options');
	    foreach($option_data as $item){
		array_push($objecttype_array, 'tt_cptc_chk_create_taxonomy_object_type_posttype_'.$item['tt-cptc_posttype_id']);
	    }
	}
	return $objecttype_array;
    }
    
    public function tt_cptc_create_custom_taxonomy(){
	global $wp_rewrite;
	
	$objecttype_array = $this->tt_cptc_get_objecttype();
	
	if(get_option('tt_cptc_create_taxonomy_options')==true){
	    $option_data = get_option('tt_cptc_create_taxonomy_options');
	    foreach($option_data as $item){
		
		$taxonomy = $item['tt_cptc_txt_create_taxonomy_typename'];
		
		$labels = array(
			'name'                       => (isset($item['tt_cptc_txt_create_taxonomy_plurallabel']) && $item['tt_cptc_txt_create_taxonomy_plurallabel']!='') ? _x( $item['tt_cptc_txt_create_taxonomy_plurallabel'], 'post type plural name', 'tt_cptc_text_domain' ) : null,
			'singular_name'              => (isset($item['tt_cptc_txt_create_taxonomy_singularlabel']) && $item['tt_cptc_txt_create_taxonomy_singularlabel']!='') ? _x( $item['tt_cptc_txt_create_taxonomy_singularlabel'], 'post type singular name', 'tt_cptc_text_domain' ) : null,
			'menu_name'                  => (isset($item['tt_cptc_txt_create_taxonomy_menuname'])&& $item['tt_cptc_txt_create_taxonomy_menuname']!='') ? _x( $item['tt_cptc_txt_create_taxonomy_menuname'], 'admin menu', 'tt_cptc_text_domain' ) : _x( $item['tt_cptc_txt_create_taxonomy_plurallabel'], 'post type menu name', 'tt_cptc_text_domain' ),
			'all_items'                  => (isset($item['tt_cptc_txt_create_taxonomy_allitems']) && $item['tt_cptc_txt_create_taxonomy_allitems']!='') ? __( $item['tt_cptc_txt_create_taxonomy_allitems'], 'tt_cptc_text_domain' ) : _x('All '.$item['tt_cptc_txt_create_taxonomy_plurallabel'], 'All Post type items','tt_cptc_text_domain' ),
			'edit_item'                  => (isset($item['tt_cptc_txt_create_taxonomy_edititem'])&& $item['tt_cptc_txt_create_taxonomy_edititem']!='') ? __( $item['tt_cptc_txt_create_taxonomy_edititem'], 'tt_cptc_text_domain' ) : _x('Edit '.$item['tt_cptc_txt_create_taxonomy_singularlabel'],'','tt_cptc_text_domain'),
			'view_item'                  => (isset($item['tt_cptc_txt_create_taxonomy_viewitem']) && $item['tt_cptc_txt_create_taxonomy_viewitem']!='') ? __( $item['tt_cptc_txt_create_taxonomy_viewitem'], 'tt_cptc_text_domain' ) : _x('View '.$item['tt_cptc_txt_create_taxonomy_singularlabel'],'','tt_cptc_text_domain'),
			'update_item'                => (isset($item['tt_cptc_txt_create_taxonomy_updateitem']) && $item['tt_cptc_txt_create_taxonomy_updateitem']!='') ? __( $item['tt_cptc_txt_create_taxonomy_updateitem'], 'tt_cptc_text_domain' ) : _x('Update '.$item['tt_cptc_txt_create_taxonomy_singularlabel'],'','tt_cptc_text_domain'),
			'add_new_item'               => (isset($item['tt_cptc_txt_create_taxonomy_addnewitem']) && $item['tt_cptc_txt_create_taxonomy_addnewitem']!='') ? __( $item['tt_cptc_txt_create_taxonomy_addnewitem'], 'tt_cptc_text_domain' ) : _x('Add New '.$item['tt_cptc_txt_create_taxonomy_singularlabel'],'','tt_cptc_text_domain'),
			'new_item_name'	             => (isset($item['tt_cptc_txt_create_taxonomy_newitemname']) && $item['tt_cptc_txt_create_taxonomy_newitemname']!='') ? __( $item['tt_cptc_txt_create_taxonomy_newitemname'], 'tt_cptc_text_domain' ) : _x('New '.$item['tt_cptc_txt_create_taxonomy_singularlabel'].' Name','','tt_cptc_text_domain'),
			'parent_item'	             => (isset($item['tt_cptc_txt_create_taxonomy_parentitem']) && $item['tt_cptc_txt_create_taxonomy_parentitem']!='') ? __( $item['tt_cptc_txt_create_taxonomy_parentitem'], 'tt_cptc_text_domain' ) : _x('Parent '.$item['tt_cptc_txt_create_taxonomy_singularlabel'],'','tt_cptc_text_domain'),
			'parent_item_colon'  	     => (isset($item['tt_cptc_txt_create_taxonomy_parentitemcolon']) && $item['tt_cptc_txt_create_taxonomy_parentitemcolon']!='') ? __( $item['tt_cptc_txt_create_taxonomy_parentitemcolon'], 'tt_cptc_text_domain' ) : _x('Parent Page', '', 'tt_cptc_text_domain'),
			'search_items'       	     => (isset($item['tt_cptc_txt_create_taxonomy_searchitems']) && $item['tt_cptc_txt_create_taxonomy_searchitems']!='') ? __( $item['tt_cptc_txt_create_taxonomy_searchitems'], 'tt_cptc_text_domain' ) : _x('Search '.$item['tt_cptc_txt_create_taxonomy_plurallabel'],'','tt_cptc_text_domain'),
			'popular_items'      	     => (isset($item['tt_cptc_txt_create_taxonomy_popularitems']) && $item['tt_cptc_txt_create_taxonomy_popularitems']!='') ? __( $item['tt_cptc_txt_create_taxonomy_popularitems'], 'tt_cptc_text_domain' ) : _x('Popular '.$item['tt_cptc_txt_create_taxonomy_plurallabel'],'','tt_cptc_text_domain'),
			'seperate_items_with_commas' => (isset($item['tt_cptc_txt_create_taxonomy_seperateitemswithcommas']) && $item['tt_cptc_txt_create_taxonomy_seperateitemswithcommas']!='') ? __( $item['tt_cptc_txt_create_taxonomy_seperateitemswithcommas'], 'tt_cptc_text_domain' ) : _x('Seperate '.$item['tt_cptc_txt_create_taxonomy_plurallabel']. ' With Commas','','tt_cptc_text_domain'),
			'add_or_remove_items'        => (isset($item['tt_cptc_txt_create_taxonomy_addorremoveitems']) && $item['tt_cptc_txt_create_taxonomy_addorremoveitems']!='') ? __( $item['tt_cptc_txt_create_taxonomy_addorremoveitems'], 'tt_cptc_text_domain' ) : _x('Add or Remove '.$item['tt_cptc_txt_create_taxonomy_plurallabel'],'','tt_cptc_text_domain'),
			'choose_from_most_used'      => (isset($item['tt_cptc_txt_create_taxonomy_choosefrommostused']) && $item['tt_cptc_txt_create_taxonomy_choosefrommostused']!='') ? _x( $item['tt_cptc_txt_create_taxonomy_choosefrommostused'], 'add new on admin bar', 'tt_cptc_text_domain' ) : _x('Choose From MOst Used '.$item['tt_cptc_txt_create_taxonomy_plurallabel'],'','tt_cptc_text_domain'),
			'not_found'                  => (isset($item['tt_cptc_txt_create_taxonomy_notfound']) && $item['tt_cptc_txt_create_taxonomy_notfound'] !='') ? __( $item['tt_cptc_txt_create_taxonomy_notfound'], 'tt_cptc_text_domain' ) : _x('No '.$item['tt_cptc_txt_create_taxonomy_plurallabel'].' Found','','tt_cptc_text_domain')
		);
		
		$capabilities = array();
		if($item['tt_cptc_chk_create_taxonomy_capabilities_manageterms']=='on'){array_push($capabilities, 'manage_terms');}
		if($item['tt_cptc_chk_create_taxonomy_capabilities_editterms']=='on'){array_push($capabilities, 'edit_terms');}
		if($item['tt_cptc_chk_create_taxonomy_capabilities_deleteterms']=='on'){array_push($capabilities, 'delete_terms');}
		if($item['tt_cptc_chk_create_taxonomy_capabilities_assignterms']=='on'){array_push($capabilities, 'assign_terms');}
		
		
		$object_type = array();
		foreach($objecttype_array as $ot){
		    $label = substr($ot, 40, strlen($ot));
		    if($item[$ot] == 'on'){array_push($object_type, $this->tt_cptc_generate_label($label));}
		}

		$args = array(
			'label'		     => isset($item['tt_cptc_txt_create_taxonomy_plurallabel']) ? _x( $item['tt_cptc_txt_create_taxonomy_plurallabel'], 'post type plural name', 'tt_cptc_text_domain' ) : '',	
			'labels'             => $labels,
			'public'             => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_public']),
			'show_ui'            => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_showui']),
			'show_in_nav_menus'  => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_showinnavmenu']),
			'show_tagcloud'      => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_showtagcloud']),
			'show_admin_column'  => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_showadmincolumn']),
			'hierarchical'       => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_hierarchical']),
			'query_var'          => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_queryvar']),
			'rewrite'            => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_rewrite']),//array( 'slug' => 'book' ) //$taxonomy value,
			'capabilities'       => $capabilities,
			'sort'		     => $this->tt_cptc_get_boolean_value($item['tt_cptc_drp_create_taxonomy_sort'])
			);
		register_taxonomy( $taxonomy, $object_type, $args );
	    }
	    $wp_rewrite->flush_rules();
	}
    }
    
    public function tt_cptc_load_scripts_and_styles(){
	require_once('tt-initialize-input-fields.php');
	require_once('templates/tt-cptc-posttype-manage-templates.php');
	require_once('templates/tt-cptc-taxonomy-manage-templates.php');
	require_once('templates/tt-cptc-posttype-manage-templates.php');
	require_once('templates/tt-cptc-guide-templates.php');
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'wp-lists' );
	wp_enqueue_script( 'postbox' );
	wp_enqueue_style('ttcptc-style', plugins_url('tt-cptc-style.css',__FILE__));
	wp_enqueue_script('tt-cptc-scripts', plugins_url('js/tt-cptc-scripts.js',__FILE__));
    }
	
    public function tt_cptc_add_settings_menu() {
	global $create_posttype_menu_page, $create_taxonomy_menu_page, $manage_posttype_menu_page, $manage_taxonomy_menu_page;
	
	/*add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );*/
	$main_menu_page = add_menu_page( __('TT Custom Post Type Creator', 'tt_cptc_text_domain'), __('TT-CPTC', 'tt_cptc_text_domain'), 'manage_options', 'tt-cptc-main-menu', array($this,'tt_cptc_main_menu_page_fn') );
	
       /*add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );*/
	add_submenu_page( 'tt-cptc-main-menu', __('Guide', 'tt_cptc_text_domain'), 'Guide', 'manage_options', 'tt-cptc-main-menu', array($this,'tt_cptc_main_menu_page_fn') );
	
	$create_posttype_menu_page = add_submenu_page( __('tt-cptc-main-menu', 'tt_cptc_text_domain'), __('Create Post Type ', 'tt_cptc_text_domain'), 'Create Post Type', 'manage_options', 'tt-cptc-menu-create_posttype', array($this,'tt_cptc_create_menu_page_fn') );
	if($create_posttype_menu_page){
	    add_action( 'load-' . $create_posttype_menu_page, array($this, 'tt_cptc_create_posttype_add_metaboxes') );
	}
	$manage_posttype_menu_page = add_submenu_page( 'tt-cptc-main-menu', __('Manage Post Types', 'tt_cptc_text_domain'), 'Manage Post Type', 'manage_options', 'tt-cptc-menu-manage-posttype', array($this,'tt_cptc_manage_posttype_menu_page_fn') );
	
	$create_taxonomy_menu_page = add_submenu_page( 'tt-cptc-main-menu', __('TT Custom Post Type Creator Sub Menu Page 2', 'tt_cptc_text_domain'), 'Create Taxonomy', 'manage_options', 'tt-cptc-menu-create_taxonomy', array($this,'tt_cptc_create_menu_page_fn') );
	if($create_taxonomy_menu_page){
	    add_action( 'load-' . $create_taxonomy_menu_page, array($this, 'tt_cptc_create_taxonomy_add_metaboxes') );
	}
	
	
	$manage_taxonomy_menu_page = add_submenu_page( 'tt-cptc-main-menu', __('Manage Taxonomies', 'tt_cptc_text_domain'), 'Manage Taxonomies', 'manage_options', 'tt-cptc-menu-manage-taxonomy', array($this,'tt_cptc_manage_taxonomy_menu_page_fn') );
    }
    
    public function tt_cptc_create_posttype_add_metaboxes(){
	global $create_posttype_menu_page;

	add_meta_box('tt_cptc_create_posttype_first_meta_box', 'Basic Settings', array($this,'tt_cptc_show_meta_box'), $create_posttype_menu_page, 'normal', 'core',
		     array('section' => 'basic', 'menu' => 'posttype') );
	add_meta_box('tt_cptc_create_posttype_second_meta_box', 'Advanced Label Options ', array($this,'tt_cptc_show_meta_box'), $create_posttype_menu_page, 'normal', 'core',
		     array('section' => 'adlabel', 'menu' => 'posttype') );
	add_meta_box('tt_cptc_create_posttype_third_meta_box', 'Advanced Options ', array($this,'tt_cptc_show_meta_box'), $create_posttype_menu_page, 'normal', 'core',
		     array('section' => 'advanced', 'menu' => 'posttype') );
	add_filter( "postbox_classes_{$create_posttype_menu_page}_tt_cptc_create_posttype_second_meta_box", array($this, 'tt_cptc_minify_my_metabox') );
	add_filter( "postbox_classes_{$create_posttype_menu_page}_tt_cptc_create_posttype_third_meta_box", array($this, 'tt_cptc_minify_my_metabox') );
    }
    
    public function tt_cptc_minify_my_metabox( $classes ) {
	array_push( $classes, 'closed' );
	return $classes;
    }
    
    public function tt_cptc_create_taxonomy_add_metaboxes(){
	global $create_taxonomy_menu_page;
	
	add_meta_box('tt_cptc_create_taxonomy_first_meta_box', 'Basic Settings', array($this,'tt_cptc_show_meta_box'), $create_taxonomy_menu_page, 'normal', 'core',
		     array('section' => 'basic', 'menu' => 'taxonomy') );
	add_meta_box('tt_cptc_create_taxonomy_second_meta_box', 'Advanced Label Options ', array($this,'tt_cptc_show_meta_box'), $create_taxonomy_menu_page, 'normal', 'core',
		     array('section' => 'adlabel', 'menu' => 'taxonomy') );
	add_meta_box('tt_cptc_create_taxonomy_third_meta_box', 'Advanced Options ', array($this,'tt_cptc_show_meta_box'), $create_taxonomy_menu_page, 'normal', 'core',
		     array('section' => 'advanced', 'menu' => 'taxonomy') );
	add_filter( "postbox_classes_{$create_taxonomy_menu_page}_tt_cptc_create_taxonomy_second_meta_box", array($this, 'tt_cptc_minify_my_metabox') );
	add_filter( "postbox_classes_{$create_taxonomy_menu_page}_tt_cptc_create_taxonomy_third_meta_box", array($this, 'tt_cptc_minify_my_metabox') );
    }
    
    public function tt_cptc_show_meta_box( $post, $metabox ){
	extract($metabox['args']);
	settings_fields( 'tt_cptc_create_'.$menu.'_options' ); // Registered settings option name for Create_posttype
	do_settings_sections( 'tt_cptc_create_'.$menu.'_settings_'.$section ); //Page name used is 'add_settings_field' function for create_posttype section 1'
    }
    
    public function tt_cptc_main_menu_page_fn(){
	echo tt_cptc_display_guide_page();
    }
    
    public function tt_cptc_create_menu_page_fn(){
	
	global $screen;
	$screen = get_current_screen();
	$page_type = substr($screen->id, 33, strlen($screen->id));
	$option = get_option('tt_cptc_create_'.$page_type.'_options');
	
	if(isset($_GET['sub'])&& ($_GET['sub']=='ept' or $_GET['sub']=='ett')){
	    switch($page_type){
		case 'posttype': $key = 'upt'; $id = $_GET['opid']; break;  
		case 'taxonomy': $key = 'utt'; $id = $_GET['opid']; break;
	    }
	}else{
	    switch($page_type){
		case 'posttype': $key = 'anpt'; $id = ''; break;  
		case 'taxonomy': $key = 'antt'; $id = ''; break;	
	    }
	}
	?>
	<div id="tt-general" class="wrap">
            <h1>
	    <?php
		switch($page_type){
		    case 'posttype': _e('Create Custom Post Type', 'tt_cptc_text_domain'); break;
		    case 'taxonomy': _e('Create Custom Taxonomy', 'tt_cptc_text_domain'); break;
		}    
	    ?>
	    </h1>
            <form name="tt_cptc_create_<?php echo $page_type; ?>_options_form" method="post" action="<?php echo $this->tt_cptc_get_url($key,$id,$screen->id);  ?>">
		<?php do_meta_boxes( $screen->id, 'normal', $option) ; ?> 
		<input type="submit" name="add_pt" value="Submit" class="button-primary" id="tt_cptc" />
            </form>
	</div>
	<?php   
    }
    

    public function tt_cptc_get_url($key, $id, $current_page){
	$opid = get_option('tt_cptc_unique_counter');
	if($key == 'anpt' or $key == 'antt'){
	    $url = "admin.php?page=".substr($current_page, 13, strlen($current_page))."&sub=".$key."&opid=".$opid;     
	}else{
	    $url = "admin.php?page=".substr($current_page, 13, strlen($current_page))."&sub=".$key."&opid=".$id;
	}
	return $url;
    }   
    
    public function tt_cptc_create_basic_callback(){
	echo "In order to create a post type you only need to complete this basic settings section. Post type name, Singular label and Plural label are the required fields. ";
    }
    public function tt_cptc_create_adlabel_callback(){
	echo "This section is optional. If you are not sure about the fields you can leave these fields blank and this plugin will generate labels automatically. ";
    }
    public function tt_cptc_create_advanced_callback(){
	echo "This section is for advanced users. All the fields in this section are set to default values which is enough to create a post type without any issue. If you are sure about the fields you can change the values. ";
    }
    
    public function tt_cptc_callback(){
	global $edit_array, $wp_post_types, $error_msg;

    }
    
    public function tt_cptc_display_check_box( $data = array() ) {
	extract ( $data );
	global $edit_array;
	
	if ($input_type=='multicheck'){
	    foreach ($multicheck as $item) {
		?>
		<div class="multi-check"><input type="checkbox" name="<?php echo "tt_cptc_".$menu."_options[".$item."]";  ?>"
	    	<?php
		    if(isset($_GET['sub']) && ($_GET['sub']=='ept' or $_GET['sub']=='ett')){
			if(isset($edit_array)){
			    switch($menu){
				case 'create_posttype': if (isset($edit_array[$item])) echo ' checked="checked" '; break;
				case 'create_taxonomy': if (isset($edit_array[$item])) echo ' checked="checked" '; break;
			    }
			} 
		    }else{
			if ($item=='tt_cptc_chk_create_posttype_support_title' or $item=='tt_cptc_chk_create_posttype_support_editor'){
			    echo ' checked="checked" ';
			}
		    }
		?>
		/>
		<label for="<?php echo "tt_cptc_".$menu."_options[".$item."]"; ?>"><?php
		$label = substr($item, strlen($name)+1, strlen($item));
		/*If there is any posttype already create it will be displayed as an option for taxonomy object_type and the following code in (if statement) is to display its name*/
		
		echo $this->tt_cptc_generate_label($label);
		?></label></div>
		<?php
	    }
	}else{
	?>
	    <input type="checkbox" name="<?php echo "tt_cptc_".$menu."_options[".$name."]";  ?>"
	    <?php
	    if(isset($edit_array)){
		switch($menu){
		    case 'create_posttype': if (isset($edit_array[$name])) echo ' checked="checked" '; break;
		    case 'create_taxonomy': if (isset($edit_array[$name])) echo ' checked="checked" '; break;
		}
	    }
	?>
	/> 
	<?php
	}
    }
    
    public function tt_cptc_generate_label($label){
	if(substr($label, 0,8)=='posttype'){
	    $id = (int)(substr($label, 9, strlen($label)));	
	    $option_data = get_option('tt_cptc_create_posttype_options');
	    foreach($option_data as $option){
		if($option['tt-cptc_posttype_id'] == $id){
		    return $option['tt_cptc_txt_create_posttype_typename']; 	
		}
	    }
	}else{
	    return $label;    
	}
    }
    
    public function tt_cptc_display_text_field( $data = array() ) {
	global $edit_array;
	extract( $data );
	?>
	<input type="<?php echo $input_type ?>" name="<?php echo "tt_cptc_".$menu."_options[".$name."]";?>" placeholder="<?php echo $place_holder; ?>" <?php if($required=='yes'){echo " required='required'";} ?> size="63"
		value="<?php
			if(isset($edit_array)){
			    switch($menu){
				case 'create_posttype': echo esc_html($edit_array[$name]); break;
				case 'create_taxonomy': echo esc_html($edit_array[$name]); break;
			    }
			}else{
			    echo '';
			}
			?>"/><br />
	<?php
    }
    
    public function tt_cptc_display_dropdown( $data = array() ) {
	extract($data);
	global $edit_array;
	switch($input_type){
	    case 'truefalse': $drp_array = array('true', 'false' ); break;
	    case 'falsetrue': $drp_array = array('false', 'true'); break;
	    case 'postpage': $drp_array = array('post', 'page'); break;
	    case 'menuposition': $drp_array = array('null','5 - Below Posts','10 - Below Media','15 - Below Links','20 - Below Pages','25 - Below Comments','60 - Below First Seperator','65 - Below Plugins','70 - Below Users','75 - Below Tools','80 - Below Settings','100 - Below Second Seperator'); break;
	}
	?>
	<select name="<?php echo "tt_cptc_".$menu."_options[".$name."]";?>" >
	    <?php
	    
	    foreach($drp_array as $drp_item){ 
		?>
		<option value="<?php if($input_type=='menuposition'){echo substr($drp_item, 0, strpos($drp_item, " "));}else{ echo $drp_item; } ?>"
		<?php
		if(isset($edit_array)){
		    switch($menu){
			    case 'create_posttype': {
						    if($input_type=='menuposition'){
							echo selected( $edit_array[$name], substr($drp_item, 0, strpos($drp_item, " ")) );
						    }else{
							echo selected( $edit_array[$name], $drp_item );
						    }
						    break;
						    }
			    case 'create_taxonomy': echo selected( $edit_array[$name], $drp_item ); break;
		    }
		}
		?>
		>
		<?php echo $drp_item; ?>
		</option>			    
	    <?php
	    }
	    ?>
	</select>
	<?php
    }
    
    public function tt_cptc_display_text_area( $data = array() ){
	extract( $data );
	global $edit_array;
	?>
	<textarea rows="5" cols="63" maxlength="5000" name="<?php echo "tt_cptc_".$menu."_options[".$name."]";?>" placeholder="<?php echo $place_holder; ?>" ><?php
	if(isset($edit_array)){
	    switch($menu){
		    case 'create_posttype': echo esc_html($edit_array[$name]); break;
		    case 'create_taxonomy': echo esc_html($edit_array[$name]); break;
	    }
	}?></textarea>
	<?php
    }
}

add_action( 'init', 'tt_cptc_plugin_init' );

function tt_cptc_plugin_init() {
    global $ttcptcObj;
    $ttcptcObj = new TT_CPTC_Class();
    //$ttcptcObj->tt_cptc_create_custom_posttype();
    //$ttcptcObj->tt_cptc_create_custom_taxonomy();
}
?>