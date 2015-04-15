<?php



function tt_load_field_details(){

/*===== This section of code is to dynamically create variable for taxonomy object_type. If there is any posttype already created it will be on the list*/
global $ttcptcObj;

$objecttype_array = $ttcptcObj->tt_cptc_get_objecttype();
/*$objecttype_array = array('tt_cptc_chk_create_taxonomy_object_type_post', 'tt_cptc_chk_create_taxonomy_object_type_page');
if(get_option('tt_cptc_create_posttype_options')==true){
    $option_data = get_option('tt_cptc_create_posttype_options');
    foreach($option_data as $item){
        array_push($objecttype_array, 'tt_cptc_chk_create_taxonomy_object_type_posttype_'.$item['tt-cptc_posttype_id']);
    }
}*/    
/*==========================================================================================================================================================*/
$input_fields = array(
                        /*Create Post Type Basic Sttings Field*/
                        
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_typename',
                            'title' => __('Post Type Name:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('Custom post type name which will be used to content of that post type. Max 20 characters, cannot contain capital letters, hyphens or spaces. Reserved post types: post, page, attachment, revision, nav_menu_item','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_basic',
                            'section' => 'tt_cptc_create_posttype_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. book',
                            'menu' => 'create_posttype',
                            'required' => 'yes'
                        ),
                        array(
                            'id' => 'tt_cptc_txta_create_posttype_description',
                            'title' => __('Description:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('Short description of the post type that describes what this post type is used for','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_area',
                            'page' => 'tt_cptc_create_posttype_settings_basic',
                            'section' => 'tt_cptc_create_posttype_basic',
                            'input_type' => 'area',
                            'place_holder_text' => 'Type Your Content',
                            'menu' => 'create_posttype',
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_singularlabel',
                            'title' => __('Singular Label:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('Post type singular label used in wordpress when a singular label is needed','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_basic',
                            'section' => 'tt_cptc_create_posttype_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Book',
                            'menu' => 'create_posttype',
                            'required' => 'yes'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_plurallabel',
                            'title' => __('Plural Label:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('A plural label for the post type','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_basic',
                            'section' => 'tt_cptc_create_posttype_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Books',
                            'menu' => 'create_posttype',
                            'required' => 'yes'
                        ),

                        
                        //=============================================================//
                        /*Create Post Type Advanced Label Settings Field*/
                        
                         array(
                            'id' => 'tt_cptc_txt_create_posttype_menuname',
                            'title' => __('Menu Name:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('The menu name text. This string is the name to give menu items. Defaults to value of <Plural Label>','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. My Books',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_addnew',
                            'title' => __('Add New:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the add new text. The default is \'Add New\' for both hierarchical and non-hierarchical post types','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Add New',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_addnewitem',
                            'title' => __('Add New Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('The add new item text. Default is Add New Post/Add New Page','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Add New Book',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_edititem',
                            'title' => __('Edit Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('The edit item text. In the UI, this label is used as the main header on the post\'s editing panel. Default is \'Edit Post\' for non-hierarchical and \'Edit Page\' for hierarchical post types','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Edit Book',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_newitem',
                            'title' => __('New Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('The new item text. Default is \'New Post\' for non-hierarchical and \'New Page\' for hierarchical post types', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. New Book',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_viewitem',
                            'title' => __('View Item:', 'tt_cptc_text_domain') .
                                    ' <a href="#" id="info" title="'. __('The view item text. Default is View Post/View Page','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. View Book',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_allitems',
                            'title' => __('All Items:', 'tt_cptc_text_domain') .
                                    ' <a href="#" id="info" title="'. __('the all items text used in the menu. Default is the value of \'name\'','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. All Books',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_searchitem',
                            'title' => __('Search Item:', 'tt_cptc_text_domain') .
                                    ' <a href="#" id="info" title="'. __('The search items text. Default is Search Posts/Search Pages', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Search Books',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_notfound',
                            'title' => __('Not Found:', 'tt_cptc_text_domain') .
                                    ' <a href="#" id="info" title="'. __('The not found text. Default is No posts found/No pages found', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. No Books Found',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_notfoundintrash',
                            'title' => __('Not Found in Trash:', 'tt_cptc_text_domain') .
                                    ' <a href="#" id="info" title="'. __('The not found in trash text. Default is No posts found in Trash/No pages found in Trash','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. No Books Found in Trash',
                            'menu' => 'create_posttype'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_parentitemcolon',
                            'title' => __('Parent Item Colon:', 'tt_cptc_text_domain') .
                                         ' <a href="#" id="info" title="' . __("The parent text. This string is used only in hierarchical post types. Default is 'Parent Page'", "tt_cptc_text_domain").'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_adlabel',
                            'section' => 'tt_cptc_create_posttype_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Parent Book',
                            'menu' => 'create_posttype'
                        ),
                        
                        //========================================================================================================//
                        /*Create Post Type Advanced Settings Fields */

                        array(
                            'id' => 'tt_cptc_drp_create_posttype_public',
                            'title' => __('Public', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers (exclude_from_search, publicly_queryable)', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_showui',
                            'title' => __('Show UI', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('Whether to generate a default UI for managing this post type in the admin', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_showinnavmenu',
                            'title' => __('Show in Nav Menu', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('Whether post_type is available for selection in navigation menus', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_showinmenu',
                            'title' => __('Show in Menu', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Where to show the post type in the admin menu. show_ui must be true', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_excludefromsearch',
                            'title' => __('Exclude From Search', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether to exclude posts with this post type from front end search results', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_publiclyqueryable',
                            'title' => __('Publicly Queryable', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether queries can be performed on the front end as part of parse_request()', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_showinadminbar',
                            'title' => __('Show in Admin Bar', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether to make this post type available in the WordPress admin bar', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_hasarchive',
                            'title' => __('Has Archive', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Enables post type archives. Will use $post_type as archive slug by default', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype' 
                        ),
                        
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_hierarchical',
                            'title' => __('Hierarchical', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The \'supports\' parameter should contain \'page-attributes\' to show the parent select box on the editor page', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_capabilitytype',
                            'title' => __('Capability Type', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('The string to use to build the read, edit, and delete capabilities', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'postpage',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_rewrite',
                            'title' => __('Rewrite', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Triggers the handling of rewrites for this post type. To prevent rewrites, set to false', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_queryvar',
                            'title' => __('Query Var', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Sets the query_var key for this post type', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_canexport',
                            'title' => __('Can Export', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Can this post_type be exported', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_posttype_menuposition',
                            'title' => __('Menu Position', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('The position in the menu order the post type should appear. show_in_menu must be true', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'menuposition',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype'   
                        ),

                        array(
                            'id' => 'tt_cptc_chk_create_posttype_support',
                            'title' => __('Support', 'tt_cptc_text_domain') . ' <a href="#" id="info" title="'.__('An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior.', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_check_box',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'multicheck',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype',
                            'multicheck' => array(
                                                  'tt_cptc_chk_create_posttype_support_title',
                                                  'tt_cptc_chk_create_posttype_support_editor',
                                                  'tt_cptc_chk_create_posttype_support_author',
                                                  'tt_cptc_chk_create_posttype_support_thumbnail',
                                                  'tt_cptc_chk_create_posttype_support_excerpt',
                                                  'tt_cptc_chk_create_posttype_support_trackbacks',
                                                  'tt_cptc_chk_create_posttype_support_custom_fields',
                                                  'tt_cptc_chk_create_posttype_support_comments',
                                                  'tt_cptc_chk_create_posttype_support_revisions',
                                                  'tt_cptc_chk_create_posttype_support_page_attributes',
                                                  'tt_cptc_chk_create_posttype_support_post_formats'
                                                )
                        ),
                        array(
                            'id' => 'tt_cptc_chk_create_posttype_taxonomy',
                            'title' => __('Taxonomies', 'tt_cptc_text_domain') . ' <a href="#" id="info" title="'.__('An array of registered taxonomies like category or post_tag that will be used with this post type','tt_cptc_text_domain', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_check_box',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'multicheck',
                            'place_holder_text' => '',
                            'menu' => 'create_posttype',
                            'multicheck' => array(
                                                  'tt_cptc_chk_create_posttype_taxonomy_category',
                                                  'tt_cptc_chk_create_posttype_taxonomy_post_tag'
                                                )
                        ),
                       
                        array(
                            'id' => 'tt_cptc_txt_create_posttype_icon',
                            'title' => __('Icon:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('The url to the icon to be used for this menu or the name of the icon from the iconfont','tt_cptc_text_domain', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_posttype_settings_advanced',
                            'section' => 'tt_cptc_create_posttype_advanced',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. http://yourdomain.com/wp-content/uploads/2014/11/icon.png',
                            'menu' => 'create_posttype'
                        ),
                        
                        //===================================================================//
                                            
                                            /*Taxonomy Fields*/
                        /*Taxonomy Basic Settings*/
                        
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_typename',
                            'title' => __('Taxonomy Name:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('The name of the taxonomy. Name should only contain lowercase letters and the underscore character, and not be more than 32 characters long','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_basic',
                            'section' => 'tt_cptc_create_taxonomy_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. writer',
                            'menu' => 'create_taxonomy',
                            'required' => 'yes'
                        ),

                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_singularlabel',
                            'title' => __('Singular Label:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('name for one object of this taxonomy. Default is _x( \'Post Tag\', \'taxonomy singular name\' ) or _x( \'Category\', \'taxonomy singular name\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_basic',
                            'section' => 'tt_cptc_create_taxonomy_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Writer',
                            'menu' => 'create_taxonomy',
                            'required' => 'yes'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_plurallabel',
                            'title' => __('Plural Label:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('A plural descriptive name for the taxonomy marked for translation','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_basic',
                            'section' => 'tt_cptc_create_taxonomy_basic',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Writers',
                            'menu' => 'create_taxonomy',
                            'required' => 'yes'
                        ),
                        array(
                            'id' => 'tt_cptc_chk_create_taxonomy_object_type',
                            'title' => __('Attach to', 'tt_cptc_text_domain') . ' <a href="#" id="info" title="'.__('Name of the object type for the taxonomy object. Object-types can be built-in Post Type or any Custom Post Type that may be registered','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_check_box',
                            'page' => 'tt_cptc_create_taxonomy_settings_basic',
                            'section' => 'tt_cptc_create_taxonomy_basic',
                            'input_type' => 'multicheck',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy',
                            'multicheck' => $objecttype_array
                        ),
                       
                        //=============================================================//
                        /*Taxonomy - Advanced Label Settings*/
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_menuname',
                            'title' => __('Menu Name:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the menu name text. This string is the name to give menu items. If not set, defaults to value of name label','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_allitems',
                            'title' => __('All Items:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the all items text. Default is __( \'All Tags\' ) or __( \'All Categories\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. All Writers',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_edititems',
                            'title' => __('Edit Items:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the edit item text. Default is __( \'Edit Tag\' ) or __( \'Edit Category\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Edit Writers',
                            'menu' => 'create_taxonomy'
                        ),
                                                array(
                            'id' => 'tt_cptc_txt_create_taxonomy_viewitem',
                            'title' => __('View Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the view item text, Default is __( \'View Tag\' ) or __( \'View Category\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. View Writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_updateitem',
                            'title' => __('Update Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the update item text. Default is __( \'Update Tag\' ) or __( \'Update Category\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Update Writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_addnewitem',
                            'title' => __('Add New Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the add new item text. Default is __( \'Add New Tag\' ) or __( \'Add New Category\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Add New Writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_newitemname',
                            'title' => __('New Item Name:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the new item name text. Default is __( \'New Tag Name\' ) or __( \'New Category Name\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. New Writer Name',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_parentitem',
                            'title' => __('Parent Item:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the parent item text. This string is not used on non-hierarchical taxonomies such as post tags. Default is null or __( \'Parent Category\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Parent Genre',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_parentitemcolon',
                            'title' => __('Parent Item Colon:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('The same as parent_item, but with colon : in the end null, __( \'Parent Category:\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Parent Genre',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_searchitems',
                            'title' => __('Search Items:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the search items text. Default is __( \'Search Tags\' ) or __( \'Search Categories\' )','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Search Writers',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_popularitems',
                            'title' => __('Popular Items:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the popular items text. This string is not used on hierarchical taxonomies. Default is __( \'Popular Tags\' ) or null','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Popular Writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_seperateitemswithcommas',
                            'title' => __('Seperate Items With Commas:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the separate item with commas text used in the taxonomy meta box. This string is not used on hierarchical taxonomies. Default is __( \'Separate tags with commas\' ), or null','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Seperate Writers With Commas',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_addorremoveitems',
                            'title' => __('Add or Remove Items:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the add or remove items text and used in the meta box when JavaScript is disabled. This string is not used on hierarchical taxonomies. Default is __( \'Add or remove tags\' ) or null','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Add or Remove Writers',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_choosefrommostused',
                            'title' => __('Choose From Most Used:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the choose from most used text used in the taxonomy meta box. This string is not used on hierarchical taxonomies. Default is __( \'Choose from the most used tags\' ) or null','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. Choose From Most Used Writers',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_notfound',
                            'title' => __('Not Found:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('the text displayed via clicking \'Choose from the most used tags\' in the taxonomy meta box when no tags are available. This string is not used on hierarchical taxonomies. Default is __( \'No tags found.\' ) or null','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_adlabel',
                            'section' => 'tt_cptc_create_taxonomy_adlabel',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. No Writer Found',
                            'menu' => 'create_taxonomy'
                        ),
                        /*============================================================================================*/
                        /*Taxonomy - Advanced Settings*/
                        
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_public',
                            'title' => __('Public', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('If the taxonomy should be publicly queryable.', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_showui',
                            'title' => __('Show UI', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __(' Whether to generate a default UI for managing this taxonomy. Default: if not set, defaults to value of public argument.', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_showinnavmenu',
                            'title' => __('Show in Nav Menu', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'. __('true makes this taxonomy available for selection in navigation menus. Default: if not set, defaults to value of public argument', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_showtagcloud',
                            'title' => __('Show Tag Cloud', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether to allow the Tag Cloud widget to use this taxonomy. Default: if not set, defaults to value of show_ui argument', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_showadmincolumn',
                            'title' => __('Publicly Queryable', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether to allow automatic creation of taxonomy columns on associated post-types table', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_hierarchical',
                            'title' => __('Hierarchical', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'falsetrue',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_queryvar',
                            'title' => __('Query Var', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('False to disable the query_var, set as string to use custom query_var instead of default which is $taxonomy, the taxonomy\'s "name".', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy' 
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_sort',
                            'title' => __('Sort', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Whether this taxonomy should remember the order in which terms are added to objects.', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy'   
                        ),
                        array(
                            'id' => 'tt_cptc_drp_create_taxonomy_rewrite',
                            'title' => __('Rewrite', 'tt_cptc_text_domain') .' <a href="#" id="info" title="'. __('Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_dropdown',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'truefalse',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy' 
                        ),
                        array(
                            'id' => 'tt_cptc_txt_create_taxonomy_rewriteslug',
                            'title' => __('Rewrite Slug:', 'tt_cptc_text_domain') .
                                        ' <a href="#" id="info" title="'.__('Used as pretty permalink text (i.e. /tag/) - defaults to $taxonomy (taxonomy\'s name slug)','tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_text_field',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'text',
                            'place_holder_text' => 'Ex. writer',
                            'menu' => 'create_taxonomy'
                        ),
                        array(
                            'id' => 'tt_cptc_chk_create_taxonomy_capabilities',
                            'title' => __('Capabilities', 'tt_cptc_text_domain') . ' <a href="#" id="info" title="'.__('An array of the capabilities for this taxonomy', 'tt_cptc_text_domain').'">?</a>',
                            'callback' => 'tt_cptc_display_check_box',
                            'page' => 'tt_cptc_create_taxonomy_settings_advanced',
                            'section' => 'tt_cptc_create_taxonomy_advanced',
                            'input_type' => 'multicheck',
                            'place_holder_text' => '',
                            'menu' => 'create_taxonomy',
                            'multicheck' => array(
                                                  'tt_cptc_chk_create_taxonomy_capabilities_manageterms',
                                                  'tt_cptc_chk_create_taxonomy_capabilities_editterms',
                                                  'tt_cptc_chk_create_taxonomy_capabilities_deleteterms',
                                                  'tt_cptc_chk_create_taxonomy_capabilities_assignterms'
                                                )
                        ),
                        
);

return $input_fields;
}

?>