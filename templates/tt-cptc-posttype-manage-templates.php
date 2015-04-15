<?php

function tt_cptc_display_posttype_manage_page(){
	
	global $create_posttype_menu_page, $manage_posttype_menu_page, $ttcptcObj;
	$post_types = get_option('tt_cptc_create_posttype_options');
	
	$template =	'<div class="wrap">
				<h1>Manage Custom Post types</h1>
				<table class="widefat" id="tt-cptc">
					<thead>
						<tr>
							<th class="tt-cptc-cell">Post Type Name</th>
							<th class="tt-cptc-cell" id="details">Configuration Details</th>
							<th class="tt-cptc-cell">Published</th>						
							<th class="tt-cptc-cell">Drafts</th>
							<th class="tt-cptc-cell">Action</th>
						</tr>
					</thead>
					<tbody>';
	$element_id = 1;
	if(get_option('tt_cptc_create_posttype_options')==true){
		foreach($post_types as $item){
				$template .=		'<tr>
								<th class="tt-cptc-cell">'.$item['tt_cptc_txt_create_posttype_typename'].'</th>
								<th class="tt-cptc-cell" id="details"> <a href="#" class="info-button" id="'.$element_id.'">Show Config Details</a>
									<div style="display:none; font-size: 12px;" class="config-details'.$element_id.'">

										<h4 style="font-size:16px";>'. __('Basic Settings', 'tt_cptc_text_domain').'</h4>';
										$template .= '<ul class="config-list">';
										$template .= (isset($item['tt_cptc_txt_create_posttype_typename'])) ? '<li><strong>'.__('Post Type Name','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_txt_create_posttype_typename'].'</li>' : null; 
										$template .= (isset($item['tt_cptc_txta_create_posttype_description'])&&($item['tt_cptc_txta_create_posttype_description']!='')) ? '<li><strong>'. __('Description', 'tt_cptc_text_domain').':</strong> ' .$item['tt_cptc_txta_create_posttype_description'].'</li>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_singularlabel'])) ? '<li><strong>'. __('Singular Label', 'tt_cptc_text_domain').':</strong> ' .$item['tt_cptc_txt_create_posttype_singularlabel'].'</li>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_plurallabel'])) ? '<li><strong>'. __('Plural Label', 'tt_cptc_text_domain').':</strong> ' .$item['tt_cptc_txt_create_posttype_plurallabel'].'</li>' : null;
										$template .= '</ul>';
										
										$template .= '<h4 style="font-size:16px";>'.__('Advanced Label Options', 'tt_cptc_text_domain').'</h4>';
										$counter = strlen($template);
										$template .= (isset($item['tt_cptc_txt_create_posttype_menuname'])&&($item['tt_cptc_txt_create_posttype_menuname']!='')) ? ''. __('Menu Name', 'tt_cptc_text_domain').': ' .$item['tt_cptc_txt_create_posttype_menuname'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_addnew'])&&($item['tt_cptc_txt_create_posttype_addnew']!='')) ? ''. __('Add New','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_addnew'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_addnewitem'])&&($item['tt_cptc_txt_create_posttype_addnewitem']!='')) ? ''. __('Add New Item','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_addnewitem'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_edititem'])&&($item['tt_cptc_txt_create_posttype_edititem']!='')) ? ''. __('Edit Item','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_edititem'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_newitem'])&&($item['tt_cptc_txt_create_posttype_newitem']!='')) ? ''. __('New Item','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_newitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_posttype_viewitem'])&&($item['tt_cptc_txt_create_posttype_viewitem']!='')) ? ''. __('View Item','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_viewitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_posttype_searchitem'])&&($item['tt_cptc_txt_create_posttype_searchitem']!='')) ? ''. __('Search Item','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_searchitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_posttype_notfound'])&&($item['tt_cptc_txt_create_posttype_notfound']!='')) ? ''. __('Not Found','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_notfound'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_posttype_notfoundintrash'])&&($item['tt_cptc_txt_create_posttype_notfoundintrash']!='')) ? ''. __('Not Found in Trash','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_notfoundintrash'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_posttype_parentitemcolon'])&&($item['tt_cptc_txt_create_posttype_parentitemcolon']!='')) ? ''. __('Parent Item Colon','tt_cptc_text_domain').': '.$item['tt_cptc_txt_create_posttype_parentitemcolon'].'<br>' : null;
										
										if($counter == strlen($template)){
											$template .= "Nothing was configured in this section";	
										}
										
										$template .= '<h4 style="font-size:16px";>'. __('Advanced Options','tt_cptc_text_domain').'</h4>';
										$template .= '<ul class="config-list">';
										$template .= '<li><strong>'. __('Public','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_public'].'</li>';
										$template .= '<li><strong>'. __('Show UI','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_showui'].'</li>';
										$template .= '<li><strong>'. __('Show in Nav Menu','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_showinnavmenu'].'</li>';
										$template .= '<li><strong>'. __('Show in Menu','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_showinmenu'].'</li>';
										$template .= '<li><strong>'. __('Exclude From Search','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_excludefromsearch'].'</li>';
										$template .= '<li><strong>'. __('Publicly Queryable','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_publiclyqueryable'].'</li>';
										$template .= '<li><strong>'. __('Show in Admin Bar','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_showinadminbar'].'</li>';
										$template .= '<li><strong>'. __('Has Archive','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_hasarchive'].'</li>';
										$template .= '<li><strong>'. __('Hierarchical','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_hierarchical'].'</li>';
										$template .= '<li><strong>'. __('Rewrite','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_rewrite'].'</li>';
										$template .= '<li><strong>'. __('Query Var','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_queryvar'].'</li>';
										$template .= '<li><strong>'. __('Can Export','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_canexport'].'</li>';
										$template .= '<li><strong>'. __('Menu Position','tt_cptc_text_domain').':</strong> '.$item['tt_cptc_drp_create_posttype_menuposition'].'</li>';
										$template .= '<li><strong>'. __('Support','tt_cptc_text_domain').':</strong> ';
												$checkstr  = null; 
												$checkstr  = (isset($item['tt_cptc_chk_create_posttype_support_title'])) ? '<li>'.__('title','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_title'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_editor'])) ? '<li>'.__('editor','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_editor'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_author'])) ? '<li>'.__('author','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_author'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_thumbnail'])) ? '<li>'.__('thumbnail','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_thumbnail'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_excerpt'])) ? '<li>'.__('excerpt','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_excerpt'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_trackbacks'])) ? '<li>'.__('trackbacks','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_trackbacks'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_custom_fields'])) ? '<li>'.__('custom-fields','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_custom_fields'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_comments'])) ? '<li>'.__('comments','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_comments'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_revisions'])) ? '<li>'.__('revisions','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_revisions'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_page_attributes'])) ? '<li>'.__('page-attributes','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_page_attributes'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_support_post_formats'])) ? '<li>'.__('post-formats','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_support_post_formats'].'</li>' : '';
										if(strlen($checkstr)==0){
											$template .= ' Nothing Selected For This Option'.'';		
										}else{
											$template .= '<ul>'. $checkstr.'</ul>';
										}
										$template .= '</li>';
										$template .= '<li><strong>'. __('Taxonomy','tt_cptc_text_domain').':</strong>';
												$checkstr  = null;
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_taxonomy_category'])) ? '<li>'.__('category','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_taxonomy_category'].'</li>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_posttype_taxonomy_post_tag'])) ? '<li'.__('post-tag','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_posttype_taxonomy_post_tag'].'</li>' : '';
										if(strlen($checkstr)==0){
											$template .= ' Nothing Selected For This Option'.'';		
										}else{
											$template .= '<ul>'. $checkstr.'</ul>';
										}
										$template .= '</li>';
										$template .= (isset($item['tt_cptc_txt_create_posttype_icon'])&&($item['tt_cptc_txt_create_posttype_icon']!='')) ? '<li><strong>'. __('Icon URL','tt_cptc_text_domain').':</strong> '. esc_attr($item['tt_cptc_txt_create_posttype_icon']).'</li>' : null;
										$template .= '</ul>';
							$template .=	'</div>

								</th>
								<th class="tt-cptc-cell">';
								$count_posts = wp_count_posts('product');
						$template .=	$count_posts->publish;
						$template .=	'</th>						
								<th class="tt-cptc-cell">';
						$template .=	$count_posts->draft;
						$template .=	'</th>
								<th class="tt-cptc-cell"><a href="'.$ttcptcObj->tt_cptc_get_url('ept',$item['tt-cptc_posttype_id'],$create_posttype_menu_page).'">'.__('Edit', 'tt_cptc_text_domain').'</a> | <a href="'.$ttcptcObj->tt_cptc_get_url('dpt',$item['tt-cptc_posttype_id'],$manage_posttype_menu_page).'">'.__('Delete', 'tt_cptc_text_domain').'</a></th>
							</tr>';
						
		++$element_id;
		}
	}
		$template .=		'</tbody>
				</table>
			</div>';
        return $template;
}
?>