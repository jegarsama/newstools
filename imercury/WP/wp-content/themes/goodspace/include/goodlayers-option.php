<?php

	/*	
	*	Goodlayers Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the goodlayers panel elements and create the 
	*	goodlayers panel to the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	// goodlayers panel navigation elements
	$goodlayers_menu = array(			
		__('General', 'gdl_back_office') => array(
			__('Page Style', 'gdl_back_office')=>'gdl_panel_page_style',
			__('Sidebar', 'gdl_back_office')=>'gdl_panel_sidebar',
			__('Footer Style', 'gdl_back_office')=>'gdl_panel_footer_style',
			__('Google Analytics', 'gdl_back_office')=>'gdl_panel_google_analytics',
			__('Favicon', 'gdl_back_office')=>'gdl_panel_favicon'),
			
		__('Font Style', 'gdl_back_office') => array(
			__('Font Size', 'gdl_back_office')=>'gdl_panel_font_size',
			__('Font Family', 'gdl_back_office')=>'gdl_panel_font',
			__('Upload Font', 'gdl_back_office')=>'gdl_panel_upload_font'),
			
		__('Overall Elements', 'gdl_back_office') => array(
			__('Logo/Navigation', 'gdl_back_office')=>'gdl_panel_logo',
			__('Background Style', 'gdl_back_office')=>'gdl_panel_background',
			__('Social Network', 'gdl_back_office')=>'gdl_panel_social_network',
			__('Social Shares', 'gdl_back_office')=>'gdl_panel_social_shares',
			__('Copyright Area', 'gdl_back_office')=>'gdl_panel_copyright_area'),
			//__('Dummy Data', 'gdl_back_office')=>'gdl_panel_dummy_data' ),	
			
		__('Elements Color', 'gdl_back_office') => array(
			__('Navigation', 'gdl_back_office')=>'gdl_panel_navigation',
			__('Body', 'gdl_back_office')=>'gdl_panel_body',
			__('Footer', 'gdl_back_office')=>'gdl_panel_footer',
			__('Slider', 'gdl_back_office')=>'gdl_panel_slider',
			__('Blog / Portfolio', 'gdl_back_office')=>'gdl_panel_blog_port',
			__('Contact Form/Comments', 'gdl_back_office')=>'gdl_panel_contact_form',
			__('Stunning Text', 'gdl_back_office')=>'gdl_panel_stunning_text',
			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements',
			__('Price Item', 'gdl_back_office')=>'gdl_panel_price_item',
			__('Load Default Color', 'gdl_back_office')=>'gdl_panel_load_default_color'),
			
		__('Translator','gdl_back_office')=> array(
			__('Enable Admin Translator', 'gdl_back_office')=>'gdl_panel_enable_admin_translator',
			__('Blog/Portfolio', 'gdl_back_office')=>'gdl_panel_blog_port_translator',
			__('Contact Form', 'gdl_back_office')=>'gdl_panel_contact_form_translator',
			__('Contact Widget', 'gdl_back_office')=>'gdl_panel_contact_widget_translator',
			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements_translator',
			),
		
		__('Slider Setting', 'gdl_back_office') => array(
			__('Nivo Slider', 'gdl_back_office')=>'gdl_panel_nivo_slider',
			__('Flex Slider', 'gdl_back_office')=>'gdl_panel_flex_slider',
			__('Anything Slider', 'gdl_back_office')=>'gdl_panel_anything_slider')
	);
	
	// goodlayers panel elements ( the head of array links to the menu of navigation elements )
	$goodlayers_element = array(
		//General

		'gdl_panel_page_style' => array(
			__('ENABLE RESPONSIVE', 'gdl_back_office')=>array(
				'type'=>'radioenabled',
				'name'=>THEME_SHORT_NAME.'_enable_responsive',
				'description'=>' *** Flex slider is only slider that supports the responsive mode.'
			),
			__('USE PORTFOLIO PAGE AS', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_use_portfolio_as',
				'options'=>array('1'=>'portfolio style', '2'=>'blog style'),
				'description'=>'You can choose the portfolio page style to be the portfolio style or the same as blog style.'),
			__('CHANGE PORTFOLIO SLUG', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_gdl_portfolio_slug',
				'default'=>'portfolio',
				'description'=>'Change/Rewrite the permalink when you use the permalink type as %postname%.'
			),	
			__('SEARCH/ARCHIVE SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_search_archive_sidebar',
				'default'=>'no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),
					'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar-120.png'),
					'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar-120.png'),
					'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),
			__('SEARCH/ARCHIVE EXCERPT NUM', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_search_archive_num_excerpt',
				'default'=>'420',
				'description'=>'Input the number of character you want to cut from the content to be the excerpt of search and archive page.'),
			__('SEARCH/ARCHIVE ITEM SIZE', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_search_archive_item_size',
				'options'=>array('1/1 Full Thumbnail', '1/1 Medium Thumbnail')
			),	
			__('DEFAULT POST SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_default_post_sidebar',
				'default'=>'post-no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'post-right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),
					'2'=>array('value'=>'post-left-sidebar','image'=>'/include/images/left-sidebar-120.png'),
					'3'=>array('value'=>'post-both-sidebar','image'=>'/include/images/both-sidebar-120.png'),
					'4'=>array('value'=>'post-no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),
			__('DEFAULT POST LEFT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_default_post_left_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-left-sidebar'),
			__('DEFAULT POST RIGHT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_default_post_right_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-right-sidebar'),					
		),
		
		'gdl_panel_sidebar' => array(
			__('CREATE SIDEBAR', 'gdl_back_office')=>array('type'=>'sidebar','name'=>THEME_SHORT_NAME.'_create_sidebar')
		),
		
		'gdl_panel_footer_style' => array(
			__('CHOOSE FOOTER STYLE', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_footer_style', 
				'default'=>'footer-style4',
				'options'=>array(
					'1'=>array('value'=>'footer-style1','image'=>'/include/images/footer-style1.png'),
					'2'=>array('value'=>'footer-style2','image'=>'/include/images/footer-style2.png'),
					'3'=>array('value'=>'footer-style3','image'=>'/include/images/footer-style3.png'),
					'4'=>array('value'=>'footer-style4','image'=>'/include/images/footer-style4.png'),
					'5'=>array('value'=>'footer-style5','image'=>'/include/images/footer-style5.png'),
					'6'=>array('value'=>'footer-style6','image'=>'/include/images/footer-style6.png'),
			)),
			__('SHOW FOOTER', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_footer'),
			__('SHOW COPYRIGHT', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_copyright'),
		),
		
		'gdl_panel_google_analytics' => array(
			__('ENABLE GOOGLE ANALYTICS', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_enable_analytics', 'default'=>'disable'),
			__('GOOGLE ANALYTICS CODE', 'gdl_back_office')=>array('type'=>'textarea', 'name'=> THEME_SHORT_NAME.'_analytics_code',
				'description'=>'Place the code you get from google here. This should be something like <br>' . 
				htmlspecialchars('<script type="text/javascript">') . '<br> ... <br>' .
				htmlspecialchars('</script>'))
		),
		
		'gdl_panel_favicon' => array(
			__('ENABLE FAVICON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=> THEME_SHORT_NAME.'_enable_favicon', 'default'=>'disable'),
			__('UPLOAD FAVICON ICON', 'gdl_back_office')=>array('type'=>'upload','name'=> THEME_SHORT_NAME.'_favicon_image'),
		),
		
		//Theme Style
		'gdl_panel_font_size' => array(
			__('H1 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h1_size','default'=>'30'),
			__('H2 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h2_size','default'=>'25'),
			__('H3 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h3_size','default'=>'20'),
			__('H4 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h4_size','default'=>'18'),
			__('H5 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h5_size','default'=>'16'),
			__('H6 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h6_size','default'=>'15')
		),

		'gdl_panel_font' => array(
			__('HEADER FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_header_font',
				'description'=>'Choose the header font of this theme. This font will be used in all title and header elements including the slider title.'),
			__('CONTENT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_content_font',
				'description'=>'Choose the font to use with content. We are highly NOT recommended to use CUFON as a content font.'),
			__('STUNNING TEXT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_stunning_text_font',
				'description'=>'Choose the font to use with stunning text title.'),
			__('SLIDER TITLE FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_slider_title_font',
				'description'=>'Choose the font to use with slider title.')
		),
				
			
		'gdl_panel_upload_font' => array(
			__('UPLOAD FONT', 'gdl_back_office')=>array(
				'type'=>'uploadfont',
				'name'=>THEME_SHORT_NAME.'_upload_font',
				'file'=>THEME_SHORT_NAME.'_upload_font_file')
		),
		
		//Overall Elements
		'gdl_panel_logo' => array( 
			__('LOGO', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_logo'), 
			__('LOGO TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_top_margin','default'=>'0',
				'description'=>'Input number to set the top space of the logo. The minimum value is 1.'), 
			__('LOGO LEFT MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_left_margin','default'=>'10'),
			__('LOGO BOTTOM MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_bottom_margin','default'=>'33',
				'description'=>'Input number to set the bottom space of the logo. The minimum value is 1.'),
			__('NAVIGATION TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_navigation_top_margin','default'=>'51')				
		),

		'gdl_panel_background' => array(
			__('BACKGROUND TYPE', 'gdl_back_office')=>array('type'=>'combobox', 'id'=>'gdl_background_style','name'=>THEME_SHORT_NAME.'_background_style','options'=>array('0'=>'Pattern','1'=>'Custom Image','2'=>'None'),
				'description'=>'You can choose the background you want between our pre-provided pettern and your custom image.'),
			__('CHOOSE PATTERN','gdl_back_office')=>array(
				'type'=>'radioimage',
				'body_class'=>'gdl_background_pattern',
				'name'=>THEME_SHORT_NAME.'_background_pattern',
				'default'=>'1',
				'options'=>array(
					'1'=>array('value'=>'1','image'=>'/include/images/pattern/pattern-1.png'),
					'2'=>array('value'=>'2','image'=>'/include/images/pattern/pattern-2.png'),
					'3'=>array('value'=>'3','image'=>'/include/images/pattern/pattern-3.png'),
					'4'=>array('value'=>'4','image'=>'/include/images/pattern/pattern-4.png'),
					'5'=>array('value'=>'5','image'=>'/include/images/pattern/pattern-5.png'),
					'6'=>array('value'=>'6','image'=>'/include/images/pattern/pattern-6.png'),
					'7'=>array('value'=>'7','image'=>'/include/images/pattern/pattern-7.png'),
					'8'=>array('value'=>'8','image'=>'/include/images/pattern/pattern-8.png'),
					'9'=>array('value'=>'9','image'=>'/include/images/pattern/pattern-9.png'),
					'10'=>array('value'=>'10','image'=>'/include/images/pattern/pattern-10.png'),
					'11'=>array('value'=>'11','image'=>'/include/images/pattern/pattern-11.png'),
					'12'=>array('value'=>'12','image'=>'/include/images/pattern/pattern-12.png'),
					'13'=>array('value'=>'13','image'=>'/include/images/pattern/pattern-13.png'),
					'14'=>array('value'=>'14','image'=>'/include/images/pattern/pattern-14.png'),
					'15'=>array('value'=>'15','image'=>'/include/images/pattern/pattern-15.png'),
				)
			),
			__('CUSTOM BACKGROUND', 'gdl_back_office')=>array(
				'type'=>'upload',
				'name'=>THEME_SHORT_NAME.'_background_custom',
				'body_class'=>'gdl_background_custom'), 
		),

		'gdl_panel_social_network' => array( 
			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_delicious',
				'description'=>'Place the link you want and delicious icon will appear. To remove it, just leave it blank.'),	
			__('DEVIANTART', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_deviantart',
				'description'=>'Place the link you want and deviantart icon will appear. To remove it, just leave it blank.'),	
			__('DIGG', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_digg',
				'description'=>'Place the link you want and digg icon will appear. To remove it, just leave it blank.'),					
			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_facebook',
				'description'=>'Place the link you want and facebook icon will appear. To remove it, just leave it blank.'),
			__('FLICKR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_flickr',
				'description'=>'Place the link you want and flickr icon will appear. To remove it, just leave it blank.'),
			__('LASTFM', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_lastfm',
				'description'=>'Place the link you want and lastfm icon will appear. To remove it, just leave it blank.'),
			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_linkedin',
				'description'=>'Place the link you want and linkedin icon will appear. To remove it, just leave it blank.'),			
			__('PICASA', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_picasa',
				'description'=>'Place the link you want and picasa icon will appear. To remove it, just leave it blank.'),
			__('RSS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_rss',
				'description'=>'Place the link you want and feed icon will appear. To remove it, just leave it blank.'),
			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_stumble_upon',
				'description'=>'Place the link you want and stumble upon icon will appear. To remove it, just leave it blank.'),
			__('TUMBLR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_tumblr',
				'description'=>'Place the link you want and tumblr icon will appear. To remove it, just leave it blank.'),	
			__('TWITTER', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_twitter',
				'description'=>'Place the link you want and twitter icon will appear. To remove it, just leave it blank.'),
			__('VIMEO', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_vimeo',
				'description'=>'Place the link you want and vimeo icon will appear. To remove it, just leave it blank.'),
			__('YOUTUBE', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_youtube',
				'description'=>'Place the link you want and youtube icon will appear. To remove it, just leave it blank.'),
				
		),		
		
		'gdl_panel_social_shares' => array(
			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_facebook_share',
				'description'=>'Toggle to enable/disable the facebook shares in blog and portfolio page.'),
			__('TWITTER', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_twitter_share',
				'description'=>'Toggle to enable/disable the twitter shares in blog and portfolio page.'),
			__('GOOGLE', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_google_share',
				'description'=>'Toggle to enable/disable the google shares in blog and portfolio page.'),
			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_stumble_upon_share',
				'description'=>'Toggle to enable/disable the stumble upon shares in blog and portfolio page.'),
			__('MY SPACE', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_my_space_share',
				'description'=>'Toggle to enable/disable the my spce shares in blog and portfolio page.'),
			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_delicious_share',
				'description'=>'Toggle to enable/disable the delicious shares in blog and portfolio page.'),
			__('DIGG', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_digg_share',
				'description'=>'Toggle to enable/disable the digg shares in blog and portfolio page.'),
			__('REDDIT', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_reddit_share',
				'description'=>'Toggle to enable/disable the reddit shares in blog and portfolio page.'),
			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_linkedin_share',
				'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),
				
		),
			
		'gdl_panel_copyright_area' => array( 
			__('COPYRIGHT AREA', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_copyright_area'), 
		),
		
		// 'gdl_panel_dummy_data' => array( 
		// 	__('LOAD DUMMY DATA', 'gdl_back_office')=>array('type'=>'dummy')
		// ),
			
		// Elements Color
		
		'gdl_panel_navigation' => array(	
			__('MAIN NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text','default'=>'#7d7d7d',
				'description'=>'This is the text color of the main navigation in the normal state.'),
			__('MAIN NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_hover','default'=>'#343434',
				'description'=>'This is the text color of the main navigation in "hover" state.'),
			__('MAIN NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_current','default'=>'#343434',
				'description'=>'This is the text color of the main navigation in "current page" state.'),				
			__('SUB NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_background','default'=>'#fdfdfd'),
			__('SUB NAVIGATION BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_border','default'=>'#ececec'),
			__('SUB NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text','default'=>'#7d7d7d'),
			__('SUB NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_hover','default'=>'#343434'),
			__('SUB NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_current','default'=>'#343434'),
		),		
		
		'gdl_panel_body' => array(	
			__('ICON STYLE','gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_icon_type',
				'options'=>array('1'=>'dark','2'=>'light'),
				'description'=>'This option will change all of the icon in this theme( except footer ) to use dark/light version.'),
			__('TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_title_color','default'=>'#383838',
				'description'=>'Change this title color wil effects all title in this theme except footer title, sidebar title, blog thumbnail title and portolio thumbnail title color.'),
			__('CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_caption_color','default'=>'#7d7d7d'),
			__('TITLE LEFT BAR COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_title_left_bar_color','default'=>'#e3e3e3'),
			__('SIDEBAR TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_title_color','default'=>'#191919'),
			__('CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_content_color','default'=>'#919191'),
			__('BODY BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_body_background','default'=>'#dddddd',
				'description'=>'Body background will NOT take effects when user use the image as background or use the non transparent pattern '),
			__('CONTAINER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_container_background','default'=>'#ffffff',
				'description'=>'Container background is a background over the body background. You can chage it to any color you want.'),
			__('LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_color','default'=>'#272727',
				'description'=>'This color effects all of the link color in this theme.'),
			__('LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_hover_color','default'=>'#a1a1a1',
				'description'=>'This color effects all of the link color on "hover" state in this theme.'),
			__('ELEMENTS SHADOW', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_elements_shadow','default'=>'#ececec',
				'description'=>'This color changes the elements shadow color in the container, including button, post and portfolio frame and sidebar shadow.'),
			__('TABLE BORDER (TABLE TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_border','default'=>'#e5e5e5'),
			__('TABLE TITLE TEXT COLOR (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_text_title','default'=>'#666666'),
			__('TABLE TITLE BACKGROUND (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_title_background','default'=>'#f7f7f7'),
			__('TAG CLOUD BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tag_cloud_background','default'=>'#fff')
			),
		
		'gdl_panel_footer' => array(	
			__('FOOTER ICON TYPE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_footer_icon_type','options'=>array('0'=>'light','1'=>'dark'),'default'=>'light',
				'description' =>'There are two icon types in this theme, dark and light, you can choose it to display on footer as you want.'),
			__('FOOTER LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_color','default'=>'#000000',
				'description'=>'This color changes all of the link color inside footer in normal state.'),
			__('FOOTER LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_hover_color','default'=>'#a8a8a8',
				'description'=>'This is the link color of footer frame in "hover" state.'),
			__('FOOTER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_title_color','default'=>'#404040'),	
			__('FOOTER CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_color','default'=>'#888888'),	
			__('FOOTER CONTENT INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_info_color','default'=>'#aaaaaa',
				'description' =>'The content info is the color of the post date( in post/portfolio widget ) and twitter widget'),	
			__('FOOTER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_background','default'=>'#eaeaea'),
			__('FOOTER DIVIDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_divider_color', 'default'=>'#d1d1d1'),
			__('FOOTER INPUT BOX TEXT', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_text', 'default'=>'#888888',
				'description' =>'This footer input box comes from search widget and contact form widget, you can change it to fit theme styles.'),
			__('FOOTER INPUT BOX BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_background', 'default'=>'#d4d4d4'),
			__('FOOTER INPUT BOX BORDER', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_border', 'default'=>'#d4d4d4'),
			__('FOOTER BUTTON COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_color', 'default'=>'#222222',
				'description' =>'This color is for the submit button of contact widget.'),
			__('FOOTER BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_text', 'default'=>'#e8e8e8'),
			__('FOOTER FRAME BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_frame_background', 'default'=>'#ffffff',
				'description' =>'Frame is the elements that wrap post/portfolio(widget) thumbnail.'),
			__('FOOTER FRAME BORDER', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_frame_border', 'default'=>'#ffffff'),
			__('COPYRIGHT TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_text', 'default'=>'#808080'),
			__('COPYRIGHT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_background', 'default'=>'#202020'),
			__('COPYRIGHT SHADOW COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_shadow', 'default'=>'#111111',
				'description' =>'This is the shadow between the footer and copyright.'),
			__('TAG CLOUD BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_tag_cloud_background','default'=>'#fff')				
		),
		
		'gdl_panel_slider' => array(
			__('SLIDER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_title_color','default'=>'#ffffff'),
			__('SLIDER CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_color','default'=>'#c6c6c6'),	
			__('SLIDER CAPTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_bg','default'=>'#000000'),	
			__('SLIDER BULLET COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_bullet_color','default'=>'#c5c5c5'),
			__('SLIDER BULLET HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_bullet_hover_color','default'=>'#4e4e4e'),
		),
			
		'gdl_panel_blog_port' => array(
			__('PORT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_color','default'=>'#888888',
				'description'=>'This is the portfolio thumbnail title color.'),
			__('PORT TITLE HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_hover_color','default'=>'#efefef',
				'description'=>'This is the portfolio thumbnail title color in "hover" state.'),
			__('PORT TITLE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_background','default'=>'#f5f5f5'),
			__('PORT TITLE BACKGROUND HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_background_hover','default'=>'#171717'),
			__('PORT INFO TOP BAR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_info_top_bar','default'=>'#b4b4b4'),
			__('BLOG TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_color','default'=>'#646464',
				'description'=>'This is the blog thumbnail title color except the blog in WIDGET style.'),
			__('BLOG TITLE HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_hover_color','default'=>'#646464',
				'description'=>'This is the blog thumbnail title color in "hover" state.'),
			__('BLOG INFO HEADER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_info_header_color','default'=>'#212121'),
			__('BLOG INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_info_color','default'=>'#9e9e9e',
				'description'=>"This is the blog informateion color. It's include the color of blog date, blog comments number and blog author."),
			__('BLOG ABOUT AUTHOR BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_about_author_color','default'=>'#f9f9f9',
				'description'=>'The author item is located in the blog page, you can enable/disable it using the post/portfolio options.'),
			__('PAGINATION NORMAL STATE', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_normal_state','default'=>'#f9f9f9',
				'description'=>'A paginaltion background color in non-hover and not-current page state.'),
		),			
		
		'gdl_panel_contact_form' => array(
			__('CONTACT FORM/COMMENT BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_background_color','default'=>'#ffffff',
				'description'=>'This is a background color of textbox and textarea in contact form and comments area.'),
			__('CONTACT FORM/COMMENT TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_text_color','default'=>'#888888',
				'description'=>'This is a text color of textbox and textarea in contact form and comments area.'),
			__('CONTACT FORM/COMMENT BORDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_border_color','default'=>'#cfcfcf'),
			__('CONTACT FORM/COMMENT FRAME COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_frame_color','default'=>'#f8f8f8'),
			__('CONTACT FORM/COMMENT INNER SHADOW', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_inner_shadow','default'=>'#ececec',
				'description'=>'An inner shadow of the textbox and textarea in contact form and comments area.'),
		),			
	
		'gdl_panel_stunning_text' => array(
			__('STUNNING TEXT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_title_color','default'=>'#333333'),
			__('STUNNING TEXT CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_caption_color','default'=>'#8c8c8c'),
			__('STUNNING TEXT BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_background_color','default'=>'#ffffff'),
			__('STUNNING TEXT BOTTOM BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_bottom_border','default'=>'#dddddd'),
			__('STUNNING TEXT BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_color','default'=>'#ffffff',
				'description'=>'If the button exists, this will be the text color of the button in stunning text item.'),
			__('STUNNING TEXT BUTTON BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_background','default'=>'#d2d2d2',
				'description'=>'If the button exists, this will be the background color of the button in stunning text item.'),
			__('STUNNING TEXT BUTTON TEXT COLOR HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_color_hover','default'=>'#efefef'),
			__('STUNNING TEXT BUTTON BACKGROUND HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_background_hover','default'=>'#171717'),				
		),	
		
		'gdl_panel_additional_elements' => array(
			__('DIVIDER LINE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_divider_line','default'=>'#ececec',
				'description'=>'This is the color of all divider inside the container( excluding divider of the footer ).'),
			__('DIVIDER ITEM BACK TO TOP TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_back_to_top_text_color','default'=>'#7c7c7c',
				'description'=>'This is the back to top text color of the divider item ( create from page items or shortcode ).'),		
			__('TAB BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_background_color','default'=>'#f5f5f5',
				'description'=>'This is the tab header background in "non-active" state.'),
			__('TAB TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_text_color','default'=>'#666666'),
			__('TAB ACTIVE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_active_background_color','default'=>'#ffffff',
				'description'=>'This is the tab header background in "active" state.'),		
			__('TAB ACTIVE TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_active_text_color','default'=>'#111111'),
			__('TAB BORDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_border_color','default'=>'#dddddd'),
			__('COLUMN SERVICE TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_title_color','default'=>'#3a3a3a',),
			__('TESTIMONIAL TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_text','default'=>'#848484'),
			__('TESTIMONIAL TEXT AUTHOR COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_author','default'=>'#494949'),
			__('TESTIMONIAL TEXT POSITION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_position','default'=>'#8d8d8d'),			
			__('BUTTON BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_background_color','default'=>'#f1f1f1',
				'description'=>'This color will changes all of the button background color in this theme except the button from shortcode and stunning text.'),			
			__('BUTTON BORDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_border_color','default'=>'#dedede',
				'description'=>'This color will changes all of the button border color in this theme except the button from shortcode and stunning text.'),			
			__('BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_text_color','default'=>'#7a7a7a',
				'description'=>'This color will changes all of the button text color in this theme except the button from shortcode and stunning text.'),			
			__('BUTTON TEXT HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_text_hover_color','default'=>'#7a7a7a',
				'description'=>'This color will changes all of the button text color of "hover" state in this theme except the button from shortcode and stunning text.'),			
		),
		
		'gdl_panel_price_item' => array(
			__('PRICE TEXT COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_price_color', 'default'=>'#3a3a3a',
				'description'=>'This color is the color of price at the top of price item with normal price.'),
			__('BEST PRICE TEXT COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_best_price_color', 'default'=>'#ef7f2c',
				'description'=>'This color is the color of price at the top of price item with best price.' . " It's also effect the top border of the best price item."),
			__('PRICE TITLE COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_price_title_color', 'default'=>'#3a3a3a',
				'description'=>'Price title is located below the price text. You can change it color as you want.'),
			__('BEST PRICE TITLE COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_best_price_title_color', 'default'=>'#ffffff',
				'description'=>'This color has effect to the best price title color( The price title is located below the price text. ).'),
			__('PRICE TITLE BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_price_title_background', 'default'=>'#e9e9e9'),
			__('BEST PRICE TITLE BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_best_price_title_background', 'default'=>'#5f5f5f'),
			__('PRICE ITEM BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_item_border', 'default'=>'#ececec',
				'description'=>'This color is the price item border color. This color will have no effects with best price item top border.'),
		),
		
		'gdl_panel_load_default_color' => array(
			__('LOAD DEFAULT ELEMENTS COLOR','gdl_back_office')=>array('type'=>'button','text'=>'Load Default','id'=>'gdl_load_default_color_button',
				'description'=>'Click this button to load the default elements color of this theme. Then click save changes to save the default value. <br><br> ' .
				'WARNING : All of settings cannot be undo after you click save changes button.')
		),
		
		// Translator
		'gdl_panel_enable_admin_translator' => array(
			__('ENABLE ADMIN TRANSLATOR', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_admin_translator')
		),
		
		'gdl_panel_blog_port_translator' => array(
			__('LEAVE A REPLY (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_leave_reply','default'=>'Leave a Reply'),
			__('ABOUT THE AUTHOR (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_about_author','default'=>'About the Author'),
			__('CONTINUE READING (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_continue_reading','default'=>'Read More'),
			__('SOCIAL SHARE (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_social_shares','default'=>'Social Share'),
			__('DATE (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_blog_date','default'=>'Date: '),
			__('BY (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_blog_by','default'=>'By: '),
			__('TAG (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_blog_tag','default'=>'Tag: '),
			__('COMMENT (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_blog_comment','default'=>'Comment: '),
			__('CLIENT (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_client','default'=>'Client'),
			__('READ MORE (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_read_more','default'=>'Read More'),
			__('VISIT WEBSITE (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_visit_website','default'=>'Visit Website'),
			__('VIEW ALL PROJECTS (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_view_all_project','default'=>'View All Projects →'),
			
		),
		
		'gdl_panel_contact_form_translator' => array(
			__('NAME (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_contact_form','default'=>'Name'),
			__('NAME ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_error_contact_form','default'=>'Please enter your name'),
			__('EMAIL (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_contact_form','default'=>'Email'),
			__('EMAIL ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_error_contact_form','default'=>'Please enter a valid email address'),
			__('MESSAGE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_contact_form','default'=>'Message'),
			__('MESSAGE ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_error_contact_form','default'=>'Please enter message'),
			__('SUBMIT BUTTON (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_submit_contact_form','default'=>'Submit'),
			__('SEND ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_error','default'=>'Message cannot be sent to destination'),
			__('SEND COMPLETE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_complete','default'=>'The e-mail was sent successfully'),
		),
		
		'gdl_panel_contact_widget_translator' => array(
			__('NAME (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_contact_widget','default'=>'Name'),
			__('EMAIL (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_contact_widget','default'=>'Email'),
			__('MESSAGE (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_contact_widget','default'=>'Message'),
			__('REQUIRE (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_require_contact_widget','default'=>'* Require'),
			__('PLEASE WAIT (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_please_wait_contact_widget','default'=>'Please Wait...'),
			__('SENDING COMPLETE (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_sending_complete_contact_widget','default'=>'Thanks! Your email was sent'),
			__('SUBMIT BUTTON (CONTACT WIDGET)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_submit_contact_widget','default'=>'Submit'),
		),

		'gdl_panel_additional_elements_translator' => array(
			__('READ MORE (PRICE ITEM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_read_more_price','default'=>'Read More'),
			__('404 TITLE (404 PAGE)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_404_title','default'=>'Sorry'),
			__('404 CONTENT (404 PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_404_content','default'=>"The page you are finding seem doesn't exist."),
			__('SEARCH NOT FOUND (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_search_not_found','default'=>"Sorry, but nothing matched your search criteria. Please try again with some different keywords."),
		),
		
		// Slider Setting
		'gdl_panel_nivo_slider' => array(
			__('SLIDER EFFECTS', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'oldname'=>'effect',
				'name'=>THEME_SHORT_NAME.'_nivo_slider_effect',
				'options'=>array(
					'0'=>'sliceDown', '1'=>'sliceDownLeft', '2'=>'sliceUp',
					'3'=>'sliceUpLeft', '4'=>'sliceUpDown', '5'=>'sliceUpDownLeft',
					'6'=>'fold', '7'=>'fade', '8'=>'random',
					'9'=>'slideInRight', '10'=>'slideInLeft', '11'=>'boxRandom',
					'12'=>'boxRain', '13'=>'boxRainReverse', '14'=>'boxRainGrow',
					'15'=>'boxRainGrowReverse')),
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_on_hover',
				'description'=>'Pause the nivo slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_bullets',
				'description'=>'Enable to show the nivo slider navigation bullets.'),
			__('SHOW LEFT/RIGHT NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_navigation',
				'description'=>'Enable left/right navigation of the nivo slider.'),
			__('ONLY SHOW NAVIGATION WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNavHide','name'=>THEME_SHORT_NAME.'_nivo_slider_hover_navigation',
				'description'=>'If the left/right navigation is enabled, enable this option will hide the left/right navigation when the mouse cursor is outside the nivo slider frame.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animSpeed','name'=>THEME_SHORT_NAME.'_nivo_slider_animation_speed','default'=>'500',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'pauseTime','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_time','default'=>'9000',
				'description'=>'This option is the pause time of each slider.'),
			__('CAPTION OPACITY', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'captionOpacity','name'=>THEME_SHORT_NAME.'_nivo_slider_caption_opacity','default'=>'0.8'),
		),
		
		'gdl_panel_flex_slider' => array(
			__('SLIDER EFFECTS', 'gdl_back_office')=>array('type'=>'combobox','oldname'=>'animation'
				,'name'=>THEME_SHORT_NAME.'_flex_slider_effect', 'options'=>array('0'=>'fade')),
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_hover','default'=>'disable',
				'description'=>'Pause the flex slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_bullets',
				'description'=>'Enable to show the flex slider navigation bullets.'),
			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_navigation',
				'description'=>'Enable left/right navigation of the flex slider.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationDuration','name'=>THEME_SHORT_NAME.'_flex_slider_animation_speed','default'=>'600',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'slideshowSpeed','name'=>THEME_SHORT_NAME.'_flex_slider_pause_time','default'=>'9000',
				'description'=>'This option is the pause time of each slider.'),
			__('PAUSE ON ACTION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnAction','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_action','default'=>'false'),
		),
		
		'gdl_panel_anything_slider' => array(
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_anything_slider_pause_on_hover',
				'description'=>'Pause the anything slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildNavigation','name'=>THEME_SHORT_NAME.'_anything_slider_show_bulltes',
				'description'=>'Enable to show the anything slider navigation bullets.'),
			__('ONLY SHOW BULLETS WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleControls','name'=>THEME_SHORT_NAME.'_anything_slider_hover_bulltes',
				'description'=>'If the bullets navigation is enabled, enable this option will hide the bullets navigation when the mouse cursor is outside the nivo slider frame.'),
			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildArrows','name'=>THEME_SHORT_NAME.'_anything_slider_show_navigation',
				'description'=>'Enable left/right navigation of the anything slider.'),
			__('ONLY SHOW NAVIGATION WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleArrows','name'=>THEME_SHORT_NAME.'_anything_slider_hover_navigation',
				'description'=>'If the left/right navigation is enabled, enable this option will hide the left/right navigation when the mouse cursor is outside the nivo slider frame.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationTime','name'=>THEME_SHORT_NAME.'_anything_slider_animation_speed','default'=>'600',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'delay','name'=>THEME_SHORT_NAME.'_anything_slider_pause_time','default'=>'9000',
				'description'=>'This option is the pause time of each slider.'),
		)
		
	);
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_goodlayers_panel');
	function add_goodlayers_panel(){
	
		$page = add_menu_page('GoodLayers Option', THEME_FULL_NAME, 'administrator', plugin_basename(__FILE__), 'create_goodlayers_panel' /*,  GOODLAYERS_PATH.'/include/images/portfolio-icon.png' */);
		
		add_action('admin_print_scripts-' . $page,'register_goodlayers_panel_scripts');
		add_action('admin_print_styles-' . $page,'register_goodlayers_panel_styles');
		
	}
	
	// add ajax action to hook the functions when save button is pressed 
	add_action('wp_ajax_save_goodlayers_panel','save_goodlayers_panel');
	function save_goodlayers_panel(){
	
		check_ajax_referer(plugin_basename(__FILE__),'security');
		
		global $goodlayers_element;
		
		foreach($goodlayers_element as $elements){
		
			foreach($elements as $element){
			
				// when save sidebar
				if($element['type'] == 'sidebar'){
				
					$sidebar_xml = '<sidebar>';
					$sidebar = $_POST[$element['name']];
					
					foreach($sidebar as $sidebar_name){
					
						$sidebar_xml = $sidebar_xml . create_xml_tag('name',$sidebar_name);
						
					}
					
					$sidebar_xml = $sidebar_xml . '</sidebar>';
					
					if(!save_option($element['name'], get_option($element['name']), $sidebar_xml)){
					
						die('-1');
						
					}
					
				// when save uploaded font
				}else if($element['type'] == 'uploadfont'){
				
					$uploadfont_xml = '<uploadfont>';
					$uploadfont = $_POST[$element['name']];
					$uploadfont_file = $_POST[$element['file']];
					$num = sizeof($uploadfont);
					
					for($i=0; $i<$num; $i++){
					
						$uploadfont_xml = $uploadfont_xml . '<font>';
						$uploadfont_xml = $uploadfont_xml . create_xml_tag('name', $uploadfont[$i]);
						$uploadfont_xml = $uploadfont_xml . create_xml_tag('file', $uploadfont_file[$i]);
						$uploadfont_xml = $uploadfont_xml . '</font>';
						
					}
					
					$uploadfont_xml = $uploadfont_xml . '</uploadfont>';
					
					if(!save_option($element['name'], get_option($element['name']), $uploadfont_xml)){
					
						die('-1');
						
					}
					
				// do nothing with dummy button
				}else if($element['type'] == 'dummy'){
				
				}else {
					$new_option_value = str_replace( "\'" , "'", $_POST[$element['name']]);
					$new_option_value = str_replace( '\"' , '"', $new_option_value);
					$new_option_value = str_replace( '\\\\' , '\\' , $new_option_value);
					
					if(!save_option($element['name'], get_option($element['name']), $new_option_value)){
					
						die('-1');
						
					}
					
				}
				
			}
			
		}
		
		die('0');
		
	}
	
	// update the option if new value is exists and not equal to old one 
	function save_option($name, $old_value, $new_value){
	
		if(empty($new_value) && !empty($old_value)){
		
			if(!delete_option($name)){
			
				return false;
				
			}
			
		}else if($old_value != $new_value){
		
			if(!update_option($name, $new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	// start creating the goodlayers panel ( by calling function to create menu and elements )
	function create_goodlayers_panel(){
	
		global $goodlayers_menu;
		global $goodlayers_element;		
		
		?>
		
		<form name="goodlayer-panel-form" id="goodlayer-panel-form">
			<div class="goodlayers-panel-wrapper">
			<?php
				
				echo '<div class="panel-menu">';
				echo '<div class="panel-menu-header"><div class="panel-menu-header-strap"></div>';
				echo '<img src="' . GOODLAYERS_PATH . '/include/images/admin-panel-logo.png" alt="goodlayers"/>';
				echo '</div>';
				
					create_goodlayers_menu($goodlayers_menu);
					
				echo '</div>';
				echo '<div class="panel-elements" id="panel-elements">';
				echo '<div class="panel-element-head"><div class="panel-element-header-strap"></div>';
				
				echo '<div class="panel-header-left-text">';
				echo '<div class="panel-goodlayers-text">goodlayers</div>';
				echo '<div class="panel-admin-panel-text">admin panel</div>';
				echo '</div>';
				
				echo '<div class="head-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';
				echo '</div>';	
				echo '</div>';	
				
				echo '<div class="panel-element" id="panel-element-save-complete">';
				echo '<div class="panel-element-save-text">Save Options Complete.</div>';
				echo '<div class="panel-element-save-arrow"></div></div>';
			
					create_goodlayers_elements($goodlayers_element);
				
				echo '<div class="panel-element-tail">';
				echo '<div class="tail-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';
				echo '</div>';						
				echo '</div>';						
				echo '<input type="hidden" name="action" value="save_goodlayers_panel">';
				echo '<input type="hidden" name="security" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '">';
				echo '</div>';	
				
			?>

			</div>
		</form>
		
		<?php
	}
	
	// Create accordion menu
	function create_goodlayers_menu($menu){
	
		echo '<div id="panel-nav"><ul>';
		
		foreach($menu as $title=>$sub_menu){ 
		
			echo '<li>';
			echo '<a id="parent" href="#" >';
			echo '<div class="top-menu-bar"></div>';
			echo '<div class="top-menu-image"><img src="' . GOODLAYERS_PATH . '/include/images/admin-panel/' . str_replace(' ', '', $title) . '.png"/></div>';
			echo '<span class="top-menu-text">' . __($title, 'gdl_back_office') . '</span>';
			echo '</a>';
			echo '<ul>';
			
			foreach($sub_menu as $sub_title=>$name){
			
				echo '<li>';
				echo '<a id="children" href="#" rel=' . $name . '>';
				echo '<div class="child-menu-image"></div>';
				echo '<span class="child-menu-text">' . __($sub_title, 'gdl_back_office') . '</span>';
				echo '</a>';
				echo '</li>';
				
			}
			
			echo '</ul>';
			echo '</li>';
			
		}
		
		echo '</ul></div>';
		
	}
	
	// decide to create each input element base on the receiving key of elements
	function create_goodlayers_elements($elements){
	
		foreach($elements as $key => $element){
		
			echo '<div class="panel-element" id=' . $key . '>';

				foreach($element as $key => $values){
				
					if( !empty($values['name']) ){
						$values['value'] = get_option($values['name']);
						$values['default'] = (isset($values['default']))? $values['default']: '';
					}
					
					switch($values['type']){
					
						case 'upload': print_panel_upload($key, $values); break;
						case 'inputtext': print_panel_input_text($key, $values); break;
						case 'textarea': print_panel_input_textarea($key, $values); break;
						case 'radioenabled': print_panel_radio_enabled($key, $values); break;
						case 'radioimage' : print_panel_radioimage($key, $values); break;
						case 'combobox': print_panel_combobox($key, $values); break;
						case 'font-combobox': print_panel_font_combobox($key, $values); break;
						case 'colorpicker': print_panel_color_picker($key, $values); break;
						case 'sliderbar': print_panel_sliderbar($key, $values); break;
						case 'sidebar': print_panel_sidebar($key, $values); break;
						case 'uploadfont': print_panel_upload_font($key, $values); break;
						case 'button': print_panel_button($key, $values); break;
						case 'dummy': print_panel_dummy(); break;
						
					}
					
				}
			
			echo '</div>';
			
		}
		
	}
	
	/*  ---------------------------------------------------------------------
	*	The following section is the template of input elements
	*	---------------------------------------------------------------------
	*/
	
	// Upload => name, value, default
	function print_panel_upload($title, $values){
	
		extract($values);
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">	
					<div class="input-example-image" id="input-example-image">
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){ 
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$image_src = (empty($image_src))? '': $image_src[0];
							$thumb_src_preview = wp_get_attachment_image_src( $value, '150x150');
							echo '<img src="' . $thumb_src_preview[0] . '" />';
							
						} 
						
					?>			
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
					
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_image_text" class="upload_image_text" type="text" value="<?php echo $image_src; ?>" />
					<input class="upload_image_button" type="button" value="Upload" />
				</div>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// text => name, value, default
	function print_panel_input_text($title, $values){
	
		extract($values);
		
		?>
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
						 ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	
	}
	
	// textarea => name, value, default
	function print_panel_input_textarea($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">
					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" ><?php
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// radioenabled => name, value
	function print_panel_radio_enabled($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">
					<label for="<?php echo $name; ?>"><div class="checkbox-switch <?php
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

					?>"></div></label>
					<input type="checkbox" name="<?php echo $name; ?>" class="checkbox-switch" value="disable" checked>
					<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="checkbox-switch" value="enable" <?php 
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checked': ''; 
					
					?>>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	function print_panel_radioimage($title, $values){
		
		extract($values);
		
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
		
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-radioimage">
				
					<?php foreach( $options as $option ){ ?>
					
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo GOODLAYERS_PATH.$option['image']?> alt=<?php echo $name;?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value'];?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>" > 
						</div>
						
					<?php } ?>
					<br class="clear">	
				</div>
			</div>		
		
		<?php
		
	}
	
	// combobox => name, value, options[]
	function print_panel_combobox($title, $values){
	
		extract($values);
		
		if( empty($body) ) $body = "";
		if( empty($id) ) $id = $name;
		
		?>
		
			<div class="panel-body <?php echo $body; ?>">	
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
						
							<?php foreach($options as $option){ ?>
							
								<option <?php if( $option == esc_html($value) ){ echo 'selected'; }?>><?php echo $option; ?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// font-combobox => name, value, options[]
	function print_panel_font_combobox($title, $values){
	
		extract($values);
		if(empty($value)){ $value = $default; } 
		$elements = get_font_array();
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 
					<div class="combobox" id="combobox-font-sample">
						<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="gdl-panel-select-font-family">
						
							<?php foreach($elements as $option_name => $status){ ?>
							
								<option <?php if( $option_name==substr(esc_html($value),2) ){ echo 'selected'; }?> <?php echo $status; ?>><?php 
										
										echo ($status=='enabled')?  '- ':'';
										echo $option_name; 
									
									?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// colorpicker => name, value, default
	function print_panel_color_picker($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" class="color-picker" value="<?php 
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
						?>" default="<?php echo $default; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	}
	
	// sliderbar => name, value, default
	function print_panel_sliderbar($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<div id="<?php echo $name; ?>" class="sliderbar" rel="sliderbar"></div>
					<input type="hidden" name="<?php echo $name; ?>" value="<?php echo ($value == '')? esc_html($default): esc_html($value); ?>" >
					<div id="slidertext"><?php echo ($value == '')? esc_html($default): esc_html($value); ?> px</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// sidebar => name, value
	function print_panel_sidebar($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title">
				<label> <?php _e($title, 'gdl_back_office'); ?> </label>
			</div>
			<div class="panel-input">
				<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
				<div id="add-more-sidebar" class="add-more-sidebar"></div>
			</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
			<br class="clear">
			<div id="selected-sidebar" class="selected-sidebar">
				<div class="default-sidebar-item" id="sidebar-item">
					<div class="panel-delete-sidebar"></div>
					<div class="slider-item-text"></div>
					<input type="hidden" id="<?php echo $name; ?>">
				</div>
				
				<?php 
				
				if(!empty($value)){
					
					$xml = new DOMDocument();
					$xml->loadXML($value);
					
					foreach( $xml->documentElement->childNodes as $sidebar_name ){
					
				?>
						<div class="sidebar-item" id="sidebar-item">
							<div class="panel-delete-sidebar"></div>
							<div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>
							<input type="hidden" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo $sidebar_name->nodeValue; ?>">
						</div>
					
				<?php 
					} 
					
				} 
				
				?>
				
			</div>
		</div>
		<?php 
		
	}
	
	// uploadfont => name, value
	function print_panel_upload_font($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title panel-add-more-title">
				<?php _e($title, 'gdl_back_office'); ?>
			</div>
			<div id="add-more-font" class="add-more-font"></div>
			<br class="clear">
			<div id="added-font" class="added-font">
				<div class="default-font-item" id="font-item">
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>
						<input type="text" id="<?php echo $name; ?>" class="gdl_upload_font_name" readonly>
					</div>
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>
						<input type="hidden" id="<?php echo $file; ?>"  class="font-attachment-id">
						<input type="text" class="upload-font-text" readonly>
						<input class="upload-font-button" type="button" value="Upload" />
					</div>
					<div class="panel-delete-font"></div>
				</div>
				<?php 
				
					if(!empty($value)){
						
						$xml = new DOMDocument();
						$xml->loadXML($value);
						
						foreach( $xml->documentElement->childNodes as $each_font ){
						
				?>
				
					<div class="font-item" id="font-item">
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>
							<input type="text" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo find_xml_value($each_font, 'name'); ?>" class="gdl_upload_font_name" readonly>
						</div>
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>
							<input type="hidden" name="<?php echo $file; ?>[]" id="<?php echo $file; ?>" class="font-attachment-id" value="<?php 
									$attachment_id = find_xml_value($each_font, 'file'); 
									echo $attachment_id;
								?>" >
							<input type="text" class="upload-font-text" value="<?php echo (empty($attachment_id))? '': wp_get_attachment_url( $attachment_id ); ?>" readonly>
							<input class="upload-font-button" type="button" value="Upload" />
						</div>
						<div class="panel-delete-font"></div>
					</div>
					
				<?php 
				
						}
						
					}
					
				?>
				
			</div>
		</div>
		<?php
		
	}
	
	// print normal button
	function print_panel_button($title, $values){
	
		extract($values);
	
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="button" value="<?php echo $text; ?>" id="<?php echo $id; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>		
		
		<?php	
	}
	
	// upload dummy data (from xml file)
	function print_panel_dummy(){
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> DUMMIES DATA </label>
				</div>
				<div class="panel-input">
					<input type="button" value="Import Dummies Data" id="import-dummies-data" />
					<div id="import-now-loading" class="now-loading"></div>
				</div>
				<div class="panel-description">
					By clicking this button, you can import the dummy post and page to help 
					you create a site that look like theme preview to help you understand the
					function of this theme better. <br><br>
					*** It may takes a while during importing process, make sure not to reload
					the page or make any changes to the database.
				</div>
				<div class="panel-description-info-img"></div>
				<br class="clear">
			</div>		
		
		<?php
	}
?>