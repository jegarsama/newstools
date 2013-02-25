<?php
/**
 * Template Name: 6.마이페이지 - 회원정보수정
 */

get_header();

?>
	<?php

		$sidebar = get_post_meta($post->ID,'page-option-sidebar-template',true);
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}

	?>
	<div class="content-wrapper <?php echo $sidebar_class; ?>">

		<div class="page-wrapper">
			<?php
				// Top Slider Part
				global $gdl_top_slider_type, $gdl_top_slider_xml;
				if ($gdl_top_slider_type != "No Slider" && $gdl_top_slider_type != ''){
					echo print_item_size('element1-1', 'mb0');

						$slider_xml = "<Slider>" . create_xml_tag('size', 'full-width');
						$slider_xml = $slider_xml . create_xml_tag('height', get_post_meta( $post->ID, 'page-option-top-slider-height', true) );
						$slider_xml = $slider_xml . create_xml_tag('width', 940);
						$slider_xml = $slider_xml . create_xml_tag('slider-type', $gdl_top_slider_type);
						$slider_xml = $slider_xml . $gdl_top_slider_xml;
						$slider_xml = $slider_xml . "</Slider>";
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						print_slider_item($slider_xml_dom->documentElement);

					echo "</div>";
				}

				$left_sidebar = get_post_meta( $post->ID , "page-option-choose-left-sidebar", true);
				$right_sidebar = get_post_meta( $post->ID , "page-option-choose-right-sidebar", true);

				// Page title and content
				$gdl_show_title = get_post_meta($post->ID, 'page-option-show-title', true);
				$gdl_show_content = get_post_meta($post->ID, 'page-option-show-content', true);
				if ( $gdl_show_title != "No" ){
						echo '<div class="sixteen columns mb0">';
						echo '<div class="gdl-page-title-wrapper">';
						echo '<h1 class="gdl-page-title gdl-title title-color">';
						the_title();
						echo '</h1>';
						echo '<div class="gdl-page-caption">';
						echo get_post_meta($post->ID, 'page-option-caption', true);
						echo '</div>';
						echo '<div class="gdl-page-title-left-bar"></div>';
						echo '<div class="clear"></div>';
						echo '</div>'; // gdl-page-title-wrapper
						echo '</div>'; // sixteen columns
				}

				echo "<div class='gdl-page-float-left'>";

				echo "<div class='gdl-page-item'>";

				// print the page content
				while (have_posts()){ the_post();
					$content = get_the_content();
					if( $gdl_show_content != 'No' && !empty( $content ) ){
						echo '<div class="sixteen columns mt0">';
						echo '<div class="gdl-page-content">';
						the_content();
						echo '</div>';
						echo '</div>';
					}
				}



				//게시판 출력용 영역 - STR
				echo '<div class="imercury-board-content">';
					define( 'NEW_IMERCURY_DIR', ABSPATH . 'imercury' );
					require_once( NEW_IMERCURY_DIR . '/include/connect.php' );
					require_once( NEW_IMERCURY_DIR . '/include/func.php' );

					//로그인 상태체크 모듈
					include( NEW_IMERCURY_DIR . '/member/login_chk.php' );

					$code = "";	//DB테이블
					$skin = "member";	//SKIN폴더
					define( 'BOARDSKINPATH', '/WP/imercury/' . $skin );

					switch( $_POST[mode] )
					{
						case 'req':
							$tempsql = "select count(*) from member_tbl where email1='".$_POST[email1]."' and email2='".$_POST[email2]."' and userid<>'".$_COOKIE[mid]."'";
							$emailexist	= $db->query_one($tempsql);
							if(!$_POST[email1] || !$_POST[email2] || ($emailexist > 0) ){
								err_back("이미 사용중인 이메일 입니다.");
							}

							$birthday = $bir_y."-".$bir_m."-".$bir_d;
							$today = date("Y/m/d");
							$sql = "update member_tbl set pwd = '$_POST[pwd]', birthday = '$_POST[birthday]', bir_chk = '$_POST[bir_chk]', tel1 = '$_POST[tel1]', tel2 = '$_POST[tel2]', tel3 = '$_POST[tel3]', hp1 = '$_POST[hp1]', hp2 = '$_POST[hp2]', hp3 = '$_POST[hp3]', email1 = '$_POST[email1]', email2 = '$_POST[email2]', zip1 = '$_POST[zip1]', zip2 = '$_POST[zip2]', addr1 = '$_POST[addr1]', addr2 = '$_POST[addr2]', job = '$_POST[job]', email_chk = '$_POST[email_chk]', pwd_q = '$_POST[pwd_q]', pwd_a = '$_POST[pwd_a]', gaip_corse = '$_POST[gaip_corse]', ga = '$_POST[ga]' where userid = '$_COOKIE[mid]'";
							$db->execute($sql);
							err_move("회원정보가 수정되었습니다.","mypage");
							break;

						default:
							include( NEW_IMERCURY_DIR . '/' . $skin . '/mypage.php' );
							break;
					}
				echo '</div>';
				//게시판 출력용 영역 - END



				global $gdl_item_row_size;
				$gdl_item_row_size = 0;
				// Page Item Part
				if(!empty($gdl_page_xml)){
					$page_xml_val = new DOMDocument();
					$page_xml_val->loadXML($gdl_page_xml);
					foreach( $page_xml_val->documentElement->childNodes as $item_xml){
						switch($item_xml->nodeName){
							case 'Accordion' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_accordion_item($item_xml);
								break;
							case 'Blog' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper mb10');
								print_blog_item($item_xml);
								break;
							case 'Contact-Form' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_contact_form($item_xml);
								break;
							case 'Column':
								print_item_size(find_xml_value($item_xml, 'size'));
								print_column_item($item_xml);
								break;
							case 'Column-Service' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_column_service($item_xml);
								break;
							case 'Content' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_content_item($item_xml);
								break;
							case 'Divider' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_divider($item_xml);
								break;
							case 'Gallery' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper');
								print_gallery_item($item_xml);
								break;
							case 'Message-Box' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_message_box($item_xml);
								break;
							case 'Page':
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper gdl-portfolio-item');
								print_page_item($item_xml);
								break;
							case 'Price-Item':
								print_item_size(find_xml_value($item_xml, 'size'), 'gdl-price-item');
								print_price_item($item_xml);
								break;
							case 'Portfolio' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper gdl-portfolio-item mb0');
								print_portfolio($item_xml);
								break;
							case 'Slider' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_slider_item($item_xml);
								break;
							case 'Stunning-Text' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_stunning_text($item_xml);
								break;
							case 'Tab' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_tab_item($item_xml);
								break;
							case 'Testimonial' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper');
								print_testimonial($item_xml);
								break;
							case 'Toggle-Box' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_toggle_box_item($item_xml);
								break;
							default:
								print_item_size(find_xml_value($item_xml, 'size'));
								break;
						}
						echo "</div>";
					}
				}
				echo "</div>"; // end of gdl-page-item

				get_sidebar('left');

				echo "</div>"; // gdl-page-float-left

				get_sidebar('right');

			?>

			<br class="clear">
		</div>
	</div> <!-- content-wrapper -->

<?php get_footer(); ?>