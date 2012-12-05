<?php
/**
 * Login Check 용도
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );

if(!$_COOKIE[mid]){
	foreach($_POST as $a => $b){
		$etc_url .= "&".$a."=".$b;
	}
	foreach($_GET as $a => $b){
		$etc_url .= "&".$a."=".$b;
	}
	err_move("회원전용 페이지입니다.","/login?r_url=" . urlencode($post->post_name . '?' . $etc_url));
}
?>