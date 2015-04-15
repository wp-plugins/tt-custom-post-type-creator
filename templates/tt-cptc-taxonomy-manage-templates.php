<?php
function tt_cptc_display_taxonomy_manage_page(){

global $create_taxonomy_menu_page, $manage_taxonomy_menu_page, $ttcptcObj;
	$post_types = get_option('tt_cptc_create_taxonomy_options');
	
	$template =	'<div class="wrap">
				<h1>Manage Custom Taxonomies</h1>
				<table class="widefat" id="tt-cptc">
					<thead>
						<tr>
							<th class="tt-cptc-cell">Taxonomy Name</th>
							<th class="tt-cptc-cell" id="details">Configuration Details</th>
							<th class="tt-cptc-cell">Action</th>
						</tr>
					</thead>
					<tbody>';
	$element_id = 1;
	if(get_option('tt_cptc_create_taxonomy_options')==true){
		foreach($post_types as $item){
				$template .=		'<tr>
								<th class="tt-cptc-cell">'.$item['tt_cptc_txt_create_taxonomy_typename'].'</th>
								<th class="tt-cptc-cell" id="details"> <a href="#" class="info-button" id="'.$element_id.'">Show Config Details</a>
									<div style="display:none; font-size: 12px;" class="config-details'.$element_id.'">
										<h4 style="font-size:16px;">'. __('Basic Settings', 'tt_cptc_text_domain').'</h4>';
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_typename'])) ? '<div class="info-title">'.__('Post Type Name','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_typename'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_singularlabel'])) ? '<div class="info-title">'. __('Singular Label', 'tt_cptc_text_domain').':</div> ' .$item['tt_cptc_txt_create_taxonomy_singularlabel'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_plurallabel'])) ? '<div class="info-title">'. __('Plural Label', 'tt_cptc_text_domain').':</div> ' .$item['tt_cptc_txt_create_taxonomy_plurallabel'].'<br>' : null;
										$template .= '<div class="info-title">'. __('Attach To','tt_cptc_text_domain').':</div>';
												$checkstr  = null;
												$checkstr .= (isset($item['tt_cptc_chk_create_taxonomy_post_type_posts'])) ? __('posts','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_taxonomy_post_type_posts'].'<br>' : '';
												$checkstr .= (isset($item['tt_cptc_chk_create_taxonomy_post_type_pages'])) ? __('pages','tt_cptc_text_domain').' = '.$item['tt_cptc_chk_create_taxonomy_post_type_pages'].'<br>' : '';
										if(strlen($checkstr)==0){
											$template .= '<div class="multi-check" id="disp">Nothing Selected For This Option'.'</div>';		
										}else{
											$template .= '<div class="multi-check" id="disp">'. $checkstr.'</div>';
										}
                                                                                
										$template .= '<h4 style="font-size:16px;">'.__('Advanced Label Options', 'tt_cptc_text_domain').'</h4>';
										$counter = strlen($template);
										
                                                                                $template .= (isset($item['tt_cptc_txt_create_taxonomy_menuname'])&&($item['tt_cptc_txt_create_taxonomy_menuname']!='')) ? '<div class="info-title">'. __('Menu Name', 'tt_cptc_text_domain').':</div> ' .$item['tt_cptc_txt_create_taxonomy_menuname'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_allitems'])&&($item['tt_cptc_txt_create_taxonomy_allitems']!='')) ? '<div class="info-title">'. __('Add New','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_allitems'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_edititems'])&&($item['tt_cptc_txt_create_taxonomy_edititems']!='')) ? '<div class="info-title">'. __('Add New Item','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_edititems'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_viewitem'])&&($item['tt_cptc_txt_create_taxonomy_viewitem']!='')) ? '<div class="info-title">'. __('Edit Item','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_viewitem'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_updateitem'])&&($item['tt_cptc_txt_create_taxonomy_updateitem']!='')) ? '<div class="info-title">'. __('New Item','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_updateitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_addnewitem'])&&($item['tt_cptc_txt_create_taxonomy_addnewitem']!='')) ? '<div class="info-title">'. __('View Item','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_addnewitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_newitemname'])&&($item['tt_cptc_txt_create_taxonomy_newitemname']!='')) ? '<div class="info-title">'. __('Search Item','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_newitemname'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_parentitem'])&&($item['tt_cptc_txt_create_taxonomy_parentitem']!='')) ? '<div class="info-title">'. __('Not Found','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_parentitem'].'<br>' : null; 
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_parentitemcolon'])&&($item['tt_cptc_txt_create_taxonomy_parentitemcolon']!='')) ? '<div class="info-title">'. __('Not Found in Trash','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_parentitemcolon'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_popularitems'])&&($item['tt_cptc_txt_create_taxonomy_popularitems']!='')) ? '<div class="info-title">'. __('Parent Item Colon','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_popularitems'].'<br>' : null;   
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_seperateitemswithcomma'])&&($item['tt_cptc_txt_create_taxonomy_seperateitemswithcomma']!='')) ? '<div class="info-title">'. __('Parent Item Colon','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_seperateitemswithcomma'].'<br>' : null;
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_addorremoveitems'])&&($item['tt_cptc_txt_create_taxonomy_addorremoveitems']!='')) ? '<div class="info-title">'. __('Parent Item Colon','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_addorremoveitems'].'<br>' : null;
                                                                                $template .= (isset($item['tt_cptc_txt_create_taxonomy_choosefrommostused'])&&($item['tt_cptc_txt_create_taxonomy_choosefrommostused']!='')) ? '<div class="info-title">'. __('Parent Item Colon','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_choosefrommostused'].'<br>' : null;
                                                                                $template .= (isset($item['tt_cptc_txt_create_taxonomy_notfound'])&&($item['tt_cptc_txt_create_taxonomy_notfound']!='')) ? '<div class="info-title">'. __('Parent Item Colon','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_notfound'].'<br>' : null;
                                                                                
                                                                                if($counter == strlen($template)){
											$template .= "Nothing was configured in this section";	
										}
										
										$template .= '<h4 style="font-size:16px;">'. __('Advanced Options','tt_cptc_text_domain').'</h4>';
										$template .= '<div class="info-title">'. __('Public','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_public'].'<br>';
										$template .= '<div class="info-title">'. __('Show UI','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_showui'].'<br>';
										$template .= '<div class="info-title">'. __('Show in Nav Menu','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_showinnavmenu'].'<br>';
										$template .= '<div class="info-title">'. __('Show Tag Cloud','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_showtagcloud'].'<br>';
										$template .= '<div class="info-title">'. __('Show Admin Column','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_showadmincolumn'].'<br>';
										$template .= '<div class="info-title">'. __('Hierarchical','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_hierarchical'].'<br>';
                                                                                $template .= '<div class="info-title">'. __('Query Var','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_queryvar'].'<br>';
										$template .= '<div class="info-title">'. __('Rewrite','tt_cptc_text_domain').':</div> '.$item['tt_cptc_drp_create_taxonomy_rewrite'].'<br>';
										$template .= (isset($item['tt_cptc_txt_create_taxonomy_rewriteslug'])&&($item['tt_cptc_txt_create_taxonomy_rewriteslug']!='')) ? '<div class="info-title">'. __('Icon URL','tt_cptc_text_domain').':</div> '.$item['tt_cptc_txt_create_taxonomy_rewriteslug'].'<br>' : null;
							$template .=	'</div>	
								</th>
								<th class="tt-cptc-cell"><a href="'.$ttcptcObj->tt_cptc_get_url('ett',$item['tt-cptc_taxonomy_id'],$create_taxonomy_menu_page).'">'.__('Edit', 'tt_cptc_text_domain').'</a> | <a href="'.$ttcptcObj->tt_cptc_get_url('dtt',$item['tt-cptc_taxonomy_id'],$manage_taxonomy_menu_page).'">'.__('Delete', 'tt_cptc_text_domain').'</a></th>
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