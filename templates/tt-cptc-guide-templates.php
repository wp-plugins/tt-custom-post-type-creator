<?php
function tt_cptc_display_guide_page(){
	
        $template  =    '<div class="wrap">
				<h1>'. __("TT Custom Post Type Creator Guide", "tt_cptc_text_domain") .'</h1>';
        
        $template .=		'<div style="width:100%; line-height: 25px; margin: 50px 0 30px 0;"><p>TT Custom Post Type Creator helps you create custom post types and taxonomies in just a few clicks from the WordPress admin interface. This is a free but very useful plugin. Please donate to the development
					of TT CUstom Post Type Creator.</p></div>';
					
	$template .= 		'<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="margin: 0 0 50px 0; text-align: center;">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHPwYJKoZIhvcNAQcEoIIHMDCCBywCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCmEYN58Bx/0uinwhNFouC9HP6BYCZN7KdUo2Z127WZ7UbrhYolfRGjTXy/CLVDC4lAZ3FONCg5uoK8Hhl3mYEMVJx94s2V/Uh4UeEH7SNEw+1So8o8v4u0LtghNC7wvudNKuorYLZ1iXkXjlcr/U0uKktbwPDuEhwgrSGpxFI59DELMAkGBSsOAwIaBQAwgbwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIjeZn/qiHBnCAgZhFqvVaa5NjnKwFhC54yUf+YK31fk0T7J7uNPWs5w0TmsjM0UtPZgEeEHl7DsInvTqWPGcKRTS3tQ63c+wbxmGmPmeif2VKVe1fo82tqOUBqbrYVjrSYgNH1TPfSdc0HW7dhpc7XVZAy4i+h4axXl8GXoIH/8wM3GPyOTVN+ZNHZrUFGOVMD3j1N6vBXv120aeRN9pDQBKbUqCCA4cwggODMIIC7KADAgECAgEAMA0GCSqGSIb3DQEBBQUAMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTAeFw0wNDAyMTMxMDEzMTVaFw0zNTAyMTMxMDEzMTVaMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAwUdO3fxEzEtcnI7ZKZL412XvZPugoni7i7D7prCe0AtaHTc97CYgm7NsAtJyxNLixmhLV8pyIEaiHXWAh8fPKW+R017+EmXrr9EaquPmsVvTywAAE1PMNOKqo2kl4Gxiz9zZqIajOm1fZGWcGS0f5JQ2kBqNbvbg2/Za+GJ/qwUCAwEAAaOB7jCB6zAdBgNVHQ4EFgQUlp98u8ZvF71ZP1LXChvsENZklGswgbsGA1UdIwSBszCBsIAUlp98u8ZvF71ZP1LXChvsENZklGuhgZSkgZEwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tggEAMAwGA1UdEwQFMAMBAf8wDQYJKoZIhvcNAQEFBQADgYEAgV86VpqAWuXvX6Oro4qJ1tYVIT5DgWpE692Ag422H7yRIr/9j/iKG4Thia/Oflx4TdL+IFJBAyPK9v6zZNZtBgPBynXb048hsP16l2vi0k5Q2JKiPDsEfBhGI+HnxLXEaUWAcVfCsQFvd2A1sxRr67ip5y2wwBelUecP3AjJ+YcxggGaMIIBlgIBATCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwCQYFKw4DAhoFAKBdMBgGCSqGSIb3DQEJAzELBgkqhkiG9w0BBwEwHAYJKoZIhvcNAQkFMQ8XDTE1MDEyNDAyNDA0N1owIwYJKoZIhvcNAQkEMRYEFFREqlmwW//W9O7pqTIwdgRbfDaSMA0GCSqGSIb3DQEBAQUABIGAgzbNKZn7Dz3lWy9aC0TLpFXXGgHaVzVskJihJNGy3i598W8D8yo6scrx1aZKMY37Hc2UvhVflni1+uiCWjXUqIoPn3wJ1+8idfuTErcBrsbQFADszjrnHwZNrwtPWDUcULOcpgRr8uiHroNkUVBUzRzl4Aku4fACYWwCKAyfw7I=-----END PKCS7-----
					">
					<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
					<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
				</form>';
				
        $template .=        	'<h2>' . __("Create Post Type","tt_cptc_text_domain") . '</h2>';
	$template .= 		'<p>Using this option custom post types can be created very easily. To check the step by step guide read this <a href="http://technologiestoday.com.au/guide-to-use-tt-custom-post-type-creator-plugin-for-wordpress/">tutorial</a>.</p>';
        $template .=        	'<h2>' . __("Manage Post Type","tt_cptc_text_domain") . '</h2>';
        $template .= 		'<p>Custom post types that are created by this plugin can be easily managed. These post types can be edited, or deleted from this option. To check the step by step guide read this <a href="http://technologiestoday.com.au/guide-to-use-tt-custom-post-type-creator-plugin-for-wordpress/">tutorial</a>.</p>';
	$template .=        	'<h2>' . __("Create Taxonomy","tt_cptc_text_domain") . '</h2>';
	$template .= 		'<p>Using this option custom Taxonomies can be created very easily. To check the step by step guide read this <a href="http://technologiestoday.com.au/guide-to-use-tt-custom-post-type-creator-plugin-for-wordpress/">tutorial</a>.</p>';
        $template .=        	'<h2>' . __("Manage Taxonomies","tt_cptc_text_domain") . '</h2>';
	$template .= 		'<p>Custom Taxonomies that are created by this plugin can be easily managed. These Taxonomies can be edited, or deleted from this option. To check the step by step guide read this <a href="http://technologiestoday.com.au/guide-to-use-tt-custom-post-type-creator-plugin-for-wordpress/">tutorial</a>.</p>';
        $template .=        	'<h2>' . __("How to Display Custom Post Types on Your Wordpress Site","tt_cptc_text_domain") . '</h2>';
		$template .= 		'<p>Check the <a href="http://technologiestoday.com.au/how-to-display-custom-post-types-on-your-wordpress-site/">tutorial</a>.</p>';
		$template .=        	'<h2>' . __("How to Display Custom Taxonomies On Your WordPress Site","tt_cptc_text_domain") . '</h2>';
		$template .= 		'<p>Check the <a href="http://technologiestoday.com.au/how-to-display-custom-taxonomies-on-your-wordpress-site/">tutorial</a>.</p>';
		
	$template .=    '</div>';
        
        return $template;
}
?>