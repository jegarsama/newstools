<?php
/**
 * Login Check 용도 - 대리점 권한체크 포함
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );

if(!$_COOKIE[mid]){
	foreach($_POST as $a => $b){
		$etc_url .= "&".$a."=".$b;
	}
	foreach($_GET as $a => $b){
		$etc_url .= "&".$a."=".$b;
	}
	err_move("회원전용 페이지입니다.","/login?r_url=" . urlencode(get_page_link($post->ID) . (($etc_url=='') ? '' : '?' . $etc_url) ));
}

if($_COOKIE[role]<1){
	err_back("대리점 전용 페이지입니다.");
}
?>