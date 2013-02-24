<?php
/**
 * Template Name: 6.마이페이지 - 회원탈퇴신청
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



				//게시판 출력용 영역 - STR		http://imercury2012.cafe24.com/imercury/jsp/mypage/mem_tal.php
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
							$email = $_POST[email1]."@".$_POST[email2];

							//$mailheaders  = "Return-Path: ".$_POST[email].";";
							//$mailheaders .= "Reply-To: ".$_POST[email].";";
							$mailheaders .= "from: ".$_POST[name_user]." <".$email.">;"; // from 과 : 은 붙여주세요 => from:
							//$mailheaders .= "Content-Type: text/html; charset=utf-8";

							$content = stripslashes($_POST[contents]);
							$content = nl2br(htmlspecialchars($content));

							$sql = "select * from admin_tbl where admin_id='u-mercury'";
							$info = $db->query($sql);
							$TO = $info[email];
							//$TO = "master@newstools.kr";

							$main  = "이름 : ".$_POST[name_user]."<br>";
							$main .= "아이디 : ".$_POST[uid]."<br>";
							$main .= "메일 : ".$_POST[email1]."@".$_POST[email2]."<br>";
							$main .= "연락처 : ".$_POST[tel]."<br>";
							$main .= "탈퇴사유 : ".$_POST[content]."<br>";
							$title = "탈퇴신청입니다.";
							mail($TO,$title,$main,$mailheaders);

							err_move("탈퇴신청이 접수되었습니다. \\n관리자가 확인 후 처리해드립니다.","6-%EB%A7%88%EC%9D%B4%ED%8E%98%EC%9D%B4%EC%A7%80-%ED%9A%8C%EC%9B%90%ED%83%88%ED%87%B4%EC%8B%A0%EC%B2%AD");
							break;

						default:
							include( NEW_IMERCURY_DIR . '/' . $skin . '/tal.php' );
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