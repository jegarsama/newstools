<?php
/**
 * Login Check 용도 - 로그인이 되어있지 않아야 하는 페이지용
**/
require_once( NEW_IMERCURY_DIR . '/include/func.php' );

if($_COOKIE[mid]){
	err_back("이미 로그인이 되어있습니다.");
}
?>